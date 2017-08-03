<?php

namespace app\models;
use Yii;
use yii\base\Model;
use common\models\Usuario;

class ActivarForm extends model{
    
    public $usuario;
    public $id_rol;
    public $activado = true;
    public $isNewRecord = true;

    public function rules()
    {
        return [
            [['usuario', 'id_rol', 'activado'], 'required', 'message' => 'Campo requerido'],
            [['id_rol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['id_rol' => 'id_rol']],
        ];
    }
}