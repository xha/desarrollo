<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TallerTransaccion */

$this->title = 'Create Taller Transaccion';
$this->params['breadcrumbs'][] = ['label' => 'Taller Transaccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taller-transaccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
