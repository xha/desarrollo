<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AlicuotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alicuotas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alicuota-index">

    <p>
        <?= Html::a('Crear Alicuota', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_alicuota',
            [
              'attribute'=>'CodClie',
              'value'=>'codClies.Descrip',
            ],
            [
              'attribute'=>'id_ubicacion',
              'value'=>'idUbicacion.nombre',
            ],
            [
              'attribute'=>'id_piso',
              'value'=>'idPiso.nombre',
            ],
            //'descripcion',
             'porcentaje',
            // 'alquiler',
            // 'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
