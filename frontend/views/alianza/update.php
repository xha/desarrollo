<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Alianza */

$this->title = 'Update Alianza: ' . $model->id_alianza;
$this->params['breadcrumbs'][] = ['label' => 'Alianzas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_alianza, 'url' => ['view', 'id' => $model->id_alianza]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="alianza-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
