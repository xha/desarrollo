<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Presupuesto;

/**
 * PresupuestoSearch represents the model behind the search form about `frontend\models\Presupuesto`.
 */
class PresupuestoSearch extends Presupuesto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodSucu', 'TipoFac', 'NumeroD', 'NroCtrol', 'CodEsta', 'CodUsua', 'CodConv', 'FechaT', 'OTipo', 'ONumero', 'NumeroC', 'NumeroT', 'NumeroR', 'AutSRI', 'NroEstable', 'PtoEmision', 'NumeroF', 'NumeroNCF', 'NumeroP', 'NumeroE', 'NumeroZ', 'Moneda', 'CodClie', 'CodVend', 'CodUbic', 'Descrip', 'Direc1', 'Direc2', 'Direc3', 'ZipCode', 'Telef', 'ID3', 'FechaR', 'FechaI', 'FechaE', 'FechaV', 'DetalChq', 'OrdenC', 'CodOper', 'Notas1', 'Notas2', 'Notas3', 'Notas4', 'Notas5', 'Notas6', 'Notas7', 'Notas8', 'Notas9', 'Notas10'], 'safe'],
            [['NroUnico', 'EsCorrel', 'Signo', 'TipoTraE', 'NGiros', 'NMeses'], 'integer'],
            [['Factor', 'MontoMEx', 'Monto', 'MtoTax', 'Fletes', 'TGravable', 'TGravable0', 'TExento', 'CostoPrd', 'CostoSrv', 'DesctoP', 'RetenIVA', 'MtoTotal', 'Contado', 'Credito', 'CancelI', 'CancelA', 'CancelE', 'CancelC', 'CancelT', 'CancelG', 'CancelP', 'Cambio', 'MtoExtra', 'ValorPtos', 'Descto1', 'PctAnual', 'MtoInt1', 'Descto2', 'PctManejo', 'MtoInt2', 'SaldoAct', 'MtoPagos', 'MtoNCredito', 'MtoNDebito', 'MtoFinanc', 'TotalPrd', 'TotalSrv', 'MtoComiVta', 'MtoComiCob', 'MtoComiVtaD', 'MtoComiCobD'], 'number'],
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
        $query = Presupuesto::find();

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
            'NroUnico' => $this->NroUnico,
            'EsCorrel' => $this->EsCorrel,
            'Signo' => $this->Signo,
            'FechaT' => $this->FechaT,
            'TipoTraE' => $this->TipoTraE,
            'Factor' => $this->Factor,
            'MontoMEx' => $this->MontoMEx,
            'Monto' => $this->Monto,
            'MtoTax' => $this->MtoTax,
            'Fletes' => $this->Fletes,
            'TGravable' => $this->TGravable,
            'TGravable0' => $this->TGravable0,
            'TExento' => $this->TExento,
            'CostoPrd' => $this->CostoPrd,
            'CostoSrv' => $this->CostoSrv,
            'DesctoP' => $this->DesctoP,
            'RetenIVA' => $this->RetenIVA,
            'FechaR' => $this->FechaR,
            'FechaI' => $this->FechaI,
            'FechaE' => $this->FechaE,
            'FechaV' => $this->FechaV,
            'MtoTotal' => $this->MtoTotal,
            'Contado' => $this->Contado,
            'Credito' => $this->Credito,
            'CancelI' => $this->CancelI,
            'CancelA' => $this->CancelA,
            'CancelE' => $this->CancelE,
            'CancelC' => $this->CancelC,
            'CancelT' => $this->CancelT,
            'CancelG' => $this->CancelG,
            'CancelP' => $this->CancelP,
            'Cambio' => $this->Cambio,
            'MtoExtra' => $this->MtoExtra,
            'ValorPtos' => $this->ValorPtos,
            'Descto1' => $this->Descto1,
            'PctAnual' => $this->PctAnual,
            'MtoInt1' => $this->MtoInt1,
            'Descto2' => $this->Descto2,
            'PctManejo' => $this->PctManejo,
            'MtoInt2' => $this->MtoInt2,
            'SaldoAct' => $this->SaldoAct,
            'MtoPagos' => $this->MtoPagos,
            'MtoNCredito' => $this->MtoNCredito,
            'MtoNDebito' => $this->MtoNDebito,
            'MtoFinanc' => $this->MtoFinanc,
            'TotalPrd' => $this->TotalPrd,
            'TotalSrv' => $this->TotalSrv,
            'NGiros' => $this->NGiros,
            'NMeses' => $this->NMeses,
            'MtoComiVta' => $this->MtoComiVta,
            'MtoComiCob' => $this->MtoComiCob,
            'MtoComiVtaD' => $this->MtoComiVtaD,
            'MtoComiCobD' => $this->MtoComiCobD,
        ]);

        $query->andFilterWhere(['like', 'CodSucu', $this->CodSucu])
            ->andFilterWhere(['like', 'TipoFac', $this->TipoFac])
            ->andFilterWhere(['like', 'NumeroD', $this->NumeroD])
            ->andFilterWhere(['like', 'NroCtrol', $this->NroCtrol])
            ->andFilterWhere(['like', 'CodEsta', $this->CodEsta])
            ->andFilterWhere(['like', 'CodUsua', $this->CodUsua])
            ->andFilterWhere(['like', 'CodConv', $this->CodConv])
            ->andFilterWhere(['like', 'OTipo', $this->OTipo])
            ->andFilterWhere(['like', 'ONumero', $this->ONumero])
            ->andFilterWhere(['like', 'NumeroC', $this->NumeroC])
            ->andFilterWhere(['like', 'NumeroT', $this->NumeroT])
            ->andFilterWhere(['like', 'NumeroR', $this->NumeroR])
            ->andFilterWhere(['like', 'AutSRI', $this->AutSRI])
            ->andFilterWhere(['like', 'NroEstable', $this->NroEstable])
            ->andFilterWhere(['like', 'PtoEmision', $this->PtoEmision])
            ->andFilterWhere(['like', 'NumeroF', $this->NumeroF])
            ->andFilterWhere(['like', 'NumeroNCF', $this->NumeroNCF])
            ->andFilterWhere(['like', 'NumeroP', $this->NumeroP])
            ->andFilterWhere(['like', 'NumeroE', $this->NumeroE])
            ->andFilterWhere(['like', 'NumeroZ', $this->NumeroZ])
            ->andFilterWhere(['like', 'Moneda', $this->Moneda])
            ->andFilterWhere(['like', 'CodClie', $this->CodClie])
            ->andFilterWhere(['like', 'CodVend', $this->CodVend])
            ->andFilterWhere(['like', 'CodUbic', $this->CodUbic])
            ->andFilterWhere(['like', 'Descrip', $this->Descrip])
            ->andFilterWhere(['like', 'Direc1', $this->Direc1])
            ->andFilterWhere(['like', 'Direc2', $this->Direc2])
            ->andFilterWhere(['like', 'Direc3', $this->Direc3])
            ->andFilterWhere(['like', 'ZipCode', $this->ZipCode])
            ->andFilterWhere(['like', 'Telef', $this->Telef])
            ->andFilterWhere(['like', 'ID3', $this->ID3])
            ->andFilterWhere(['like', 'DetalChq', $this->DetalChq])
            ->andFilterWhere(['like', 'OrdenC', $this->OrdenC])
            ->andFilterWhere(['like', 'CodOper', $this->CodOper])
            ->andFilterWhere(['like', 'Notas1', $this->Notas1])
            ->andFilterWhere(['like', 'Notas2', $this->Notas2])
            ->andFilterWhere(['like', 'Notas3', $this->Notas3])
            ->andFilterWhere(['like', 'Notas4', $this->Notas4])
            ->andFilterWhere(['like', 'Notas5', $this->Notas5])
            ->andFilterWhere(['like', 'Notas6', $this->Notas6])
            ->andFilterWhere(['like', 'Notas7', $this->Notas7])
            ->andFilterWhere(['like', 'Notas8', $this->Notas8])
            ->andFilterWhere(['like', 'Notas9', $this->Notas9])
            ->andFilterWhere(['like', 'Notas10', $this->Notas10]);

        return $dataProvider;
    }
}
