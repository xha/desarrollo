<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model frontend\models\AlianzaTransaccion */
/* @var $form yii\widgets\ActiveForm */
$id_usuario = Yii::$app->user->identity->id_usuario;
?>

<div class="alianza-transaccion-form">

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear Registro' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'id_alianza')->textInput() ?>

    <?= $form->field($model, 'id_transaccion')->textInput() ?>

    <?= $form->field($model, 'nro_factura')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'nro_control')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'CodProv')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'almacenista')->hiddenInput(['value' => $id_usuario])->label(false) ?>
    <?= $form->field($model, 'activo')->hiddenInput(['value' => 1])->label(false) ?>

    <?php ActiveForm::end(); ?>

</div>
