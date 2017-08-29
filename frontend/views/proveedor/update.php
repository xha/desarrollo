<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Proveedor */

$this->title = 'Actualizar Proveedor: ' . $model->CodProv;
$this->params['breadcrumbs'][] = ['label' => 'Proveedorees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CodProv, 'url' => ['view', 'id' => $model->CodProv]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="proveedor-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
