<?php

namespace common\models\orders;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property string $id
 * @property string $id_order
 * @property string $id_item
 * @property string $item_name
 * @property string $id_item_category
 * @property string $c_name
 * @property string $item_color
 * @property string $height
 * @property integer $quantity
 * @property string $unit_price
 * @property string $total_price
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Category $idCategory
 * @property Order $idOrder
 * @property Item $idItem
 * @property Item[] $items
 * @property Category $idItemCategory
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_order', 'id_item', 'item_name', 'id_item_category', 'c_name', 'item_color', 'height', 'unit_price', 'total_price', 'created_at', 'updated_at'], 'required'],
            [['id_order', 'id_item', 'id_item_category', 'quantity', 'created_at', 'updated_at'], 'integer'],
            [['height', 'unit_price', 'total_price'], 'number'],
            [['item_name', 'c_name', 'item_color'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('orders/item', 'ID'),
            'id_order' => Yii::t('orders/item', 'Id Order'),
            'id_item' => Yii::t('orders/item', 'Id Item'),
            'item_name' => Yii::t('orders/item', 'Item Name'),
            'id_item_category' => Yii::t('orders/item', 'Id Item Category'),
            'c_name' => Yii::t('orders/item', 'C Name'),
            'item_color' => Yii::t('orders/item', 'Item Color'),
            'height' => Yii::t('orders/item', 'Height'),
            'quantity' => Yii::t('orders/item', 'Quantity'),
            'unit_price' => Yii::t('orders/item', 'Unit Price'),
            'total_price' => Yii::t('orders/item', 'Total Price'),
            'created_at' => Yii::t('orders/item', 'Created At'),
            'updated_at' => Yii::t('orders/item', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOrder()
    {
        return $this->hasOne(Order::className(), ['id_customer' => 'id_order']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'id_item']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id_item' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdItemCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_item_category']);
    }

}
