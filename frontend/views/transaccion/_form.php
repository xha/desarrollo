<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transaccion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaccion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_vehiculo')->textInput() ?>

    <?= $form->field($model, 'fecha_transaccion')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'hora')->textInput() ?>

    <?= $form->field($model, 'CodSucu')->textInput() ?>

    <?= $form->field($model, 'asesor')->textInput() ?>

    <?= $form->field($model, 'km')->textInput() ?>

    <?= $form->field($model, 'representante')->textInput() ?>

    <?= $form->field($model, 'numero_atencion')->textInput() ?>

    <?= $form->field($model, 'gravable')->textInput() ?>

    <?= $form->field($model, 'exento')->textInput() ?>

    <?= $form->field($model, 'tax')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'observacion')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
