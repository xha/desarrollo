<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ISCO_PISO".
 *
 * @property integer $id_piso
 * @property string $nombre
 * @property integer $activo
 *
 * @property ISCOALICUOTA[] $iSCOALICUOTAs
 */
class Piso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISCO_PISO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string'],
            [['activo'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_piso' => 'Id Piso',
            'nombre' => 'Nombre',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlicuotas()
    {
        return $this->hasMany(Alicuota::className(), ['id_piso' => 'id_piso']);
    }
}
