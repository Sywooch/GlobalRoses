<?php

namespace backend\controllers;

use Yii;
use common\models\items\Category;
use common\models\items\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BackendController
 */
abstract class Backend extends Controller
{
    public $content_header = '';
}
