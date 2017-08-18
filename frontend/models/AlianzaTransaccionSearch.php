<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\AlianzaTransaccion;

/**
 * AlianzaTransaccionSearch represents the model behind the search form about `frontend\models\AlianzaTransaccion`.
 */
class AlianzaTransaccionSearch extends AlianzaTransaccion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_at', 'id_alianza', 'id_transaccion', 'almacenista', 'activo'], 'integer'],
            [['nro_factura', 'fecha', 'nro_control', 'CodProv'], 'safe'],
            [['total'], 'number'],
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
        $query = AlianzaTransaccion::find();

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
            'id_at' => $this->id_at,
            'id_alianza' => $this->id_alianza,
            'id_transaccion' => $this->id_transaccion,
            'fecha' => $this->fecha,
            'almacenista' => $this->almacenista,
            'total' => $this->total,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'nro_factura', $this->nro_factura])
            ->andFilterWhere(['like', 'nro_control', $this->nro_control])
            ->andFilterWhere(['like', 'CodProv', $this->CodProv]);

        return $dataProvider;
    }
}
