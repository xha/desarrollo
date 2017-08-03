<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RolUsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rol Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rol Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
              'attribute'=>'id_usuario',
              'value'=>'idUsers.name',
            ],
            [
              'attribute'=>'id_rol',
              'value'=>'idRol.descripcion',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
