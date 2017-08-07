<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Inspeccion */

$this->title = 'Actualizar Inspección: ' . $model->id_inspeccion;
$this->params['breadcrumbs'][] = ['label' => 'Inspecciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_inspeccion, 'url' => ['view', 'id' => $model->id_inspeccion]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="inspeccion-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
