<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $surname;
    public $email;
    public $password;
    public $password_check;

    public $company;
    public $vat_id;
    public $vat_authority;
    public $city;
    public $address;
    public $postal;
    public $phone;
    public $mobile;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'name',
                    'surname',
                    'company',
                    'vat_authority',
                    'city',
                    'address',
                    'email'
                ],
                'filter',
                'filter' => 'trim'
            ],
            [
                [
                    'name',
                    'surname',
                    'email',
                    'password',
                    'city',
                    'password_check',
                    'company',
                    'vat_id',
                    'vat_authority',
                    'city',
                    'address',
                    'postal',
                    'phone',
                ],
                'required'
            ],

            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['email', 'email'],

            ['password', 'string', 'min' => 6],
            ['password', 'compare', 'compareAttribute' => 'password_check'],

            ['vat_id', 'unique', 'targetClass' => '\common\models\Company', 'message' => 'This vat_id has already been used.'],
            ['vat_id', 'string', 'min' => 7, 'max' => 255],

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
//            $user->username = $this->username;
//            $user->email = $this->email;
//            $user->setPassword($this->password);
//            $user->generateAuthKey();
//            $user->save();
            return $user;
        }

        return null;
    }
}
