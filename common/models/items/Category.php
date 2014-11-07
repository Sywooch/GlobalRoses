<?php

namespace common\models\items;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $name
 * @property string $id_parent
 * @property string $reference
 * @property integer $deleted
 * @property string $created_at
 *
 * @property Category $idParent
 * @property Category[] $categories
 * @property Item[] $items
 * @property OrderItem[] $orderItems
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_parent', 'reference', 'created_at'], 'required'],
            [['id_parent', 'deleted', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['reference'], 'string', 'max' => 50],
            [['reference'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('items/category', 'ID'),
            'name' => Yii::t('items/category', 'Name'),
            'id_parent' => Yii::t('items/category', 'Id Parent'),
            'reference' => Yii::t('items/category', 'Reference'),
            'deleted' => Yii::t('items/category', 'Deleted'),
            'created_at' => Yii::t('items/category', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id_parent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id_category' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['id_item_category' => 'id']);
    }
}
