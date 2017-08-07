<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Proveedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CodProv')->textInput() ?>

    <?= $form->field($model, 'Descrip')->textInput() ?>

    <?= $form->field($model, 'TipoPrv')->textInput() ?>

    <?= $form->field($model, 'TipoID3')->textInput() ?>

    <?= $form->field($model, 'TipoID')->textInput() ?>

    <?= $form->field($model, 'ID3')->textInput() ?>

    <?= $form->field($model, 'DescOrder')->textInput() ?>

    <?= $form->field($model, 'Clase')->textInput() ?>

    <?= $form->field($model, 'Activo')->textInput() ?>

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

    <?= $form->field($model, 'Fax')->textInput() ?>

    <?= $form->field($model, 'Email')->textInput() ?>

    <?= $form->field($model, 'FechaE')->textInput() ?>

    <?= $form->field($model, 'EsReten')->textInput() ?>

    <?= $form->field($model, 'RetenISLR')->textInput() ?>

    <?= $form->field($model, 'DiasCred')->textInput() ?>

    <?= $form->field($model, 'Observa')->textInput() ?>

    <?= $form->field($model, 'EsMoneda')->textInput() ?>

    <?= $form->field($model, 'Saldo')->textInput() ?>

    <?= $form->field($model, 'MontoMax')->textInput() ?>

    <?= $form->field($model, 'PagosA')->textInput() ?>

    <?= $form->field($model, 'PromPago')->textInput() ?>

    <?= $form->field($model, 'RetenIVA')->textInput() ?>

    <?= $form->field($model, 'FechaUC')->textInput() ?>

    <?= $form->field($model, 'MontoUC')->textInput() ?>

    <?= $form->field($model, 'NumeroUC')->textInput() ?>

    <?= $form->field($model, 'FechaUP')->textInput() ?>

    <?= $form->field($model, 'MontoUP')->textInput() ?>

    <?= $form->field($model, 'NumeroUP')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
