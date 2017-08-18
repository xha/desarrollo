<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AlianzaTransaccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alianza Transacciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alianza-transaccion-index">

    <p>
        <?= Html::a('Crear Alianza Transaccion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //'id_at',
            'id_transaccion',
            'id_alianza',
            'nro_factura',
            'fecha',
            // 'nro_control',
            // 'CodProv',
            // 'almacenista',
            // 'total',
            // 'activo',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
