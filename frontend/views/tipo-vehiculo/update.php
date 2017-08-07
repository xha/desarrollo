<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoVehiculo */

$this->title = 'Actualizar Tipo Vehiculo: ' . $model->id_tipo_vehiculo;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Vehiculos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipo_vehiculo, 'url' => ['view', 'id' => $model->id_tipo_vehiculo]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tipo-vehiculo-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
