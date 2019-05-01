<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/solicitud.js');
$this->registerCssFile('@web/css/general.css');
$id_usuario = Yii::$app->user->identity->id_usuario;

$this->title = 'Actualizar Solicitud';
$this->params['breadcrumbs'][] = $this->title;
$id_usuario = Yii::$app->user->identity->id_usuario;
$rol = Yii::$app->user->identity->id_rol;
?>

<div class="solicitud-form">

    <div class="inicial00" align="center">
        <?= Html::submitButton("Actualizar Solicitud de Almacen",array('class'=>'btn btn-success','onclick'=>'js:enviar_data();')); ?>
    </div>
    
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id_vehiculo')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'id_transaccion')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'pagador')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'numero_atencion')->textInput(['readonly'=>true, 'class'=>'texto texto-ec']) ?><br />
    <input type="hidden" id='rol' name='rol' value="<?= $rol ?>" />
    <table class="tablas tablas1">
        <tr>
            <th colspan="5" align="center">
                <b>DATOS DEL VEHICULO</b>
            </th>
        </tr>
        <tr>
            <td align="left">
                <b>Placa</b><br />
                <input class="texto texto-corto" id="v_placa" readonly="true" />
            </td>
            <td align="left">
                <b>Modelo</b><br />
                <input class="texto texto-corto" id="v_modelo" readonly="true" />
            </td>
            <td align="left">
                <b>Tipo</b><br />
                <input class="texto texto-corto" id="v_tipo" readonly="true" />
            </td>
            <td align="left">
                <b>Año</b><br />
                <input class="texto texto-corto" id="v_anio" readonly="true" />
            </td>
            <td align="left">
                <b>Color</b><br />
                <input class="texto texto-corto" id="v_color" readonly="true" />
            </td>
        </tr>
    </table>
    
    <table class="tablas tablas1">
        <tr>
            <th colspan="8" align="center">
                <b>Repuesto Solicitado</b>
            </th>
        </tr>
        <tr>
            <td>
                Fila<br />
                <input id="d_fila" maxlength="5" class="texto texto-xc" onkeypress="return entero(event);" />
                <input id="tipo_item" type="hidden" />
                <input id="almacenista" name="almacenista" type="hidden" value="<?= $id_usuario; ?>" />
                <input id="i_items" name="i_items" type="hidden" />
            </td>
            <td>
                Cod. de Item *<br />
                <?= $form->field($model, 'd_codigo')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
                        'clientOptions' => [
                            'source' => $items,
                        ],
                        'options' => ['class' => 'texto texto-ec izq','onblur'=>'js: carga_servicios()'],
                    ]) 
                ?>
            </td>
            <td colspan="4">
                Descripci&oacute;n *<br />
                <input id="d_nombre" maxlength="120" class="texto texto-largo" readonly />
            </td> 
            <td valign="button" rowspan="2">
                <button type="button" class="btn btn-primary" id="d_agregar" onclick="valida_detalle()">Actualizar</button>
            </td>
        </tr>
        <tr>
            <td>
                Cantidad *<br />
                <input id="d_cantidad" maxlength="10" class="texto texto-xc" 
                 onkeypress="return entero(event);" onkeyup="valida_cantidad(this.id)" onblur="calcula_subtotal()" />
            </td>
            <td>
                Precio *<br />
                <input id="d_precio" maxlength="20" class="texto texto-corto" readonly="true" />
            </td>
            <td>
                Descuento<br />
                <input id="d_descuento" maxlength="10" class="texto texto-ec" placeholder="%" 
                 onkeypress="return entero(event);" onblur="calcula_subtotal()" />
            </td>
            <td>
                IVA<br />
                <select class="texto texto-xc" id="d_iva" onchange="calcula_subtotal()"></select>
            </td>
            <td>
                Impuesto<br />
                <input id="d_impuesto" readonly maxlength="20" class="texto texto-ec" />
            </td>
            <td>
                Total Item<br />
                <input id="d_total" readonly maxlength="20" class="texto texto-ec" />
            </td>
        </tr>
    </table>
    <div class="row" align="center">
        <h3 class="text-danger" id='h_bloqueo'></h3>
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
            <th>Serv</th>
            <th>Imp</th>
            <th>Opt</th>
        </tr>
    </table>
    
    <?php ActiveForm::end(); ?>

</div>
