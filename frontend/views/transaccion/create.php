<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Transaccion */

$this->title = 'Generar Nueva Orden';
$this->params['breadcrumbs'][] = ['label' => 'Transaccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaccion-create">

    <?= $this->render('_form', [
        'model' => $model,
        'clientes' => $clientes,
        'placas' => $placas,
        'items' => $items,
    ]) ?>

</div>
