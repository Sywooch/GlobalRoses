<?php
/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@app/views/layouts//main'); ?>
    <div class="well well-sm well-title">
        <strong><?= Yii::t('application', 'Suggested') ?></strong>
    </div>
    <div class="well well-sm">
        <?= $content ?>
    </div>
<?php $this->endContent(); ?>