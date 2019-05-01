<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TecnicoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tecnicos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tecnico-index">

    <p>
        <?= Html::a('Crear Tecnico', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->Activo == 0) return ['style' => 'background-color: #FADCAC'];
        },
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'CodMeca',
            'Descrip',
            //'TipoID3',
            //'TipoID',
            'ID3',
            // 'DescOrder',
            // 'Clase',
            // 'Activo',
            'Direc1',
            [
                'filter' =>[frontend\models\Racionado::ESTATUS_ACTIVE=>'SI', frontend\models\Racionado::ESTATUS_INACTIVE=>'NO'],
                'header'=>'Activo',
                'attribute'=>'Activo',
                'value'=>'activo',
            ],
            // 'Direc2',
            // 'Telef',
            // 'Movil',
            // 'Email:email',
            // 'DEsComi',
            // 'Monto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
