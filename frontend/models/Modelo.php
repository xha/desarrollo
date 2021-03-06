<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISAU_Modelo".
 *
 * @property integer $id_modelo
 * @property string $descripcion
 * @property integer $activo
 *
 * @property ISAUVehiculo[] $iSAUVehiculos
 */
class Modelo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const ESTATUS_ACTIVE=1;
    const ESTATUS_INACTIVE=0;
    public static function tableName()
    {
        return 'ISAU_Modelo';
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
            'id_modelo' => 'Id Modelo',
            'descripcion' => 'Descripcion',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISAUVehiculos()
    {
        return $this->hasMany(ISAUVehiculo::className(), ['id_modelo' => 'id_modelo']);
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
