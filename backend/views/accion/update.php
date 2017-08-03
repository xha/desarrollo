<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Accion */

$this->title = 'Update Accion: ' . $model->id_accion;
$this->params['breadcrumbs'][] = ['label' => 'Accions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_accion, 'url' => ['view', 'id' => $model->id_accion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
