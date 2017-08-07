<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Vehiculo;

/**
 * VehiculoSearch represents the model behind the search form about `frontend\models\Vehiculo`.
 */
class VehiculoSearch extends Vehiculo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_vehiculo', 'id_modelo', 'id_tipo_vehiculo', 'activo'], 'integer'],
            [['placa', 'anio', 'color', 'propietario'], 'safe'],
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
        $query = Vehiculo::find();

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
            'id_vehiculo' => $this->id_vehiculo,
            'id_modelo' => $this->id_modelo,
            'id_tipo_vehiculo' => $this->id_tipo_vehiculo,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'placa', $this->placa])
            ->andFilterWhere(['like', 'anio', $this->anio])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'propietario', $this->propietario]);

        return $dataProvider;
    }
}
