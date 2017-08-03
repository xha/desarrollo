<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "SATAXES".
 *
 * @property string $CodTaxs
 * @property string $Descrip
 * @property string $MtoTax
 * @property integer $Activo
 * @property integer $EsFijo
 * @property integer $EsReten
 * @property string $CodOper
 * @property integer $EsPorct
 * @property integer $EsCosto
 * @property integer $TipoIVA
 * @property integer $EsLibroI
 * @property integer $EsPartic
 * @property integer $EsTaxVenta
 * @property integer $EsTaxCompra
 * @property string $MontoMax
 * @property string $Sustraendo
 */
class Sataxes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SATAXES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodTaxs'], 'required'],
            [['CodTaxs', 'Descrip', 'CodOper'], 'string'],
            [['MtoTax', 'MontoMax', 'Sustraendo'], 'number'],
            [['Activo', 'EsFijo', 'EsReten', 'EsPorct', 'EsCosto', 'TipoIVA', 'EsLibroI', 'EsPartic', 'EsTaxVenta', 'EsTaxCompra'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodTaxs' => 'Cod Taxs',
            'Descrip' => 'Descrip',
            'MtoTax' => 'Mto Tax',
            'Activo' => 'Activo',
            'EsFijo' => 'Es Fijo',
            'EsReten' => 'Es Reten',
            'CodOper' => 'Cod Oper',
            'EsPorct' => 'Es Porct',
            'EsCosto' => 'Es Costo',
            'TipoIVA' => 'Tipo Iva',
            'EsLibroI' => 'Es Libro I',
            'EsPartic' => 'Es Partic',
            'EsTaxVenta' => 'Es Tax Venta',
            'EsTaxCompra' => 'Es Tax Compra',
            'MontoMax' => 'Monto Max',
            'Sustraendo' => 'Sustraendo',
        ];
    }
}
