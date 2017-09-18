<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\VwResumenOrden;

/**
 * VwResumenOrdenSearch represents the model behind the search form about `frontend\models\VwResumenOrden`.
 */
class VwResumenOrdenSearch extends VwResumenOrden
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaccion', 'id_vehiculo', 'nro_puestos', 'asesor', 'numero_atencion', 'activo'], 'integer'],
            [['modelo', 'tipo_vehiculo', 'marca', 'placa', 'anio', 'color', 'serial_carroceria', 'serial_motor', 'venta', 'propietario', 'nombre_propietario', 'fecha_transaccion', 'fecha', 'hora', 'nombre_asesor', 'representante', 'nombre_representante', 'pagador', 'nombre_pagador', 'observacion', 'observacion3'], 'safe'],
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
        $query = VwResumenOrden::find();

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
            'nro_puestos' => $this->nro_puestos,
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

        $query->andFilterWhere(['like', 'modelo', $this->modelo])
            ->andFilterWhere(['like', 'tipo_vehiculo', $this->tipo_vehiculo])
            ->andFilterWhere(['like', 'marca', $this->marca])
            ->andFilterWhere(['like', 'placa', $this->placa])
            ->andFilterWhere(['like', 'anio', $this->anio])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'serial_carroceria', $this->serial_carroceria])
            ->andFilterWhere(['like', 'serial_motor', $this->serial_motor])
            ->andFilterWhere(['like', 'venta', $this->venta])
            ->andFilterWhere(['like', 'propietario', $this->propietario])
            ->andFilterWhere(['like', 'nombre_propietario', $this->nombre_propietario])
            ->andFilterWhere(['like', 'hora', $this->hora])
            ->andFilterWhere(['like', 'nombre_asesor', $this->nombre_asesor])
            ->andFilterWhere(['like', 'representante', $this->representante])
            ->andFilterWhere(['like', 'nombre_representante', $this->nombre_representante])
            ->andFilterWhere(['like', 'pagador', $this->pagador])
            ->andFilterWhere(['like', 'nombre_pagador', $this->nombre_pagador])
            ->andFilterWhere(['like', 'observacion', $this->observacion])
            ->andFilterWhere(['like', 'observacion3', $this->observacion3]);

        return $dataProvider;
    }
}
