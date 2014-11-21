<?php

namespace common\models;

use Yii;
use \yii\db\ActiveRecord;
use \common\models\items\Category;
use \common\models\orders\Item as OrderItem;
use \yii\behaviors\TimestampBehavior;
use \common\components\ReferenceBehavior;
use common\components\SoftDeleteBehavior;
use common\components\SingleFileUploadBehavior;

/**
 * This is the model class for table "item".
 *
 * @property string $id
 * @property string $name
 * @property string $reference
 * @property string $file
 * @property string $file_name_original
 * @property string $id_category
 * @property integer $quantity
 * @property integer $stock
 * @property string $height
 * @property string $weight
 * @property string $color
 * @property integer $available
 * @property string $status
 * @property string $unit_price
 * @property string $created_at
 * @property string $updated_at
 * @property integer $deleted
 * @property string $deleted_at
 *
 * @property Category $category
 * @property OrderItem[] $orderItems
 */
class Item extends ActiveRecord
{
    /**
     * @var mixed upload_file the attribute for rendering the file input
     * widget for upload on the form
     */
    public $upload_file;

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
            [['name', 'stock', 'quantity'], 'required'],
            [['file', 'file_name_original', 'description', 'status', 'color'], 'string'],
            [['id_category', 'quantity', 'available', 'deleted', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['height', 'weight', 'unit_price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['reference'], 'string', 'max' => 50],
            [['reference'], 'unique'],
            [['upload_file'], 'safe'],
            [['upload_file'], 'file', 'extensions' => 'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'TimestampBehavior' => TimestampBehavior::className(),
            'ReferenceBehavior' => ReferenceBehavior::className(),
            'SoftDeleteBehavior' => SoftDeleteBehavior::className(),
            'SingleFileUploadBehavior' => SingleFileUploadBehavior::className(),
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
            'file' => Yii::t('item', 'Image'),
            'file_name_original' => Yii::t('item', 'image original name'),
            'upload_file' => Yii::t('item', 'Upload Image'),
            'id_category' => Yii::t('item', 'Category'),
            'quantity' => Yii::t('item', 'Quantity'),
            'stock' => Yii::t('item', 'Stock'),
            'height' => Yii::t('item', 'Height'),
            'weight' => Yii::t('item', 'Weight'),
            'color' => Yii::t('item', 'Color'),
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

    public function getTmpFolderPath()
    {
        return Yii::$app->basePath . '/uploads/image/item/tmp/';
    }

    public function getFolderPath()
    {
        return ($this->isNewRecord)
            ? $this->getTmpFolderPath()
            : sprintf(Yii::$app->basePath . '/uploads/image/item/%d/', $this->id);
    }

    public function getFilePath()
    {
        return $this->getFolderPath() . $this->file;
    }
}
