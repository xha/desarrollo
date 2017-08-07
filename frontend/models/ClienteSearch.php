<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Cliente;

/**
 * ClienteSearch represents the model behind the search form about `frontend\models\Cliente`.
 */
class ClienteSearch extends Cliente
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodClie', 'Descrip', 'ID3', 'DescOrder', 'Clase', 'Represent', 'Direc1', 'Direc2', 'ZipCode', 'Telef', 'Movil', 'Email', 'Fax', 'FechaE', 'CodZona', 'CodVend', 'CodConv', 'CodAlte', 'Observa', 'FechaUV', 'NumeroUV', 'FechaUP', 'NumeroUP', 'DescripExt'], 'safe'],
            [['TipoID3', 'TipoID', 'Activo', 'Pais', 'Estado', 'Ciudad', 'Municipio', 'TipoCli', 'TipoPVP', 'EsMoneda', 'EsCredito', 'DiasCred', 'EsToleran', 'DiasTole', 'IntMora'], 'integer'],
            [['LimiteCred', 'Descto', 'Saldo', 'PagosA', 'MontoUV', 'MontoUP', 'MontoMax', 'MtoMaxCred', 'PromPago', 'RetenIVA', 'SaldoPtos'], 'number'],
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
        $query = Cliente::find();

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
            'TipoID3' => $this->TipoID3,
            'TipoID' => $this->TipoID,
            'Activo' => $this->Activo,
            'Pais' => $this->Pais,
            'Estado' => $this->Estado,
            'Ciudad' => $this->Ciudad,
            'Municipio' => $this->Municipio,
            'FechaE' => $this->FechaE,
            'TipoCli' => $this->TipoCli,
            'TipoPVP' => $this->TipoPVP,
            'EsMoneda' => $this->EsMoneda,
            'EsCredito' => $this->EsCredito,
            'LimiteCred' => $this->LimiteCred,
            'DiasCred' => $this->DiasCred,
            'EsToleran' => $this->EsToleran,
            'DiasTole' => $this->DiasTole,
            'IntMora' => $this->IntMora,
            'Descto' => $this->Descto,
            'Saldo' => $this->Saldo,
            'PagosA' => $this->PagosA,
            'FechaUV' => $this->FechaUV,
            'MontoUV' => $this->MontoUV,
            'FechaUP' => $this->FechaUP,
            'MontoUP' => $this->MontoUP,
            'MontoMax' => $this->MontoMax,
            'MtoMaxCred' => $this->MtoMaxCred,
            'PromPago' => $this->PromPago,
            'RetenIVA' => $this->RetenIVA,
            'SaldoPtos' => $this->SaldoPtos,
        ]);

        $query->andFilterWhere(['like', 'CodClie', $this->CodClie])
            ->andFilterWhere(['like', 'Descrip', $this->Descrip])
            ->andFilterWhere(['like', 'ID3', $this->ID3])
            ->andFilterWhere(['like', 'DescOrder', $this->DescOrder])
            ->andFilterWhere(['like', 'Clase', $this->Clase])
            ->andFilterWhere(['like', 'Represent', $this->Represent])
            ->andFilterWhere(['like', 'Direc1', $this->Direc1])
            ->andFilterWhere(['like', 'Direc2', $this->Direc2])
            ->andFilterWhere(['like', 'ZipCode', $this->ZipCode])
            ->andFilterWhere(['like', 'Telef', $this->Telef])
            ->andFilterWhere(['like', 'Movil', $this->Movil])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'Fax', $this->Fax])
            ->andFilterWhere(['like', 'CodZona', $this->CodZona])
            ->andFilterWhere(['like', 'CodVend', $this->CodVend])
            ->andFilterWhere(['like', 'CodConv', $this->CodConv])
            ->andFilterWhere(['like', 'CodAlte', $this->CodAlte])
            ->andFilterWhere(['like', 'Observa', $this->Observa])
            ->andFilterWhere(['like', 'NumeroUV', $this->NumeroUV])
            ->andFilterWhere(['like', 'NumeroUP', $this->NumeroUP])
            ->andFilterWhere(['like', 'DescripExt', $this->DescripExt]);

        return $dataProvider;
    }
}
