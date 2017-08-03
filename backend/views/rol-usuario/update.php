<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RolUsuario */

$this->title = 'Update Rol Usuario: ' . $model->id_usuario;
$this->params['breadcrumbs'][] = ['label' => 'Rol Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_usuario, 'url' => ['view', 'id_usuario' => $model->id_usuario, 'id_rol' => $model->id_rol]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rol-usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pendientes' => $pendientes,
    ]) ?>

</div>
