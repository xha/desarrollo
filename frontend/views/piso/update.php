<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Piso */

$this->title = 'Actualizar Piso: ' . $model->id_piso;
$this->params['breadcrumbs'][] = ['label' => 'Pisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_piso, 'url' => ['view', 'id' => $model->id_piso]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="piso-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
