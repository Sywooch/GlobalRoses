<?php
/**
 * Project GlobalRoses
 * File ReferenceBehavior.php
 * @author Andreas Kondylis
 * @version 0.1
 * Date 11/13/14 8:29 PM
 */
namespace common\components;

use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

/**
 * Class ReferenceBehavior
 * @package common\components
 * @author Andreas Kondylis
 * @version 0.1
 */
class ReferenceBehavior extends AttributeBehavior
{

    public $referenceAttribute = 'reference';

    public $value;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => $this->referenceAttribute
            ];
        }
    }


    /**
     * @inheritdoc
     */
    protected function getValue($event)
    {
        if ($this->value instanceof Expression) {
            return $this->value;
        } else {
            return $this->value !== null ? call_user_func($this->value, $event) : 'test1';
        }
    }

    /**
     * Updates a timestamp attribute to the current timestamp.
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