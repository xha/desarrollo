<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "SAITEMFAC".
 *
 * @property string $CodSucu
 * @property string $TipoFac
 * @property string $NumeroD
 * @property string $OTipo
 * @property string $ONumero
 * @property string $NumeroE
 * @property integer $NroLinea
 * @property integer $NroLineaC
 * @property string $CodItem
 * @property string $CodUbic
 * @property string $CodMeca
 * @property string $CodVend
 * @property string $Descrip1
 * @property string $Descrip2
 * @property string $Descrip3
 * @property string $Descrip4
 * @property string $Descrip5
 * @property string $Descrip6
 * @property string $Descrip7
 * @property string $Descrip8
 * @property string $Descrip9
 * @property string $Descrip10
 * @property string $Refere
 * @property integer $Signo
 * @property string $CantMayor
 * @property string $Cantidad
 * @property string $CantidadD
 * @property string $CantidadO
 * @property string $CantidadA
 * @property string $CantidadU
 * @property string $CantidadUA
 * @property string $ExistAntU
 * @property string $ExistAnt
 * @property string $Tara
 * @property string $TotalItem
 * @property string $Costo
 * @property string $Precio
 * @property string $MtoTax
 * @property string $PriceO
 * @property string $Descto
 * @property integer $NroUnicoL
 * @property string $NroLote
 * @property string $FechaE
 * @property string $FechaL
 * @property string $FechaV
 * @property integer $EsServ
 * @property integer $EsUnid
 * @property integer $EsFreeP
 * @property integer $EsPesa
 * @property integer $EsExento
 * @property integer $UsaServ
 * @property integer $DEsLote
 * @property integer $DEsSeri
 * @property integer $DEsComp
 */
class Saitemfac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SAITEMFAC';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodSucu', 'TipoFac', 'NumeroD'], 'required'],
            [['CodSucu', 'TipoFac', 'NumeroD', 'OTipo', 'ONumero', 'NumeroE', 'CodItem', 'CodUbic', 'CodMeca', 'CodVend', 'Descrip1', 'Descrip2', 'Descrip3', 'Descrip4', 'Descrip5', 'Descrip6', 'Descrip7', 'Descrip8', 'Descrip9', 'Descrip10', 'Refere', 'NroLote'], 'string'],
            [['NroLinea', 'NroLineaC', 'Signo', 'NroUnicoL', 'EsServ', 'EsUnid', 'EsFreeP', 'EsPesa', 'EsExento', 'UsaServ', 'DEsLote', 'DEsSeri', 'DEsComp'], 'integer'],
            [['CantMayor', 'Cantidad', 'CantidadD', 'CantidadO', 'CantidadA', 'CantidadU', 'CantidadUA', 'ExistAntU', 'ExistAnt', 'Tara', 'TotalItem', 'Costo', 'Precio', 'MtoTax', 'PriceO', 'Descto'], 'number'],
            [['FechaE', 'FechaL', 'FechaV'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodSucu' => 'Cod Sucu',
            'TipoFac' => 'Tipo Fac',
            'NumeroD' => 'Numero D',
            'OTipo' => 'Otipo',
            'ONumero' => 'Onumero',
            'NumeroE' => 'Numero E',
            'NroLinea' => 'Nro Linea',
            'NroLineaC' => 'Nro Linea C',
            'CodItem' => 'Cod Item',
            'CodUbic' => 'Cod Ubic',
            'CodMeca' => 'Cod Meca',
            'CodVend' => 'Cod Vend',
            'Descrip1' => 'Descrip1',
            'Descrip2' => 'Descrip2',
            'Descrip3' => 'Descrip3',
            'Descrip4' => 'Descrip4',
            'Descrip5' => 'Descrip5',
            'Descrip6' => 'Descrip6',
            'Descrip7' => 'Descrip7',
            'Descrip8' => 'Descrip8',
            'Descrip9' => 'Descrip9',
            'Descrip10' => 'Descrip10',
            'Refere' => 'Refere',
            'Signo' => 'Signo',
            'CantMayor' => 'Cant Mayor',
            'Cantidad' => 'Cantidad',
            'CantidadD' => 'Cantidad D',
            'CantidadO' => 'Cantidad O',
            'CantidadA' => 'Cantidad A',
            'CantidadU' => 'Cantidad U',
            'CantidadUA' => 'Cantidad Ua',
            'ExistAntU' => 'Exist Ant U',
            'ExistAnt' => 'Exist Ant',
            'Tara' => 'Tara',
            'TotalItem' => 'Total Item',
            'Costo' => 'Costo',
            'Precio' => 'Precio',
            'MtoTax' => 'Mto Tax',
            'PriceO' => 'Price O',
            'Descto' => 'Descto',
            'NroUnicoL' => 'Nro Unico L',
            'NroLote' => 'Nro Lote',
            'FechaE' => 'Fecha E',
            'FechaL' => 'Fecha L',
            'FechaV' => 'Fecha V',
            'EsServ' => 'Es Serv',
            'EsUnid' => 'Es Unid',
            'EsFreeP' => 'Es Free P',
            'EsPesa' => 'Es Pesa',
            'EsExento' => 'Es Exento',
            'UsaServ' => 'Usa Serv',
            'DEsLote' => 'Des Lote',
            'DEsSeri' => 'Des Seri',
            'DEsComp' => 'Des Comp',
        ];
    }
}
