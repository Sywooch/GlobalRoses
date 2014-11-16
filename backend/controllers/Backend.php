<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Html;

/**
 * BackendController
 */
abstract class Backend extends Controller
{
    public $content_header = '';

    protected function previousButton($model, $view)
    {
        $prev = $model->getPrevious();
        $options = [
            'class' => 'btn btn-default',
            'title' => Yii::t('common/application', 'previous')
        ];
        if (is_null($prev)) {
            $options['disabled'] = 'disabled';
        }

        return Html::a('<i class="fa fa-backward"></i>',
            [$view, 'id' => $prev], $options);
    }

    protected function nextButton($model, $view)
    {
        $next = $model->getNext();
        $options = [
            'class' => 'btn btn-default',
            'title' => Yii::t('common/application', 'next')
        ];
        if (is_null($next)) {
            $options['disabled'] = 'disabled';
        }

        return Html::a('<i class="fa fa-forward"></i>',
            [$view, 'id' => $next], $options);
    }
}
