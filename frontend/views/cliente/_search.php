<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ClienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CodClie') ?>

    <?= $form->field($model, 'Descrip') ?>

    <?= $form->field($model, 'ID3') ?>

    <?= $form->field($model, 'TipoID3') ?>

    <?= $form->field($model, 'TipoID') ?>

    <?php // echo $form->field($model, 'Activo') ?>

    <?php // echo $form->field($model, 'DescOrder') ?>

    <?php // echo $form->field($model, 'Clase') ?>

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

    <?php // echo $form->field($model, 'Email') ?>

    <?php // echo $form->field($model, 'Fax') ?>

    <?php // echo $form->field($model, 'FechaE') ?>

    <?php // echo $form->field($model, 'CodZona') ?>

    <?php // echo $form->field($model, 'CodVend') ?>

    <?php // echo $form->field($model, 'CodConv') ?>

    <?php // echo $form->field($model, 'CodAlte') ?>

    <?php // echo $form->field($model, 'TipoCli') ?>

    <?php // echo $form->field($model, 'TipoPVP') ?>

    <?php // echo $form->field($model, 'Observa') ?>

    <?php // echo $form->field($model, 'EsMoneda') ?>

    <?php // echo $form->field($model, 'EsCredito') ?>

    <?php // echo $form->field($model, 'LimiteCred') ?>

    <?php // echo $form->field($model, 'DiasCred') ?>

    <?php // echo $form->field($model, 'EsToleran') ?>

    <?php // echo $form->field($model, 'DiasTole') ?>

    <?php // echo $form->field($model, 'IntMora') ?>

    <?php // echo $form->field($model, 'Descto') ?>

    <?php // echo $form->field($model, 'Saldo') ?>

    <?php // echo $form->field($model, 'PagosA') ?>

    <?php // echo $form->field($model, 'FechaUV') ?>

    <?php // echo $form->field($model, 'MontoUV') ?>

    <?php // echo $form->field($model, 'NumeroUV') ?>

    <?php // echo $form->field($model, 'FechaUP') ?>

    <?php // echo $form->field($model, 'MontoUP') ?>

    <?php // echo $form->field($model, 'NumeroUP') ?>

    <?php // echo $form->field($model, 'MontoMax') ?>

    <?php // echo $form->field($model, 'MtoMaxCred') ?>

    <?php // echo $form->field($model, 'PromPago') ?>

    <?php // echo $form->field($model, 'RetenIVA') ?>

    <?php // echo $form->field($model, 'SaldoPtos') ?>

    <?php // echo $form->field($model, 'DescripExt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
