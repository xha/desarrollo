<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Producto;

/**
 * ProductoSearch represents the model behind the search form about `frontend\models\Producto`.
 */
class ProductoSearch extends Producto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodProd', 'Descrip', 'Descrip2', 'Descrip3', 'Refere', 'Marca', 'Unidad', 'UndEmpaq', 'FechaUV', 'FechaUC', 'UndVol'], 'safe'],
            [['CodInst', 'Activo', 'DEsComp', 'DEsComi', 'DEsSeri', 'EsReten', 'DEsLote', 'DEsVence', 'EsImport', 'EsExento', 'EsEnser', 'EsOferta', 'EsPesa', 'EsEmpaque', 'ExDecimal', 'DiasEntr', 'DiasTole'], 'integer'],
            [['CantEmpaq', 'Precio1', 'Precio2', 'PrecioU2', 'Precio3', 'PrecioU3', 'PrecioU', 'CostAct', 'CostPro', 'CostAnt', 'Existen', 'ExUnidad', 'Compro', 'Pedido', 'Minimo', 'Maximo', 'Tara', 'Peso', 'Volumen'], 'number'],
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
        $query = Producto::find();

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
            'CodInst' => $this->CodInst,
            'Activo' => $this->Activo,
            'CantEmpaq' => $this->CantEmpaq,
            'Precio1' => $this->Precio1,
            'Precio2' => $this->Precio2,
            'PrecioU2' => $this->PrecioU2,
            'Precio3' => $this->Precio3,
            'PrecioU3' => $this->PrecioU3,
            'PrecioU' => $this->PrecioU,
            'CostAct' => $this->CostAct,
            'CostPro' => $this->CostPro,
            'CostAnt' => $this->CostAnt,
            'Existen' => $this->Existen,
            'ExUnidad' => $this->ExUnidad,
            'Compro' => $this->Compro,
            'Pedido' => $this->Pedido,
            'Minimo' => $this->Minimo,
            'Maximo' => $this->Maximo,
            'Tara' => $this->Tara,
            'DEsComp' => $this->DEsComp,
            'DEsComi' => $this->DEsComi,
            'DEsSeri' => $this->DEsSeri,
            'EsReten' => $this->EsReten,
            'DEsLote' => $this->DEsLote,
            'DEsVence' => $this->DEsVence,
            'EsImport' => $this->EsImport,
            'EsExento' => $this->EsExento,
            'EsEnser' => $this->EsEnser,
            'EsOferta' => $this->EsOferta,
            'EsPesa' => $this->EsPesa,
            'EsEmpaque' => $this->EsEmpaque,
            'ExDecimal' => $this->ExDecimal,
            'DiasEntr' => $this->DiasEntr,
            'FechaUV' => $this->FechaUV,
            'FechaUC' => $this->FechaUC,
            'DiasTole' => $this->DiasTole,
            'Peso' => $this->Peso,
            'Volumen' => $this->Volumen,
        ]);

        $query->andFilterWhere(['like', 'CodProd', $this->CodProd])
            ->andFilterWhere(['like', 'Descrip', $this->Descrip])
            ->andFilterWhere(['like', 'Descrip2', $this->Descrip2])
            ->andFilterWhere(['like', 'Descrip3', $this->Descrip3])
            ->andFilterWhere(['like', 'Refere', $this->Refere])
            ->andFilterWhere(['like', 'Marca', $this->Marca])
            ->andFilterWhere(['like', 'Unidad', $this->Unidad])
            ->andFilterWhere(['like', 'UndEmpaq', $this->UndEmpaq])
            ->andFilterWhere(['like', 'UndVol', $this->UndVol]);

        return $dataProvider;
    }
}
