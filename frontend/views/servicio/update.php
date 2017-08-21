<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Servicio */

$this->title = 'Actualizar Servicio: ' . $model->CodServ;
$this->params['breadcrumbs'][] = ['label' => 'Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CodServ, 'url' => ['view', 'id' => $model->CodServ]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="servicio-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
