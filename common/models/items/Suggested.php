<?php

namespace common\models\items;

use Yii;
use \common\models\ItemQuery;

/**
 *
 * @inheritdoc
 */
class Suggested extends Available
{

    public static function find()
    {
        $query = new ItemQuery(get_called_class());
        return $query->suggested();
    }

}
