<?php

namespace common\models\items;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ItemSearch represents the model behind the search form about `common\models\Item`.
 */
class SuggestedSearch extends Suggested
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id_category', 'validateCategory'],
            [['height', 'weight', 'unit_price'], 'number'],
            [['name', 'reference', 'color', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function validateCategory($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!is_array($this->$attribute)) {
                $this->addError($attribute, 'Incorrect category.');
            }
        }
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Suggested::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $case_load = $this->load($params);
        $case_valid = $this->validate();
        $case = !($this->load($params) && $this->validate());
        if ($case) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            '`item`.`id_category`' => $this->id_category,
            '`item`.`color`' => $this->color,
        ]);

        $query->joinWith('idCategory');

        $query->andFilterWhere(['like', '`item`.`name`', $this->name])
            ->andFilterWhere(['like', '`item`.`reference`', $this->reference])
            ->andFilterWhere(['like', '`item`.`color`', $this->color]);

        return $dataProvider;
    }

    public function searchDefault()
    {
        return $this->search(array());
    }
}
