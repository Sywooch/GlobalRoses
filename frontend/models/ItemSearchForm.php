<?php
namespace frontend\models;

use common\models\items\Category;
use common\models\items\Suggested;
use common\models\items\SuggestedSearch;
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
            ['color', 'string'],
            ['color', 'safe'],
            ['category', 'categoryExists'],
        ];
    }

    public function categoryExists($attribute, $params)
    {
        $category = (array)$this->category;
        if (!empty($category)) {
            $available = Category::getCategoriesIdList();
            $diff = array_diff($category, $available);
            if (count($diff) > 0) {
                $this->addError($attribute, 'category value error');
            }
        }
    }

    public function getSearchModel()
    {
        return new SuggestedSearch();
    }
    /**
     * Item Search
     *
     * @return Suggested[]|null the search result or null
     */
    public function search($params)
    {
        $searchModel = $this->getSearchModel();
        if ($this->validate()) {
            $dataProvider = $searchModel->search($params);
        } else {
            $dataProvider = $searchModel->searchDefault();
        }
        return $dataProvider;

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
