<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "SAMECA".
 *
 * @property string $CodMeca
 * @property string $Descrip
 * @property integer $TipoID3
 * @property integer $TipoID
 * @property string $ID3
 * @property string $DescOrder
 * @property string $Clase
 * @property integer $Activo
 * @property string $Direc1
 * @property string $Direc2
 * @property string $Telef
 * @property string $Movil
 * @property string $Email
 * @property integer $DEsComi
 * @property string $Monto
 */
class Tecnico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SAMECA';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodMeca', 'Descrip', 'ID3'], 'required'],
            [['CodMeca', 'Descrip', 'ID3', 'DescOrder', 'Clase', 'Direc1', 'Direc2', 'Telef', 'Movil', 'Email'], 'string'],
            [['TipoID3', 'TipoID', 'Activo', 'DEsComi'], 'integer'],
            [['Monto'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodMeca' => 'Código',
            'Descrip' => 'Razón Social o Nombre',
            'TipoID3' => 'Tipo Id3',
            'TipoID' => 'Tipo ID',
            'ID3' => 'Rif',
            'DescOrder' => 'Desc Order',
            'Clase' => 'Clase',
            'Activo' => 'Activo',
            'Direc1' => 'Dirección 1',
            'Direc2' => 'Dirección 2',
            'Telef' => 'Telefono',
            'Movil' => 'Movil',
            'Email' => 'Email',
            'DEsComi' => 'Des Comi',
            'Monto' => 'Monto',
        ];
    }
}
