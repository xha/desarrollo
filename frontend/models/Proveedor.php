<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "SAPROV".
 *
 * @property string $CodProv
 * @property string $Descrip
 * @property integer $TipoPrv
 * @property integer $TipoID3
 * @property integer $TipoID
 * @property string $ID3
 * @property string $DescOrder
 * @property string $Clase
 * @property integer $Activo
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
 * @property string $Fax
 * @property string $Email
 * @property string $FechaE
 * @property integer $EsReten
 * @property integer $RetenISLR
 * @property integer $DiasCred
 * @property string $Observa
 * @property integer $EsMoneda
 * @property string $Saldo
 * @property string $MontoMax
 * @property string $PagosA
 * @property string $PromPago
 * @property string $RetenIVA
 * @property string $FechaUC
 * @property string $MontoUC
 * @property string $NumeroUC
 * @property string $FechaUP
 * @property string $MontoUP
 * @property string $NumeroUP
 *
 * @property ISAUAlianza[] $iSAUAlianzas
 */
class Proveedor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const ESTATUS_ACTIVE=1;
    const ESTATUS_INACTIVE=0;
    public static function tableName()
    {
        return 'SAPROV';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodProv', 'Descrip', 'ID3'], 'required'],
            [['CodProv', 'Descrip', 'ID3', 'DescOrder', 'Clase', 'Represent', 'Direc1', 'Direc2', 'ZipCode', 'Telef', 'Movil', 'Fax', 'Email', 'Observa', 'NumeroUC', 'NumeroUP'], 'string'],
            [['TipoPrv', 'TipoID3', 'TipoID', 'Activo', 'Pais', 'Estado', 'Ciudad', 'Municipio', 'EsReten', 'RetenISLR', 'DiasCred', 'EsMoneda'], 'integer'],
            [['FechaE', 'FechaUC', 'FechaUP'], 'safe'],
            [['Saldo', 'MontoMax', 'PagosA', 'PromPago', 'RetenIVA', 'MontoUC', 'MontoUP'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodProv' => 'Código',
            'Descrip' => 'Razón Social',
            'TipoPrv' => 'Tipo de Proveedor',
            'TipoID3' => 'Tipo Id3',
            'TipoID' => 'Tipo ID',
            'ID3' => 'Rif',
            'DescOrder' => 'Desc Order',
            'Clase' => 'Clase',
            'Activo' => 'Activo',
            'Represent' => 'Representante',
            'Direc1' => 'Direc1',
            'Direc2' => 'Direc2',
            'Pais' => 'Pais',
            'Estado' => 'Estado',
            'Ciudad' => 'Ciudad',
            'Municipio' => 'Municipio',
            'ZipCode' => 'Zip Code',
            'Telef' => 'Telef',
            'Movil' => 'Movil',
            'Fax' => 'Fax',
            'Email' => 'Email',
            'FechaE' => 'Fecha E',
            'EsReten' => 'Tipo de Retención',
            'RetenISLR' => 'Tiene Retencion de ISLR',
            'DiasCred' => 'Dias Cred',
            'Observa' => 'Observación',
            'EsMoneda' => 'Es Moneda',
            'Saldo' => 'Saldo',
            'MontoMax' => 'Monto Max',
            'PagosA' => 'Pagos A',
            'PromPago' => 'Prom Pago',
            'RetenIVA' => 'Reten Iva',
            'FechaUC' => 'Fecha Uc',
            'MontoUC' => 'Monto Uc',
            'NumeroUC' => 'Numero Uc',
            'FechaUP' => 'Fecha Up',
            'MontoUP' => 'Monto Up',
            'NumeroUP' => 'Numero Up',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISAUAlianzas()
    {
        return $this->hasMany(ISAUAlianza::className(), ['CodProv' => 'CodProv']);
    }

    public function getActivo(){
        $r = $this->Activo;
        if($r == 1){
            $z = "SI";
        }else{
            $z = 'NO';
        }
        return $z;
    }
}
