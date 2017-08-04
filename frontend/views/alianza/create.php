<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Alianza */

$this->title = 'Crear Alianza';
$this->params['breadcrumbs'][] = ['label' => 'Alianzas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alianza-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
