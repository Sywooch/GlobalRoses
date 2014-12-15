<?php

namespace frontend\models\cart;

use Yii;
use \common\models\ItemQuery;

/**
 *
 * @inheritdoc
 */
class Item extends \common\models\Item
{
    public $request_quantity;
}
