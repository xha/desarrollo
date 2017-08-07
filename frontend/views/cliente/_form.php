<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CodClie')->textInput() ?>

    <?= $form->field($model, 'Descrip')->textInput() ?>

    <?= $form->field($model, 'ID3')->textInput() ?>

    <?= $form->field($model, 'TipoID3')->textInput() ?>

    <?= $form->field($model, 'TipoID')->textInput() ?>

    <?= $form->field($model, 'Activo')->textInput() ?>

    <?= $form->field($model, 'DescOrder')->textInput() ?>

    <?= $form->field($model, 'Clase')->textInput() ?>

    <?= $form->field($model, 'Represent')->textInput() ?>

    <?= $form->field($model, 'Direc1')->textInput() ?>

    <?= $form->field($model, 'Direc2')->textInput() ?>

    <?= $form->field($model, 'Pais')->textInput() ?>

    <?= $form->field($model, 'Estado')->textInput() ?>

    <?= $form->field($model, 'Ciudad')->textInput() ?>

    <?= $form->field($model, 'Municipio')->textInput() ?>

    <?= $form->field($model, 'ZipCode')->textInput() ?>

    <?= $form->field($model, 'Telef')->textInput() ?>

    <?= $form->field($model, 'Movil')->textInput() ?>

    <?= $form->field($model, 'Email')->textInput() ?>

    <?= $form->field($model, 'Fax')->textInput() ?>

    <?= $form->field($model, 'FechaE')->textInput() ?>

    <?= $form->field($model, 'CodZona')->textInput() ?>

    <?= $form->field($model, 'CodVend')->textInput() ?>

    <?= $form->field($model, 'CodConv')->textInput() ?>

    <?= $form->field($model, 'CodAlte')->textInput() ?>

    <?= $form->field($model, 'TipoCli')->textInput() ?>

    <?= $form->field($model, 'TipoPVP')->textInput() ?>

    <?= $form->field($model, 'Observa')->textInput() ?>

    <?= $form->field($model, 'EsMoneda')->textInput() ?>

    <?= $form->field($model, 'EsCredito')->textInput() ?>

    <?= $form->field($model, 'LimiteCred')->textInput() ?>

    <?= $form->field($model, 'DiasCred')->textInput() ?>

    <?= $form->field($model, 'EsToleran')->textInput() ?>

    <?= $form->field($model, 'DiasTole')->textInput() ?>

    <?= $form->field($model, 'IntMora')->textInput() ?>

    <?= $form->field($model, 'Descto')->textInput() ?>

    <?= $form->field($model, 'Saldo')->textInput() ?>

    <?= $form->field($model, 'PagosA')->textInput() ?>

    <?= $form->field($model, 'FechaUV')->textInput() ?>

    <?= $form->field($model, 'MontoUV')->textInput() ?>

    <?= $form->field($model, 'NumeroUV')->textInput() ?>

    <?= $form->field($model, 'FechaUP')->textInput() ?>

    <?= $form->field($model, 'MontoUP')->textInput() ?>

    <?= $form->field($model, 'NumeroUP')->textInput() ?>

    <?= $form->field($model, 'MontoMax')->textInput() ?>

    <?= $form->field($model, 'MtoMaxCred')->textInput() ?>

    <?= $form->field($model, 'PromPago')->textInput() ?>

    <?= $form->field($model, 'RetenIVA')->textInput() ?>

    <?= $form->field($model, 'SaldoPtos')->textInput() ?>

    <?= $form->field($model, 'DescripExt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
