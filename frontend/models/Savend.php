<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "SAVEND".
 *
 * @property string $CodVend
 * @property string $Descrip
 * @property integer $TipoID3
 * @property integer $TipoID
 * @property string $ID3
 * @property string $DescOrder
 * @property string $Clase
 * @property string $Direc1
 * @property string $Direc2
 * @property string $Telef
 * @property string $Movil
 * @property string $Email
 * @property string $FechaUV
 * @property string $FechaUC
 * @property integer $EsComiPV
 * @property integer $EsComiTV
 * @property integer $EsComiTC
 * @property integer $EsComiTU
 * @property integer $EsComiDT
 * @property integer $EsComiUT
 * @property integer $EsComiTM
 * @property integer $Activo
 */
class Savend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SAVEND';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodVend'], 'required'],
            [['CodVend', 'Descrip', 'ID3', 'DescOrder', 'Clase', 'Direc1', 'Direc2', 'Telef', 'Movil', 'Email'], 'string'],
            [['TipoID3', 'TipoID', 'EsComiPV', 'EsComiTV', 'EsComiTC', 'EsComiTU', 'EsComiDT', 'EsComiUT', 'EsComiTM', 'Activo'], 'integer'],
            [['FechaUV', 'FechaUC'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodVend' => 'Cod Vend',
            'Descrip' => 'Descrip',
            'TipoID3' => 'Tipo Id3',
            'TipoID' => 'Tipo ID',
            'ID3' => 'Id3',
            'DescOrder' => 'Desc Order',
            'Clase' => 'Clase',
            'Direc1' => 'Direc1',
            'Direc2' => 'Direc2',
            'Telef' => 'Telef',
            'Movil' => 'Movil',
            'Email' => 'Email',
            'FechaUV' => 'Fecha Uv',
            'FechaUC' => 'Fecha Uc',
            'EsComiPV' => 'Es Comi Pv',
            'EsComiTV' => 'Es Comi Tv',
            'EsComiTC' => 'Es Comi Tc',
            'EsComiTU' => 'Es Comi Tu',
            'EsComiDT' => 'Es Comi Dt',
            'EsComiUT' => 'Es Comi Ut',
            'EsComiTM' => 'Es Comi Tm',
            'Activo' => 'Activo',
        ];
    }
}
