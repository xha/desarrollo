<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Transaccion */

$this->title = 'Create Transaccion';
$this->params['breadcrumbs'][] = ['label' => 'Transaccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaccion-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
