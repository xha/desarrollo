<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RolAccion */

$this->title = 'Update Rol Accion: ' . $model->id_accion;
$this->params['breadcrumbs'][] = ['label' => 'Rol Accions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_accion, 'url' => ['view', 'id_accion' => $model->id_accion, 'id_rol' => $model->id_rol]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rol-accion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
