<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transaccion */

$this->title = $model->id_transaccion;
$this->params['breadcrumbs'][] = ['label' => 'Transaccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaccion-view">

    

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_transaccion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->id_transaccion], [
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
            'id_transaccion',
            'id_vehiculo',
            //'fecha_transaccion',
            'fecha',
            'hora',
            'CodSucu',
            'asesor',
            'km',
            'representante',
            'numero_atencion',
            'gravable',
            'exento',
            'tax',
            'total',
            'observacion',
            'activo',
        ],
    ]) ?>

</div>
