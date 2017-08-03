<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ubicacion */

$this->title = 'Actualizar Ubicación: ' . $model->id_ubicacion;
$this->params['breadcrumbs'][] = ['label' => 'Ubicaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_ubicacion, 'url' => ['view', 'id' => $model->id_ubicacion]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="ubicacion-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
