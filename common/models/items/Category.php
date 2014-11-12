<?php

namespace common\models\items;

use \Yii;
use \yii\db\ActiveRecord;
use \common\models\Item;
use \common\models\items\categories\Relation;
use \common\models\orders\Item as OrderItem;

/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $name
 * @property string $reference
 * @property integer $deleted
 * @property string $created_at
 *
 * @property Category $parent_category
 * @property Category[] $children
 * @property Relation[] $categoryRelations
 * @property Item[] $items
 * @property OrderItem[] $orderItems
 */
class Category extends ActiveRecord
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
            [['name', 'reference', 'created_at'], 'required'],
            [['deleted', 'created_at'], 'integer'],
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
            'reference' => Yii::t('items/category', 'Reference'),
            'deleted' => Yii::t('items/category', 'Deleted'),
            'created_at' => Yii::t('items/category', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryRelations()
    {
        return $this->hasMany(Relation::className(), ['id_parent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
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
