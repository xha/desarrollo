<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VwResumenOrdenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vw Resumen Ordens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vw-resumen-orden-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vw Resumen Orden', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_transaccion',
            'id_vehiculo',
            'modelo',
            'tipo_vehiculo',
            'marca',
            // 'nro_puestos',
            // 'placa',
            // 'anio',
            // 'color',
            // 'serial_carroceria',
            // 'serial_motor',
            // 'venta',
            // 'propietario',
            // 'nombre_propietario',
            // 'fecha_transaccion',
            // 'fecha',
            // 'hora',
            // 'asesor',
            // 'nombre_asesor',
            // 'km',
            // 'representante',
            // 'nombre_representante',
            // 'pagador',
            // 'nombre_pagador',
            // 'numero_atencion',
            // 'gravable',
            // 'exento',
            // 'tax',
            // 'total',
            // 'observacion',
            // 'observacion3',
            // 'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
