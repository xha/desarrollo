<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Instancia;
use frontend\models\Sataxes;
/* @var $this yii\web\View */
/* @var $model frontend\models\Servicio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CodServ')->textInput() ?>

    <label class="control-label">Instancia</label>
    <?= Html::activeDropDownList($model, 'CodInst',ArrayHelper::map(Instancia::find()->OrderBy('Descrip')->all(), 'CodInst', 'Descrip'), 
        ['class'=>'form-control']) ?>
    <br />

    <?= $form->field($model, 'Descrip')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'Descrip2')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'Descrip3')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'Clase')->textInput(['maxlength' => 10]) ?>
    
    <?= $form->field($model, 'Precio1')->textInput() ?>
    
    <?= $form->field($model, 'Unidad')->textInput(['maxlength' => 6]) ?>
    
    <?= $form->field($model, 'EsExento')->dropDownList(['0' => 'NO', '1' => 'SI']); ?>
    
    <label class="control-label">Impuesto</label>
    <?= Html::activeDropDownList($model, 'iva',ArrayHelper::map(Sataxes::find()->where(['activo' => '1'])->OrderBy('Descrip')->all(), 'CodTaxs', 'MtoTax'), 
        ['class'=>'form-control','prompt'=>'Seleccione','onblur'=>'js: separa_iva(this.id)']) ?>
    <br />

    <?= $form->field($model, 'Activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>
    
    <?= $form->field($model, 'mtotax')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'PrecioI1')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Precio2')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'PrecioI2')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Precio3')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'PrecioI3')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Costo')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsReten')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsPorCost')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'UsaServ')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Comision')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsPorComi')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsImport')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsVenta')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsCompra')->hiddenInput(['value' => 0])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    function separa_iva(id) {
        var variable = document.getElementById(id);
        var descrip = document.getElementById('servicio-mtotax');
        
        descrip.value = variable.options[variable.selectedIndex].text;
    }
</script>