<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TransaccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Generar Ordenes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaccion-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nueva Orden', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //'id_transaccion',
            'numero_atencion',
            'id_vehiculo',
            //'fecha_transaccion',
            'fecha',
            'hora',
            // 'CodSucu',
            // 'asesor',
            // 'km',
            'representante',
            // 'gravable',
            // 'exento',
            // 'tax',
            // 'total',
            // 'observacion',
            // 'activo',
        ],
    ]); ?>
</div>
