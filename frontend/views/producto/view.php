<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Producto */

$this->title = $model->CodProd;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->CodProd], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Desactivar', ['delete', 'id' => $model->CodProd], [
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
            'CodProd',
            'Descrip',
            'CodInst',
            'Activo',
            'Descrip2',
            'Descrip3',
            'Refere',
            'Marca',
            'Unidad',
            'UndEmpaq',
            'CantEmpaq',
            'Precio1',
            'Precio2',
            'PrecioU2',
            'Precio3',
            'PrecioU3',
            'PrecioU',
            'CostAct',
            'CostPro',
            'CostAnt',
            'Existen',
            'ExUnidad',
            'Compro',
            'Pedido',
            'Minimo',
            'Maximo',
            'Tara',
            'DEsComp',
            'DEsComi',
            'DEsSeri',
            'EsReten',
            'DEsLote',
            'DEsVence',
            'EsImport',
            'EsExento',
            'EsEnser',
            'EsOferta',
            'EsPesa',
            'EsEmpaque',
            'ExDecimal',
            'DiasEntr',
            'FechaUV',
            'FechaUC',
            'DiasTole',
            'Peso',
            'Volumen',
            'UndVol',
        ],
    ]) ?>

</div>
