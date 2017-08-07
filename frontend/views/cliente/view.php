<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cliente */

$this->title = $model->CodClie;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-view">

    

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->CodClie], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->CodClie], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirmar Desactivado',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CodClie',
            'Descrip',
            'ID3',
            'Activo',
            /*'TipoID3',
            'TipoID',
            'DescOrder',
            'Clase',
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
            'Email:email',
            'Fax',
            'FechaE',
            'CodZona',
            'CodVend',
            'CodConv',
            'CodAlte',
            'TipoCli',
            'TipoPVP',
            'Observa',
            'EsMoneda',
            'EsCredito',
            'LimiteCred',
            'DiasCred',
            'EsToleran',
            'DiasTole',
            'IntMora',
            'Descto',
            'Saldo',
            'PagosA',
            'FechaUV',
            'MontoUV',
            'NumeroUV',
            'FechaUP',
            'MontoUP',
            'NumeroUP',
            'MontoMax',
            'MtoMaxCred',
            'PromPago',
            'RetenIVA',
            'SaldoPtos',
            'DescripExt',*/
        ],
    ]) ?>

</div>
