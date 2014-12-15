<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\ItemSearchForm;
use \yii\helpers\Url;
use \yii\helpers\Json;
use \kartik\helpers\Html;
use \common\models\items\Suggested;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $item_search_model;

    /**
     * @var array
     */
    public $searchData;

    private $_layout_carousel = 'carousel';
    private $_layout_login = 'login';
    private $_layout_empty = 'empty';


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
        $this->layout = $this->$_layout_login;
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

    public function actionContact()
    {
        $this->layout = $this->_layout_empty;
        $this->item_search_model = new ItemSearchForm();

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        $this->layout = $this->_layout_empty;
        $this->item_search_model = new ItemSearchForm();
        return $this->render('about');
    }

    public function actionSignup()
    {
        $this->layout = $this->_layout_empty;
        $this->item_search_model = new ItemSearchForm();
        $model = new SignupForm();
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

    public function actionRequestPasswordReset()
    {
        $this->layout = $this->_layout_empty;
        $this->item_search_model = new ItemSearchForm();
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
        $this->item_search_model = new ItemSearchForm();
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
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
                    /* @var $model Suggested */
                    $image_url = $model->getImageUrl();
                    $img = Html::img($image_url);
                    $a = Html::a($img, '#', [
                        'data-id' => 'product-popover',
                        'data-content' => $img,
                        'data-trigger' => 'hover'
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
                    /* @var $model Suggested */
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
                    /* @var $model Suggested */
                    return sprintf('<strong>%s</strong>%s',
                        Yii::t('application', 'stock'), $model->stock);
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
                    /* @var $model Suggested */
                    return sprintf('<strong>%s</strong>%s',
                        Yii::t('application', 'height'), $model->height);
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
                    /* @var $model Suggested */
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
                    /* @var $model Suggested */
                    return sprintf('<strong>%s</strong>%s (%s)',
                        Yii::t('application', 'contains'), $model->quantity,
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
                    /* @var $model Suggested */
                    return sprintf('<strong>%s</strong>%s',
                        Yii::t('application', 'unit_price'), $model->unit_price);
                },
                'format' => 'raw',
                'contentOptions' => [
                    'class' => 'price'
                ]
            ],
            [
                'class' => \common\components\Column::className(),
                'value' => function ($model, $key, $index, $widget) {
                    /* @var $model Suggested */
                    return Html::button('<span class="icon glyphicon glyphicon-shopping-cart"></span>' . Yii::t('application', 'unit_price'),
                        [
                            'class' => 'btn btn-primary btn-md btn-cart',
                            'data-target' => '#productModal',
                            'data-toggle' => 'modal',
                            'data-modal-options' => Json::encode([
                                'request' => Url::to(['shopping-cart/add-item', 'id' => $model->id])
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
