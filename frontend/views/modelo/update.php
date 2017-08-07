<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Modelo */

$this->title = 'Actualizar Modelo: ' . $model->id_modelo;
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_modelo, 'url' => ['view', 'id' => $model->id_modelo]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="modelo-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
