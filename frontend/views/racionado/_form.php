<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Racionado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="racionado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CodItem')->widget(\yii\jui\AutoComplete::classname(), [
            'clientOptions' => [
                'source' => $items,
            ],
            'options' => ['class' => 'form-control'],
        ]) 
    ?>

    <?= $form->field($model, 'CodUbic')->hiddenInput(['value' => Yii::$app->user->identity->CodUbic])->label(false) ?>

    <?= $form->field($model, 'dias')->textInput() ?>

    <?= $form->field($model, 'activo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
