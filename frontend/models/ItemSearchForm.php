<?php
namespace frontend\models;

use common\models\Item;
use yii\base\Model;
use Yii;

/**
 * Product Search form
 */
class ItemSearchForm extends Model
{
    public $color;
    public $category;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['color, category', 'integer', 'min' => 0],
        ];
    }

    /**
     * Signs user up.
     *
     * @return Item[]|null the search result or null
     */
    public function search()
    {
        if ($this->validate()) {
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category' => Yii::t('application', 'Categories'),
            'color' => Yii::t('application', 'Color'),
        ];
    }
}
