<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ServicioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Servicios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicio-index">

    <p>
        <?= Html::a('Crear Servicio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'CodServ',
            'CodInst',
            'Descrip',
            //'Descrip2',
            //'Descrip3',
            // 'Clase',
            // 'Activo',
            // 'Unidad',
            'Precio1',
            // 'PrecioI1',
            // 'Precio2',
            // 'PrecioI2',
            // 'Precio3',
            // 'PrecioI3',
            // 'Costo',
            'EsExento',
            // 'EsReten',
            // 'EsPorCost',
            // 'UsaServ',
            // 'Comision',
            // 'EsPorComi',
            // 'FechaUV',
            // 'FechaUC',
            // 'EsImport',
            // 'EsVenta',
            // 'EsCompra',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
