<?php

namespace common\models\users;

use Yii;

/**
 * This is the model class for table "user_address".
 *
 * @property string $id
 * @property string $name
 * @property string $surname
 * @property string $position
 * @property string $telephone
 * @property string $mobile
 * @property string $fax
 * @property string $notes
 * @property string $id_user
 *
 * @property User $idUser
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'id_user'], 'required'],
            [['notes'], 'string'],
            [['id_user'], 'integer'],
            [['name', 'surname', 'position'], 'string', 'max' => 255],
            [['telephone', 'mobile', 'fax'], 'string', 'max' => 12],
            [['id_user'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('users/address', 'ID'),
            'name' => Yii::t('users/address', 'Name'),
            'surname' => Yii::t('users/address', 'Surname'),
            'position' => Yii::t('users/address', 'Position'),
            'telephone' => Yii::t('users/address', 'Telephone'),
            'mobile' => Yii::t('users/address', 'Mobile'),
            'fax' => Yii::t('users/address', 'Fax'),
            'notes' => Yii::t('users/address', 'Notes'),
            'id_user' => Yii::t('users/address', 'Id User'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
