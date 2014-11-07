<?php

namespace common\models\items;

use Yii;

/**
 * This is the model class for table "color".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_at
 * @property integer $deleted
 *
 * @property Item[] $items
 * @property OrderItem[] $orderItems
 */
class Color extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at'], 'required'],
            [['created_at', 'deleted'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('items/color', 'ID'),
            'name' => Yii::t('items/color', 'Name'),
            'created_at' => Yii::t('items/color', 'Created At'),
            'deleted' => Yii::t('items/color', 'Deleted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id_color' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['id_item_color' => 'id']);
    }
}
