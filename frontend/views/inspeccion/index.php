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
        'columns' => [
            'id_inspeccion',
            'descripcion',
            'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
