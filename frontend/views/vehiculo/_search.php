<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\VehiculoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehiculo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_vehiculo') ?>

    <?= $form->field($model, 'id_modelo') ?>

    <?= $form->field($model, 'id_tipo_vehiculo') ?>

    <?= $form->field($model, 'placa') ?>

    <?= $form->field($model, 'anio') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'propietario') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
