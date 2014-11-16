<?php

namespace common\models\items;

use common\components\SoftDeleteBehavior;
use \yii\db\ActiveQuery;

class CategoryQuery extends ActiveQuery
{
    public function active()
    {
        $this->andWhere(['and', 'deleted=:default_deleted', 'id!=:default_parent'])
            ->addParams(['default_deleted' => SoftDeleteBehavior::DELETED_NO, 'default_parent' => Category::DEFAULT_PARENT]);
        return $this;
    }

    public function deleted()
    {
        $this->andWhere(['and', 'deleted=:default_deleted', 'id!=:default_parent'])
            ->addParams(['default_deleted' => SoftDeleteBehavior::DELETED_YES, 'default_parent' => Category::DEFAULT_PARENT]);
        return $this;
    }
}
