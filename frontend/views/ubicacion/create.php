<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ubicacion */

$this->title = 'Crear Ubicación';
$this->params['breadcrumbs'][] = ['label' => 'Ubicaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubicacion-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
