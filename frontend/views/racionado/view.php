<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Racionado */

$this->title = $model->CodItem;
$this->params['breadcrumbs'][] = ['label' => 'Control de Entrega', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="racionado-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->CodItem], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->CodItem], [
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
            'CodItem',
            'CodUbic',
            'dias',
            'activo',
        ],
    ]) ?>

</div>
