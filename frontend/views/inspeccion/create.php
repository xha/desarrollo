<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Inspeccion */

$this->title = 'Crear Inspección';
$this->params['breadcrumbs'][] = ['label' => 'Inspeccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inspeccion-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
