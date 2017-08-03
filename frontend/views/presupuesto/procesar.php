<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\jui\Tabs;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\tabs\TabsX;
use frontend\models\Savend;
use frontend\models\Sadepo;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presupuesto */
/* @var $form yii\widgets\ActiveForm */
    $this->registerJsFile('@web/general.js');
    $this->registerJsFile('@web/procesar.js');
    $this->registerCssFile('@web/css/general.css');
    $id_usuario = Yii::$app->user->identity->id_usuario;
    $this->title = 'Procesar Condominios';
    $this->params['breadcrumbs'][] = ['label' => 'Presupuestos', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="procesar-form">

    <div class="form-group">
        <input type="hidden" id='id_usuario' value="<?php echo $id_usuario; ?>" />
        <button id='btn_enviar' class='btn btn-success' onclick="procesar_condominio();">Generar Proceso de Condominio</button>
        <img id="imag" src="../../../img/preloader.gif" />
    </div>

    <div class="inicial_em1">
        <table class="tabla-decorada" height="202">
            <tr>
                <td align="right"><b>No.</b></td>
                <td><input id="numerod" placeholder="Presupuesto a Buscar" class="texto texto-corto" /></td>
                <td><button onclick="buscar_presupuesto();" class="btn btn-default">Buscar</button></td>
            </tr>
            <tr>
                <td align="right"><b>Cliente</b></td>
                <td><input readonly id="cliente" class="texto texto-corto" /></td>
                <td><input readonly id="descripcion" class="texto texto-largo" /></td>
            </tr>
            <tr>
                <td align="right"><b>Vendedor</b></td>
                <td><input readonly id="vendedor" class="texto texto-corto" /></td>
                <td align="right" rowspan="2">
                    <img src="../../../img/saint.jpg" width="167" />
                </td>
            </tr>
            <tr>
                <td align="right"><b>Ubicación</b></td>
                <td><input readonly id="ubicacion" class="texto texto-corto" /></td>
            </tr>
            
        </table>

        <table class="tabla-decorada" style="width:25em">
            <tr>
                <td align="right"><b>Fecha</b></td>
                <td><input id='fecha' class="texto texto-corto" readonly="" /></td>
            </tr>
            <tr>
                <td align="right"><b>Descuento</b></td>
                <td><input id="descuento" readonly class="texto texto-corto" /></td>
            </tr>
            <tr>
                <td align="right"><b>Sub Total</b></td>
                <td><input readonly id="sub_total" class="texto texto-corto" /></td>
            </tr>
            <tr>
                <td align="right"><b>Impuestos</b></td>
                <td><input readonly id="impuesto" class="texto texto-corto" /></td>
            </tr>
            <tr>
                <td align="right"><b>Total</b></td>
                <td><input readonly id="total" class="texto texto-corto" /></td>
            </tr>
        </table>
    </div>

    <table class="tablas inicial00" id="listado_detalle">
        <tr>
            <th>Nro</th>
            <th>Código</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Tax</th>
            <th>Descuento</th>
            <th>Total</th>
        </tr>
    </table>

</div>
<style>
    #imag {
        float: left;
        visibility: hidden;
    }
</style>