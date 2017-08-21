<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISAU_AlianzaTransaccion".
 *
 * @property integer $id_at
 * @property integer $id_alianza
 * @property integer $id_transaccion
 * @property string $nro_factura
 * @property string $fecha
 * @property string $nro_control
 * @property string $CodProv
 * @property integer $almacenista
 * @property string $total
 * @property integer $activo
 *
 * @property ISAUAlianza $idAlianza
 * @property ISAUTransaccion $idTransaccion
 * @property ISAUDetalleAlianzaTransaccion[] $iSAUDetalleAlianzaTransaccions
 */
class AlianzaTransaccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $fecha_transaccion;
    public $nro;
    public $d_codigo;
    
    public static function tableName()
    {
        return 'ISAU_AlianzaTransaccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_alianza', 'id_transaccion', 'nro_factura', 'fecha', 'nro_control', 'CodProv', 'almacenista'], 'required'],
            [['id_alianza', 'id_transaccion', 'almacenista', 'activo'], 'integer'],
            [['nro_factura', 'nro_control', 'CodProv'], 'string'],
            [['fecha'], 'safe'],
            [['total'], 'number'],
            [['id_alianza'], 'exist', 'skipOnError' => true, 'targetClass' => Alianza::className(), 'targetAttribute' => ['id_alianza' => 'id_alianza']],
            [['id_transaccion'], 'exist', 'skipOnError' => true, 'targetClass' => Transaccion::className(), 'targetAttribute' => ['id_transaccion' => 'id_transaccion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_at' => 'Id At',
            'id_alianza' => 'Alianza',
            'id_transaccion' => 'Transaccion',
            'nro_factura' => 'Nro Factura',
            'fecha' => 'Fecha de Factura',
            'nro_control' => 'Nro Control',
            'CodProv' => 'Cod Prov',
            'almacenista' => 'Almacenista',
            'total' => 'Total',
            'fecha_transaccion' => 'Fecha de Orden',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAlianza()
    {
        return $this->hasOne(Alianza::className(), ['id_alianza' => 'id_alianza']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTransaccion()
    {
        return $this->hasOne(Transaccion::className(), ['id_transaccion' => 'id_transaccion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISAUDetalleAlianzaTransaccions()
    {
        return $this->hasMany(DetalleAlianzaTransaccion::className(), ['id_at' => 'id_at']);
    }
}
