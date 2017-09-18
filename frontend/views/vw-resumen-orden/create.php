<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\VwResumenOrden */

$this->title = 'Create Vw Resumen Orden';
$this->params['breadcrumbs'][] = ['label' => 'Vw Resumen Ordens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vw-resumen-orden-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
