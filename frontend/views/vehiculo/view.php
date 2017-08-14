<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Vehiculo */

$this->title = $model->id_vehiculo;
$this->params['breadcrumbs'][] = ['label' => 'Vehiculos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehiculo-view">

    

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_vehiculo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->id_vehiculo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirmar Desactivado',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_vehiculo',
            'id_modelo',
            'id_tipo_vehiculo',
            'id_marca',
            'placa',
            'anio',
            'color',
            'propietario',
            'activo',
        ],
    ]) ?>

</div>
