<?php
namespace common\models;

use yii;

class AccessHelpers {

    public static function getAcceso($accion,$rol) {
        $connection = \Yii::$app->db;
        $sql = "SELECT u.usuario as nombre
                FROM ISAU_Usuario u, ISAU_RolAccion ra, ISAU_Accion a
                WHERE a.descripcion =:accion
                AND ra.id_accion=a.id_accion
                AND u.id_rol=ra.id_rol 
                AND ra.id_rol =:id_rol";
        $command = $connection->createCommand($sql);
        $command->bindValue(":accion", $accion);
        $command->bindValue(":id_rol", $rol);
        $result = $command->queryOne();

        if ($result['nombre'] != null){
            return true;
        } else {
            return false;
        }
    }

    public function chequeo() {
        $operacion = str_replace("/", "-", Yii::$app->controller->route);
        $permitirSiempre = ['site-index','site-error','site-logout','site-login','site-register','site-recuperar'];
        if (in_array($operacion, $permitirSiempre)) {
            return true;
        }
     
        $rol = Yii::$app->user->identity->id_rol;
        if (!AccessHelpers::getAcceso($operacion,$rol)) {
            echo $this->render('../no_permitido');
            return false;
        }
        return true;
    }
    
}
?>