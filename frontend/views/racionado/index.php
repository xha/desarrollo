<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RacionadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Control de Entrega';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="racionado-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->activo == 0) return ['style' => 'background-color: #FADCAC'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CodItem',
            'CodUbic',
            'dias',
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
