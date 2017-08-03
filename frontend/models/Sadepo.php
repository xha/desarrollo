<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "SADEPO".
 *
 * @property string $CodUbic
 * @property string $Descrip
 * @property string $Clase
 * @property integer $Activo
 * @property string $Represent
 * @property string $Direc1
 * @property string $Direc2
 * @property string $ZipCode
 * @property string $Telef
 * @property integer $Printer
 */
class Sadepo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SADEPO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodUbic'], 'required'],
            [['CodUbic', 'Descrip', 'Clase', 'Represent', 'Direc1', 'Direc2', 'ZipCode', 'Telef'], 'string'],
            [['Activo', 'Printer'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodUbic' => 'Cod Ubic',
            'Descrip' => 'Descrip',
            'Clase' => 'Clase',
            'Activo' => 'Activo',
            'Represent' => 'Represent',
            'Direc1' => 'Direc1',
            'Direc2' => 'Direc2',
            'ZipCode' => 'Zip Code',
            'Telef' => 'Telef',
            'Printer' => 'Printer',
        ];
    }
}
