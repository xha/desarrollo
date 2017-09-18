<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use frontend\models\Transaccion;
use kartik\money\MaskMoney;
use kartik\detail\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Documento */
/* @var $form yii\widgets\ActiveForm */


$this->title = 'Consultar Estatus de la Orden';
$this->params['breadcrumbs'][] = ['label' => 'Orden', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
 $fecha_actual=date('d-m-Y')
?>
<br>
<br>

<div class="consulta-form">

    <?php $form = ActiveForm::begin(); ?>

	    <div class="panel panel-primary">
	          <div class="panel-heading"> <i class="glyphicon glyphicon-list-alt"></i> Datos de la Orden</div>

	    <!--CONTENT-->
	        <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'numero_atencion')->textInput(['maxlength' => true])->label("Numero de Atención") ?>
                        </div>         
                        <div class="col-md-4">
                            <?= $form->field($model, 'placa')->textInput(['maxlength' => true])->label("Numero de Placa") ?>
                        </div>         
                        <div class="col-md-4">
                            <?php 
                            $model->fecha_transaccion = ($model->isNewRecord  || $model->fecha_transaccion != null) ? date('d-m-Y') : null;
                            echo $form->field($model, 'fecha_transaccion')->widget(DatePicker::classname(), [
                                'language' => 'es',
                                'removeButton'=>false,
                                'options' => ['placeholder' => 'Fecha de la Orden', 'class'=>'form-control'],
                                'pluginOptions' => [
                                'endDate' => date('d-m-Y'),
                                    'autoclose'=>true,
                                    'format' => 'dd-mm-yyyy',
                                ]
                            ])->label('Fecha de la Orden');
                            ?>    
                        </div>         
                    </div>
                </div>

		<!--FOOTER-->
		        <div class="panel-footer">
		                <center>
		                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '<i class="glyphicon glyphicon-search"></i> Consultar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		                </center>
		        </div>
		</div>

    <?php ActiveForm::end(); ?>

</div>


