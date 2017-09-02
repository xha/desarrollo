<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TransaccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reabrir Orden';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="transaccion-index">

    <h3><?= $mensaje ?></h3>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
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
            //'hora',
            // 'CodSucu',
            // 'asesor',
            // 'km',
            //'representante',
            //'gravable',
            //'exento',
            //'tax',
            //'total',
            //'ISAU_SolicitudTransaccion.activo',
            'observacion',
            // 'activo',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                /*'buttons' => [
                    'info' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', $url, [
                                    'title' => Yii::t('app', 'Info'),
                        ]);
                    }
                ],*/
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = Yii::$app->urlManager->createUrl(['transaccion/abrir-orden?id='.$model->id_transaccion.'&num='.$model->numero_atencion]); // your own url generation logic
                        return $url;
                    }
                }
                          
            ],
        ],
    ]); ?>
</div>
