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
        } else {
            $this->addError($attribute, 'category is empty');
        }
    }

    public function getSearchModel()
    {
        return new SuggestedSearch();
    }

    /**
     * Item Search
     *
     * @param $params
     * @return \common\models\items\SuggestedSearch[]|null the search result or null
     */
    public function search($params)
    {
        $searchModel = $this->getSearchModel();
        $category = isset($params['category']) ? (array)$params['category'] : [];
        $color = isset($params['color']) ? $params['color'] : null;

        $search_params = [$searchModel->formName() => [
            'id_category' => $category,
            'color' => $color
        ]];

        $is_valid = $this->validate();
        if ($is_valid && (!empty($category) || !is_null($color))) {
            $dataProvider = $searchModel->search($search_params);
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
