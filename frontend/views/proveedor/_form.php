<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Proveedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CodProv')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'Descrip')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'TipoPrv')->dropDownList(['0' => 'Nacional', '1' => 'Extranjero']); ?>

    <?= $form->field($model, 'ID3')->textInput() ?>

    <?= $form->field($model, 'Clase')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'Represent')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'Direc1')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'Direc2')->textInput(['maxlength' => 60]) ?>
    
    <?= $form->field($model, 'Telef')->textInput(['maxlength' => 30]) ?>
    
    <?= $form->field($model, 'Movil')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'Email')->textInput(['maxlength' => 60]) ?>
    
    <?= $form->field($model, 'EsReten')->dropDownList(['0' => 'Exento de Retención', '1' => 'Contribuyente', '2' => 'Autoretenedor']); ?>

    <?= $form->field($model, 'RetenISLR')->dropDownList(['0' => 'NO', '1' => 'SI']); ?>
    
    <?= $form->field($model, 'Observa')->textInput(['maxlength' => 40]) ?>
    
    <?= $form->field($model, 'Activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>
    
    <?= $form->field($model, 'TipoID3')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'TipoID')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Pais')->hiddenInput(['value' => 1])->label(false); ?>
    <?= $form->field($model, 'Estado')->hiddenInput(['value' => 1])->label(false); ?>
    <?= $form->field($model, 'Ciudad')->hiddenInput(['value' => 1])->label(false); ?>
    <?= $form->field($model, 'Municipio')->hiddenInput(['value' => 1])->label(false); ?>
    <?= $form->field($model, 'ZipCode')->hiddenInput(['value' => 1])->label(false); ?>
    <?= $form->field($model, 'DiasCred')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsMoneda')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Saldo')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'MontoMax')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'PagosA')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'PromPago')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'RetenIVA')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'MontoUC')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'MontoUP')->textInput()->hiddenInput(['value' => 0])->label(false); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
