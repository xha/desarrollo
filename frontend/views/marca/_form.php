<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Marca */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marca-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-8">
        <?= $form->field($model, 'descripcion')->textInput() ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
