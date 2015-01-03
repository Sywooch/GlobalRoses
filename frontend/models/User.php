<?php
namespace frontend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\IdentityInterface;
use \common\models\User as CUser;

/**
 * User model
 *
 * @property integer $id
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends CUser
{
    public $passwd;

    public function beforeSave($insert)
    {
        $is_valid = parent::beforeSave($insert);
        if ($is_valid) {
            if ($this->isNewRecord) {
                $this->sendActivationEmail();
            }
        }
        return $is_valid;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('user', 'id'),
            'email' => \Yii::t('user', 'email'),
        ];
    }

    public function sendActivationEmail()
    {
        $this->generateActivationToken();
        $from = Yii::$app->params['noReplyEmail'];
        $fromName = Yii::$app->params['emailName'];
        $subject = Yii::t('application', 'Activation-email-subject');
        $body = Yii::t('application',
            'Activation-email-body', [
                'url' => Url::toRoute([
                    'site/account-activate',
                    'token' => $this->activation_token
                ], true)]);

        return Yii::$app->mailer->compose()
            ->setTo($this->email)
            ->setFrom([$from => $fromName])
            ->setSubject($subject)
            ->setHtmlBody($body)
            ->send();
    }
}
