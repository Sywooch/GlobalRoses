<?php
/**
 * Project GlobalRoses
 * File SoftDeleteBehavior.php
 * @author Andreas Kondylis
 * @version 0.1
 * Date 11/13/14 8:29 PM
 */
namespace common\components;

use yii\db\BaseActiveRecord;
use yii\behaviors\AttributeBehavior;

/**
 * Class SoftDeleteBehavior
 * @package common\components
 * @author Andreas Kondylis
 * @version 0.1
 */
class SoftDeleteBehavior extends AttributeBehavior
{

    const DELETED_YES = '1';

    const DELETED_NO = '0';

    public $attributeDeleted = 'deleted';

    public $attributeTimestamp = 'deleted_at';

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
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->attributeDeleted, $this->attributeTimestamp],
                BaseActiveRecord::EVENT_BEFORE_DELETE => [$this->attributeDeleted, $this->attributeTimestamp],
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
        $attributeDeleted = $this->attributeDeleted;
        $attributeTimestamp = $this->attributeTimestamp;
        $this->owner->$attributeDeleted = self::DELETED_NO;
        $this->owner->$attributeTimestamp = 0;
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
        $attributeDeleted = $this->attributeDeleted;
        $attributeTimestamp = $this->attributeTimestamp;
        $this->owner->$attributeDeleted = self::DELETED_YES;
        $this->owner->$attributeTimestamp = time();
        $this->owner->save(false, [$attributeDeleted, $attributeTimestamp]);
    }

    protected function restore()
    {
        $attributeDeleted = $this->attributeDeleted;
        $attributeTimestamp = $this->attributeTimestamp;
        $this->owner->$attributeDeleted = self::DELETED_NO;
        $this->owner->$attributeTimestamp = 0;
        $this->owner->save(false, [$attributeDeleted, $attributeTimestamp]);
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
}
