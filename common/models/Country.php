<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 *
 * @property UserContact[] $userContacts
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'code'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 5],
            [['code'], 'unique'],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('country', 'ID'),
            'name' => Yii::t('country', 'Name'),
            'code' => Yii::t('country', 'Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserContacts()
    {
        return $this->hasMany(UserContact::className(), ['id_country' => 'id']);
    }
}
