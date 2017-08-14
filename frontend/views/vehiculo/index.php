<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VehiculoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vehiculos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehiculo-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Vehiculo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_vehiculo',
            [
              'attribute'=>'id_modelo',
              'value'=>'idModelo.descripcion',
            ],
            [
              'attribute'=>'id_tipo_vehiculo',
              'value'=>'idTipoVehiculo.descripcion',
            ],
            [
              'attribute'=>'id_marca',
              'value'=>'idMarca.descripcion',
            ],
            'placa',
            //'anio',
            // 'color',
            'propietario',
            // 'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
