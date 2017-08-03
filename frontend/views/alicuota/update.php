<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Alicuota */

$this->title = 'Actualizar Alicuota: ' . $model->id_alicuota;
$this->params['breadcrumbs'][] = ['label' => 'Alicuotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_alicuota, 'url' => ['view', 'id' => $model->id_alicuota]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="alicuota-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
