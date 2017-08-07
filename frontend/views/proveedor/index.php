<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProveedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proveedors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Proveedor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CodProv',
            'Descrip',
            'TipoPrv',
            'TipoID3',
            'TipoID',
            // 'ID3',
            // 'DescOrder',
            // 'Clase',
            // 'Activo',
            // 'Represent',
            // 'Direc1',
            // 'Direc2',
            // 'Pais',
            // 'Estado',
            // 'Ciudad',
            // 'Municipio',
            // 'ZipCode',
            // 'Telef',
            // 'Movil',
            // 'Fax',
            // 'Email:email',
            // 'FechaE',
            // 'EsReten',
            // 'RetenISLR',
            // 'DiasCred',
            // 'Observa',
            // 'EsMoneda',
            // 'Saldo',
            // 'MontoMax',
            // 'PagosA',
            // 'PromPago',
            // 'RetenIVA',
            // 'FechaUC',
            // 'MontoUC',
            // 'NumeroUC',
            // 'FechaUP',
            // 'MontoUP',
            // 'NumeroUP',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
