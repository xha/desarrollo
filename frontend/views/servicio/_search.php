<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ServicioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CodServ') ?>

    <?= $form->field($model, 'CodInst') ?>

    <?= $form->field($model, 'Descrip') ?>

    <?= $form->field($model, 'Descrip2') ?>

    <?= $form->field($model, 'Descrip3') ?>

    <?php // echo $form->field($model, 'Clase') ?>

    <?php // echo $form->field($model, 'Activo') ?>

    <?php // echo $form->field($model, 'Unidad') ?>

    <?php // echo $form->field($model, 'Precio1') ?>

    <?php // echo $form->field($model, 'PrecioI1') ?>

    <?php // echo $form->field($model, 'Precio2') ?>

    <?php // echo $form->field($model, 'PrecioI2') ?>

    <?php // echo $form->field($model, 'Precio3') ?>

    <?php // echo $form->field($model, 'PrecioI3') ?>

    <?php // echo $form->field($model, 'Costo') ?>

    <?php // echo $form->field($model, 'EsExento') ?>

    <?php // echo $form->field($model, 'EsReten') ?>

    <?php // echo $form->field($model, 'EsPorCost') ?>

    <?php // echo $form->field($model, 'UsaServ') ?>

    <?php // echo $form->field($model, 'Comision') ?>

    <?php // echo $form->field($model, 'EsPorComi') ?>

    <?php // echo $form->field($model, 'FechaUV') ?>

    <?php // echo $form->field($model, 'FechaUC') ?>

    <?php // echo $form->field($model, 'EsImport') ?>

    <?php // echo $form->field($model, 'EsVenta') ?>

    <?php // echo $form->field($model, 'EsCompra') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
