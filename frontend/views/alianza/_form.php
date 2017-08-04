<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Saprov;

/* @var $this yii\web\View */
/* @var $model frontend\models\Alianza */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alianza-form">

    <?php $form = ActiveForm::begin(); ?>

    <label class="control-label">Proveedor</label>
    <?= Html::activeDropDownList($model, 'CodProv',
      ArrayHelper::map(Saprov::find()->where(['activo' => '1'])->OrderBy('Descrip')->all(), 'CodProv', 'Descrip'), ['class'=>'form-control','prompt'=>'Seleccione']) ?>
    <br />
    <?= $form->field($model, 'porcentaje')->textInput() ?>

    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
