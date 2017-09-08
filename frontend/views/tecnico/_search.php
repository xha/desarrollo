<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TecnicoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tecnico-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CodMeca') ?>

    <?= $form->field($model, 'Descrip') ?>

    <?= $form->field($model, 'TipoID3') ?>

    <?= $form->field($model, 'TipoID') ?>

    <?= $form->field($model, 'ID3') ?>

    <?php // echo $form->field($model, 'DescOrder') ?>

    <?php // echo $form->field($model, 'Clase') ?>

    <?php // echo $form->field($model, 'Activo') ?>

    <?php // echo $form->field($model, 'Direc1') ?>

    <?php // echo $form->field($model, 'Direc2') ?>

    <?php // echo $form->field($model, 'Telef') ?>

    <?php // echo $form->field($model, 'Movil') ?>

    <?php // echo $form->field($model, 'Email') ?>

    <?php // echo $form->field($model, 'DEsComi') ?>

    <?php // echo $form->field($model, 'Monto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
