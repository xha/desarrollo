<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Marca */

$this->title = 'Crear Marca';
$this->params['breadcrumbs'][] = ['label' => 'Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marca-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
