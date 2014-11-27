<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ItemSearch represents the model behind the search form about `common\models\Item`.
 */
class ItemSearch extends Item
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_category', 'quantity', 'stock', 'available', 'deleted', 'created_at', 'updated_at'], 'integer'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Item::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            '`item`.`id`' => $this->id,
            '`item`.`id_category`' => $this->id_category,
            '`item`.`quantity`' => $this->quantity,
            '`item`.`stock`' => $this->stock,
            '`item`.`height`' => $this->height,
            '`item`.`weight`' => $this->weight,
            '`item`.`color`' => $this->color,
            '`item`.`available`' => $this->available,
            '`item`.`unit_price`' => $this->unit_price,
            '`item`.`deleted`' => $this->deleted,
            '`item`.`created_at`' => $this->created_at,
            '`item`.`updated_at`' => $this->updated_at,
        ]);

        $query->joinWith('idCategory');

        $query->andFilterWhere(['like', '`item`.`name`', $this->name])
            ->andFilterWhere(['like', '`item`.`reference`', $this->reference])
            ->andFilterWhere(['like', '`item`.`color`', $this->color])
            ->andFilterWhere(['like', '`item`.`status`', $this->status]);

        return $dataProvider;
    }
}
