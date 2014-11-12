<?php

namespace common\models\items\categories;

use Yii;
use \yii\db\ActiveRecord;
use common\models\items\Category;

/**
 * This is the model class for table "category_relation".
 *
 * @property string $id_category
 * @property string $id_parent
 *
 * @property Category $category
 * @property Category $parent
 */
class Relation extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_relation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_category', 'id_parent'], 'required'],
            [['id_category', 'id_parent'], 'integer'],
            [['id_category', 'id_parent'], 'unique', 'targetAttribute' => ['id_category', 'id_parent'], 'message' => 'The combination of Id Category and Id Parent has already been taken.'],
            [['id_category'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_category' => Yii::t('items/categories/relation', 'Id Category'),
            'id_parent' => Yii::t('items/categories/relation', 'Id Parent'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_parent']);
    }
}
