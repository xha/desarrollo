<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISAU_TallerTransaccion".
 *
 * @property integer $id_taller
 * @property integer $id_transaccion
 * @property string $fecha_transaccion
 * @property integer $tecnico
 * @property string $observacion
 * @property integer $activo
 *
 * @property ISAUTransaccion $idTransaccion
 */
class TallerTransaccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISAU_TallerTransaccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaccion', 'tecnico'], 'required'],
            [['id_transaccion', 'tecnico', 'activo'], 'integer'],
            [['fecha_transaccion'], 'safe'],
            [['observacion'], 'string'],
            [['id_transaccion'], 'exist', 'skipOnError' => true, 'targetClass' => Transaccion::className(), 'targetAttribute' => ['id_transaccion' => 'id_transaccion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_taller' => 'Id Taller',
            'id_transaccion' => 'Id Transaccion',
            'fecha_transaccion' => 'Fecha Transaccion',
            'tecnico' => 'Tecnico',
            'observacion' => 'Observacion',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaccion()
    {
        return $this->hasOne(Transaccion::className(), ['id_transaccion' => 'id_transaccion']);
    }
    
    public function getVehiculo()
    {
        return $this->hasOne(Transaccion::className(), ['id_transaccion' => 'id_transaccion']);
    }
    
  
    
    public function getPlaca1(){

        $r= Transaccion::findOne($this->id_transaccion);
        $a = $r->id_vehiculo;
        $v = Vehiculo::findOne($a);
        return ($v) ? $v->placa : '<no definido>';
    }

    public function getAsesor(){

        $r= Transaccion::findOne($this->id_transaccion);
        $a = $r->asesor;
        $v = Usuario::findOne($a);
        
        return ($v) ? $v->id_usuario : '<no definido>';
    }
    
    public function getTecnico(){
        $v = Usuario::findOne($this->tecnico);
        return ($v) ? $v->nombre . ' ' .$v->apellido : '<no definido>';
    }
    
    public static function ListaAsesor(){
        $array = \yii\helpers\ArrayHelper::map(Usuario::find()->where(['activo'=>1])->orderBy('nombre')->all(),'id_usuario', 'NombreCompleto');
        //var_dump($array); die();
        return($array) ? $array : [];
    }
    
    public static function ListaTecnico(){
        $array = \yii\helpers\ArrayHelper::map(Usuario::find()->where(['activo'=>1])->orderBy('nombre')->all(),'id_usuario', 'NombreCompleto');
        //var_dump($array); die();
        return($array) ? $array : [];
    }
    
    
    
    
    }
