<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Modelo;
use frontend\models\Marca;
use frontend\models\TipoVehiculo;

/* @var $this yii\web\View */
/* @var $model frontend\models\Vehiculo */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/general.js');
$this->registerCssFile('@web/css/general.css');
?>

<div class="vehiculo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_modelo')->dropDownList(ArrayHelper::map(Modelo::find()->where(['activo' => '1'])->OrderBy('descripcion')->all(), 
        'id_modelo', 'descripcion'), ['prompt' => 'Seleccione']); ?>

    <?= $form->field($model, 'id_tipo_vehiculo')->dropDownList(ArrayHelper::map(TipoVehiculo::find()->where('activo=1')->OrderBy('descripcion')->all(), 
        'id_tipo_vehiculo', 'descripcion'), ['prompt' => 'Seleccione']); ?>
    
    <?= $form->field($model, 'id_marca')->dropDownList(ArrayHelper::map(Marca::find()->where('activo=1')->OrderBy('descripcion')->all(), 
        'id_marca', 'descripcion'), ['prompt' => 'Seleccione']); ?>

    <?= $form->field($model, 'placa')->textInput(['maxlength' => 10, 'style' => 'text-transform: uppercase']) ?>
    
    <?= $form->field($model, 'nro_puestos')->textInput() ?>
    
    <?= $form->field($model, 'serial_motor')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'serial_carroceria')->textInput(['maxlength' => 100]) ?>
    
    <?= $form->field($model, 'venta')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'color')->textInput() ?>
    
    <?= $form->field($model, 'anio')->textInput() ?>

    <label>Propietario</label><br /><br />
    <?= $form->field($model, 'propietario')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
            'clientOptions' => [
                'source' => $data,
            ],
            'options' => ['class' => 'form-control','onblur'=>'js: split_clientes()'],
        ]) 
    ?>
    
    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>
    <?php //$form->field($model, 'activo')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    function split_clientes() {
        var propietario = trae('vehiculo-propietario');
        
        if (propietario.value!="") {
            var arreglo = propietario.value.split(" - ");    
            propietario.value = arreglo[0];
        }
    }
</script>
