<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RolAccion */

$this->title = 'Create Rol Accion';
$this->params['breadcrumbs'][] = ['label' => 'Rol Accions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-accion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
