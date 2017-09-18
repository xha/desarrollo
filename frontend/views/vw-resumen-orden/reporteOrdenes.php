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
?>
<div class="vw-resumen-orden-form">

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
                            <?php 
                            $model->fecha = ($model->isNewRecord  || $model->fecha != null) ? $fecha_actual : null;
                            echo $form->field($model, 'fecha')->widget(DatePicker::classname(), [
                                'language' => 'es',
                                'removeButton'=>false,
                                'options' => ['placeholder' => 'Fecha de la Orden', 'class'=>'form-control'],
                                'id'=>'fecha_desde',
                                'pluginOptions' => [
                                'endDate' => date('d-m-Y'),
                                    'autoclose'=>true,
                                    'format' => 'dd-mm-yyyy',
                                ]
                            ])->label('Fecha Desde de la Orden');
                            ?>    
                        </div>         
                        <div class="col-md-4">
                            <?php 
                            $model->fecha_transaccion = ($model->isNewRecord  || $model->fecha_transaccion != null) ? $fecha_actual : null;
                            echo $form->field($model, 'fecha_transaccion')->widget(DatePicker::classname(), [
                                'language' => 'es',
                                'removeButton'=>false,
                                'id'=>'fecha_Hasta',
                                'options' => ['placeholder' => 'Fecha de la Orden', 'class'=>'form-control'],
                                'pluginOptions' => [
                                'endDate' => date('d-m-Y'),
                                    'autoclose'=>true,
                                    'format' => 'dd-mm-yyyy',
                                ]
                            ])->label('Fecha Hasta de la Orden');
                            ?>    
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'modelo')->dropDownList(ArrayHelper::map(Modelo::find()->where('activo=1')->OrderBy('descripcion')->all(), 
                            'id_modelo', 'descripcion'), ['prompt' => 'Seleccione'])->label('Modelo'); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'activo')->dropDownList(['1' => 'Abierta', '2' => 'Cerrada'],['prompt'=>'Seleccione...'])->label("Estatus de la Orden") ?>
                        </div>
                       
                       
                    </div>
                </div>

		<!--FOOTER-->
		        <div class="panel-footer">
		                <center>
		                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '<i class="glyphicon glyphicon-search"></i> Consultar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                <?= Html::a('Limpiar Consulta', ['index'], ['class' => 'btn btn-danger']) ?>
                                </center>
		        </div>
		</div>

    <?php ActiveForm::end(); ?>

</div>