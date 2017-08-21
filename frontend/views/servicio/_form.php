<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Servicio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CodServ')->textInput() ?>

    <?= $form->field($model, 'CodInst')->textInput() ?>

    <?= $form->field($model, 'Descrip')->textInput() ?>

    <?= $form->field($model, 'Descrip2')->textInput() ?>

    <?= $form->field($model, 'Descrip3')->textInput() ?>

    <?= $form->field($model, 'Clase')->textInput() ?>

    <?= $form->field($model, 'Activo')->textInput() ?>

    <?= $form->field($model, 'Unidad')->textInput() ?>

    <?= $form->field($model, 'Precio1')->textInput() ?>

    <?= $form->field($model, 'PrecioI1')->textInput() ?>

    <?= $form->field($model, 'Precio2')->textInput() ?>

    <?= $form->field($model, 'PrecioI2')->textInput() ?>

    <?= $form->field($model, 'Precio3')->textInput() ?>

    <?= $form->field($model, 'PrecioI3')->textInput() ?>

    <?= $form->field($model, 'Costo')->textInput() ?>

    <?= $form->field($model, 'EsExento')->textInput() ?>

    <?= $form->field($model, 'EsReten')->textInput() ?>

    <?= $form->field($model, 'EsPorCost')->textInput() ?>

    <?= $form->field($model, 'UsaServ')->textInput() ?>

    <?= $form->field($model, 'Comision')->textInput() ?>

    <?= $form->field($model, 'EsPorComi')->textInput() ?>

    <?= $form->field($model, 'FechaUV')->textInput() ?>

    <?= $form->field($model, 'FechaUC')->textInput() ?>

    <?= $form->field($model, 'EsImport')->textInput() ?>

    <?= $form->field($model, 'EsVenta')->textInput() ?>

    <?= $form->field($model, 'EsCompra')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
