<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Marca */

$this->title = 'Update Marca: ' . $model->id_marca;
$this->params['breadcrumbs'][] = ['label' => 'Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_marca, 'url' => ['view', 'id' => $model->id_marca]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="marca-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
