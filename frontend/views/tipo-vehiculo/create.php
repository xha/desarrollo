<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TipoVehiculo */

$this->title = 'Crear Tipo Vehiculo';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Vehiculos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-vehiculo-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
