<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tecnico */

$this->title = 'Actualizar Tecnico: ' . $model->CodMeca;
$this->params['breadcrumbs'][] = ['label' => 'Tecnicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CodMeca, 'url' => ['view', 'id' => $model->CodMeca]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tecnico-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
