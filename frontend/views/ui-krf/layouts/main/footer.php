<?php
use yii\helpers\Html;
use \yii\helpers\Url;

?>
<footer>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-sm-3 col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a(Yii::t('application', 'FAQ'), Url::to(['site/faq'])) ?></li>
                </ul>
            </div>
            <div class="col-sm-3 col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a(Yii::t('application', 'Contact'), Url::to(['site/contact'])) ?></li>
                </ul>
            </div>
            <div class="col-sm-3 col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a(Yii::t('application', 'Who we are'), Url::to(['site/about'])) ?></li>
                </ul>
            </div>
            <div class="col-sm-3 col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a(Yii::t('application', 'Payment methods'), Url::to(['site/payment'])) ?></li>
                </ul>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills nav-justified">
                <li><?= Html::a(Yii::t('application', 'Copyright Project', ['year' => date('Y')]), '#') ?></li>
                <li><?= Html::a(Yii::t('application', 'Terms and conditions'), '#') ?></li>
                <li><?= Html::a(Yii::t('application', 'Privacy policy'), '#') ?></li>
            </ul>
        </div>

    </div>
</footer>