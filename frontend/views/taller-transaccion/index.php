<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TallerTransaccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Taller';
$this->params['breadcrumbs'][] = $this->title;

?>
<center><div class="taller-transaccion-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

 <?= Html::a('LIMPIAR CONSULTA', ['index'], ['class' => 'btn btn-danger']) ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id_taller',
            [
                'header'=>'Numero de Atención',
                'attribute'=>'filtro_uno',
                'value'=>'transaccion.numero_atencion',
            ], 
            [
                'header'=>'Placa',
                'attribute'=>'filtro_dos',
                'value'=>'Placa1',
            ],
//            [
//                'header'=>'Asesor',
//                'attribute'=>'filtro_tres',
//                'value'=>'Asesor',
//            ],
    [
        'header'=>'Asesor',
        'filter'=> \frontend\models\TallerTransaccion::ListaAsesor(),
        'attribute'=>'filtro_tres',
        'value'=>function($data){
            $l = frontend\models\Transaccion::find()->where(['id_transaccion' => $data->id_transaccion])->one();
            $u = frontend\models\Usuario::find()->where(['id_usuario'=>$l->asesor])->one();
            return ($u) ? $u->nombre . " " . $u->apellido : "No definido";
        },
    ],
            
                [
                'header'=>'Hora de Asignación',
                'attribute'=>'filtro_cinco',
                'value'=>'transaccion.hora',
            ], 
            [
                'header'=>'Tecnico',
                'filter'=> \frontend\models\TallerTransaccion::ListaAsesor(),
                'attribute'=>'filtro_cuatro',
                'value'=>function($data){
            $u = frontend\models\Usuario::find()->where(['id_usuario'=>$data->tecnico])->one();
            return ($u) ? $u->nombre . " " . $u->apellido : "No definido";
        },
            ],
            'observacion:text:Servicio',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}'],
        ],
    ]); ?>
</div>
</center>
