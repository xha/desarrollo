<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Saclie;
use app\models\Ubicacion;
use app\models\Piso;

/* @var $this yii\web\View */
/* @var $model app\models\Alicuota */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alicuota-form">

    <?php $form = ActiveForm::begin(); ?>

    <label class="control-label">Cliente</label>
    <?= Html::activeDropDownList($model, 'CodClie',
      ArrayHelper::map(Saclie::find()->where(['activo' => '1'])->OrderBy('Descrip')->all(), 'CodClie', 'Descrip'), ['class'=>'form-control','prompt'=>'Seleccione']) ?>

    <label class="control-label">Ubicación</label>
    <?= Html::activeDropDownList($model, 'id_ubicacion',
      ArrayHelper::map(Ubicacion::find()->where(['activo' => '1'])->OrderBy('nombre')->all(), 'id_ubicacion', 'nombre'), ['class'=>'form-control','prompt'=>'Seleccione']) ?>

    <label class="control-label">Piso</label>
    <?= Html::activeDropDownList($model, 'id_piso',
      ArrayHelper::map(Piso::find()->where(['activo' => '1'])->OrderBy('nombre')->all(), 'id_piso', 'nombre'), ['class'=>'form-control','prompt'=>'Seleccione']) ?>

    <?= $form->field($model, 'descripcion')->textInput() ?>

    <?= $form->field($model, 'porcentaje')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'alquiler')->dropDownList(['0' => 'NO', '1' => 'SI']); ?>

    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
