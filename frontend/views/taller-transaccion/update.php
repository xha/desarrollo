<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TallerTransaccion */


$this->title = 'Resumen de la Atención';

$this->registerCssFile('@web/css/general.css');

$connection= \Yii::$app->db;
$command = $connection->createCommand("select * from ISAU_RESUMEN_TALLER_TRANSACCION where id_transaccion = $model->id_transaccion");
$row = $command->queryAll();
//var_dump($row); die();
?>
<fieldset>
<table class="tablas tablas1">
    <tr>
        <th>Num. de Atención</th>
        <th>Placa del Vehiculo</th>
        <th>Modelo</th>
        <th>Km</th>
        <th>Asesor</th>
        <th>Servicio</th>
        <th>Observacion</th>
    </tr>
    <tr>
        <td><?php echo $row[0]["numero_atencion"];?></td>
        <td><?php echo $row[0]["placa"];?></td>
        <td><?php echo $row[0]["modelo"];?></td>
        <td><?php echo $row[0]["km"];?></td>
        <td><?php echo $row[0]["nombre_asesor"];?></td>
        <td><?php echo $row[0]["nombre_asesor"];?></td>
        <td><?php echo $row[0]["observacion"];?></td>
    </tr>
</table>
    
    <table class="tablas tablas1">
        <tr>
            <th colspan="12" align="center">
                <b>Asignar Técnico</b>
            </th>
        </tr>
    </table>
</fieldset>
<?php
//$this->title = 'Asignar Técnico: ' . $model->id_taller;
$this->params['breadcrumbs'][] = ['label' => 'Taller', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_taller, 'url' => ['view', 'id' => $model->id_taller]];
$this->params['breadcrumbs'][] = 'Asignar Técnico';
?>
<div class="taller-transaccion-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
