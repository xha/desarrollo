<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoVehiculo */

$this->title = 'Update Tipo Vehiculo: ' . $model->id_tipo_vehiculo;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Vehiculos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipo_vehiculo, 'url' => ['view', 'id' => $model->id_tipo_vehiculo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-vehiculo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
