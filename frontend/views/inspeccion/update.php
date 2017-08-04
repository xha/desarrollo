<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Inspeccion */

$this->title = 'Update Inspeccion: ' . $model->id_inspeccion;
$this->params['breadcrumbs'][] = ['label' => 'Inspeccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_inspeccion, 'url' => ['view', 'id' => $model->id_inspeccion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inspeccion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
