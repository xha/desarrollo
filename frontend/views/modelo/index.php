<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ModeloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Modelos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modelo-index">

<p>
    <?= Html::a('Crear Modelo', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'rowOptions' => function ($model, $index, $widget, $grid){
        if($model->activo == 0) return ['style' => 'background-color: #FADCAC'];
    },
    'columns' => [
        'id_modelo',
        'descripcion',
        'activo',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
</div>
