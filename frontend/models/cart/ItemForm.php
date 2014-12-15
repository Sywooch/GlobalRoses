<?php
namespace frontend\models;

use common\models\Item;
use yii\base\Model;
use Yii;

/**
 * Cart Item form
 */
class ItemForm extends Model
{
    public $id_item;
    public $requested_quantity;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_item', 'requested_quantity'], 'required'],
            [['id_item', 'requested_quantity'], 'integer'],
            ['requested_quantity', 'min' => 1],
            ['id_item', 'validateItemId'],
        ];
    }

    public function validateItemId($attribute, $params)
    {
        $id = $this->{$attribute};
        $item = Item::findOne(['id' => $id]);
        if (is_null($item)) {
            $this->addError($attribute, 'item does not exists');
        }
    }

}
