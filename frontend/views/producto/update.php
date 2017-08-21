<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Producto */

$this->title = 'Actualizar Producto: ' . $model->CodProd;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CodProd, 'url' => ['view', 'id' => $model->CodProd]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="producto-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
