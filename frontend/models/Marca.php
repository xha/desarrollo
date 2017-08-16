<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISAU_Marca".
 *
 * @property integer $id_marca
 * @property string $descripcion
 * @property integer $activo
 *
 * @property ISAUVehiculo[] $iSAUVehiculos
 */
class Marca extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISAU_Marca';
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
            'id_marca' => 'Id Marca',
            'descripcion' => 'Descripcion',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISAUVehiculos()
    {
        return $this->hasMany(ISAUVehiculo::className(), ['id_marca' => 'id_marca']);
    }
}
