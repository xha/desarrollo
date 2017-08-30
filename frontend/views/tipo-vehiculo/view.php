<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoVehiculo */

$this->title = $model->id_tipo_vehiculo;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Vehiculos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-vehiculo-view">

    

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_tipo_vehiculo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->id_tipo_vehiculo], [
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
//            'id_tipo_vehiculo',
            'descripcion',
//            'activo',
        ],
    ]) ?>

</div>
