<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\VwResumenOrden */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vw-resumen-orden-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_transaccion')->textInput() ?>

    <?= $form->field($model, 'id_vehiculo')->textInput() ?>

    <?= $form->field($model, 'modelo')->textInput() ?>

    <?= $form->field($model, 'tipo_vehiculo')->textInput() ?>

    <?= $form->field($model, 'marca')->textInput() ?>

    <?= $form->field($model, 'nro_puestos')->textInput() ?>

    <?= $form->field($model, 'placa')->textInput() ?>

    <?= $form->field($model, 'anio')->textInput() ?>

    <?= $form->field($model, 'color')->textInput() ?>

    <?= $form->field($model, 'serial_carroceria')->textInput() ?>

    <?= $form->field($model, 'serial_motor')->textInput() ?>

    <?= $form->field($model, 'venta')->textInput() ?>

    <?= $form->field($model, 'propietario')->textInput() ?>

    <?= $form->field($model, 'nombre_propietario')->textInput() ?>

    <?= $form->field($model, 'fecha_transaccion')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'hora')->textInput() ?>

    <?= $form->field($model, 'asesor')->textInput() ?>

    <?= $form->field($model, 'nombre_asesor')->textInput() ?>

    <?= $form->field($model, 'km')->textInput() ?>

    <?= $form->field($model, 'representante')->textInput() ?>

    <?= $form->field($model, 'nombre_representante')->textInput() ?>

    <?= $form->field($model, 'pagador')->textInput() ?>

    <?= $form->field($model, 'nombre_pagador')->textInput() ?>

    <?= $form->field($model, 'numero_atencion')->textInput() ?>

    <?= $form->field($model, 'gravable')->textInput() ?>

    <?= $form->field($model, 'exento')->textInput() ?>

    <?= $form->field($model, 'tax')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'observacion')->textInput() ?>

    <?= $form->field($model, 'observacion3')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
