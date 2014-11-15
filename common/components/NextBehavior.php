<?php
/**
 * Project GlobalRoses
 * File NextBehavior.php
 * @author Andreas Kondylis
 * @version 0.1
 * Date 11/13/14 8:29 PM
 */
namespace common\components;

use yii\behaviors\AttributeBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class NextBehavior
 * @package common\components
 * @author Andreas Kondylis
 * @version 0.1
 */
class NextBehavior extends AttributeBehavior
{

    const EVENT_GET_NEXT = 'getnext';

    public $nextAttribute = 'id';

    public $value;

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            self::EVENT_GET_NEXT => 'getNext',
        ];
    }

    public function getNext($event)
    {
        return $this->getValue(null);
    }

    /**
     * @inheritdoc
     */
    protected function getValue($event)
    {
        if ($this->value instanceof Expression) {
            return $this->value;
        } else {

            $nextAttribute = $this->owner->{$this->nextAttribute};

            $next_row = $this->owner->find()->where('id>:id')->
            params([':id' => $nextAttribute])->orderBy(['id' => SORT_ASC])->one();
            if (is_null($next_row)) {
                $next_row = $this->owner->find()->where('id>:id')->
                params([':id' => $nextAttribute])->orderBy(['id' => SORT_DESC])->one();
            }

            if (is_null($next_row)) {
                return null;
            }
            $nextAttribute = $next_row->id;
            return $nextAttribute;
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