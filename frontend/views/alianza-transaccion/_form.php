<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AlianzaTransaccion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alianza-transaccion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_alianza')->textInput() ?>

    <?= $form->field($model, 'id_transaccion')->textInput() ?>

    <?= $form->field($model, 'nro_factura')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'nro_control')->textInput() ?>

    <?= $form->field($model, 'CodProv')->textInput() ?>

    <?= $form->field($model, 'almacenista')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
