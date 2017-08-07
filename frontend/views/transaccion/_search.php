<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TransaccionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaccion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_transaccion') ?>

    <?= $form->field($model, 'id_vehiculo') ?>

    <?= $form->field($model, 'fecha_transaccion') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'hora') ?>

    <?php // echo $form->field($model, 'CodSucu') ?>

    <?php // echo $form->field($model, 'asesor') ?>

    <?php // echo $form->field($model, 'km') ?>

    <?php // echo $form->field($model, 'representante') ?>

    <?php // echo $form->field($model, 'numero_atencion') ?>

    <?php // echo $form->field($model, 'gravable') ?>

    <?php // echo $form->field($model, 'exento') ?>

    <?php // echo $form->field($model, 'tax') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
