<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "SACLIE".
 *
 * @property string $CodClie
 * @property string $Descrip
 * @property string $ID3
 * @property integer $TipoID3
 * @property integer $TipoID
 * @property integer $Activo
 * @property string $DescOrder
 * @property string $Clase
 * @property string $Represent
 * @property string $Direc1
 * @property string $Direc2
 * @property integer $Pais
 * @property integer $Estado
 * @property integer $Ciudad
 * @property integer $Municipio
 * @property string $ZipCode
 * @property string $Telef
 * @property string $Movil
 * @property string $Email
 * @property string $Fax
 * @property string $FechaE
 * @property string $CodZona
 * @property string $CodVend
 * @property string $CodConv
 * @property string $CodAlte
 * @property integer $TipoCli
 * @property integer $TipoPVP
 * @property string $Observa
 * @property integer $EsMoneda
 * @property integer $EsCredito
 * @property string $LimiteCred
 * @property integer $DiasCred
 * @property integer $EsToleran
 * @property integer $DiasTole
 * @property integer $IntMora
 * @property string $Descto
 * @property string $Saldo
 * @property string $PagosA
 * @property string $FechaUV
 * @property string $MontoUV
 * @property string $NumeroUV
 * @property string $FechaUP
 * @property string $MontoUP
 * @property string $NumeroUP
 * @property string $MontoMax
 * @property string $MtoMaxCred
 * @property string $PromPago
 * @property string $RetenIVA
 * @property string $SaldoPtos
 * @property string $DescripExt
 *
 * @property ISCOALICUOTA[] $iSCOALICUOTAs
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SACLIE';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodClie'], 'required'],
            [['CodClie', 'Descrip', 'ID3', 'DescOrder', 'Clase', 'Represent', 'Direc1', 'Direc2', 'ZipCode', 'Telef', 'Movil', 'Email', 'Fax', 'CodZona', 'CodVend', 'CodConv', 'CodAlte', 'Observa', 'NumeroUV', 'NumeroUP', 'DescripExt'], 'string'],
            [['TipoID3', 'TipoID', 'Activo', 'Pais', 'Estado', 'Ciudad', 'Municipio', 'TipoCli', 'TipoPVP', 'EsMoneda', 'EsCredito', 'DiasCred', 'EsToleran', 'DiasTole', 'IntMora'], 'integer'],
            [['FechaE', 'FechaUV', 'FechaUP'], 'safe'],
            [['LimiteCred', 'Descto', 'Saldo', 'PagosA', 'MontoUV', 'MontoUP', 'MontoMax', 'MtoMaxCred', 'PromPago', 'RetenIVA', 'SaldoPtos'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodClie' => 'Codigo',
            'Descrip' => 'Descripción',
            'ID3' => 'Rif',
            'TipoID3' => 'Tipo',
            'TipoID' => 'Tipo ID',
            'Activo' => 'Activo',
            'DescOrder' => 'Desc Order',
            'Clase' => 'Clase',
            'Represent' => 'Representante',
            'Direc1' => 'Dirección 1',
            'Direc2' => 'Dirección 2',
            'Pais' => 'Pais',
            'Estado' => 'Estado',
            'Ciudad' => 'Ciudad',
            'Municipio' => 'Municipio',
            'ZipCode' => 'Zip Code',
            'Telef' => 'Telef',
            'Movil' => 'Movil',
            'Email' => 'Email',
            'Fax' => 'Fax',
            'FechaE' => 'Fecha Creación',
            'CodZona' => 'Cod Zona',
            'CodVend' => 'Cod Vend',
            'CodConv' => 'Cod Conv',
            'CodAlte' => 'Cod Alte',
            'TipoCli' => 'Tipo Cliente',
            'TipoPVP' => 'Tipo Pvp',
            'Observa' => 'Observación',
            'EsMoneda' => 'Es Moneda',
            'EsCredito' => 'Es Credito',
            'LimiteCred' => 'Limite Cred',
            'DiasCred' => 'Dias Cred',
            'EsToleran' => 'Es Toleran',
            'DiasTole' => 'Dias Tole',
            'IntMora' => 'Int Mora',
            'Descto' => 'Descto',
            'Saldo' => 'Saldo',
            'PagosA' => 'Pagos A',
            'FechaUV' => 'Fecha Uv',
            'MontoUV' => 'Monto Uv',
            'NumeroUV' => 'Numero Uv',
            'FechaUP' => 'Fecha Up',
            'MontoUP' => 'Monto Up',
            'NumeroUP' => 'Numero Up',
            'MontoMax' => 'Monto Max',
            'MtoMaxCred' => 'Mto Max Cred',
            'PromPago' => 'Prom Pago',
            'RetenIVA' => 'Reten Iva',
            'SaldoPtos' => 'Saldo Ptos',
            'DescripExt' => 'Descrip Ext',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISCOALICUOTAs()
    {
        return $this->hasMany(ISCOALICUOTA::className(), ['CodClie' => 'CodClie']);
    }
}
