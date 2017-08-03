<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "SAFACT".
 *
 * @property string $CodSucu
 * @property string $TipoFac
 * @property string $NumeroD
 * @property integer $NroUnico
 * @property string $NroCtrol
 * @property string $CodEsta
 * @property string $CodUsua
 * @property integer $EsCorrel
 * @property string $CodConv
 * @property integer $Signo
 * @property string $FechaT
 * @property string $OTipo
 * @property string $ONumero
 * @property string $NumeroC
 * @property string $NumeroT
 * @property string $NumeroR
 * @property integer $TipoTraE
 * @property string $AutSRI
 * @property string $NroEstable
 * @property string $PtoEmision
 * @property string $NumeroF
 * @property string $NumeroNCF
 * @property string $NumeroP
 * @property string $NumeroE
 * @property string $NumeroZ
 * @property string $Moneda
 * @property string $Factor
 * @property string $MontoMEx
 * @property string $CodClie
 * @property string $CodVend
 * @property string $CodUbic
 * @property string $Descrip
 * @property string $Direc1
 * @property string $Direc2
 * @property string $Direc3
 * @property string $ZipCode
 * @property string $Telef
 * @property string $ID3
 * @property string $Monto
 * @property string $MtoTax
 * @property string $Fletes
 * @property string $TGravable
 * @property string $TGravable0
 * @property string $TExento
 * @property string $CostoPrd
 * @property string $CostoSrv
 * @property string $DesctoP
 * @property string $RetenIVA
 * @property string $FechaR
 * @property string $FechaI
 * @property string $FechaE
 * @property string $FechaV
 * @property string $MtoTotal
 * @property string $Contado
 * @property string $Credito
 * @property string $CancelI
 * @property string $CancelA
 * @property string $CancelE
 * @property string $CancelC
 * @property string $CancelT
 * @property string $CancelG
 * @property string $CancelP
 * @property string $Cambio
 * @property string $MtoExtra
 * @property string $ValorPtos
 * @property string $Descto1
 * @property string $PctAnual
 * @property string $MtoInt1
 * @property string $Descto2
 * @property string $PctManejo
 * @property string $MtoInt2
 * @property string $SaldoAct
 * @property string $MtoPagos
 * @property string $MtoNCredito
 * @property string $MtoNDebito
 * @property string $MtoFinanc
 * @property string $DetalChq
 * @property string $TotalPrd
 * @property string $TotalSrv
 * @property string $OrdenC
 * @property string $CodOper
 * @property integer $NGiros
 * @property integer $NMeses
 * @property string $MtoComiVta
 * @property string $MtoComiCob
 * @property string $MtoComiVtaD
 * @property string $MtoComiCobD
 * @property string $Notas1
 * @property string $Notas2
 * @property string $Notas3
 * @property string $Notas4
 * @property string $Notas5
 * @property string $Notas6
 * @property string $Notas7
 * @property string $Notas8
 * @property string $Notas9
 * @property string $Notas10
 */
class Presupuesto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SAFACT';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodSucu', 'TipoFac', 'NumeroD','CodVend'], 'required'],
            [['CodSucu', 'TipoFac', 'NumeroD', 'NroCtrol', 'CodEsta', 'CodUsua', 'CodConv', 'OTipo', 'ONumero', 'NumeroC', 'NumeroT', 'NumeroR', 'AutSRI', 'NroEstable', 'PtoEmision', 'NumeroF', 'NumeroNCF', 'NumeroP', 'NumeroE', 'NumeroZ', 'Moneda', 'CodClie', 'CodVend', 'CodUbic', 'Descrip', 'Direc1', 'Direc2', 'Direc3', 'ZipCode', 'Telef', 'ID3', 'DetalChq', 'OrdenC', 'CodOper', 'Notas1', 'Notas2', 'Notas3', 'Notas4', 'Notas5', 'Notas6', 'Notas7', 'Notas8', 'Notas9', 'Notas10'], 'string'],
            [['EsCorrel', 'Signo', 'TipoTraE', 'NGiros', 'NMeses','CodVend'], 'integer'],
            [['FechaT', 'FechaR', 'FechaI', 'FechaE', 'FechaV'], 'safe'],
            [['Factor', 'MontoMEx', 'Monto', 'MtoTax', 'Fletes', 'TGravable', 'TGravable0', 'TExento', 'CostoPrd', 'CostoSrv', 'DesctoP', 'RetenIVA', 'MtoTotal', 'Contado', 'Credito', 'CancelI', 'CancelA', 'CancelE', 'CancelC', 'CancelT', 'CancelG', 'CancelP', 'Cambio', 'MtoExtra', 'ValorPtos', 'Descto1', 'PctAnual', 'MtoInt1', 'Descto2', 'PctManejo', 'MtoInt2', 'SaldoAct', 'MtoPagos', 'MtoNCredito', 'MtoNDebito', 'MtoFinanc', 'TotalPrd', 'TotalSrv', 'MtoComiVta', 'MtoComiCob', 'MtoComiVtaD', 'MtoComiCobD'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodSucu' => 'Sucursal',
            'TipoFac' => 'Tipo',
            'NumeroD' => 'Nro',
            'NroUnico' => 'Nro Unico',
            'NroCtrol' => 'Nro Ctrol',
            'CodEsta' => 'Estación',
            'CodUsua' => 'Usuario',
            'EsCorrel' => 'Es Correl',
            'CodConv' => 'Cod Conv',
            'Signo' => 'Signo',
            'FechaT' => 'Fecha T',
            'OTipo' => 'Otipo',
            'ONumero' => 'Onumero',
            'NumeroC' => 'Numero C',
            'NumeroT' => 'Numero T',
            'NumeroR' => 'Numero R',
            'TipoTraE' => 'Tipo Tra E',
            'AutSRI' => 'Aut Sri',
            'NroEstable' => 'Nro Estable',
            'PtoEmision' => 'Pto Emision',
            'NumeroF' => 'Numero F',
            'NumeroNCF' => 'Numero Ncf',
            'NumeroP' => 'Numero P',
            'NumeroE' => 'Numero E',
            'NumeroZ' => 'Numero Z',
            'Moneda' => 'Moneda',
            'Factor' => 'Factor',
            'MontoMEx' => 'Monto Mex',
            'CodClie' => 'Cliente',
            'CodVend' => 'Vendedor',
            'CodUbic' => 'Ubicación',
            'Descrip' => 'Razón Social',
            'Direc1' => 'Direc1',
            'Direc2' => 'Direc2',
            'Direc3' => 'Direc3',
            'ZipCode' => 'Zip Code',
            'Telef' => 'Telef',
            'ID3' => 'Rif',
            'Monto' => 'Monto',
            'MtoTax' => 'Impuesto',
            'Fletes' => 'Fletes',
            'TGravable' => 'Gravable',
            'TGravable0' => 'Tgravable0',
            'TExento' => 'Exento',
            'CostoPrd' => 'Costo Prd',
            'CostoSrv' => 'Costo Srv',
            'DesctoP' => 'Descto P',
            'RetenIVA' => 'Retención',
            'FechaR' => 'Fecha R',
            'FechaI' => 'Fecha I',
            'FechaE' => 'Fecha Emisión',
            'FechaV' => 'Fecha V',
            'MtoTotal' => 'Total',
            'Contado' => 'Contado',
            'Credito' => 'Credito',
            'CancelI' => 'Cancel I',
            'CancelA' => 'Cancel A',
            'CancelE' => 'Cancel E',
            'CancelC' => 'Cancel C',
            'CancelT' => 'Cancel T',
            'CancelG' => 'Cancel G',
            'CancelP' => 'Cancel P',
            'Cambio' => 'Cambio',
            'MtoExtra' => 'Mto Extra',
            'ValorPtos' => 'Valor Ptos',
            'Descto1' => 'Descto1',
            'PctAnual' => 'Pct Anual',
            'MtoInt1' => 'Mto Int1',
            'Descto2' => 'Descto2',
            'PctManejo' => 'Pct Manejo',
            'MtoInt2' => 'Mto Int2',
            'SaldoAct' => 'Saldo Act',
            'MtoPagos' => 'Mto Pagos',
            'MtoNCredito' => 'Mto Ncredito',
            'MtoNDebito' => 'Mto Ndebito',
            'MtoFinanc' => 'Mto Financ',
            'DetalChq' => 'Detal Chq',
            'TotalPrd' => 'Total Prd',
            'TotalSrv' => 'Total Srv',
            'OrdenC' => 'Orden C',
            'CodOper' => 'Cod Oper',
            'NGiros' => 'Ngiros',
            'NMeses' => 'Nmeses',
            'MtoComiVta' => 'Mto Comi Vta',
            'MtoComiCob' => 'Mto Comi Cob',
            'MtoComiVtaD' => 'Mto Comi Vta D',
            'MtoComiCobD' => 'Mto Comi Cob D',
            'Notas1' => 'Notas1',
            'Notas2' => 'Notas2',
            'Notas3' => 'Notas3',
            'Notas4' => 'Notas4',
            'Notas5' => 'Notas5',
            'Notas6' => 'Notas6',
            'Notas7' => 'Notas7',
            'Notas8' => 'Notas8',
            'Notas9' => 'Notas9',
            'Notas10' => 'Notas10',
        ];
    }
}
