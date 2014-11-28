<?php
/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('//layouts/main'); ?>
    <div class="well well-sm carousel-container">
        <div id="carousel">
            <div class="item">
                <a href="#" title=""><img
                        src="themes/ui-krf/imgs/products/carousel1.jpg" alt=""></a>

                <div class="caption">
                    <p>

                    <h3><?= Yii::t('application', '_carousel_title_1_') ?></h3>
                    <?= Yii::t('application', '_carousel_text_1_') ?>
                    </p>
                </div>
            </div>
            <div class="item">
                <a href="#" title=""><img
                        src="themes/ui-krf/imgs/products/carousel2.jpg" alt=""></a>

                <div class="caption">
                    <p>

                    <h3><?= Yii::t('application', '_carousel_title_2_') ?></h3>
                    <?= Yii::t('application', '_carousel_text_2_') ?>
                    </p>
                </div>
            </div>
            <div class="item">
                <a href="#" title=""><img
                        src="themes/ui-krf/imgs/products/carousel3.jpg" alt=""></a>

                <div class="caption">
                    <p>

                    <h3><?= Yii::t('application', '_carousel_title_3_') ?></h3>
                    <?= Yii::t('application', '_carousel_text_3_') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="well well-sm well-title">
        <strong><?= Yii::t('application', 'Suggested') ?></strong>
    </div>
    <div class="well well-sm">
        <?= $content ?>
    </div>
<?php $this->endContent(); ?>