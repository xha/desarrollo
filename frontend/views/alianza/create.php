<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Alianza */

$this->title = 'Crear Alianza';
$this->params['breadcrumbs'][] = ['label' => 'Alianzas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alianza-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
