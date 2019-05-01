<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Racionado */

$this->title = 'Crear';
$this->params['breadcrumbs'][] = ['label' => 'Control de Entrega', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="racionado-create">

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
    ]) ?>

</div>
