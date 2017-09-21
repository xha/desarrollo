<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use frontend\models\VwResumenOrden;
use frontend\models\Usuario;
use frontend\models\Modelo;
use kartik\money\MaskMoney;
use kartik\detail\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Documento */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Consulta de Ordenes';
$this->params['breadcrumbs'][] = ['label' => 'Orden', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$fecha_actual=date('d-m-Y');
$this->registerCssFile('@web/css/general.css');
$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/resumen_orden.js');
?>
<div class="vw-resumen-orden-form">

    <center>
        <?= Html::submitButton('<i class="glyphicon glyphicon-search"></i> Consultar',array('class'=>'btn btn-success','onclick'=>'js:enviar_data();')); ?>
        <?= Html::a('Limpiar Consulta', ['reporte-ordenes'], ['class' => 'btn btn-danger']) ?>
    </center>
    <br />
    <?php $form = ActiveForm::begin(); ?>

	    <div class="panel panel-primary">
	          <div class="panel-heading"> <i class="glyphicon glyphicon-list-alt"></i> Datos de la Orden</div>
	    <!--CONTENT-->
	        <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                              <?= $form->field($model, 'numero_atencion')->textInput() ?>
                        </div>         
                        <div class="col-md-4">
                            <?= $form->field($model, 'placa')->textInput(['maxlength' => true])->label("Numero de Placa") ?>
                        </div>         
                        <div class="col-md-4">
                            <?= $form->field($model,'nombre_asesor')->dropDownList(
                                    ArrayHelper::map(Usuario::find()->all(), 'id_usuario', 'NombreCompleto'),
                                [
                                    'prompt'=>'Seleccione..',
                                    'id'=>'asesor',
                                ]);
                            ?>
                        </div>         
                        <div class="col-md-4">
                            <label>Fecha Hasta </label><br /><br />
                            <?= $form->field($model, 'fecha')->widget(DatePicker::classname(), [
                                    'language' => 'es',
                                    'removeButton'=>false,
                                    'options' => ['readonly' => true, 'value' => $fecha_actual],
                                    'id'=>'fecha_desde',
                                    'pluginOptions' => [
                                    'endDate' => date('d-m-Y'),
                                        'autoclose'=>true,
                                        'format' => 'dd-mm-yyyy',
                                    ]
                                ])->label(false);
                            ?>    
                        </div>         
                        <div class="col-md-4">
                            <label>Fecha Desde </label><br /><br />
                            <?= $form->field($model, 'fecha_transaccion')->widget(DatePicker::classname(), [
                                    'language' => 'es',
                                    'removeButton'=>false,
                                    'id'=>'fecha_Hasta',
                                    'options' => ['readonly' => true, 'value' => $fecha_actual],
                                    'pluginOptions' => [
                                    'endDate' => date('d-m-Y'),
                                        'autoclose'=>true,
                                        'format' => 'dd-mm-yyyy',
                                    ]
                                ])->label(false);
                            ?>    
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'activo')->dropDownList(['1' => 'Abierta', '0' => 'Cerrada'],['prompt'=>'Seleccione...'])->label("Estatus de la Orden") ?>
                        </div>
                       
                       
                    </div>
                </div>
            </div>
    <?php ActiveForm::end(); ?>
    <center class="panel" id="div_resultado"></center>
    <table class="tablas inicial00" id="listado_detalle"></table>
</div>
