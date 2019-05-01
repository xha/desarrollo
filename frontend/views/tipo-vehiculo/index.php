<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TipoVehiculoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Vehiculos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-vehiculo-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Tipo Vehiculo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->activo == 0) return ['style' => 'background-color: #FADCAC'];
        },
        'columns' => [
            'id_tipo_vehiculo',
            'descripcion',
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
