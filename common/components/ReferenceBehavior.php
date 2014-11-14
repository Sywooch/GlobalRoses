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
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

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
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeCreate',
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeCreate($event)
    {
        $this->owner->{$this->referenceAttribute} = $this->getValue(null);
    }

    /**
     * @inheritdoc
     */
    protected function getValue($event)
    {
        if ($this->value instanceof Expression) {
            return $this->value;
        } else {
            $reference_value = $this->owner->{$this->referenceAttribute};
            $existing_reference = ArrayHelper::map(
                $this->owner->find()->all(), 'id', $this->referenceAttribute);

            $is_null = ($reference_value == null);
            $exists = in_array($reference_value, $existing_reference);
            while ($is_null || $exists) {
                $reference_value = uniqid();
                $is_null = ($reference_value == null);
                $exists = in_array($reference_value, $existing_reference);
            }
            return $reference_value;
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
        $this->owner->updateAttributes(array_fill_keys((array)$attribute,
            $this->getValue(null)));
    }
}