<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Modelo */

$this->title = $model->descripcion;
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<center>
<div class="modelo-view">

    

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_modelo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->id_modelo], [
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
//            'id_modelo',
            'descripcion:text:Descripción',
//            'activo',
        ],
    ]) ?>

</div<>
    </center>
