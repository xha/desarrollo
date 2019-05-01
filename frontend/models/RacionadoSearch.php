<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Racionado;

/**
 * RacionadoSearch represents the model behind the search form about `frontend\models\Racionado`.
 */
class RacionadoSearch extends Racionado
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodItem', 'CodUbic'], 'safe'],
            [['dias', 'activo'], 'integer'],
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
        $query = Racionado::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'dias' => $this->dias,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'CodItem', $this->CodItem])
            ->andFilterWhere(['like', 'CodUbic', $this->CodUbic]);

        return $dataProvider;
    }
}
