<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AlianzaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alianzas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alianza-index">

    <p>
        <?= Html::a('Crear Alianza', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id_alianza',
            'CodProv',
            'Descrip',
            'porcentaje',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
