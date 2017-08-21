<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CodProd')->textInput() ?>

    <?= $form->field($model, 'Descrip')->textInput() ?>

    <?= $form->field($model, 'CodInst')->textInput() ?>

    <?= $form->field($model, 'Activo')->textInput() ?>

    <?= $form->field($model, 'Descrip2')->textInput() ?>

    <?= $form->field($model, 'Descrip3')->textInput() ?>

    <?= $form->field($model, 'Refere')->textInput() ?>

    <?= $form->field($model, 'Marca')->textInput() ?>

    <?= $form->field($model, 'Unidad')->textInput() ?>

    <?= $form->field($model, 'UndEmpaq')->textInput() ?>

    <?= $form->field($model, 'CantEmpaq')->textInput() ?>

    <?= $form->field($model, 'Precio1')->textInput() ?>

    <?= $form->field($model, 'Precio2')->textInput() ?>

    <?= $form->field($model, 'PrecioU2')->textInput() ?>

    <?= $form->field($model, 'Precio3')->textInput() ?>

    <?= $form->field($model, 'PrecioU3')->textInput() ?>

    <?= $form->field($model, 'PrecioU')->textInput() ?>

    <?= $form->field($model, 'CostAct')->textInput() ?>

    <?= $form->field($model, 'CostPro')->textInput() ?>

    <?= $form->field($model, 'CostAnt')->textInput() ?>

    <?= $form->field($model, 'Existen')->textInput() ?>

    <?= $form->field($model, 'ExUnidad')->textInput() ?>

    <?= $form->field($model, 'Compro')->textInput() ?>

    <?= $form->field($model, 'Pedido')->textInput() ?>

    <?= $form->field($model, 'Minimo')->textInput() ?>

    <?= $form->field($model, 'Maximo')->textInput() ?>

    <?= $form->field($model, 'Tara')->textInput() ?>

    <?= $form->field($model, 'DEsComp')->textInput() ?>

    <?= $form->field($model, 'DEsComi')->textInput() ?>

    <?= $form->field($model, 'DEsSeri')->textInput() ?>

    <?= $form->field($model, 'EsReten')->textInput() ?>

    <?= $form->field($model, 'DEsLote')->textInput() ?>

    <?= $form->field($model, 'DEsVence')->textInput() ?>

    <?= $form->field($model, 'EsImport')->textInput() ?>

    <?= $form->field($model, 'EsExento')->textInput() ?>

    <?= $form->field($model, 'EsEnser')->textInput() ?>

    <?= $form->field($model, 'EsOferta')->textInput() ?>

    <?= $form->field($model, 'EsPesa')->textInput() ?>

    <?= $form->field($model, 'EsEmpaque')->textInput() ?>

    <?= $form->field($model, 'ExDecimal')->textInput() ?>

    <?= $form->field($model, 'DiasEntr')->textInput() ?>

    <?= $form->field($model, 'FechaUV')->textInput() ?>

    <?= $form->field($model, 'FechaUC')->textInput() ?>

    <?= $form->field($model, 'DiasTole')->textInput() ?>

    <?= $form->field($model, 'Peso')->textInput() ?>

    <?= $form->field($model, 'Volumen')->textInput() ?>

    <?= $form->field($model, 'UndVol')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
