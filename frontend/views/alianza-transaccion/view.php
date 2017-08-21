<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\AlianzaTransaccion */

$this->title = $model->id_at;
$this->params['breadcrumbs'][] = ['label' => 'Alianza Transaccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alianza-transaccion-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_at], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->id_at], [
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
            'id_at',
            'id_alianza',
            'id_transaccion',
            'nro_factura',
            'fecha',
            'nro_control',
            'CodProv',
            'almacenista',
            'total',
            'activo',
        ],
    ]) ?>

</div>
