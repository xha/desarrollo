<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\VwResumenOrden */

$this->title = $model->id_transaccion;
$this->params['breadcrumbs'][] = ['label' => 'Vw Resumen Ordens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vw-resumen-orden-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_transaccion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_transaccion], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_transaccion',
            'id_vehiculo',
            'modelo',
            'tipo_vehiculo',
            'marca',
            'nro_puestos',
            'placa',
            'anio',
            'color',
            'serial_carroceria',
            'serial_motor',
            'venta',
            'propietario',
            'nombre_propietario',
            'fecha_transaccion',
            'fecha',
            'hora',
            'asesor',
            'nombre_asesor',
            'km',
            'representante',
            'nombre_representante',
            'pagador',
            'nombre_pagador',
            'numero_atencion',
            'gravable',
            'exento',
            'tax',
            'total',
            'observacion',
            'observacion3',
            'activo',
        ],
    ]) ?>

</div>
