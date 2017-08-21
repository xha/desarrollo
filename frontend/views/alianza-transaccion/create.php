<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\AlianzaTransaccion */

$this->title = 'Crear Alianza Transaccion';
$this->params['breadcrumbs'][] = ['label' => 'Alianza Transacciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alianza-transaccion-create">

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
    ]) ?>

</div>
