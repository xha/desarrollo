<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RacionadoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="racionado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CodItem') ?>

    <?= $form->field($model, 'CodUbic') ?>

    <?= $form->field($model, 'dias') ?>

    <?= $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
