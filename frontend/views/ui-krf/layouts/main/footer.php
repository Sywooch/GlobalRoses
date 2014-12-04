<?php
use yii\helpers\Html;

?>
<footer>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-sm-3 col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a(Yii::t('application', 'FAQ'), ['faq']) ?></li>
                </ul>
            </div>
            <div class="col-sm-3 col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a(Yii::t('application', 'Contact'), ['contact']) ?></li>
                </ul>
            </div>
            <div class="col-sm-3 col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a(Yii::t('application', 'Who we are'), ['about']) ?></li>
                </ul>
            </div>
            <div class="col-sm-3 col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li><?= Html::a(Yii::t('application', 'Payment methods'), ['payment']) ?></li>
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