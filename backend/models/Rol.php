<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "is_rol".
 *
 * @property integer $id_rol
 * @property string $nombre
 * @property integer $activo
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'is_rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['activo'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_rol' => 'Id Rol',
            'nombre' => 'Descripción',
            'activo' => 'Activo',
        ];
    }
}
