<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Inspeccion */

$this->title = $model->id_inspeccion;
$this->params['breadcrumbs'][] = ['label' => 'Inspecciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inspeccion-view">

    

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_inspeccion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->id_inspeccion], [
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
            'id_inspeccion',
            'descripcion',
            'activo',
        ],
    ]) ?>

</div>
