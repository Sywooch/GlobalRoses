<?php

namespace common\models\items;

use Yii;
use \common\models\Item;
use \common\models\ItemQuery;

/**
 *
 * @inheritdoc
 */
class Suggested extends Item
{

    public static function find()
    {
        $query = new ItemQuery(get_called_class());
        return $query->suggested();
    }

}
