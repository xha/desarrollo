<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISAU_Vehiculo".
 *
 * @property integer $id_vehiculo
 * @property integer $id_modelo
 * @property integer $id_tipo_vehiculo
 * @property string $placa
 * @property string $anio
 * @property string $color
 * @property string $propietario
 * @property integer $activo
 *
 * @property ISAUTransaccion[] $iSAUTransaccions
 * @property Cliente $propietario0
 * @property Modelo $idModelo
 * @property TipoVehiculo $idTipoVehiculo
 */
class Vehiculo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISAU_Vehiculo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_modelo', 'id_tipo_vehiculo', 'id_marca', 'placa', 'anio', 'propietario'], 'required'],
            [['id_modelo', 'id_tipo_vehiculo', 'activo', 'anio', 'id_marca', 'nro_puestos'], 'integer'],
            [['color', 'propietario', 'placa'], 'string', 'max'=>50],
            [['serial_carroceria', 'serial_inttt', 'serial_motor', 'venta'], 'string', 'max'=>100],
            [['propietario'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['propietario' => 'CodClie']],
            [['id_modelo'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['id_modelo' => 'id_modelo']],
            [['id_tipo_vehiculo'], 'exist', 'skipOnError' => true, 'targetClass' => TipoVehiculo::className(), 'targetAttribute' => ['id_tipo_vehiculo' => 'id_tipo_vehiculo']],
            [['id_marca'], 'exist', 'skipOnError' => true, 'targetClass' => Marca::className(), 'targetAttribute' => ['id_marca' => 'id_marca']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_vehiculo' => 'Id Vehiculo',
            'id_modelo' => 'Modelo',
            'id_marca' => 'Marca',
            'id_tipo_vehiculo' => 'Tipo Vehiculo',
            'placa' => 'Placa',
            'anio' => 'Año',
            'serial_motor' => 'Serial de Motor',
            'serial_inttt' => 'Serial de Carnet de Circulación',
            'serial_carroceria' => 'Serial de Carrocería',
            'color' => 'Color',
            'propietario' => 'Propietario',
            'nro_puestos' => 'Nro de Puestos',
            'venta' => 'Medio de adquisición del Vehiculo',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISAUTransaccions()
    {
        return $this->hasMany(Transaccion::className(), ['id_vehiculo' => 'id_vehiculo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropietario0()
    {
        return $this->hasOne(Cliente::className(), ['CodClie' => 'propietario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdModelo()
    {
        return $this->hasOne(Modelo::className(), ['id_modelo' => 'id_modelo']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMarca()
    {
        return $this->hasOne(Marca::className(), ['id_marca' => 'id_marca']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoVehiculo()
    {
        return $this->hasOne(TipoVehiculo::className(), ['id_tipo_vehiculo' => 'id_tipo_vehiculo']);
    }
}
