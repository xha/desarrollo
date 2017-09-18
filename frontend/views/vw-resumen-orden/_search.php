<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\VwResumenOrdenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vw-resumen-orden-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_transaccion') ?>

    <?= $form->field($model, 'id_vehiculo') ?>

    <?= $form->field($model, 'modelo') ?>

    <?= $form->field($model, 'tipo_vehiculo') ?>

    <?= $form->field($model, 'marca') ?>

    <?php // echo $form->field($model, 'nro_puestos') ?>

    <?php // echo $form->field($model, 'placa') ?>

    <?php // echo $form->field($model, 'anio') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'serial_carroceria') ?>

    <?php // echo $form->field($model, 'serial_motor') ?>

    <?php // echo $form->field($model, 'venta') ?>

    <?php // echo $form->field($model, 'propietario') ?>

    <?php // echo $form->field($model, 'nombre_propietario') ?>

    <?php // echo $form->field($model, 'fecha_transaccion') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'hora') ?>

    <?php // echo $form->field($model, 'asesor') ?>

    <?php // echo $form->field($model, 'nombre_asesor') ?>

    <?php // echo $form->field($model, 'km') ?>

    <?php // echo $form->field($model, 'representante') ?>

    <?php // echo $form->field($model, 'nombre_representante') ?>

    <?php // echo $form->field($model, 'pagador') ?>

    <?php // echo $form->field($model, 'nombre_pagador') ?>

    <?php // echo $form->field($model, 'numero_atencion') ?>

    <?php // echo $form->field($model, 'gravable') ?>

    <?php // echo $form->field($model, 'exento') ?>

    <?php // echo $form->field($model, 'tax') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'observacion3') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
