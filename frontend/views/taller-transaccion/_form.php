<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\TallerTransaccion */
/* @var $form yii\widgets\ActiveForm */
?>


    <div class="taller-transaccion-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<?= $form->field($model, 'id_transaccion')->textInput() ?>

    <?= $form->field($model, 'fecha_transaccion')->textInput() ?>-->

    <div class="col-md-4">
    <?= $form->field($model,'tecnico')->dropDownList(
            ArrayHelper::map(frontend\models\Usuario::find()->all(), 'id_usuario', 'NombreCompleto'),
        [
            'prompt'=>'Seleccione..',
            'id'=>'Tecnico',
            //'onchange'=>'check()',
        ]); ?>
    </div>
    <div class="col-md-8">
   <?= $form->field($model, 'observacion')->textInput() ?>
    </div>  
    <div class="col-md-12">
        <hr>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Asignar Técnico', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
           <?= Html::a('Atrás', ['index'], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
 
    <?php ActiveForm::end(); ?>

</div>
</center>