<?php

use \kartik\helpers\Html;
use \common\models\items\Suggested;
use \kartik\form\ActiveForm;
use \kartik\widgets\TouchSpin;

/* @var $this yii\web\View */
/* @var $model common\models\items\Suggested */
/* @var $searchModel common\models\items\SuggestedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$form = ActiveForm::begin([
    'type' => ActiveForm::TYPE_VERTICAL,
    'id' => 'form-add-item',
//            'beforeSubmit' => 'submitForm'
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
                        Yii::t('application', 'Category'), $model->idCategory->name);
                    printf('<span class="stock"><strong>%s</strong>%d</span>',
                        Yii::t('application', 'Stock'), $model->stock);
                    printf('<span class="height"><strong>%s</strong>%.2f&nbsp;cm</span>',
                        Yii::t('application', 'Height'), $model->height);
                    printf('<span class="Color"><strong>%s</strong><span class="col-sm-12"><span style="background-color: %s" class="col-sm-1 badge">&nbsp;</span></span></span>',
                        Yii::t('application', 'Color'), $model->color);
                    printf('<span class="quantity"><strong>%s</strong>%.d&nbsp;%s</span>',
                        Yii::t('application', 'Contains'), $model->quantity, ($model->quantity > 0) ? Yii::t('application', 'pieces') : Yii::t('application', 'piece'));
                    ?>
                    <span class="quanity">
                            <?php echo TouchSpin::widget([
                                'name' => 'quantity',
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
