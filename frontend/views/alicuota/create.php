<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Alicuota */

$this->title = 'Crear Alicuota';
$this->params['breadcrumbs'][] = ['label' => 'Alicuotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alicuota-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
