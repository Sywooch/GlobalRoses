<?php
namespace frontend\models;

//use frontend\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $password_check;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'filter', 'filter' => 'trim'],
            [['email', 'password', 'password_check',], 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => User::className(),
                'message' => Yii::t('application', 'This email address has already been taken.')
            ],
            ['password', 'string', 'min' => 6],
            ['password_check', 'compare', 'compareAttribute' => 'password'],
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
            $user->email = $this->email;
            $user->passwd = $this->password;
            $user->setPassword($user->passwd);
            $user->generateAuthKey();
            $user->save();
            return $user;
        }

        return null;
    }
}
