<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Accion;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $model app\models\RolAccion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rol-accion-form">

    <?php $form = ActiveForm::begin(); ?>

    <label class="control-label">Acción</label>
    <?= Html::activeDropDownList($model, 'id_accion',
      ArrayHelper::map(Accion::find()->where(['activo' => '1'])->OrderBy('descripcion')->all(), 'id_accion', 'descripcion'), ['prompt'=>'Seleccione','class'=>'form-control']) ?>

    <label class="control-label">Rol</label>
    <?= Html::activeDropDownList($model, 'id_rol',
      ArrayHelper::map(Rol::find()->where(['activo' => '1'])->OrderBy('descripcion')->all(), 'id_rol', 'descripcion'), ['prompt'=>'Seleccione','class'=>'form-control']) ?>
      <br />
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
