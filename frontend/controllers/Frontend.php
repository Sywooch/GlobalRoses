<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * FrontendController
 */
abstract class Frontend extends Controller
{
    /**
     * @var array
     */
    public $searchData;

    protected $_layout_carousel = 'carousel';
    protected $_layout_login = 'login';
    protected $_layout_empty = 'empty';

}
