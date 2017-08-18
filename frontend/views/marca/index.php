<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MarcaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marca-index">

    <p>
        <?= Html::a('Crear Marca', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id_marca',
            'descripcion',
            'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
