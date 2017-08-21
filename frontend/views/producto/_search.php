<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProductoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CodProd') ?>

    <?= $form->field($model, 'Descrip') ?>

    <?= $form->field($model, 'CodInst') ?>

    <?= $form->field($model, 'Activo') ?>

    <?= $form->field($model, 'Descrip2') ?>

    <?php // echo $form->field($model, 'Descrip3') ?>

    <?php // echo $form->field($model, 'Refere') ?>

    <?php // echo $form->field($model, 'Marca') ?>

    <?php // echo $form->field($model, 'Unidad') ?>

    <?php // echo $form->field($model, 'UndEmpaq') ?>

    <?php // echo $form->field($model, 'CantEmpaq') ?>

    <?php // echo $form->field($model, 'Precio1') ?>

    <?php // echo $form->field($model, 'Precio2') ?>

    <?php // echo $form->field($model, 'PrecioU2') ?>

    <?php // echo $form->field($model, 'Precio3') ?>

    <?php // echo $form->field($model, 'PrecioU3') ?>

    <?php // echo $form->field($model, 'PrecioU') ?>

    <?php // echo $form->field($model, 'CostAct') ?>

    <?php // echo $form->field($model, 'CostPro') ?>

    <?php // echo $form->field($model, 'CostAnt') ?>

    <?php // echo $form->field($model, 'Existen') ?>

    <?php // echo $form->field($model, 'ExUnidad') ?>

    <?php // echo $form->field($model, 'Compro') ?>

    <?php // echo $form->field($model, 'Pedido') ?>

    <?php // echo $form->field($model, 'Minimo') ?>

    <?php // echo $form->field($model, 'Maximo') ?>

    <?php // echo $form->field($model, 'Tara') ?>

    <?php // echo $form->field($model, 'DEsComp') ?>

    <?php // echo $form->field($model, 'DEsComi') ?>

    <?php // echo $form->field($model, 'DEsSeri') ?>

    <?php // echo $form->field($model, 'EsReten') ?>

    <?php // echo $form->field($model, 'DEsLote') ?>

    <?php // echo $form->field($model, 'DEsVence') ?>

    <?php // echo $form->field($model, 'EsImport') ?>

    <?php // echo $form->field($model, 'EsExento') ?>

    <?php // echo $form->field($model, 'EsEnser') ?>

    <?php // echo $form->field($model, 'EsOferta') ?>

    <?php // echo $form->field($model, 'EsPesa') ?>

    <?php // echo $form->field($model, 'EsEmpaque') ?>

    <?php // echo $form->field($model, 'ExDecimal') ?>

    <?php // echo $form->field($model, 'DiasEntr') ?>

    <?php // echo $form->field($model, 'FechaUV') ?>

    <?php // echo $form->field($model, 'FechaUC') ?>

    <?php // echo $form->field($model, 'DiasTole') ?>

    <?php // echo $form->field($model, 'Peso') ?>

    <?php // echo $form->field($model, 'Volumen') ?>

    <?php // echo $form->field($model, 'UndVol') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
