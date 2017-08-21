<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Vehiculo */

$this->title = 'ActualizarVehiculo: ' . $model->id_vehiculo;
$this->params['breadcrumbs'][] = ['label' => 'Vehiculos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_vehiculo, 'url' => ['view', 'id' => $model->id_vehiculo]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="vehiculo-update">

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
