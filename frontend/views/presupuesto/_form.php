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
$this->registerJsFile('@web/presupuesto.js');
$this->registerCssFile('@web/css/general.css');
$id_usuario = Yii::$app->user->identity->id_usuario;

    $contenido1='<table class="tablas inicial_em1">
                <tr>
                    <td>
                        Fila<br />
                        <input id="d_fila" maxlength="5" class="texto texto-xc" onkeypress="return entero(event);" />
                    </td>
                    <td>
                        Tipo de Item<br />
                        <select class="texto texto-ec" id="tipo_item">
                            <option value="0">Producto</option>
                            <option value="1">Servicio</option>
                        </select>
                    </td>
                    <td>
                        Cod. de Item *<br />
                        <input id="d_codigo" maxlength="10" class="texto texto-ec izq" onblur="carga_servicios(this.value)" />
                    </td>
                    <td colspan="3">
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
                        <input id="d_precio" maxlength="20" class="texto texto-corto" 
                         onkeypress="return entero(event);" onkeyup="valida_cantidad(this.id)" onblur="calcula_subtotal()" />
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
            </table>';

    $contenido2 = '<table class="tablas">
                <tr>
                    <td align="right">Nota 1</td>
                    <td><input id="presupuesto-notas1" name="Presupuesto[Notas1]" maxlength="60" class="texto texto-el" /></td>
                </tr> 
                <tr>
                    <td align="right">Nota 2</td>
                    <td><input id="presupuesto-notas2" name="Presupuesto[Notas2]" maxlength="60" class="texto texto-el" /></td>
                </tr> 
                <tr>
                    <td align="right">Nota 3</td>
                    <td><input id="presupuesto-notas3" name="Presupuesto[Notas3]" maxlength="60" class="texto texto-el" /></td>
                </tr> 
                <tr>
                    <td align="right">Nota 4</td>
                    <td><input id="presupuesto-notas4" name="Presupuesto[Notas4]" maxlength="60" class="texto texto-el" /></td>
                </tr> 
                <tr>
                    <td align="right">Nota 5</td>
                    <td><input id="presupuesto-notas5" name="Presupuesto[Notas5]" maxlength="60" class="texto texto-el" /></td>
                </tr> 
                <tr>
                    <td align="right">Nota 6</td>
                    <td><input id="presupuesto-notas6" name="Presupuesto[Notas6]" maxlength="60" class="texto texto-el" /></td>
                </tr> 
                <tr>
                    <td align="right">Nota 7</td>
                    <td><input id="presupuesto-notas7" name="Presupuesto[Notas7]" maxlength="60" class="texto texto-el" /></td>
                </tr> 
                <tr>
                    <td align="right">Nota 8</td>
                    <td><input id="presupuesto-notas8" name="Presupuesto[Notas8]" maxlength="60" class="texto texto-el" /></td>
                </tr> 
                <tr>
                    <td align="right">Nota 9</td>
                    <td><input id="presupuesto-notas9" name="Presupuesto[Notas9]" maxlength="60" class="texto texto-el" /></td>
                </tr> 
                <tr>
                    <td align="right">Nota 10</td>
                    <td><input id="presupuesto-notas10" name="Presupuesto[Notas10]" maxlength="100" class="texto texto-el" /></td>
                </tr> 
            </table>';
?>

<div class="presupuesto-form">

    <div class="form-group">
        <?= Html::submitButton("Actualizar Presupuesto",array('class'=>'btn btn-success','onclick'=>'js:enviar_data();')); ?>
        <?php // Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <input type="hidden" id='i_items' name='i_items' />
    <?= $form->field($model, "id_usuario")->hiddenInput(['value'=> $id_usuario])->label(false); ?>
    <div class="inicial_em1">
        <table class="tabla-decorada" height="202">
            <tr>
                <td align="right"><b>Cliente</b></td>
                <td valign="top">
                    <?= $form->field($model, 'CodClie')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
                            'clientOptions' => [
                                'source' => $data,
                            ],
                            'options' => ['class' => 'texto texto-ec','onblur'=>'js: split_clientes()'],

                        ]) 
                    ?>
                </td>
                <td>
                    <input type="text" readonly id="presupuesto-descrip" class="texto texto-largo" />
                </td>
            </tr>
            <tr>
                <td align="right"><b>Vendedor</b></td>
                <td>
                    <?= Html::activeDropDownList($model, 'CodVend',
                      ArrayHelper::map(Savend::find()->where(['activo' => '1'])->OrderBy('Descrip')->all(), 'CodVend', 'Descrip'), ['class'=>'form-control','prompt'=>'Seleccione']) ?>
                </td>
                <td align="right" rowspan="3">
                    <img src="../../../img/saint.jpg" width="167" />
                </td>
            </tr>
            <tr>
                <td align="right"><b>Ubicación</b></td>
                <td>
                    <?= Html::activeDropDownList($model, 'CodUbic',
                      ArrayHelper::map(Sadepo::find()->where(['activo' => '1'])->OrderBy('Descrip')->all(), 'CodUbic', 'Descrip'), ['class'=>'form-control','prompt'=>'Seleccione']) ?>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top"><br /><b>Fecha *</b></td>
                <td valign="top">
                    <?= $form->field($model,'FechaE')->label(false)->
                        widget(DatePicker::className("texto"),[
                            'dateFormat' => 'dd-MM-yyyy',
                            'clientOptions' => [
                                'changeYear' => true
                            ],
                            'options' => ['class' => 'texto texto-ec', 'readonly'=>true]
                        ]) 
                    ?>
                    <i class="fa fa-calendar"></i>
                </td>
            </tr>
        </table>
        <table class="tabla-decorada" style="width:25em">
            <tr>
                <td align="right"><b>Documento</b></td>
                <td><input readonly id="presupuesto-numerod" class="texto texto-corto" /></td>
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

    <table>
        <tr>
            <td>
                <?php
                    echo TabsX::widget([
                        'position' => TabsX::POS_ABOVE,
                        'align' => TabsX::ALIGN_LEFT,
                        'items' => [
                            [
                                'label' => 'Items',
                                'content' => $contenido1,
                                'active' => true
                            ],
                            [
                                'label' => 'Comentarios',
                                'content' => $contenido2,
                                'headerOptions' => ['style'=>'font-weight:bold'],
                                'options' => ['id' => 'myveryownID'],
                            ],
                        ],
                    ]);
                ?>
            </td>
        </tr>
    </table>

    <?= $form->field($model, 'TipoFac')->hiddenInput(['value'=>'F'])->label(false); ?>
    <?= $form->field($model, 'CodSucu')->hiddenInput(['value'=>'00000'])->label(false); ?>
    <?= $form->field($model, 'TotalPrd')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'TotalSrv')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'CostoPrd')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'CostoSrv')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'Monto')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'MtoTax')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'MtoTotal')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'TGravable')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'TExento')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'DesctoP')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'CodUsua')->hiddenInput(['value'=>$id_usuario])->label(false); ?>
    <?= $form->field($model, 'Signo')->hiddenInput(['value'=>'1'])->label(false); ?>
    <?= $form->field($model, 'EsExPickup')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'Factor')->hiddenInput(['value'=>'1'])->label(false); ?>
    <?= $form->field($model, 'MontoMEx')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'Fletes')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'RetenIVA')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'Credito')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'Contado')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'EsCorrel')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'Municipio')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'TipoTraE')->hiddenInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'TGravable0')->hiddenInput(['value'=>'0'])->label(false); ?>

    <?php ActiveForm::end(); ?>

</div>