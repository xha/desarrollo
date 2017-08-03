<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presupuesto */

$this->title = 'Actualizar Presupuesto: ' . $model->NumeroD;
$this->params['breadcrumbs'][] = ['label' => 'Presupuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NumeroD, 'url' => ['view', 'NumeroD' => $model->NumeroD, 'TipoFac' => $model->TipoFac]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="presupuesto-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
