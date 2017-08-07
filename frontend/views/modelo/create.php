<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Modelo */

$this->title = 'Crear Modelo';
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modelo-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
