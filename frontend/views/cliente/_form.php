<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\models\Cliente */
/* @var $form yii\widgets\ActiveForm */

date_default_timezone_set("America/Caracas");
?>

<div class="cliente-form">
    <h3 style="color: red"><?= $msg ?></h3>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CodClie')->textInput(['maxlength' => 15, 'readonly' => !$model->isNewRecord]); ?>
    
    <?= $form->field($model, 'Descrip')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'ID3')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'TipoCli')->dropDownList(['0' => 'Contribuyente', '1' => 'Consumidor Final', '2' => 'Exportación', 
         '3' => 'Interno no gravable', '4' => 'Contribuyente Especial',]); ?>
    
    <?= $form->field($model,'FechaE')->
        widget(DatePicker::className("form-control"),[
            'dateFormat' => 'dd-MM-yyyy',
            'clientOptions' => [
                'changeYear' => true
            ],
            'options' => ['class' => 'form-control', 'readonly' => true]
        ]) 
    ?>

    <?= $form->field($model, 'TipoID3')->dropDownList(['1' => 'Natural', '0' => 'Jurídico']); ?>
    
    <?= $form->field($model, 'Telef')->textInput(['maxlength' => 30]) ?>
    
    <?= $form->field($model, 'Fax')->textInput(['maxlength' => 30]) ?>
    
    <?= $form->field($model, 'Movil')->textInput(['maxlength' => 15]) ?>
    
    <?= $form->field($model, 'Email')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'Direc1')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'Direc2')->textInput(['maxlength' => 60]) ?>
    
    <?= $form->field($model, 'Observa')->textInput(['maxlength' => 40]) ?>
    
    <?= $form->field($model, 'Activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <?= $form->field($model, 'Pais')->hiddenInput(['value' => 1])->label(false); ?>
    <?= $form->field($model, 'Estado')->hiddenInput(['value' => 1])->label(false); ?>
    <?= $form->field($model, 'Ciudad')->hiddenInput(['value' => 1])->label(false); ?>
    <?= $form->field($model, 'Municipio')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'DescOrder')->hiddenInput(['value' => 13])->label(false); ?>
    <?= $form->field($model, 'TipoID')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'TipoPVP')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsMoneda')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsCredito')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'LimiteCred')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'DiasCred')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsToleran')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'DiasTole')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'IntMora')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Descto')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Saldo')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'PagosA')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'MontoUV')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'MontoUP')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'MontoMax')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'MtoMaxCred')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'PromPago')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'RetenIVA')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'SaldoPtos')->hiddenInput(['value' => 0])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
