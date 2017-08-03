<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "is_rol_usuario".
 *
 * @property integer $id_usuario
 * @property integer $id_rol
 *
 * @property IsRol $idRol
 */
class RolUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'is_rol_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_rol'], 'required'],
            [['id_usuario', 'id_rol'], 'integer'],
            [['id_rol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['id_rol' => 'id_rol']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'id_rol' => 'Id Rol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRol()
    {
        return $this->hasOne(Rol::className(), ['id_rol' => 'id_rol']);
    }

    public function getIdUsers()
    {
        return $this->hasOne(Users::className(), ['uid' => 'id_usuario']);
    }
}
