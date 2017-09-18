<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\VwResumenOrden */

$this->title = 'Update Vw Resumen Orden: ' . $model->id_transaccion;
$this->params['breadcrumbs'][] = ['label' => 'Vw Resumen Ordens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_transaccion, 'url' => ['view', 'id' => $model->id_transaccion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vw-resumen-orden-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
