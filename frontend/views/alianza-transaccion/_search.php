<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AlianzaTransaccionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alianza-transaccion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_at') ?>

    <?= $form->field($model, 'id_alianza') ?>

    <?= $form->field($model, 'id_transaccion') ?>

    <?= $form->field($model, 'nro_factura') ?>

    <?= $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'nro_control') ?>

    <?php // echo $form->field($model, 'CodProv') ?>

    <?php // echo $form->field($model, 'almacenista') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
