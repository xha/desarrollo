<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Tecnico;

/**
 * TecnicoSearch represents the model behind the search form about `frontend\models\Tecnico`.
 */
class TecnicoSearch extends Tecnico
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodMeca', 'Descrip', 'ID3', 'DescOrder', 'Clase', 'Direc1', 'Direc2', 'Telef', 'Movil', 'Email'], 'safe'],
            [['TipoID3', 'TipoID', 'Activo', 'DEsComi'], 'integer'],
            [['Monto'], 'number'],
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
        $query = Tecnico::find();

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
            'DEsComi' => $this->DEsComi,
            'Monto' => $this->Monto,
        ]);

        $query->andFilterWhere(['like', 'CodMeca', $this->CodMeca])
            ->andFilterWhere(['like', 'Descrip', $this->Descrip])
            ->andFilterWhere(['like', 'ID3', $this->ID3])
            ->andFilterWhere(['like', 'DescOrder', $this->DescOrder])
            ->andFilterWhere(['like', 'Clase', $this->Clase])
            ->andFilterWhere(['like', 'Direc1', $this->Direc1])
            ->andFilterWhere(['like', 'Direc2', $this->Direc2])
            ->andFilterWhere(['like', 'Telef', $this->Telef])
            ->andFilterWhere(['like', 'Movil', $this->Movil])
            ->andFilterWhere(['like', 'Email', $this->Email]);

        return $dataProvider;
    }
}
