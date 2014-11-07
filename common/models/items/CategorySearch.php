<?php

namespace common\models\items;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\items\Category;

/**
 * CategorySearch represents the model behind the search form about `common\models\items\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_parent', 'deleted', 'created_at'], 'integer'],
            [['name', 'reference'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_parent' => $this->id_parent,
            'deleted' => $this->deleted,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'reference', $this->reference]);

        return $dataProvider;
    }
}
