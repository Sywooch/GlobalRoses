<?php

namespace common\models;

use common\components\SoftDeleteBehavior;
use \yii\db\ActiveQuery;

class ItemQuery extends ActiveQuery
{
    public function active()
    {
        $this->andWhere('deleted=:default_deleted')
            ->addParams(['default_deleted' => SoftDeleteBehavior::DELETED_NO]);
        return $this;
    }

    public function deleted()
    {
        $this->andWhere('deleted=:default_deleted')
            ->addParams(['default_deleted' => SoftDeleteBehavior::DELETED_YES]);
        return $this;
    }
}
