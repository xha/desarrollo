<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\AlianzaTransaccion */

$this->title = 'Create Alianza Transaccion';
$this->params['breadcrumbs'][] = ['label' => 'Alianza Transaccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alianza-transaccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
