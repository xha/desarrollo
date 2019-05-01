<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">

    <p>
        <?= Html::a('Crear Cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->Activo == 0) return ['style' => 'background-color: #FADCAC'];
        },
        'columns' => [
            'CodClie',
            'Descrip',
            'ID3',
            //'TipoID3',
            //'TipoID',
            // 'Activo',
            // 'DescOrder',
            // 'Clase',
            // 'Represent',
            'Direc1',
            // 'Direc2',
            // 'Pais',
            // 'Estado',
            // 'Ciudad',
            // 'Municipio',
            // 'ZipCode',
            'Telef',
            [
                'filter' =>[frontend\models\Cliente::ESTATUS_ACTIVE=>'SI', frontend\models\Cliente::ESTATUS_INACTIVE=>'NO'],
                'header'=>'Activo',
                'attribute'=>'Activo',
                'value'=>'activo',
            ],
            // 'Movil',
            // 'Email:email',
            // 'Fax',
            // 'FechaE',
            // 'CodZona',
            // 'CodVend',
            // 'CodConv',
            // 'CodAlte',
            // 'TipoCli',
            // 'TipoPVP',
            // 'Observa',
            // 'EsMoneda',
            // 'EsCredito',
            // 'LimiteCred',
            // 'DiasCred',
            // 'EsToleran',
            // 'DiasTole',
            // 'IntMora',
            // 'Descto',
            // 'Saldo',
            // 'PagosA',
            // 'FechaUV',
            // 'MontoUV',
            // 'NumeroUV',
            // 'FechaUP',
            // 'MontoUP',
            // 'NumeroUP',
            // 'MontoMax',
            // 'MtoMaxCred',
            // 'PromPago',
            // 'RetenIVA',
            // 'SaldoPtos',
            // 'DescripExt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
