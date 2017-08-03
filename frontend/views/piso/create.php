<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Piso */

$this->title = 'Crear Piso';
$this->params['breadcrumbs'][] = ['label' => 'Pisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="piso-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
