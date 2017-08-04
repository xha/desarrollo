<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Modelo */

$this->title = 'Update Modelo: ' . $model->id_modelo;
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_modelo, 'url' => ['view', 'id' => $model->id_modelo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="modelo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
