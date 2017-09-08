<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Tecnico */

$this->title = 'Crear Tecnico';
$this->params['breadcrumbs'][] = ['label' => 'Tecnicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tecnico-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
