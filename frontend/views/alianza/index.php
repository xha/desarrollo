<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AlianzaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alianzas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alianza-index">

    <p>
        <?= Html::a('Crear Alianza', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->activo == 0) return ['style' => 'background-color: #FADCAC'];
        },
        'columns' => [
            'id_alianza',
            'CodProv',
            'Descrip',
            'porcentaje',
            [
                'filter' =>[frontend\models\Alianza::ESTATUS_ACTIVE=>'SI', frontend\models\Alianza::ESTATUS_INACTIVE=>'NO'],
                'header'=>'Activo',
                'attribute'=>'activo',
                'value'=>'Activo',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
