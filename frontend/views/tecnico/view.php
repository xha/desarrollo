<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tecnico */

$this->title = $model->CodMeca;
$this->params['breadcrumbs'][] = ['label' => 'Tecnicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tecnico-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->CodMeca], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->CodMeca], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirmar Desactivado',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CodMeca',
            'Descrip',
            //'TipoID3',
            //'TipoID',
            'ID3',
            //'DescOrder',
            //'Clase',
            'Activo',
            'Direc1',
            'Direc2',
            'Telef',
            'Movil',
            'Email:email',
            //'DEsComi',
            //'Monto',
        ],
    ]) ?>

</div>
