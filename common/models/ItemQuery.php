<?php

namespace common\models;

use common\components\DeletedBehavior;
use \yii\db\ActiveQuery;

class ItemQuery extends ActiveQuery
{
    public function active()
    {
        $this->andWhere('deleted=:default_deleted')
            ->addParams(['default_deleted' => DeletedBehavior::DELETED_NO]);
        return $this;
    }

    public function deleted()
    {
        $this->andWhere('deleted=:default_deleted')
            ->addParams(['default_deleted' => DeletedBehavior::DELETED_YES]);
        return $this;
    }
}
