<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\tabs\TabsX;
use frontend\models\Savend;
/* @var $this yii\web\View */
/* @var $model frontend\models\Transaccion */
/* @var $form yii\widgets\ActiveForm */
date_default_timezone_set("America/Caracas");
$fecha= time();
$fecha=date('d-m-Y',$fecha);
$hora="";
$minuto="";
for($i=7;$i<23;$i++) {
    if($i<10) {
        $valor = "0".$i;
    } else {
        $valor = $i;
    }
    /*if ($valor>12) {
        $hora1 = $valor - 12;
    } else {
        $hora1 = $valor;
    }*/
    $hora.= "<option value='$valor'>$valor</option>";
}

for($i=0;$i<60;$i++) {
    if($i<10) {
        $valor = "0".$i;
    } else {
        $valor = $i;
    }
    $minuto.= "<option value='$valor'>$valor</option>";
}
$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/transaccion.js');
$this->registerCssFile('@web/css/general.css');
$id_usuario = Yii::$app->user->identity->id_usuario;
$rol = Yii::$app->user->identity->id_rol;
$fecha_2=date('d-m-Y',time());

$dia28 = strtotime ('-28 day',strtotime($fecha_2)) ;
$dia28 = date ('d-m-Y',$dia28)
?>

<div class="transaccion-form">

    <div class="inicial00" align="center">
        <?= Html::submitButton("Crear Nueva Orden",array('class'=>'btn btn-success','onclick'=>'js:enviar_data();')); ?>
    </div>
    
    <?php $form = ActiveForm::begin(); ?>
    <input type="hidden" id='rol' name='rol' value="<?= $rol ?>" />
    <table class="tablas tablas1">
        <tr>
            <td>
                <b>Hora de Entrada</b><br /><br />
                <select class='texto texto-xc' id='hora_e'><?= $hora; ?></select>
                <select class='texto texto-xc' id='minuto_e'><?= $minuto; ?></select> 
            </td>
            <td>
                <b>Fecha</b><br /><br />
                <?= $form->field($model, 'fecha')->widget(DatePicker::classname(), [
                        'language' => 'es',
                        'removeButton'=>false,
                        'options' => ['class' => 'texto texto-ec', 'readonly' => true],
                        'pluginOptions' => [
                            'endDate' => date('d-m-Y'),
                            'autoclose'=>true,
                            'format' => 'dd-mm-yyyy',
                        ]
                    ])->label(false);
                ?>
            </td>
            <td>
                <?= $form->field($model, 'CodVend')->dropDownList(ArrayHelper::map(Savend::find()->where('Activo=1')->OrderBy('Descrip')->all(), 
                'CodVend', 'Descrip')); ?>
            </td>
        </tr>
    </table>
    <table class="tablas tablas1">
        <tr>
            <th colspan="5" align="center">
                <b>DATOS DEL VEHICULO</b>
            </th>
        </tr>
        <tr>
            <td align="left">
                <?= $form->field($model, 'numero_atencion')->textInput(['class'=>'texto texto-ec','onblur'=>'js: buscar_numero()']) ?>
            </td>
            <td>
                <?= $form->field($model, 'placa')->widget(\yii\jui\AutoComplete::classname(), [
                        'clientOptions' => [
                            'source' => $placas,
                        ],
                        'options' => ['class' => 'texto texto-ec','onblur'=>'js: buscar_vehiculo()', 'placeHolder' => 'Escriba Placa'],
                    ]) 
                ?>
            </td>
            <td align="left" colspan="3">
                <?= $form->field($model, 'km')->textInput(['class'=>'texto texto-ec']) ?>
            </td>
        </tr>
        <tr>
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
            <td align="left" colspan="2">
                <b>Color</b><br />
                <input class="texto texto-corto" id="v_color" readonly="true" />
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <?= $form->field($model, 'observacion')->textArea(['maxlength' => 2000]) ?>
            </td>
        </tr>
        <tr>
            <th colspan="5" align="center">
                <b>DATOS DEL CLIENTE O REPRESENTANTE</b>
            </th>
        </tr>
        <tr>
            <td colspan="5">
                <?= $form->field($model, 'representante')->widget(\yii\jui\AutoComplete::classname(), [
                        'clientOptions' => [
                            'source' => $clientes,
                        ],
                        'options' => ['class' => 'texto texto-ec','onblur'=>'js: buscar_cliente(this.id)', 'placeHolder' => 'Escriba Cliente'],
                    ]) 
                ?>
            </td>
        </tr>
        <tr>
            <td align="left" colspan="2">
                <b>Nombre</b><br />
                <input class="texto texto-largo" id="c_nombre" readonly="true" />
            </td>
            <td align="left">
                <b>Cédula - Rif</b><br />
                <input class="texto texto-corto" id="c_rif" readonly="true" />
            </td>
            <td align="left">
                <b>Teléfono</b><br />
                <input class="texto texto-corto" id="c_tlf" readonly="true" />
            </td>
            <td align="left">
                <b>Email</b><br />
                <input class="texto texto-corto" id="c_email" readonly="true" />
            </td>
        </tr>
        <tr>
            <td align="left" colspan="5">
                <b>Dirección</b><br />
                <input class="texto texto-xl" id="c_direccion" readonly="true" />
            </td>
        </tr>
        <tr>
            <th colspan="5" align="center">
                <b>DATOS DEL RESPONSABLE DEL PAGO</b>
            </th>
        </tr>
        <tr>
            <td colspan="5">
                <?= $form->field($model, 'pagador')->widget(\yii\jui\AutoComplete::classname(), [
                        'clientOptions' => [
                            'source' => $clientes,
                        ],
                        'options' => ['class' => 'texto texto-ec','onblur'=>'js: buscar_cliente(this.id)', 'placeHolder' => 'Escriba Cliente'],
                    ]) 
                ?>
            </td>
        </tr>
        <tr>
            <td align="left" colspan="2">
                <b>Nombre</b><br />
                <input class="texto texto-largo" id="p_nombre" readonly="true" />
            </td>
            <td align="left">
                <b>Cédula - Rif</b><br />
                <input class="texto texto-corto" id="p_rif" readonly="true" />
            </td>
            <td align="left">
                <b>Teléfono</b><br />
                <input class="texto texto-corto" id="p_tlf" readonly="true" />
            </td>
            <td align="left">
                <b>Email</b><br />
                <input class="texto texto-corto" id="p_email" readonly="true" />
            </td>
        </tr>
        <tr>
            <td align="left" colspan="5">
                <b>Dirección</b><br />
                <input class="texto texto-xl" id="p_direccion" readonly="true" />
            </td>
        </tr>
        <tr>
            <th colspan="5" align="center">
                <b>Inspeccion del vehiculo</b>
            </th>
        </tr>
        <tr>
            <td colspan="5">
                <div id="div_inspescciones">
                    <div id="di_izquierdo" style="width: 60%; float: left"></div>
                    <div id="di_derecho" style="width: 38%; float: right"></div>
                </div>
                <div style="width: 38%; float: right">
                    <?= $form->field($model, 'observacion3')->textArea(['maxlength' => 2000, 'rows' => 6]) ?>
                </div>
            </td>
        </tr>
    </table>
    
    <table class="tablas tablas1">
        <tr>
            <th colspan="8" align="center">
                <b>Servicio/Repuesto Solicitado</b>
            </th>
        </tr>
        <tr>
            <td>
                Fila<br />
                <input id="d_fila" maxlength="5" class="texto texto-xc" onkeypress="return entero(event);" />
                <input id="tipo_item" type="hidden" />
                <input id="i_items" name="i_items" type="hidden" />
                <input id="i_inspecciones" name="i_inspecciones" type="hidden" />
                <input id="fecha_e" value="<?= $fecha; ?>" type="hidden" />
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

    <table class="tablas tablas1">
        <tr>
            <td>
                <b>Gravable</b>
                <?= $form->field($model, 'gravable')->textInput(['value' => 0, 'readonly'=>true, 'class'=>'texto texto-ec'])->label(false) ?>
            </td>
            <td>
                <b>Exento</b>
                <?= $form->field($model, 'exento')->textInput(['value' => 0, 'readonly'=>true, 'class'=>'texto texto-ec'])->label(false) ?>
            </td>
            <td>
                <b>Impuesto</b>
                <?= $form->field($model, 'tax')->textInput(['value' => 0, 'readonly'=>true, 'class'=>'texto texto-ec'])->label(false) ?>
            </td>
            <td>
                <b>Total</b>
                <?= $form->field($model, 'total')->textInput(['value' => 0, 'readonly'=>true, 'class'=>'texto texto-ec'])->label(false) ?>
            </td>
        </tr>
    </table>

    <table id="div_estadistica" class="tablas tablas1" style="visibility: hidden; border: 1px solid green">
        <tr>
            <td>
                <h4 style="margin-left: 10px">Estadística de Despacho</h4>
                <table style="margin-left: 10px" cellpadding="2" cellspacing="2">
                    <tr>
                        <td>
                            Desde:<br />
                            <input readonly="true" class='texto texto-ec' type='text' id='fecha_desde' value='<?= $dia28 ?>' />
                        </td>
                        <td>
                            Hasta:<br />
                            <input readonly="true" class='texto texto-ec' type='text' id='fecha_hasta' value='<?= $fecha_2 ?>' />
                        </td>
                    </tr>
                </table>
                <div style='max-height: 600px; overflow-y: scroll; width: 100%' >
                    <table id='resultado_estadistica' class='tablas inicial00' style='width: 98%'></table>
                </div>
            </td>
        </tr>
    </table>
    
    <?= $form->field($model, 'asesor')->hiddenInput(['value' => $id_usuario])->label(false) ?>
    <?= $form->field($model, 'id_vehiculo')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'CodUbic')->hiddenInput(['value' => Yii::$app->user->identity->CodUbic])->label(false) ?>
    <?= $form->field($model, 'hora')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'activo')->hiddenInput(['value' => 1])->label(false); ?>
    
    <?php ActiveForm::end(); ?>

</div>
