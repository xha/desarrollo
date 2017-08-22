<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Servicio */

$this->title = $model->CodServ;
$this->params['breadcrumbs'][] = ['label' => 'Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicio-view">
    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->CodServ], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->CodServ], [
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
            'CodServ',
            'CodInst',
            'Descrip',
            'Descrip2',
            'Descrip3',
            'Clase',
            'Activo',
            'Unidad',
            'Precio1',
            /*'PrecioI1',
            'Precio2',
            'PrecioI2',
            'Precio3',
            'PrecioI3',
            'Costo',
            'EsExento',
            'EsReten',
            'EsPorCost',
            'UsaServ',
            'Comision',
            'EsPorComi',
            'FechaUV',
            'FechaUC',
            'EsImport',
            'EsVenta',
            'EsCompra',*/
        ],
    ]) ?>

</div>
