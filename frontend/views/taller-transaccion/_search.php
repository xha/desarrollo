<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TallerTransaccionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="taller-transaccion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_taller') ?>

    <?= $form->field($model, 'id_transaccion') ?>

    <?= $form->field($model, 'fecha_transaccion') ?>

    <?= $form->field($model, 'tecnico') ?>

    <?= $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
