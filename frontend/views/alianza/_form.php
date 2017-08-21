<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Proveedor;

/* @var $this yii\web\View */
/* @var $model frontend\models\Alianza */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alianza-form">

    <?php $form = ActiveForm::begin(); ?>

    <label class="control-label">Proveedor</label>
    <?= Html::activeDropDownList($model, 'CodProv',ArrayHelper::map(Proveedor::find()->where(['activo' => '1'])->OrderBy('Descrip')->all(), 'CodProv', 'Descrip'), 
        ['class'=>'form-control','prompt'=>'Seleccione','onblur'=>'js: divide(this.id)']) ?>
    <br />
    <?= $form->field($model, 'Descrip')->textInput(['readonly'=>true]) ?>
    
    <?= $form->field($model, 'porcentaje')->textInput() ?>

    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    function divide(id) {
        var variable = document.getElementById(id);
        var descrip = document.getElementById('alianza-descrip');
        
        descrip.value = variable.options[variable.selectedIndex].text;
    }
</script>