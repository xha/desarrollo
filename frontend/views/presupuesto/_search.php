<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PresupuestoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presupuesto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CodSucu') ?>

    <?= $form->field($model, 'TipoFac') ?>

    <?= $form->field($model, 'NumeroD') ?>

    <?= $form->field($model, 'NroUnico') ?>

    <?= $form->field($model, 'NroCtrol') ?>

    <?php // echo $form->field($model, 'CodEsta') ?>

    <?php // echo $form->field($model, 'CodUsua') ?>

    <?php // echo $form->field($model, 'EsCorrel') ?>

    <?php // echo $form->field($model, 'CodConv') ?>

    <?php // echo $form->field($model, 'Signo') ?>

    <?php // echo $form->field($model, 'FechaT') ?>

    <?php // echo $form->field($model, 'OTipo') ?>

    <?php // echo $form->field($model, 'ONumero') ?>

    <?php // echo $form->field($model, 'NumeroC') ?>

    <?php // echo $form->field($model, 'NumeroT') ?>

    <?php // echo $form->field($model, 'NumeroR') ?>

    <?php // echo $form->field($model, 'TipoTraE') ?>

    <?php // echo $form->field($model, 'AutSRI') ?>

    <?php // echo $form->field($model, 'NroEstable') ?>

    <?php // echo $form->field($model, 'PtoEmision') ?>

    <?php // echo $form->field($model, 'NumeroF') ?>

    <?php // echo $form->field($model, 'NumeroNCF') ?>

    <?php // echo $form->field($model, 'NumeroP') ?>

    <?php // echo $form->field($model, 'NumeroE') ?>

    <?php // echo $form->field($model, 'NumeroZ') ?>

    <?php // echo $form->field($model, 'Moneda') ?>

    <?php // echo $form->field($model, 'Factor') ?>

    <?php // echo $form->field($model, 'MontoMEx') ?>

    <?php // echo $form->field($model, 'CodClie') ?>

    <?php // echo $form->field($model, 'CodVend') ?>

    <?php // echo $form->field($model, 'CodUbic') ?>

    <?php // echo $form->field($model, 'Descrip') ?>

    <?php // echo $form->field($model, 'Direc1') ?>

    <?php // echo $form->field($model, 'Direc2') ?>

    <?php // echo $form->field($model, 'Direc3') ?>

    <?php // echo $form->field($model, 'ZipCode') ?>

    <?php // echo $form->field($model, 'Telef') ?>

    <?php // echo $form->field($model, 'ID3') ?>

    <?php // echo $form->field($model, 'Monto') ?>

    <?php // echo $form->field($model, 'MtoTax') ?>

    <?php // echo $form->field($model, 'Fletes') ?>

    <?php // echo $form->field($model, 'TGravable') ?>

    <?php // echo $form->field($model, 'TGravable0') ?>

    <?php // echo $form->field($model, 'TExento') ?>

    <?php // echo $form->field($model, 'CostoPrd') ?>

    <?php // echo $form->field($model, 'CostoSrv') ?>

    <?php // echo $form->field($model, 'DesctoP') ?>

    <?php // echo $form->field($model, 'RetenIVA') ?>

    <?php // echo $form->field($model, 'FechaR') ?>

    <?php // echo $form->field($model, 'FechaI') ?>

    <?php // echo $form->field($model, 'FechaE') ?>

    <?php // echo $form->field($model, 'FechaV') ?>

    <?php // echo $form->field($model, 'MtoTotal') ?>

    <?php // echo $form->field($model, 'Contado') ?>

    <?php // echo $form->field($model, 'Credito') ?>

    <?php // echo $form->field($model, 'CancelI') ?>

    <?php // echo $form->field($model, 'CancelA') ?>

    <?php // echo $form->field($model, 'CancelE') ?>

    <?php // echo $form->field($model, 'CancelC') ?>

    <?php // echo $form->field($model, 'CancelT') ?>

    <?php // echo $form->field($model, 'CancelG') ?>

    <?php // echo $form->field($model, 'CancelP') ?>

    <?php // echo $form->field($model, 'Cambio') ?>

    <?php // echo $form->field($model, 'MtoExtra') ?>

    <?php // echo $form->field($model, 'ValorPtos') ?>

    <?php // echo $form->field($model, 'Descto1') ?>

    <?php // echo $form->field($model, 'PctAnual') ?>

    <?php // echo $form->field($model, 'MtoInt1') ?>

    <?php // echo $form->field($model, 'Descto2') ?>

    <?php // echo $form->field($model, 'PctManejo') ?>

    <?php // echo $form->field($model, 'MtoInt2') ?>

    <?php // echo $form->field($model, 'SaldoAct') ?>

    <?php // echo $form->field($model, 'MtoPagos') ?>

    <?php // echo $form->field($model, 'MtoNCredito') ?>

    <?php // echo $form->field($model, 'MtoNDebito') ?>

    <?php // echo $form->field($model, 'MtoFinanc') ?>

    <?php // echo $form->field($model, 'DetalChq') ?>

    <?php // echo $form->field($model, 'TotalPrd') ?>

    <?php // echo $form->field($model, 'TotalSrv') ?>

    <?php // echo $form->field($model, 'OrdenC') ?>

    <?php // echo $form->field($model, 'CodOper') ?>

    <?php // echo $form->field($model, 'NGiros') ?>

    <?php // echo $form->field($model, 'NMeses') ?>

    <?php // echo $form->field($model, 'MtoComiVta') ?>

    <?php // echo $form->field($model, 'MtoComiCob') ?>

    <?php // echo $form->field($model, 'MtoComiVtaD') ?>

    <?php // echo $form->field($model, 'MtoComiCobD') ?>

    <?php // echo $form->field($model, 'Notas1') ?>

    <?php // echo $form->field($model, 'Notas2') ?>

    <?php // echo $form->field($model, 'Notas3') ?>

    <?php // echo $form->field($model, 'Notas4') ?>

    <?php // echo $form->field($model, 'Notas5') ?>

    <?php // echo $form->field($model, 'Notas6') ?>

    <?php // echo $form->field($model, 'Notas7') ?>

    <?php // echo $form->field($model, 'Notas8') ?>

    <?php // echo $form->field($model, 'Notas9') ?>

    <?php // echo $form->field($model, 'Notas10') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
