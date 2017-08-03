<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Presupuesto */

$this->title = 'Crear Presupuesto';
$this->params['breadcrumbs'][] = ['label' => 'Presupuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presupuesto-create">

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
