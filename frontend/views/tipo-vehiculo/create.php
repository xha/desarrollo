<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TipoVehiculo */

$this->title = 'Create Tipo Vehiculo';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Vehiculos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-vehiculo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
