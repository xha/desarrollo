<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProveedorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CodProv') ?>

    <?= $form->field($model, 'Descrip') ?>

    <?= $form->field($model, 'TipoPrv') ?>

    <?= $form->field($model, 'TipoID3') ?>

    <?= $form->field($model, 'TipoID') ?>

    <?php // echo $form->field($model, 'ID3') ?>

    <?php // echo $form->field($model, 'DescOrder') ?>

    <?php // echo $form->field($model, 'Clase') ?>

    <?php // echo $form->field($model, 'Activo') ?>

    <?php // echo $form->field($model, 'Represent') ?>

    <?php // echo $form->field($model, 'Direc1') ?>

    <?php // echo $form->field($model, 'Direc2') ?>

    <?php // echo $form->field($model, 'Pais') ?>

    <?php // echo $form->field($model, 'Estado') ?>

    <?php // echo $form->field($model, 'Ciudad') ?>

    <?php // echo $form->field($model, 'Municipio') ?>

    <?php // echo $form->field($model, 'ZipCode') ?>

    <?php // echo $form->field($model, 'Telef') ?>

    <?php // echo $form->field($model, 'Movil') ?>

    <?php // echo $form->field($model, 'Fax') ?>

    <?php // echo $form->field($model, 'Email') ?>

    <?php // echo $form->field($model, 'FechaE') ?>

    <?php // echo $form->field($model, 'EsReten') ?>

    <?php // echo $form->field($model, 'RetenISLR') ?>

    <?php // echo $form->field($model, 'DiasCred') ?>

    <?php // echo $form->field($model, 'Observa') ?>

    <?php // echo $form->field($model, 'EsMoneda') ?>

    <?php // echo $form->field($model, 'Saldo') ?>

    <?php // echo $form->field($model, 'MontoMax') ?>

    <?php // echo $form->field($model, 'PagosA') ?>

    <?php // echo $form->field($model, 'PromPago') ?>

    <?php // echo $form->field($model, 'RetenIVA') ?>

    <?php // echo $form->field($model, 'FechaUC') ?>

    <?php // echo $form->field($model, 'MontoUC') ?>

    <?php // echo $form->field($model, 'NumeroUC') ?>

    <?php // echo $form->field($model, 'FechaUP') ?>

    <?php // echo $form->field($model, 'MontoUP') ?>

    <?php // echo $form->field($model, 'NumeroUP') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
