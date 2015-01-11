<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\bootstrap\ActiveForm;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\ItemSearchForm;
use \yii\helpers\Url;
use \yii\helpers\Json;
use \kartik\helpers\Html;
use \common\models\Item;
use \common\models\User;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Frontend
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = $this->_layout_carousel;
        $model = new ItemSearchForm();
        $dataProvider = $model->search(array());

        return $this->render('index', [
            'searchModel' => $model->getSearchModel(),
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionFaq()
    {
        $this->layout = $this->_layout_empty;
        return $this->render('faq');
    }

    public function actionPayment()
    {
        $this->layout = $this->_layout_empty;
        return $this->render('payment');
    }

    public function actionContact()
    {
        $this->layout = $this->_layout_empty;
        $model = new ContactForm();
        Yii::$app->session->removeFlash('success');
        Yii::$app->session->removeFlash('error');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $contact_email = Yii::$app->params['adminEmail'];
            $send = $model->sendEmail($contact_email);
            if ($send == true) {
                Yii::$app->session->setFlash('success', Yii::t('application', 'Thank you for contacting us. We will respond to you as soon as possible'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('application', 'There was an error sending email'));
            }

            return $this->refresh();
        } else {
            if (!Yii::$app->user->isGuest) {
                $model->email = Yii::$app->user->identity->email;
            }
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionSearch()
    {
        $this->layout = $this->_layout_empty;
        $model = new ItemSearchForm();
        $searchData = Yii::$app->request->get();
        $searchData['category'] = (isset($searchData['category']) ? (array)$searchData['category'] : []);
        $searchData['color'] = (isset($searchData['color']) ? $searchData['color'] : null);
        $this->searchData = $searchData;
        $model->load($this->searchData);
        $dataProvider = $model->search(Yii::$app->request->queryParams);

        return $this->render('search', [
            'searchModel' => $model->getSearchModel(),
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionLogin()
    {
        $this->layout = $this->_layout_empty;
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAbout()
    {
        $this->layout = $this->_layout_empty;
        return $this->render('about');
    }

    public function actionSignup()
    {
        $this->layout = $this->_layout_empty;
        $model = new SignupForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * SiteController::actionAccountActivate()
     *
     * @author: Andreas Kondylis
     * @version: 0.1
     * @param $token
     * @return string|Response
     * @throws BadRequestHttpException
     */
    public function actionAccountActivate($token)
    {
        try {

            if (empty($token) || !is_string($token)) {
                throw new InvalidParamException('activation token cannot be blank.');
            }
            $model = User::findByActivationToken($token);
            if (!$model) {
                throw new InvalidParamException('Wrong activation token.');
            }
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        /* @var User $model */
        $model->removeActivationToken();
        if ($model->save()) {
            if (Yii::$app->getUser()->login($model)) {
//                return $this->goHome();
            }
        }
        $model->save();

        $this->layout = $this->_layout_empty;
        return $this->render('activate-account', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $this->layout = $this->_layout_empty;
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        $this->layout = $this->_layout_empty;
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function loadItemModal()
    {
        return $this->renderPartial('/shopping-cart/load-item-modal');
    }

    public static function getGridColumn()
    {
        return [
            [
                'class' => \common\components\Column::className(),
                'attribute' => 'file_name_original',
                'label' => Yii::t('item', 'Image'),
                'format' => 'raw',
                'value' => function ($model, $key, $index, $widget) {
                    /* @var $model Item */
                    $image_url = $model->getImageUrl();
                    $img = Html::img($image_url);
                    $a = Html::a($img, '#', [
                        'data-id' => 'product-popover',
                        'data-content' => $img,
                        'data-trigger' => 'hover',
                        'rel' => 'popover',
                    ]);
                    return $a;
                },
                'contentOptions' => [
                    'class' => 'image'
                ]
            ],
            [
                'class' => \common\components\Column::className(),
                'attribute' => 'name',
                'contentOptions' => [
                    'class' => 'name'
                ]
            ],
            [
                'class' => \common\components\Column::className(),
                'attribute' => 'id_category',
                'value' => function ($model, $key, $index, $widget) {
                    /* @var $model Item */
                    return sprintf('<strong>%s</strong>%s',
                        Yii::t('application', 'category'), $model->idCategory->name);
                },
                'format' => 'raw',
                'contentOptions' => [
                    'class' => 'category'
                ]

            ],
            [
                'class' => \common\components\Column::className(),
                'attribute' => 'stock',
                'value' => function ($model, $key, $index, $widget) {
                    /* @var $model Item */
                    return sprintf('<strong>%s</strong>%s',
                        Yii::t('application', 'stock'),
                        Yii::$app->formatter->asInteger($model->stock));
                },
                'format' => 'raw',
                'contentOptions' => [
                    'class' => 'stock'
                ]
            ],
            [
                'class' => \common\components\Column::className(),
                'attribute' => 'height',
                'value' => function ($model, $key, $index, $widget) {
                    /* @var $model Item */
                    return sprintf('<strong>%s</strong>%s&nbsp;%s',
                        Yii::t('application', 'height'),
                        Yii::$app->formatter->asDecimal($model->height, 2),
                        Yii::t('application', 'cm'));
                },
                'format' => 'raw',
                'contentOptions' => [
                    'class' => 'height'
                ]
            ],
            [
                'class' => \common\components\Column::className(),
                'attribute' => 'color',
                'value' => function ($model, $key, $index, $widget) {
                    /* @var $model Item */
                    if ($model->color == '' || empty($model->color)) {
                        $col = Yii::t('common/application', '(not set)');
                    } else {
                        $col = "<span class='badge' style='background-color: {$model->color}'>&nbsp;</span>";
                    }
                    return sprintf('<strong>%s</strong>%s',
                        Yii::t('application', 'color'), $col);
                },
                'format' => 'raw',
                'contentOptions' => [
                    'class' => 'color'
                ]
            ],
            [
                'class' => \common\components\Column::className(),
                'attribute' => 'quantity',
                'value' => function ($model, $key, $index, $widget) {
                    /* @var $model Item */
                    return sprintf('<strong>%s</strong>%s (%s)',
                        Yii::t('application', 'contains'),
                        Yii::$app->formatter->asInteger($model->quantity),
                        ($model->quantity > 1)
                            ? Yii::t('application', 'pieces')
                            : Yii::t('application', 'piece'));
                },
                'format' => 'raw',
                'contentOptions' => [
                    'class' => 'quantity'
                ]
            ],
            [
                'class' => \common\components\Column::className(),
                'attribute' => 'unit_price',
                'value' => function ($model, $key, $index, $widget) {
                    /* @var $model Item */
                    return sprintf('<strong>%s</strong>%s&nbsp;%s',
                        Yii::t('application', 'unit_price'),
                        Yii::$app->formatter->asDecimal($model->unit_price, 2),
                        '&euro;');
                },
                'format' => 'raw',
                'contentOptions' => [
                    'class' => 'price'
                ]
            ],
            [
                'class' => \common\components\Column::className(),
                'value' => function ($model, $key, $index, $widget) {
                    /* @var $model Item */
                    return Html::button('<span class="icon glyphicon glyphicon-shopping-cart"></span>' . Yii::t('application', 'unit_price'),
                        [
                            'class' => 'btn btn-primary btn-md btn-cart',
                            'data-target' => '#productModal',
                            'data-toggle' => 'modal',
                            'data-modal-options' => Json::encode([
                                'request' => Url::to(['shopping-cart/load-item', 'id' => $model->id])
                            ])
                        ]);
                },
                'format' => 'raw',
                'contentOptions' => [
                    'class' => 'btn-cart-wp'
                ]
            ],
        ];
    }
}
