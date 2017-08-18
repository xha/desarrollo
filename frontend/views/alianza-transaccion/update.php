<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\AlianzaTransaccion */

$this->title = 'Update Alianza Transaccion: ' . $model->id_at;
$this->params['breadcrumbs'][] = ['label' => 'Alianza Transaccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_at, 'url' => ['view', 'id' => $model->id_at]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="alianza-transaccion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
