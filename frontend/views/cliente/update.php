<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cliente */

$this->title = 'Actualizar Cliente: ' . $model->CodClie;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CodClie, 'url' => ['view', 'id' => $model->CodClie]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="cliente-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
