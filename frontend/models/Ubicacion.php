<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ISCO_UBICACION".
 *
 * @property integer $id_ubicacion
 * @property string $nombre
 * @property integer $activo
 *
 * @property ISCOALICUOTA[] $iSCOALICUOTAs
 */
class Ubicacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISCO_UBICACION';
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
            'id_ubicacion' => 'Id Ubicacion',
            'nombre' => 'Nombre',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlicuotas()
    {
        return $this->hasMany(Alicuota::className(), ['id_ubicacion' => 'id_ubicacion']);
    }
}
