<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Instancia;
use frontend\models\Sataxes;
/* @var $this yii\web\View */
/* @var $model frontend\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CodProd')->textInput() ?>

    <?= $form->field($model, 'Descrip')->textInput(['maxlength' => 40]) ?>
    
    <?= $form->field($model, 'Descrip2')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'Descrip3')->textInput(['maxlength' => 40]) ?>

    <label class="control-label">Instancia</label>
    <?= Html::activeDropDownList($model, 'CodInst',ArrayHelper::map(Instancia::find()->OrderBy('Descrip')->all(), 'CodInst', 'Descrip'), 
        ['class'=>'form-control']) ?>
    <br />
    <?= $form->field($model, 'Refere')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'Marca')->textInput(['maxlength' => 20]) ?>
    
    <?= $form->field($model, 'Precio1')->textInput() ?>
    
    <?= $form->field($model, 'EsExento')->dropDownList(['0' => 'NO', '1' => 'SI']); ?>
    
    <label class="control-label">Impuesto</label>
    <?= Html::activeDropDownList($model, 'iva',ArrayHelper::map(Sataxes::find()->where(['activo' => '1'])->OrderBy('Descrip')->all(), 'CodTaxs', 'MtoTax'), 
        ['class'=>'form-control','prompt'=>'Seleccione','onblur'=>'js: separa_iva(this.id)']) ?>
    <br />
    <?= $form->field($model, 'Activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <?= $form->field($model, 'mtotax')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Unidad')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'UndEmpaq')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'CantEmpaq')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Precio2')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'PrecioU2')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Precio3')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'PrecioU3')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'PrecioU')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'CostAct')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'CostPro')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'CostAnt')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Existen')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'ExUnidad')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Compro')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Pedido')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Minimo')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Maximo')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Tara')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'DEsComp')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'DEsComi')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'DEsSeri')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsReten')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'DEsLote')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'DEsVence')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsImport')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsEnser')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsOferta')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsPesa')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'EsEmpaque')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'ExDecimal')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'DiasEntr')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'DiasTole')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Peso')->hiddenInput(['value' => 0])->label(false); ?>
    <?= $form->field($model, 'Volumen')->hiddenInput(['value' => 0])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    function separa_iva(id) {
        var variable = document.getElementById(id);
        var descrip = document.getElementById('producto-mtotax');
        
        descrip.value = variable.options[variable.selectedIndex].text;
    }
</script>