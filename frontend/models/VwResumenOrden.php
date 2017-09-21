<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "vw_resumen_orden".
 *
 * @property integer $id_transaccion
 * @property integer $id_vehiculo
 * @property string $modelo
 * @property string $tipo_vehiculo
 * @property string $marca
 * @property integer $nro_puestos
 * @property string $placa
 * @property string $anio
 * @property string $color
 * @property string $serial_carroceria
 * @property string $serial_motor
 * @property string $venta
 * @property string $propietario
 * @property string $nombre_propietario
 * @property string $fecha_transaccion
 * @property string $fecha
 * @property string $hora
 * @property integer $asesor
 * @property string $nombre_asesor
 * @property string $km
 * @property string $representante
 * @property string $nombre_representante
 * @property string $pagador
 * @property string $nombre_pagador
 * @property integer $numero_atencion
 * @property string $gravable
 * @property string $exento
 * @property string $tax
 * @property string $total
 * @property string $observacion
 * @property string $observacion3
 * @property integer $activo
 */
class VwResumenOrden extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $primaryKey =  ['id_transaccion'];  

    public static function primaryKey()     
    {
        return ['id_transaccion'];
    }
    
    
    public static function tableName()
    {
        return 'vw_resumen_orden';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaccion', 'id_vehiculo', 'tipo_vehiculo', 'marca', 'anio', 'propietario', 'fecha_transaccion', 
                'fecha', 'hora', 'asesor', 'km', 'representante', 'pagador', 'gravable', 'exento', 'tax',
                'total'], 'required'],
            [['id_transaccion', 'id_vehiculo', 'nro_puestos', 'asesor', 'activo'], 'integer'],
            [['modelo', 'tipo_vehiculo', 'marca', 'placa', 'anio', 'color', 'serial_carroceria', 'serial_motor', 'venta', 'propietario', 'nombre_propietario', 'hora', 
                'nombre_asesor', 'representante', 'nombre_representante', 'pagador', 'nombre_pagador', 'observacion', 'observacion3'], 'string'],
            [['fecha_transaccion', 'fecha','numero_atencion', 'modelo', 'placa', 'nombre_asesor', 'activo'], 'safe'],
            [['km', 'gravable', 'exento', 'tax', 'total'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_transaccion' => 'Id Transaccion',
            'id_vehiculo' => 'Id Vehiculo',
            'modelo' => 'Modelo',
            'tipo_vehiculo' => 'Tipo Vehiculo',
            'marca' => 'Marca',
            'nro_puestos' => 'Nro Puestos',
            'placa' => 'Placa',
            'anio' => 'Anio',
            'color' => 'Color',
            'serial_carroceria' => 'Serial Carroceria',
            'serial_motor' => 'Serial Motor',
            'venta' => 'Venta',
            'propietario' => 'Propietario',
            'nombre_propietario' => 'Nombre Propietario',
            'fecha_transaccion' => 'Fecha Transaccion',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
            'asesor' => 'Asesor',
            'nombre_asesor' => 'Nombre Asesor',
            'km' => 'Km',
            'representante' => 'Representante',
            'nombre_representante' => 'Nombre Representante',
            'pagador' => 'Pagador',
            'nombre_pagador' => 'Nombre Pagador',
            'numero_atencion' => 'Numero Atencion',
            'gravable' => 'Gravable',
            'exento' => 'Exento',
            'tax' => 'Tax',
            'total' => 'Total',
            'observacion' => 'Observacion',
            'observacion3' => 'Observacion3',
            'activo' => 'Activo',
        ];
    }
}
