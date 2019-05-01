<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\InspeccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inspecciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inspeccion-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Inspección', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->activo == 0) return ['style' => 'background-color: #FADCAC'];
        },
        'columns' => [
            'id_inspeccion',
            'descripcion',
            [
                'filter' =>[frontend\models\Inspeccion::ESTATUS_ACTIVE=>'SI', frontend\models\Inspeccion::ESTATUS_INACTIVE=>'NO'],
                'header'=>'Activo',
                'attribute'=>'activo',
                'value'=>'Activo',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
