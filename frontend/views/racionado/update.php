<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Racionado */

$this->title = 'Actualizar Racionado: ' . $model->CodItem;
$this->params['breadcrumbs'][] = ['label' => 'Control de Entrega', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CodItem, 'url' => ['view', 'id' => $model->CodItem]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="racionado-update">


    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
    ]) ?>

</div>
