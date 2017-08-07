<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Transaccion;

/**
 * TransaccionSearch represents the model behind the search form about `frontend\models\Transaccion`.
 */
class TransaccionSearch extends Transaccion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaccion', 'id_vehiculo', 'asesor', 'numero_atencion', 'activo'], 'integer'],
            [['fecha_transaccion', 'fecha', 'hora', 'CodSucu', 'representante', 'observacion'], 'safe'],
            [['km', 'gravable', 'exento', 'tax', 'total'], 'number'],
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
        $query = Transaccion::find();

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
            'id_transaccion' => $this->id_transaccion,
            'id_vehiculo' => $this->id_vehiculo,
            'fecha_transaccion' => $this->fecha_transaccion,
            'fecha' => $this->fecha,
            'asesor' => $this->asesor,
            'km' => $this->km,
            'numero_atencion' => $this->numero_atencion,
            'gravable' => $this->gravable,
            'exento' => $this->exento,
            'tax' => $this->tax,
            'total' => $this->total,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'hora', $this->hora])
            ->andFilterWhere(['like', 'CodSucu', $this->CodSucu])
            ->andFilterWhere(['like', 'representante', $this->representante])
            ->andFilterWhere(['like', 'observacion', $this->observacion]);

        return $dataProvider;
    }
}
