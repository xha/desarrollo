<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "_Transaccion".
 *
 * @property integer $id_transaccion
 * @property integer $id_vehiculo
 * @property string $fecha_transaccion
 * @property string $fecha
 * @property string $hora
 * @property string $CodSucu
 * @property integer $asesor
 * @property string $km
 * @property string $representante
 * @property integer $numero_atencion
 * @property string $gravable
 * @property string $exento
 * @property string $tax
 * @property string $total
 * @property string $observacion
 * @property integer $activo
 *
 * @property AlianzaTransaccion[] $iSAUAlianzaTransaccions
 * @property DetalleTransaccion[] $iSAUDetalleTransaccions
 * @property SolicitudTransaccion[] $iSAUSolicitudTransaccions
 * @property TallerTransaccion[] $iSAUTallerTransaccions
 * @property TaxTransaccion[] $iSAUTaxTransaccions
 * @property Vehiculo $idVehiculo
 * @property TransaccionInspeccion[] $iSAUTransaccionInspeccions
 */
class Transaccion extends \yii\db\ActiveRecord
{   
    public $placa;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISAU_Transaccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_vehiculo', 'asesor', 'representante', 'placa'], 'required'],
            [['id_vehiculo', 'asesor', 'numero_atencion', 'activo'], 'integer'],
            [['fecha_transaccion', 'fecha'], 'safe'],
            ['placa', 'placaExiste'],
            [['hora', 'CodSucu', 'representante', 'observacion'], 'string'],
            [['km', 'gravable', 'exento', 'tax', 'total'], 'number'],
            [['id_vehiculo'], 'exist', 'skipOnError' => true, 'targetClass' => Vehiculo::className(), 'targetAttribute' => ['id_vehiculo' => 'id_vehiculo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_transaccion' => 'Id Transaccion',
            'id_vehiculo' => 'Vehiculo',
            'fecha_transaccion' => 'Fecha Transaccion',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
            'CodSucu' => 'Sucursal',
            'asesor' => 'Asesor',
            'km' => 'Km',
            'representante' => 'Representante',
            'numero_atencion' => 'Número',
            'gravable' => 'Gravable',
            'exento' => 'Exento',
            'tax' => 'Tax',
            'total' => 'Total',
            'observacion' => 'Observacion',
            'activo' => 'Activo',
        ];
    }

    public function placaExiste($attribute, $params) {
        //Buscar la placa en la tabla
        $table = Vehiculo::find()->where("placa=:placa", [":placa" => $this->placa]);
        
        //Si la placa no existe mostrar el error
        if ($table->count() < 1) {
            $this->addError($attribute, "La placa ".$this->placa." no existe");
        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlianzaTransaccions()
    {
        return $this->hasMany(AlianzaTransaccion::className(), ['id_transaccion' => 'id_transaccion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleTransaccions()
    {
        return $this->hasMany(DetalleTransaccion::className(), ['id_transaccion' => 'id_transaccion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudTransaccions()
    {
        return $this->hasMany(SolicitudTransaccion::className(), ['id_transaccion' => 'id_transaccion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTallerTransaccions()
    {
        return $this->hasMany(TallerTransaccion::className(), ['id_transaccion' => 'id_transaccion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxTransaccions()
    {
        return $this->hasMany(TaxTransaccion::className(), ['id_transaccion' => 'id_transaccion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdVehiculo()
    {
        return $this->hasOne(Vehiculo::className(), ['id_vehiculo' => 'id_vehiculo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaccionInspeccions()
    {
        return $this->hasMany(TransaccionInspeccion::className(), ['id_transaccion' => 'id_transaccion']);
    }
}
