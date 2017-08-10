<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transaccion */
/* @var $form yii\widgets\ActiveForm */
date_default_timezone_set("America/Caracas");
$fecha= time();
$fecha=date('d-m-Y',$fecha);

?>

<div class="transaccion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'placa')->textInput() ?>

    <?= $form->field($model, 'fecha_transaccion')->textInput() ?>

    <?= $form->field($model,'fecha')->
        widget(DatePicker::className("form-control"),[
            'dateFormat' => 'dd-MM-yyyy',
            'clientOptions' => [
                'changeYear' => true
            ],
            'options' => ['class' => 'form-control texto-ec', 'readonly'=>true]
        ]) 
    ?>

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
        <?= Html::submitButton($model->isNewRecord ? 'Crear Nueva Orden' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
