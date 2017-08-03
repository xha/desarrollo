<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RolAccion */

$this->title = $model->id_accion;
$this->params['breadcrumbs'][] = ['label' => 'Rol Accions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-accion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_accion' => $model->id_accion, 'id_rol' => $model->id_rol], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_accion' => $model->id_accion, 'id_rol' => $model->id_rol], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_accion',
            'id_rol',
        ],
    ]) ?>

</div>
