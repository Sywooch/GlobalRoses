<?php

namespace common\models\items;

use Yii;
use \yii\db\ActiveRecord;
use \common\models\Item;
use \common\models\orders\Item as OrderItem;
use \yii\behaviors\TimestampBehavior;

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
class Color extends ActiveRecord
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
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'id' => Yii::t('common/application', 'ID'),
            'name' => Yii::t('common/application', 'Name'),
            'deleted' => Yii::t('common/application', 'Deleted'),
            'created_at' => Yii::t('common/application', 'Created At'),
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

    public function getPrevious()
    {
        $current_id = $this->id;

        $search = self::find()->andWhere('id<:id')->
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

        $search = self::find()->andWhere('id>:id')->
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
