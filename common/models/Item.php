<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property string $id
 * @property string $name
 * @property string $reference
 * @property string $image
 * @property string $description
 * @property string $description_short
 * @property string $id_category
 * @property integer $quantity
 * @property string $height
 * @property string $weight
 * @property integer $id_color
 * @property integer $available
 * @property string $status
 * @property string $unit_price
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Category $idCategory
 * @property Color $idColor
 * @property OrderItem[] $orderItems
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'reference', 'image', 'description', 'created_at', 'updated_at'], 'required'],
            [['image', 'description', 'status'], 'string'],
            [['id_category', 'quantity', 'id_color', 'available', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['height', 'weight', 'unit_price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['reference'], 'string', 'max' => 50],
            [['description_short'], 'string', 'max' => 100],
            [['reference'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('item', 'ID'),
            'name' => Yii::t('item', 'Name'),
            'reference' => Yii::t('item', 'Reference'),
            'image' => Yii::t('item', 'Image'),
            'description' => Yii::t('item', 'Description'),
            'description_short' => Yii::t('item', 'Description Short'),
            'id_category' => Yii::t('item', 'Id Category'),
            'quantity' => Yii::t('item', 'Quantity'),
            'height' => Yii::t('item', 'Height'),
            'weight' => Yii::t('item', 'Weight'),
            'id_color' => Yii::t('item', 'Id Color'),
            'available' => Yii::t('item', 'Available'),
            'status' => Yii::t('item', 'Status'),
            'unit_price' => Yii::t('item', 'Unit Price'),
            'deleted' => Yii::t('item', 'Deleted'),
            'created_at' => Yii::t('item', 'Created At'),
            'updated_at' => Yii::t('item', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdColor()
    {
        return $this->hasOne(Color::className(), ['id' => 'id_color']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['id_item' => 'id']);
    }
}
