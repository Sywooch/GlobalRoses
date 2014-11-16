<?php

namespace common\models;

use Yii;
use \yii\db\ActiveRecord;
use \common\models\items\Category;
use \common\models\items\Color;
use \common\models\orders\Item as OrderItem;
use \yii\behaviors\TimestampBehavior;
use \common\components\ReferenceBehavior;
use common\components\SoftDeleteBehavior;

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
 * @property string $created_at
 * @property string $updated_at
 * @property integer $deleted
 * @property string $deleted_at
 *
 * @property Category $idCategory
 * @property Color $idColor
 * @property OrderItem[] $orderItems
 */
class Item extends ActiveRecord
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
            [['name', 'description'], 'required'],
            [['image', 'description', 'status'], 'string'],
            [['id_category', 'quantity', 'id_color', 'available', 'deleted', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
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
    public function behaviors()
    {
        return [
            'create-update' => TimestampBehavior::className(),
            'reference' => ReferenceBehavior::className(),
            'deleted' => SoftDeleteBehavior::className(),
        ];
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
            'updated_at' => Yii::t('common/application', 'Updated At'),
            'image' => Yii::t('item', 'Image'),
            'description' => Yii::t('item', 'Description'),
            'description_short' => Yii::t('item', 'Description Short'),
            'id_category' => Yii::t('item', 'Category'),
            'quantity' => Yii::t('item', 'Quantity'),
            'height' => Yii::t('item', 'Height'),
            'weight' => Yii::t('item', 'Weight'),
            'id_color' => Yii::t('item', 'Color'),
            'available' => Yii::t('item', 'Available'),
            'status' => Yii::t('item', 'Status'),
            'unit_price' => Yii::t('item', 'Unit Price'),
        ];
    }

    public static function find()
    {
        $query = new ItemQuery(get_called_class());
        return $query->active();
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

    public function getPrevious()
    {
        $current_id = $this->id;

        $search = self::find()->andWhere('id<:id')->
        addParams([':id' => $current_id])->
        orderBy(['id' => SORT_DESC])->limit(1)->one();
        if (is_null($search)) {
            $search = self::find()->andWhere('id!=:id')->
            addParams(['id' => $this->id])->orderBy(['id' => SORT_DESC])->
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

        $search = self::find()->andWhere('id>:id')->
        addParams([':id' => $current_id])->orderBy(['id' => SORT_ASC])->
        limit(1)->one();
        if (is_null($search)) {
            $search = self::find()->andWhere('id!=:id')->
            addParams(['id' => $this->id])->orderBy(['id' => SORT_ASC])->
            limit(1)->one();
        }

        if (is_null($search)) {
            return null;
        }
        return $search->id;
    }
}
