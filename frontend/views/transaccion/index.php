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
            [
              'attribute'=>'id_vehiculo',
              'value'=>'idVehiculo.placa',
            ],
            //'fecha_transaccion',
            [
               'attribute' => 'fecha',
                'format' =>  ['date', 'php:d-m-Y'],
            ],
            'hora',
            // 'asesor',
            // 'km',
            'representante',
            // 'gravable',
            // 'exento',
            // 'tax',
            // 'total',
            // 'observacion',
            // 'activo',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{print}',
                'buttons' => [
                    'print' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, [
                                    'title' => Yii::t('app', 'Orden '.$model->numero_atencion),
                                    'target' => '_blank',
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'print') {
                        $url = Yii::$app->urlManager->createUrl(['transaccion/imprime-orden?id='.$model->id_transaccion]); // your own url generation logic
                        return $url;
                    }
                }
                          
            ],
        ],
    ]); ?>
</div>
