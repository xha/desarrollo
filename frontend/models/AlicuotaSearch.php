<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Alicuota;

/**
 * AlicuotaSearch represents the model behind the search form about `app\models\Alicuota`.
 */
class AlicuotaSearch extends Alicuota
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_alicuota', 'id_ubicacion', 'id_piso', 'alquiler', 'activo'], 'integer'],
            [['CodClie', 'descripcion'], 'safe'],
            [['porcentaje'], 'number'],
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
        $query = Alicuota::find();

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
            'id_alicuota' => $this->id_alicuota,
            'id_ubicacion' => $this->id_ubicacion,
            'id_piso' => $this->id_piso,
            'porcentaje' => $this->porcentaje,
            'alquiler' => $this->alquiler,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'CodClie', $this->CodClie])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
