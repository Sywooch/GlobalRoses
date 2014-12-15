<?php

use \yii\helpers\Url;
use \kartik\helpers\Html;
use \kartik\form\ActiveForm;
use \kartik\widgets\TouchSpin;

/* @var $this yii\web\View */
/* @var $model \frontend\models\cart\Item */

$form = ActiveForm::begin([
    'type' => ActiveForm::TYPE_VERTICAL,
    'id' => 'form-load-item',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'action' => \yii\helpers\Url::to(['shopping-cart/add-item']),
]); ?>

    <ul class="product-list">
        <li>
            <div class="row">
                <div class="col-sm-4 col-md-4">
                    <img src="<?= $model->getImageUrl() ?>" alt=""
                         class="img-responsive">
                </div>
                <div class="col-sm-8 col-md-8">
                    <div class="product-details">
                        <h4><?= $model->name ?></h4>
                        <?php
                        printf('<span class="category"><strong>%s</strong>%s</span>',
                            Yii::t('application', 'Category'),
                            $model->idCategory->name);
                        printf('<span class="stock"><strong>%s</strong>%s</span>',
                            Yii::t('application', 'Stock'),
                            Yii::$app->formatter->asInteger($model->stock));
                        printf('<span class="height"><strong>%s</strong>%s&nbsp;%s</span>',
                            Yii::t('application', 'Height'),
                            Yii::$app->formatter->asDecimal($model->height, 2),
                            Yii::t('application', 'cm'));
                        printf('<span class="Color"><strong>%s</strong><span class="col-sm-12"><span style="background-color: %s" class="col-sm-1 badge">&nbsp;</span></span></span>',
                            Yii::t('application', 'Color'), $model->color);
                        printf('<span class="quantity"><strong>%s</strong>%s&nbsp;%s</span>',
                            Yii::t('application', 'Contains'),
                            Yii::$app->formatter->asInteger($model->quantity),
                            ($model->quantity > 1)
                                ? Yii::t('application', 'pieces')
                                : Yii::t('application', 'piece'));
                        printf('<span class="price"><strong>%s</strong>%s&nbsp;%s</span>',
                            Yii::t('application', 'Price'),
                            Yii::$app->formatter->asDecimal($model->unit_price, 2),
                            '&euro;');
                        ?>
                        <span class="quanity">
                        <?= $form->field($model, 'request_quantity')->widget(TouchSpin::classname(), [
                            'options' => [
                                'placeholder' => Yii::t('application', 'Placeholder: Set quality ...'),
                            ],
                            'pluginOptions' => [
                                'initval' => 0,
                                'min' => 0,
                                'max' => $model->stock,
                                'buttonup_class' => 'btn btn-warning',
                                'buttondown_class' => 'btn btn-success',
                                'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
                                'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>'
                            ]
                        ]);
                        echo Html::submitButton(
                            '<span class="icon glyphicon glyphicon-shopping-cart"></span> ' . Yii::t('application', 'add to cart'), [
                            'class' => "btn btn-primary btn-md btn-cart",
                        ]) ?>
                        </span>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <div class="clearfix navigation">
        <?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span>', '#', [
            'class' => 'btn btn-primary btnPrevious',
            'data-display' => 'prev',
        ]); ?>
        <?= Html::a('<span class="glyphicon glyphicon-chevron-right"></span>', '#', [
            'class' => 'btn btn-primary btnNext',
            'data-display' => 'next',
        ]); ?>
    </div>
<?php
ActiveForm::end();
