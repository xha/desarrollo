<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use frontend\models\Alianza;
/* @var $this yii\web\View */
/* @var $model frontend\models\AlianzaTransaccion */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/alianza_transaccion.js');
$this->registerCssFile('@web/css/general.css');
$id_usuario = Yii::$app->user->identity->id_usuario;
?>

<div class="alianza-transaccion-form">

    <div class="inicial00" align="center">
        <?= Html::submitButton($model->isNewRecord ? 'Crear Registro' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <?php $form = ActiveForm::begin(); ?>
    
    <table class="tablas tablas1">
        <tr>
            <td>
                <b>Nro. de Orden</b>
                <?= $form->field($model, 'nro')->textInput(['class'=>'texto texto-ec'])->label(false) ?>
            </td>
            <td>
                <b>Fecha</b>
                <?= $form->field($model,'fecha_transaccion')->label(false)->
                    widget(DatePicker::className("form-control"),[
                        'dateFormat' => 'dd-MM-yyyy',
                        'clientOptions' => [
                            'changeYear' => true
                        ],
                        'options' => ['class' => 'texto texto-ec', 'readonly' => true]
                    ]) 
                ?>
            </td>
            <td>
                <b>Total</b>
                <?= $form->field($model, 'total')->textInput(['value' => 0, 'readonly'=>true, 'class'=>'texto texto-ec'])->label(false) ?>
            </td>
        </tr>
            <td colspan="3">
                <b>Alianza</b>
                <?= Html::activeDropDownList($model, 'id_alianza',ArrayHelper::map(Alianza::find()->where(['activo' => '1'])->OrderBy('CodProv')->all(), 
                    'id_alianza', 'CodProv'), ['class'=>'form-control','prompt'=>'Seleccione','onblur'=>'js: alert(this.id)']) ?>
            </td>
        </tr>
    </table>
    
    <table class="tablas tablas1">
        <tr>
            <th colspan="5" align="center">
                <b>DATOS DE LA ORDEN</b>
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
    <?= $form->field($model, 'id_alianza')->textInput() ?>

    <?= $form->field($model, 'id_transaccion')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'nro_factura')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'nro_control')->textInput() ?>

    <?= $form->field($model, 'CodProv')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'almacenista')->hiddenInput(['value' => $id_usuario])->label(false) ?>
    <?= $form->field($model, 'activo')->hiddenInput(['value' => 1])->label(false) ?>

    <?php ActiveForm::end(); ?>

</div>
