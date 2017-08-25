<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Transaccion */

$this->title = "Transacción: ".$model->id_transaccion;
$this->params['breadcrumbs'][] = ['label' => 'Transacciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaccion-view">

    

    <p>
        <?php //Html::a('Actualizar', ['update', 'id' => $model->id_transaccion], ['class' => 'btn btn-primary']) ?>
        <?php /*/*Html::a('Desactivar', ['delete', 'id' => $model->id_transaccion], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirmar Desactivado',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'numero_atencion',
            'id_transaccion',
            'id_vehiculo',
            //'fecha_transaccion',
            'fecha',
            'hora',
            'CodSucu',
            'asesor',
            'km',
            'representante',
            'gravable',
            'exento',
            'tax',
            'total',
            'observacion',
            'activo',
        ],
    ]) ?>

</div>
