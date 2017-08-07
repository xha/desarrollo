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
            [['id_modelo', 'id_tipo_vehiculo', 'placa', 'anio'], 'required'],
            [['id_modelo', 'id_tipo_vehiculo', 'activo', 'anio'], 'integer'],
            [['color', 'propietario', 'placa'], 'string', 'max'=>50],
            [['propietario'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['propietario' => 'CodClie']],
            [['id_modelo'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['id_modelo' => 'id_modelo']],
            [['id_tipo_vehiculo'], 'exist', 'skipOnError' => true, 'targetClass' => TipoVehiculo::className(), 'targetAttribute' => ['id_tipo_vehiculo' => 'id_tipo_vehiculo']],
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
            'id_tipo_vehiculo' => 'Tipo Vehiculo',
            'placa' => 'Placa',
            'anio' => 'Año',
            'color' => 'Color',
            'propietario' => 'Propietario',
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
    public function getIdTipoVehiculo()
    {
        return $this->hasOne(TipoVehiculo::className(), ['id_tipo_vehiculo' => 'id_tipo_vehiculo']);
    }
}
