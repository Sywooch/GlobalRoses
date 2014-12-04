<?php

namespace common\models\users;

use Yii;

/**
 * This is the model class for table "user_contact".
 *
 * @property string $id
 * @property string $address
 * @property string $number
 * @property string $city
 * @property string $postal_code
 * @property integer $id_country
 * @property string $type
 * @property string $notes
 * @property string $created_at
 * @property string $updated_at
 * @property string $id_user
 *
 * @property User $idUser
 * @property Country $idCountry
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_country', 'created_at', 'updated_at', 'id_user'], 'integer'],
            [['type', 'notes'], 'string'],
            [['created_at', 'updated_at', 'id_user'], 'required'],
            [['address', 'city'], 'string', 'max' => 255],
            [['number'], 'string', 'max' => 5],
            [['postal_code'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('users/contact', 'ID'),
            'address' => Yii::t('users/contact', 'Address'),
            'number' => Yii::t('users/contact', 'Number'),
            'city' => Yii::t('users/contact', 'City'),
            'postal_code' => Yii::t('users/contact', 'Postal Code'),
            'id_country' => Yii::t('users/contact', 'Id Country'),
            'type' => Yii::t('users/contact', 'Type'),
            'notes' => Yii::t('users/contact', 'Notes'),
            'created_at' => Yii::t('users/contact', 'Created At'),
            'updated_at' => Yii::t('users/contact', 'Updated At'),
            'id_user' => Yii::t('users/contact', 'Id User'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'id_country']);
    }
}
