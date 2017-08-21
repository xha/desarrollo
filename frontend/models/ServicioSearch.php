<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Servicio;

/**
 * ServicioSearch represents the model behind the search form about `frontend\models\Servicio`.
 */
class ServicioSearch extends Servicio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodServ', 'Descrip', 'Descrip2', 'Descrip3', 'Clase', 'Unidad', 'FechaUV', 'FechaUC'], 'safe'],
            [['CodInst', 'Activo', 'EsExento', 'EsReten', 'EsPorCost', 'UsaServ', 'EsPorComi', 'EsImport', 'EsVenta', 'EsCompra'], 'integer'],
            [['Precio1', 'PrecioI1', 'Precio2', 'PrecioI2', 'Precio3', 'PrecioI3', 'Costo', 'Comision'], 'number'],
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
        $query = Servicio::find();

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
            'Precio1' => $this->Precio1,
            'PrecioI1' => $this->PrecioI1,
            'Precio2' => $this->Precio2,
            'PrecioI2' => $this->PrecioI2,
            'Precio3' => $this->Precio3,
            'PrecioI3' => $this->PrecioI3,
            'Costo' => $this->Costo,
            'EsExento' => $this->EsExento,
            'EsReten' => $this->EsReten,
            'EsPorCost' => $this->EsPorCost,
            'UsaServ' => $this->UsaServ,
            'Comision' => $this->Comision,
            'EsPorComi' => $this->EsPorComi,
            'FechaUV' => $this->FechaUV,
            'FechaUC' => $this->FechaUC,
            'EsImport' => $this->EsImport,
            'EsVenta' => $this->EsVenta,
            'EsCompra' => $this->EsCompra,
        ]);

        $query->andFilterWhere(['like', 'CodServ', $this->CodServ])
            ->andFilterWhere(['like', 'Descrip', $this->Descrip])
            ->andFilterWhere(['like', 'Descrip2', $this->Descrip2])
            ->andFilterWhere(['like', 'Descrip3', $this->Descrip3])
            ->andFilterWhere(['like', 'Clase', $this->Clase])
            ->andFilterWhere(['like', 'Unidad', $this->Unidad]);

        return $dataProvider;
    }
}
