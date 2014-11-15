<?php

namespace common\models\items;

use common\components\DeletedBehavior;
use \yii\db\ActiveQuery;

class CategoryQuery extends ActiveQuery
{
    public function active()
    {
        $this->andWhere(['and', 'deleted=:default_deleted', 'id!=:default_parent'])
            ->params(['default_deleted' => DeletedBehavior::DELETED_NO, 'default_parent' => Category::DEFAULT_PARENT]);
        return $this;
    }

    public function deleted()
    {
        $this->andWhere(['and', 'deleted=:default_deleted', 'id!=:default_parent'])
            ->params(['default_deleted' => DeletedBehavior::DELETED_YES, 'default_parent' => Category::DEFAULT_PARENT]);
        return $this;
    }
}
