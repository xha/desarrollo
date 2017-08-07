<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Proveedor;

/**
 * ProveedorSearch represents the model behind the search form about `frontend\models\Proveedor`.
 */
class ProveedorSearch extends Proveedor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodProv', 'Descrip', 'ID3', 'DescOrder', 'Clase', 'Represent', 'Direc1', 'Direc2', 'ZipCode', 'Telef', 'Movil', 'Fax', 'Email', 'FechaE', 'Observa', 'FechaUC', 'NumeroUC', 'FechaUP', 'NumeroUP'], 'safe'],
            [['TipoPrv', 'TipoID3', 'TipoID', 'Activo', 'Pais', 'Estado', 'Ciudad', 'Municipio', 'EsReten', 'RetenISLR', 'DiasCred', 'EsMoneda'], 'integer'],
            [['Saldo', 'MontoMax', 'PagosA', 'PromPago', 'RetenIVA', 'MontoUC', 'MontoUP'], 'number'],
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
        $query = Proveedor::find();

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
            'TipoPrv' => $this->TipoPrv,
            'TipoID3' => $this->TipoID3,
            'TipoID' => $this->TipoID,
            'Activo' => $this->Activo,
            'Pais' => $this->Pais,
            'Estado' => $this->Estado,
            'Ciudad' => $this->Ciudad,
            'Municipio' => $this->Municipio,
            'FechaE' => $this->FechaE,
            'EsReten' => $this->EsReten,
            'RetenISLR' => $this->RetenISLR,
            'DiasCred' => $this->DiasCred,
            'EsMoneda' => $this->EsMoneda,
            'Saldo' => $this->Saldo,
            'MontoMax' => $this->MontoMax,
            'PagosA' => $this->PagosA,
            'PromPago' => $this->PromPago,
            'RetenIVA' => $this->RetenIVA,
            'FechaUC' => $this->FechaUC,
            'MontoUC' => $this->MontoUC,
            'FechaUP' => $this->FechaUP,
            'MontoUP' => $this->MontoUP,
        ]);

        $query->andFilterWhere(['like', 'CodProv', $this->CodProv])
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
            ->andFilterWhere(['like', 'Fax', $this->Fax])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'Observa', $this->Observa])
            ->andFilterWhere(['like', 'NumeroUC', $this->NumeroUC])
            ->andFilterWhere(['like', 'NumeroUP', $this->NumeroUP]);

        return $dataProvider;
    }
}
