<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AlianzaTransaccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alianza Transaccions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alianza-transaccion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Alianza Transaccion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_at',
            'id_alianza',
            'id_transaccion',
            'nro_factura',
            'fecha',
            // 'nro_control',
            // 'CodProv',
            // 'almacenista',
            // 'total',
            // 'activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
