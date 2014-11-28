<?php
use kartik\widgets\ColorInput;
use \kartik\select2\Select2;
use \common\models\items\Category;
use \common\models\Item;
use \kartik\form\ActiveForm;

/* @var $this \yii\web\View */
/* @var $item_search_model \frontend\models\ItemSearchForm */

$item_search_model = Yii::$app->controller->item_search_model;
$colors = Item::getUsedColor(5);
?>
<div class="col-sm-3 col-md-3 left">
    <div class="well well-sm well-title well-side">
        <strong><?= Yii::t('application', 'Filters') ?></strong>
    </div>
    <!-- Filters -->
    <div class="well well-sm">
        <?php $form = ActiveForm::begin([
            'type' => ActiveForm::TYPE_VERTICAL,
            'id' => 'form-product-search'
        ]); ?>
        <div class="row">
            <div class="col-sm-12">
                <?= $form->field($item_search_model, 'color')->widget(ColorInput::classname(), [
                    'showDefaultPalette' => false,
                    'options' => [
                        'placeholder' => Yii::t('application', 'Placeholder: Select color ...'),
                    ],
                    'pluginOptions' => [
                        'showPalette' => true,
                        'showPaletteOnly' => true,
                        'showSelectionPalette' => true,
                        'showAlpha' => false,
                        'allowEmpty' => true,
                        'preferredFormat' => 'name',
                        'palette' => $colors
                    ],
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?= $form->field($item_search_model, 'category')->widget(Select2::classname(), [
                    'data' => Category::getCategoryGrouped(),
                    'language' => Yii::$app->language,

                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'options' => [
                        'multiple' => true,
                        'placeholder' => Yii::t('application', 'Placeholder: Select category ...')
                    ]
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <button type="submit"
                            class="btn btn-primary btn-md btn-cart">
                                    <span
                                        class="icon glyphicon glyphicon-search"></span> <?= Yii::t('application', 'Find') ?>
                    </button>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /Filters -->
</div>
<!-- Left menu -->