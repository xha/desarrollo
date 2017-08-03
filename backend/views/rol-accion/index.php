<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RolAccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rol Accions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-accion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rol Accion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
              'attribute'=>'id_accion',
              'value'=>'idAccion.descripcion',
            ],
            [
              'attribute'=>'id_rol',
              'value'=>'idRol.descripcion',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
