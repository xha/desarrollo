<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TecnicoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tecnicos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tecnico-index">

    <p>
        <?= Html::a('Crear Tecnico', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'CodMeca',
            'Descrip',
            //'TipoID3',
            //'TipoID',
            'ID3',
            // 'DescOrder',
            // 'Clase',
            // 'Activo',
            'Direc1',
            // 'Direc2',
            // 'Telef',
            // 'Movil',
            // 'Email:email',
            // 'DEsComi',
            // 'Monto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
