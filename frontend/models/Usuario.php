<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISAU_Usuario".
 *
 * @property integer $id_usuario
 * @property string $usuario
 * @property string $correo
 * @property string $cedula
 * @property string $clave
 * @property string $nombre
 * @property string $apellido
 * @property string $sexo
 * @property string $respuesta_seguridad
 * @property string $fecha_registro
 * @property string $telefono
 * @property integer $activo
 * @property integer $id_rol
 * @property integer $id_pregunta
 *
 * @property ISAUPregunta $idPregunta
 * @property ISAURol $idRol
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ISAU_Usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario', 'correo', 'cedula', 'clave', 'nombre', 'apellido', 'id_rol'], 'required'],
            [['usuario', 'correo', 'cedula', 'clave', 'nombre', 'apellido', 'sexo', 'respuesta_seguridad', 'telefono'], 'string'],
            [['fecha_registro'], 'safe'],
            [['activo', 'id_rol', 'id_pregunta'], 'integer'],
            [['usuario'], 'unique'],
            [['id_pregunta'], 'exist', 'skipOnError' => true, 'targetClass' => ISAUPregunta::className(), 'targetAttribute' => ['id_pregunta' => 'id_pregunta']],
            [['id_rol'], 'exist', 'skipOnError' => true, 'targetClass' => ISAURol::className(), 'targetAttribute' => ['id_rol' => 'id_rol']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'usuario' => 'Usuario',
            'correo' => 'Correo',
            'cedula' => 'Cedula',
            'clave' => 'Clave',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'sexo' => 'Sexo',
            'respuesta_seguridad' => 'Respuesta Seguridad',
            'fecha_registro' => 'Fecha Registro',
            'telefono' => 'Telefono',
            'activo' => 'Activo',
            'id_rol' => 'Id Rol',
            'id_pregunta' => 'Id Pregunta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPregunta()
    {
        return $this->hasOne(ISAUPregunta::className(), ['id_pregunta' => 'id_pregunta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRol()
    {
        return $this->hasOne(ISAURol::className(), ['id_rol' => 'id_rol']);
    }
    
    
    public function getNombreCompleto()
    {
        $r= \frontend\models\Usuario::findOne($this->id_usuario);
        return $r->nombre." ".$r->apellido;
    }
    
    /*public static function ListaAsesor(){
        $v = \yii\helpers\ArrayHelper::map(Usuario::find()->where(['activo'=>1])->orderBy('nombre')->all(),'id_usuario', 'nombre');
        
        return $v;
    }*/
    
}
