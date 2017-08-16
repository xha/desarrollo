<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TallerTransaccion;

/**
 * TallerTransaccionSearch represents the model behind the search form about `frontend\models\TallerTransaccion`.
 */
class TallerTransaccionSearch extends TallerTransaccion
{
    /**
     * @inheritdoc
     */
     public $filtro_uno; 
     public $filtro_dos; 
     public $filtro_tres; 
     public $filtro_cuatro; 
     public $filtro_cinco; 
     
    
    public function rules()
    {
        return [
            [['id_taller', 'id_transaccion', 'tecnico', 'activo'], 'integer'],
            [['fecha_transaccion', 'observacion','filtro_uno','filtro_dos','filtro_tres','filtro_cuatro','filtro_cinco'], 'safe'],
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
        $query = TallerTransaccion::find();

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
        //Agregamos los join de las tablas para realizar las relaciones
        $query->joinWith('transaccion')->LeftJoin('ISAU_Vehiculo', 'ISAU_Transaccion.id_vehiculo = ISAU_Vehiculo.id_vehiculo')
              ->LeftJoin('ISAU_Usuario', 'ISAU_Transaccion.asesor = ISAU_Usuario.id_usuario');
//        $query->rightJoin('ISAU_Transaccion','ISAU_TallerTransaccion.id_transaccion = ISAU_Transaccion.id_transaccion')->leftJoin('ISAU_Vehiculo', 'ISAU_Transaccion.id_vehiculo = ISAU_Vehiculo.id_vehiculo');s
        
//        
        // grid filtering conditions
        $query->andFilterWhere([
            'id_taller' => $this->id_taller,
            //'id_transaccion' => $this->id_transaccion,
            'id_usuario'=> $this->filtro_tres,
            'fecha_transaccion' => $this->fecha_transaccion,
            'tecnico' => $this->tecnico,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'observacion', $this->observacion])
        ->andFilterWhere(['like', 'ISAU_Transaccion.numero_atencion', $this->filtro_uno])
        ->andFilterWhere(['like', 'ISAU_Vehiculo.placa', $this->filtro_dos])
        ->andFilterWhere(['like', 'ISAU_Transaccion.asesor', $this->filtro_tres])
        ->andFilterWhere(['like', 'ISAU_Usuario', $this->filtro_cuatro])
        ->andFilterWhere(['like', 'ISAU_Transaccion.hora', $this->filtro_cinco]);

        return $dataProvider;
    }
}
