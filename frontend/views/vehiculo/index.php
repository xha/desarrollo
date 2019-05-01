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
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->activo == 0) return ['style' => 'background-color: #FADCAC'];
        },
        'columns' => [
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
            [
                'filter' =>[frontend\models\Racionado::ESTATUS_ACTIVE=>'SI', frontend\models\Racionado::ESTATUS_INACTIVE=>'NO'],
                'header'=>'Activo',
                'attribute'=>'activo',
                'value'=>'Activo',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
