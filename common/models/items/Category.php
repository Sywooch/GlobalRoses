<?php

namespace common\models\items;

use \Yii;
use \yii\db\ActiveRecord;
use \common\models\Item;
use \common\models\orders\Item as OrderItem;
use \yii\behaviors\TimestampBehavior;
use \common\components\ReferenceBehavior;
use common\components\DeletedBehavior;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $reference
 * @property integer $deleted
 * @property integer $created_at
 * @property integer $id_parent
 *
 * @property Category $parent
 * @property Category[] $children
 * @property Item[] $items
 * @property OrderItem[] $orderItems
 */
class Category extends ActiveRecord
{
    const DEFAULT_PARENT = '0';

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
            [['name'], 'required'],
            [['deleted', 'created_at', 'id_parent'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['reference'], 'string', 'max' => 50],
            [['reference'], 'unique'],
            [['parent'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
            'reference' => ReferenceBehavior::className(),
            'deleted' => DeletedBehavior::className()
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
            'parent' => Yii::t('items/category', 'Parent Category'),
            'id_parent' => Yii::t('items/category', 'id_parent'),
        ];
    }

    /**
     * @return \common\models\items\Category[]
     */
    public function getChildren()
    {
        $children = $this->find()
            ->where(['and', 'id_parent=:id_parent', 'id!=:id'])
            ->params([':id_parent' => $this->id, ':id' => $this->id])->all();
        return $children;
    }

    /**
     * @return \common\models\items\Category
     */
    public function getParent()
    {
        return $this->find()
            ->where(['and', 'id=:id', 'id!=:id2'])
            ->params([':id' => $this->id_parent, ':id2' => $this->id])->one();
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

    /**
     * @return \common\models\items\Category[]
     */
    public static function getGlobalCategories()
    {
        return static::find()->indexBy('id')
            ->where('id_parent=:id_parent')
            ->params([':id_parent' => self::DEFAULT_PARENT])->all();
    }

    /**
     * @return array
     */
    public static function getCategoryGrouped()
    {
        $list = [];
        $used = [];
        $categories = self::getGlobalCategories();
        if (count($categories) > 0) {
            foreach ($categories as $category) {
                if (!in_array($category->id, $used)) {
                    $list[$category->id] = $category->name;
                    $used[] = $category->id;
                }
                if ($category->id == self::DEFAULT_PARENT) {
                    continue;
                }
                $children = $category->getChildren();
                if (count($children) > 0) {
                    $list[$category->name] = [];
                    foreach ($children as $child) {
                        $list[$category->name][$child->id] = $child->name;
                        $used[] = $child->id;
                    }
                }
            }
        }
        return $list;
    }
}
