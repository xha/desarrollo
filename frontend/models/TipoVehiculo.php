<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISAU_TipoVehiculo".
 *
 * @property integer $id_tipo_vehiculo
 * @property string $descripcion
 * @property integer $activo
 *
 * @property ISAUVehiculo[] $iSAUVehiculos
 */
class TipoVehiculo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const ESTATUS_ACTIVE=1;
    const ESTATUS_INACTIVE=0;
    public static function tableName()
    {
        return 'ISAU_TipoVehiculo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string'],
            [['activo'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_vehiculo' => 'Id Tipo Vehiculo',
            'descripcion' => 'Descripcion',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISAUVehiculos()
    {
        return $this->hasMany(ISAUVehiculo::className(), ['id_tipo_vehiculo' => 'id_tipo_vehiculo']);
    }

    public function getActivo(){
        $r = $this->activo;
        if($r == 1){
            $z = "SI";
        }else{
            $z = 'NO';
        }
        return $z;
    }
}
