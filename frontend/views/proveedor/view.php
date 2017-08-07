<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Proveedor */

$this->title = $model->CodProv;
$this->params['breadcrumbs'][] = ['label' => 'Proveedors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->CodProv], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->CodProv], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CodProv',
            'Descrip',
            'TipoPrv',
            'TipoID3',
            'TipoID',
            'ID3',
            'DescOrder',
            'Clase',
            'Activo',
            'Represent',
            'Direc1',
            'Direc2',
            'Pais',
            'Estado',
            'Ciudad',
            'Municipio',
            'ZipCode',
            'Telef',
            'Movil',
            'Fax',
            'Email:email',
            'FechaE',
            'EsReten',
            'RetenISLR',
            'DiasCred',
            'Observa',
            'EsMoneda',
            'Saldo',
            'MontoMax',
            'PagosA',
            'PromPago',
            'RetenIVA',
            'FechaUC',
            'MontoUC',
            'NumeroUC',
            'FechaUP',
            'MontoUP',
            'NumeroUP',
        ],
    ]) ?>

</div>
