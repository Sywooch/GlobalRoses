<?php

use kartik\grid\GridView;
use \yii\helpers\Url;
use \yii\helpers\Html;
use \kartik\widgets\SwitchInput;
use \kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ArrayDataProvider */

$this->registerJsFile(Url::to('@web/js/chart/index.js'), ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = Yii::t('application', 'TITLE');
$gridColumns = [
    [
        'label' => Yii::t('application', 'Product'),
        'attribute' => 'product',
        'format' => 'raw',
        'vAlign' => 'middle',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model array */
            /* @var $item common\models\items\Available */
            $item = $model['item'];
            $image_url = $item->getImageUrlSmall();
            $image = sprintf('<img src="%s" alt="" class="img-responsive product" height="80">', $image_url);
            return sprintf('<div class="row"><div class="col-sm-4">%s</div><div class="col-sm-8">%s</div></div>',
                $image, $model['name']);
        },
    ],
    [
        'label' => Yii::t('application', 'Price {currency}', ['currency' => html_entity_decode('&euro;')]),
        'attribute' => 'price',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format' => ['decimal', 2],
    ],
    [
        'label' => Yii::t('application', 'Quantity'),
        'attribute' => 'requested_quantity',
        'format' => ['decimal', 0],
        'vAlign' => 'middle',
        'hAlign' => 'center',
    ],
    [
        'label' => Yii::t('application', 'Total price {currency}', ['currency' => html_entity_decode('&euro;')]),
        'attribute' => 'cost',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format' => 'raw',
        'value' => function ($model, $key, $index, $widget) {
            return sprintf('<span data-price="sub-total">%s</span>',
                Yii::$app->formatter->asDecimal($model['cost'], 2));
        }
    ],
];
?>
<div class="well well-sm well-title">
    <strong><?= Yii::t('application', 'Cart') ?></strong>
</div>
<div class="well well-sm">
    <?php echo GridView::widget([
        'id' => 'item-cart-list',
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'columns' => $gridColumns,
        'bordered' => true,
        'striped' => true,
        'condensed' => false,
        'responsive' => true,
        'hover' => false,
        'showPageSummary' => false,
        'showFooter' => false,
        'footerRowOptions' => [],
        'afterFooter' => [
            [
                'columns' => [
                    [
                        'content' => sprintf('<a href="%s" class="btn btn-warning"><i class="glyphicon glyphicon-shopping-cart"></i> %s</a>',
                            Url::to(['site/search']),
                            Yii::t('application', 'Continue Shopping')),
                        'tag' => 'td',
                        'options' => ['colspan' => 2],
                    ],
                    [
                        'content' => sprintf('<strong>%s&nbsp;%s</strong>',
                            Yii::$app->formatter->asDecimal(Yii::$app->cart->getCost(), 2), '&euro;'),
                        'tag' => 'td',
                        'options' => ['class' => 'hidden-xs text-center', 'data-price' => 'total'],
                    ],
                    [
                        'content' => sprintf('<a href="%s" class="btn btn-success btn-block" data-button="checkout">%s <i class="glyphicon glyphicon-chevron-right"></i></a>',
                            Url::to(['shopping-cart/checkout']),
                            Yii::t('application', 'Finish')),
                        'tag' => 'td',
                        'options' => [],
                    ],
                ],
                'options' => []
            ]
        ],
        'tableOptions' => [
            'id' => 'checkout-cart',
            'class' => 'table table-hover table-condensed cart-product-list',
        ],
        'rowOptions' => [
            'data-row' => 'product'
        ],
        'options' => [
            'data-type' => 'cart',
            'class' => 'grid-view',
        ],
        'layout' => '{items}',
    ]); ?>

    <div class="address-info">
        <div class="row">
            <div class="col-sm-6">
                <fieldset>
                    <legend><?= Yii::t('application', 'Delivery Address') ?></legend>
                    <div class="row">
                        <div class="col-sm-6">
                            <?php
                            printf('<label class="control-label">%s</label>', Yii::t('application', 'use from profile'));
                            echo SwitchInput::widget(
                                [
                                    'name' => 'status_1',
                                    'value' => true,
                                    'pluginOptions' => [
                                        'size' => 'mini',
                                        'onText' => Yii::t('application', 'yes'),
                                        'offText' => Yii::t('application', 'no'),
                                    ],
                                    'labelOptions' => ['style' => 'font-size: 10px'],
                                ]
                            );
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            printf('<label class="control-label">%s</label>', Yii::t('application', 'address'));
                            echo Select2::widget([
                                'name' => 'id-profile-address',
                                'data' => [],
                                'size' => Select2::SMALL,
                                'options' => [],
                                'pluginOptions' => [
                                    'allowClear' => false
                                ],
                            ])
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Company name</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>First name</label>
                                    <input type="text">
                                </div>
                                <div class="col-sm-6">
                                    <label>Surname name</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Vat ID</label>
                                    <input type="text">
                                </div>
                                <div class="col-sm-6">
                                    <label>Vat Authority</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Address 1</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Address 2</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>City</label>
                                    <input type="text">
                                </div>
                                <div class="col-sm-6">
                                    <label>Postal</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Phone</label>
                                    <input type="text">
                                </div>
                                <div class="col-sm-6">
                                    <label>Mobile</label>
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-sm-6">
                <fieldset>
                    <legend><?= Yii::t('application', 'Shipping Address') ?></legend>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                            printf('<label class="control-label">%s</label>', Yii::t('application', 'use the delivery address'));
                            echo SwitchInput::widget(
                                [
                                    'name' => 'status_1',
                                    'value' => true,
                                    'pluginOptions' => [
                                        'size' => 'mini',
                                        'onText' => Yii::t('application', 'yes'),
                                        'offText' => Yii::t('application', 'no'),
                                    ],
                                    'labelOptions' => ['style' => 'font-size: 10px'],
                                ]
                            );
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?php
                            printf('<label class="control-label">%s</label>', Yii::t('application', 'use from profile'));
                            echo SwitchInput::widget(
                                [
                                    'name' => 'status_1',
                                    'value' => true,
                                    'pluginOptions' => [
                                        'size' => 'mini',
                                        'onText' => Yii::t('application', 'yes'),
                                        'offText' => Yii::t('application', 'no'),
                                    ],
                                    'labelOptions' => ['style' => 'font-size: 10px'],
                                ]
                            );
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            printf('<label class="control-label">%s</label>', Yii::t('application', 'address'));
                            echo Select2::widget([
                                'name' => 'id-profile-address',
                                'data' => [],
                                'size' => Select2::SMALL,
                                'options' => [],
                                'pluginOptions' => [
                                    'allowClear' => false
                                ],
                            ])
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Company name</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>First name</label>
                                    <input type="text">
                                </div>
                                <div class="col-sm-6">
                                    <label>Surname name</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Vat ID</label>
                                    <input type="text">
                                </div>
                                <div class="col-sm-6">
                                    <label>Vat Authority</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Address 1</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Address 2</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>City</label>
                                    <input type="text">
                                </div>
                                <div class="col-sm-6">
                                    <label>Postal</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Phone</label>
                                    <input type="text">
                                </div>
                                <div class="col-sm-6">
                                    <label>Mobile</label>
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="pricing-info">
        <div class="row">
            <div class="col-sm-12">
                <fieldset>
                    <legend><?= Yii::t('application', 'Pricing Info') ?></legend>
                    <table>
                        <tbody>
                        <tr>
                            <td><?= Yii::t('application', 'Product price (without tax)') ?></td>
                            <td><?= Yii::t('application', '{price} {currency}', [
                                    'price' => Yii::$app->formatter->asDecimal(Yii::$app->cart->getCost(), 2),
                                    'currency' => '&euro;',
                                ]) ?></td>
                        </tr>
                        <tr>
                            <td><?= Yii::t('application', 'Tax price ({percentage}%)', [
                                    'percentage' => Yii::$app->formatter->asDecimal(23, 2)
                                ]) ?></td>
                            <td><?= Yii::t('application', '{price} {currency}', [
                                    'price' => Yii::$app->formatter->asDecimal(Yii::$app->cart->getCost(), 2),
                                    'currency' => '&euro;',
                                ]) ?></td>
                        </tr>
                        <tr>
                            <td><?= Yii::t('application', 'Price (with tax)') ?></td>
                            <td><?= Yii::t('application', '{price} {currency}', [
                                    'price' => Yii::$app->formatter->asDecimal(Yii::$app->cart->getCost(), 2),
                                    'currency' => '&euro;',
                                ]) ?></td>
                        </tr>
                        <tr>
                            <td><?= Yii::t('application', 'Delivery price') ?></td>
                            <td><?= Yii::t('application', '{price} {currency}', [
                                    'price' => Yii::$app->formatter->asDecimal(Yii::$app->cart->getCost(), 2),
                                    'currency' => '&euro;',
                                ]) ?></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td><?= Yii::t('application', 'Final Price') ?></td>
                            <td><?= Yii::t('application', '{price} {currency}', [
                                    'price' => Yii::$app->formatter->asDecimal(Yii::$app->cart->getCost(), 2),
                                    'currency' => '&euro;',
                                ]) ?></td>
                        </tr>
                        </tfoot>
                    </table>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="payment-info">
        <div class="row">
            <div class="col-sm-12">
                <fieldset>
                    <legend><?= Yii::t('application', 'Payment Info') ?></legend>
                    <div class="row">
                        <div class="col-sm-12">

                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
