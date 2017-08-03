<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "is_pregunta".
 *
 * @property integer $id_pregunta
 * @property string $nombre
 * @property boolean $activo
 *
 * @property IsUsuario[] $isUsuarios
 */
class Pregunta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'is_pregunta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['activo'], 'boolean'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pregunta' => 'Id Pregunta',
            'nombre' => 'Descripción',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIsUsuarios()
    {
        return $this->hasMany(IsUsuario::className(), ['id_pregunta' => 'id_pregunta']);
    }
}
