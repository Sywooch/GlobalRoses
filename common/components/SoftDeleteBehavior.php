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
use yii\db\Expression;
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

    public $attribute = 'deleted';

    public $timestamp = 'deleted_at';

    /**
     * @var bool If true, this behavior will process '$model->delete()' as a soft-delete. Thus, the
     *           only way to truly delete a record is to call '$model->forceDelete()'
     */
    public $safeMode = true;

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
        $timestamp = $this->timestamp;
        $this->owner->$attribute = self::DELETED_NO;
        $this->owner->$timestamp = 0;
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
        $timestamp = $this->timestamp;
        $this->owner->$attribute = self::DELETED_YES;
        $this->owner->$timestamp = time();
        $this->owner->save(false, [$attribute, $timestamp]);
    }

    protected function restore()
    {
        $attribute = $this->attribute;
        $timestamp = $this->timestamp;
        $this->owner->$attribute = self::DELETED_NO;
        $this->owner->$timestamp = 0;
        $this->owner->save(false, [$attribute, $timestamp]);
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