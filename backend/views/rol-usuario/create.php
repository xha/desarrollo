<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RolUsuario */

$this->title = 'Create Rol Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Rol Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="rol-usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pendientes' => $pendientes,
    ]) ?>

</div>
