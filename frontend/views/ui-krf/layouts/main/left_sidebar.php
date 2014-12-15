<?php
use kartik\widgets\ColorInput;
use \kartik\select2\Select2;
use \common\models\items\Category;
use \common\models\Item;
use \kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $item_search_model \frontend\models\ItemSearchForm */
/* @var $searchData array */

$searchData = Yii::$app->controller->searchData;
$colors = Item::getUsedColor(5);
?>
<div class="col-sm-3 col-md-3 left">
    <div class="well well-sm well-title well-side">
        <strong><?= Yii::t('application', 'Filters') ?></strong>
    </div>
    <!-- Filters -->
    <div class="well well-sm">
        <form id="product-search-form" class="form-vertical" method="get"
              action="<?= Url::to(['site/search']) ?>">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group field-search-color">
                            <?php
                            printf('<label for="search-color" class="control-label">%s</label>',
                                Yii::t('application', 'Color'));
                            echo ColorInput::widget([
                                'name' => 'color',
                                'value' => $searchData['color'],
                                'id' => 'search-color',
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
                                    'preferredFormat' => 'hex',
                                    'palette' => $colors,
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="form-group field-search-category">
                            <?php
                            printf('<label for="search-category" class="control-label">%s</label>',
                                Yii::t('application', 'Category'));
                            echo Select2::widget([
                                'name' => 'category',
                                'value' => $searchData['category'],
                                'data' => Category::getCategoryGrouped(),
                                'language' => Yii::$app->language,
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                                'options' => [
                                    'multiple' => true,
                                    'placeholder' => Yii::t('application', 'Placeholder: Select category ...')
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <?= Html::submitButton(
                            sprintf('<span class="icon glyphicon glyphicon-search"></span>&nbsp;%s', Yii::t('application', 'Find')),
                            ['class' => 'btn btn-primary btn-md btn-cart']) ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /Filters -->
</div>
<!-- Left menu -->