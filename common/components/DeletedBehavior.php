<?php
/**
 * Project GlobalRoses
 * File DeletedBehavior.php
 * @author Andreas Kondylis
 * @version 0.1
 * Date 11/13/14 8:29 PM
 */
namespace common\components;

use yii\db\BaseActiveRecord;
use yii\db\Expression;
use yii\behaviors\AttributeBehavior;

/**
 * Class DeletedBehavior
 * @package common\components
 * @author Andreas Kondylis
 * @version 0.1
 */
class DeletedBehavior extends AttributeBehavior
{

    const DELETED_YES = '1';

    const DELETED_NO = '0';

    public $attribute = 'deleted';

    public $value;
    /**
     * @var bool If true, this behavior will process '$model->delete()' as a soft-delete. Thus, the
     *           only way to truly delete a record is to call '$model->forceDelete()'
     */
    public $safeMode = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => $this->attribute,
                BaseActiveRecord::EVENT_BEFORE_DELETE => $this->attribute,
            ];
        }
    }

    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_INSERT => 'insert',
            BaseActiveRecord::EVENT_BEFORE_DELETE => 'disable',
        ];
    }

    public function insert($event)
    {
        $attribute = $this->attribute;
        $this->owner->$attribute = $this->getValue($event);
    }

    public function disable($event)
    {
        // do nothing if safeMode is disabled. this will result in a normal deletion
        if (!$this->safeMode) {
            return;
        }

        // remove and mark as invalid to prevent real deletion
        $this->_disable();
        $event->isValid = false;
    }

    protected function _disable()
    {
        $attribute = $this->attribute;
        $this->owner->$attribute = self::DELETED_YES;
        $this->owner->save(false, [$attribute]);
    }

    protected function restore()
    {
        $attribute = $this->attribute;
        $this->owner->$attribute = self::DELETED_NO;
        $this->owner->save(false, [$attribute]);
    }

    /**
     * Delete record from database regardless of the $safeMode attribute
     */
    public function forceDelete()
    {
        // store model so that we can detach the behavior and delete as normal
        $model = $this->owner;
        $this->detach();
        $model->delete();
    }

    /**
     * @inheritdoc
     */
    protected function getValue($event)
    {
        if ($this->value instanceof Expression) {
            return $this->value;
        } else {
            return $this->value !== null ? call_user_func($this->value, $event) : static::DELETED_NO;
        }
    }

    /**
     * Updates the deleted attribute to the current value.
     *
     * ```php
     * $model->touch('reference');
     * ```
     * @param string $attribute the name of the attribute to update.
     */
    public function touch($attribute)
    {
        $this->owner->updateAttributes(array_fill_keys((array)$attribute, $this->getValue(null)));
    }
}