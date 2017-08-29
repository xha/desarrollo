<?php

namespace backend\models;
use Yii;
use yii\base\Model;
use common\models\Usuario;
use backend\models\Rol;

class ActivarForm extends model{
    
    public $usuario;
    public $id_rol;
    public $CodUbic;
    public $activado = true;
    public $isNewRecord = true;

    public function rules()
    {
        return [
            [['usuario', 'id_rol', 'activado'], 'required', 'message' => 'Campo requerido'],
            [['id_rol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['id_rol' => 'id_rol']],
            [['CodUbic'], 'string'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'usuario' => 'Usuario',
            'id_rol' => 'Rol',
        ];
    }
}