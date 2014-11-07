<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $reference
 * @property string $id_customer
 * @property string $price_total
 * @property string $delivery_info
 * @property integer $modifed
 * @property integer $deleted
 * @property string $delivery_at
 * @property string $updated_at
 * @property string $created_at
 *
 * @property User $idCustomer
 * @property OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'reference', 'id_customer', 'delivery_at', 'updated_at', 'created_at'], 'required'],
            [['id', 'id_customer', 'modifed', 'deleted', 'delivery_at', 'updated_at', 'created_at'], 'integer'],
            [['price_total'], 'number'],
            [['delivery_info'], 'string'],
            [['reference'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('order', 'ID'),
            'reference' => Yii::t('order', 'Reference'),
            'id_customer' => Yii::t('order', 'Id Customer'),
            'price_total' => Yii::t('order', 'Price Total'),
            'delivery_info' => Yii::t('order', 'Delivery Info'),
            'modifed' => Yii::t('order', 'Modifed'),
            'deleted' => Yii::t('order', 'Deleted'),
            'delivery_at' => Yii::t('order', 'Delivery At'),
            'updated_at' => Yii::t('order', 'Updated At'),
            'created_at' => Yii::t('order', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCustomer()
    {
        return $this->hasOne(User::className(), ['id' => 'id_customer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['id_order' => 'id_customer']);
    }
}
