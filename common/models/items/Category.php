<?php

namespace common\models\items;

use \Yii;
use \yii\db\ActiveRecord;
use \common\models\Item;
use \common\models\orders\Item as OrderItem;
use \yii\behaviors\TimestampBehavior;
use \common\components\ReferenceBehavior;
use common\components\SoftDeleteBehavior;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $reference
 * @property integer $id_parent
 * @property integer $created_at
 * @property integer $deleted
 * @property string $deleted_at
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
            [['deleted', 'created_at', 'deleted_at', 'id_parent'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['reference'], 'string', 'max' => 50],
            [['reference', 'name'], 'unique'],
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
            'deleted' => SoftDeleteBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            if ($this->id_parent == '') {
                $this->id_parent = self::DEFAULT_PARENT;
            }
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common/application', 'ID'),
            'name' => Yii::t('common/application', 'Name'),
            'reference' => Yii::t('common/application', 'Reference'),
            'deleted' => Yii::t('common/application', 'Deleted'),
            'created_at' => Yii::t('common/application', 'Created At'),
            'deleted_at' => Yii::t('common/application', 'Deleted At'),
            'parent' => Yii::t('items/category', 'Parent Category'),
            'id_parent' => Yii::t('items/category', 'id_parent'),
        ];
    }

    public static function find()
    {
        $query = new CategoryQuery(get_called_class());
        return $query->active();
    }

    /**
     * @return \common\models\items\Category[]
     */
    public function getChildren()
    {
        $children = $this->find()
            ->andWhere(['and', '`category`.`id_parent`=:id_parent', '`category`.`id`!=:id'])
            ->addParams([':id_parent' => $this->id, ':id' => $this->id])->all();
        return $children;
    }

    /**
     * @return \common\models\items\Category
     */
    public function getIdParent()
    {
        return $this->hasOne(self::className(), ['id' => 'id_parent']);
    }

    /**
     * @return \common\models\items\Category
     */
    public function getParent()
    {
        return $this->find()
            ->andWhere(['and', '`category`.`id`=:id', '`category`.`id`!=:id2'])
            ->addParams([':id' => $this->id_parent, ':id2' => $this->id]);
    }

    /**
     * @return string
     */
    public function getParentName()
    {
        $parent = $this->getParent()->one();
        if (is_null($parent)) {
            return null;
        }
        return $parent->name;
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
        return self::find()->indexBy('id')
            ->andWhere('`category`.`id_parent`=:id_parent')
            ->addParams([':id_parent' => self::DEFAULT_PARENT])->all();
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

    public function getPrevious()
    {
        $current_id = $this->id;

        $search = self::find()->andWhere('`category`.`id`<:id')->
        addParams([':id' => $current_id])->
        orderBy(['id' => SORT_DESC])->limit(1)->one();
        if (is_null($search)) {
            $search = self::find()->orderBy(['id' => SORT_DESC])->
            limit(1)->one();
        }

        if (is_null($search)) {
            return null;
        }
        return $search->id;
    }

    public function getNext()
    {
        $current_id = $this->id;

        $search = self::find()->andWhere('`category`.`id`>:id')->
        addParams([':id' => $current_id])->orderBy(['id' => SORT_ASC])->
        limit(1)->one();
        if (is_null($search)) {
            $search = self::find()->orderBy(['id' => SORT_ASC])->
            limit(1)->one();
        }

        if (is_null($search)) {
            return null;
        }
        return $search->id;
    }
}
