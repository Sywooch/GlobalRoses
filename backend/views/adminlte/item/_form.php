<?php

use \yii\helpers\Html;
use \kartik\form\ActiveForm;
use kartik\widgets\FileInput;
use \kartik\widgets\ColorInput;
use \kartik\widgets\Select2;
use \kartik\widgets\SwitchInput;
use \kartik\widgets\TouchSpin;
use \common\models\items\Category;

/* @var $this \yii\web\View */
/* @var $model \common\models\Item */
/* @var $form \kartik\form\ActiveForm */
/* @var $form_id string */
/* @var $previousButton string */
/* @var $nextButton string */
?>

<div class="form">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'type' => ActiveForm::TYPE_VERTICAL,
        'id' => $form_id,
    ]); ?>

    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'name')->textInput([
                            'maxlength' => 255,
                            'placeholder' => Yii::t('item', 'Placeholder: Item name ...')
                        ]); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'id_category')->widget(Select2::classname(), [
                            'data' => Category::getCategoryGrouped(),
                            'language' => Yii::$app->language,
                            'options' => [
                                'id' => 'id_category',
                                'placeholder' => Yii::t('item', 'Placeholder: Select category ...')
                            ]
                        ]); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'color')->widget(ColorInput::classname(), [
                            'options' => [
                                'placeholder' => Yii::t('item', 'Placeholder: Select color ...'),
                            ],
                            'pluginOptions' => [
                                'showAlpha' => false,
                            ]
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'quantity')->widget(TouchSpin::classname(), [
                            'options' => [
                                'placeholder' => Yii::t('item', 'Placeholder: Set quality ...'),
                            ],
                            'pluginOptions' => [
                                'verticalbuttons' => true,
                                'initval' => 1,
                                'min' => 0,
                                'max' => 2000,
                            ]
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'stock')->widget(TouchSpin::classname(), [
                            'options' => [
                                'placeholder' => Yii::t('item', 'Placeholder: Set stock ...'),
                            ],
                            'pluginOptions' => [
                                'verticalbuttons' => true,
                                'initval' => 1,
                                'min' => 0,
                                'max' => 2000,
                            ]
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'height')->widget(TouchSpin::classname(), [
                            'options' => [
                                'placeholder' => Yii::t('item', 'Placeholder: Set height ...'),
                            ],
                            'pluginOptions' => [
                                'verticalbuttons' => true,
                                'initval' => 1,
                                'min' => 0,
                                'max' => 200,
                                'postfix' => 'cm',
                            ]
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'weight')->widget(TouchSpin::classname(), [
                            'options' => [
                                'placeholder' => Yii::t('item', 'Placeholder: Set weight ...'),
                            ],
                            'pluginOptions' => [
                                'verticalbuttons' => true,
                                'initval' => 1.00,
                                'min' => 0,
                                'max' => 1000,
                                'step' => 0.1,
                                'decimals' => 2,
                                'boostat' => 5,
                                'maxboostedstep' => 10,
                                'postfix' => 'gr',
                            ]
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'unit_price')->widget(TouchSpin::classname(), [
                            'options' => [
                                'placeholder' => Yii::t('item', 'Placeholder: Set Unit Price ...'),
                            ],
                            'pluginOptions' => [
                                'verticalbuttons' => true,
                                'initval' => 0.00,
                                'min' => 0.00,
                                'max' => 100000.00,
                                'step' => 0.1,
                                'decimals' => 2,
                                'boostat' => 5,
                                'maxboostedstep' => 10,
                                'postfix' => '&euro;',
                            ]
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
                            'inlineLabel' => false,
                            'pluginOptions' => [
                                'onColor' => 'success',
                                'offColor' => 'danger',
                                'onText' => '<i class="glyphicon glyphicon-ok"></i>',
                                'offText' => '<i class="glyphicon glyphicon-remove"></i>',
                            ]
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'available')->widget(SwitchInput::classname(), [
                            'inlineLabel' => false,
                            'pluginOptions' => [
                                'onColor' => 'success',
                                'offColor' => 'danger',
                                'onText' => '<i class="glyphicon glyphicon-ok"></i>',
                                'offText' => '<i class="glyphicon glyphicon-remove"></i>',
                            ]
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?php
                $image_pluginOptions = [
                    'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                    'showUpload' => false,
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' => Yii::t('commons/application', 'Select ...'),
                ];
                $image_pluginEvents = [];
                if (!$model->isNewRecord && $model->fileExists()) {
                    $image_pluginOptions['initialPreview'] = [
                        Html::img($model->getFileUrl(),
                            [
                                'class' => 'file-preview-image',
                                'alt' => $model->name,
                                'title' => $model->file_name_original
                            ])
                    ];
                    $image_pluginOptions['initialCaption'] = $model->file_name_original;

                    $image_pluginEvents = [
                        'filecleared' => 'function() {
                            var $this = $(this);var $form = $this.closest("form");
                            $form.find("input[name=\'file_cleared\']").val(1);
                            console.log($this);console.log($form);
                        }',
                        'fileloaded' => 'function() {
                            var $this = $(this);var $form = $this.closest("form");
                            $form.find("input[name=\'file_cleared\']").val(1);
                            console.log($this);console.log($form);
                        }',
                    ];

                    echo Html::hiddenInput('file_cleared', 0, []);
                }
                echo $form->field($model, 'upload_file')->widget(FileInput::classname(), [
                    'options' => [
                        'accept' => 'image/*',
                    ],
                    'pluginOptions' => $image_pluginOptions,
                    'pluginEvents' => $image_pluginEvents
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="btn-group" role="group">
            <?php
            if ($model->isNewRecord) {
                echo Html::submitButton(
                    Yii::t('common/application', 'Create'),
                    ['class' => 'btn btn-success  btn-sm']);
            } else {
                if (isset($previousButton)) {
                    echo $previousButton;
                }
                echo Html::a(
                    '<i class="glyphicon glyphicon-eye-open"></i>',
                    ['view', 'id' => $model->id],
                    [
                        'class' => 'btn btn-success  btn-sm',
                        'title' => Yii::t('common/application', 'View')
                    ]);
                echo Html::submitButton(
                    '<i class="glyphicon glyphicon-floppy-disk"></i>',
                    [
                        'class' => 'btn btn-primary  btn-sm',
                        'title' => Yii::t('common/application', 'Update')
                    ]);
                if (isset($nextButton)) {
                    echo $nextButton;
                }
            }
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
