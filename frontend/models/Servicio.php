<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "SASERV".
 *
 * @property string $CodServ
 * @property integer $CodInst
 * @property string $Descrip
 * @property string $Descrip2
 * @property string $Descrip3
 * @property string $Clase
 * @property integer $Activo
 * @property string $Unidad
 * @property string $Precio1
 * @property string $PrecioI1
 * @property string $Precio2
 * @property string $PrecioI2
 * @property string $Precio3
 * @property string $PrecioI3
 * @property string $Costo
 * @property integer $EsExento
 * @property integer $EsReten
 * @property integer $EsPorCost
 * @property integer $UsaServ
 * @property string $Comision
 * @property integer $EsPorComi
 * @property string $FechaUV
 * @property string $FechaUC
 * @property integer $EsImport
 * @property integer $EsVenta
 * @property integer $EsCompra
 */
class Servicio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $iva;
    public $mtotax;
    const ESTATUS_ACTIVE=1;
    const ESTATUS_INACTIVE=0;
    public static function tableName()
    {
        return 'SASERV';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodServ', 'Descrip', 'CodInst', 'Precio1'], 'required'],
            [['CodServ', 'Descrip', 'Descrip2', 'Descrip3', 'Clase', 'Unidad' ,'iva'], 'string'],
            [['CodInst', 'Activo', 'EsExento', 'EsReten', 'EsPorCost', 'UsaServ', 'EsPorComi', 'EsImport', 'EsVenta', 'EsCompra'], 'integer'],
            [['Precio1', 'PrecioI1', 'Precio2', 'PrecioI2', 'Precio3', 'PrecioI3', 'Costo', 'Comision', 'mtotax'], 'number'],
            [['FechaUV', 'FechaUC'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodServ' => 'Código',
            'CodInst' => 'Instancia',
            'Descrip' => 'Descripción',
            'Descrip2' => 'Descripción 2',
            'Descrip3' => 'Descripción 3',
            'Clase' => 'Clase',
            'Activo' => 'Activo',
            'Unidad' => 'Unidad',
            'Precio1' => 'Precio 1',
            'PrecioI1' => 'Precio I1',
            'Precio2' => 'Precio2',
            'PrecioI2' => 'Precio I2',
            'Precio3' => 'Precio3',
            'PrecioI3' => 'Precio I3',
            'Costo' => 'Costo',
            'EsExento' => 'Es Exento',
            'EsReten' => 'Es Reten',
            'EsPorCost' => 'Es Por Cost',
            'UsaServ' => 'Usa Serv',
            'Comision' => 'Comision',
            'EsPorComi' => 'Es Por Comi',
            'FechaUV' => 'Fecha Uv',
            'FechaUC' => 'Fecha Uc',
            'EsImport' => 'Es Import',
            'EsVenta' => 'Es Venta',
            'EsCompra' => 'Es Compra',
        ];
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
