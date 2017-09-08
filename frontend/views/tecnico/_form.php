<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tecnico */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tecnico-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CodMeca')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'Descrip')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'ID3')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'Direc1')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'Direc2')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'Telef')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'Movil')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'Email')->textInput(['maxlength' => 60]) ?>
    
    <?= $form->field($model, 'Activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <?= $form->field($model, 'TipoID3')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'TipoID')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'DescOrder')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'DEsComi')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Monto')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Clase')->hiddenInput(['value' => 0])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
