<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Usuario;

$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/taller.js');
$this->registerCssFile('@web/css/general.css');
$id_usuario = Yii::$app->user->identity->id_usuario;

$this->title = 'Actualizar Taller';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="taller-form">

    <div class="inicial00" align="center">
        <?= Html::submitButton("Actualizar Taller",array('class'=>'btn btn-success','onclick'=>'js:enviar_data();')); ?>
    </div>
    
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id_vehiculo')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'id_transaccion')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'numero_atencion')->textInput(['readonly'=>true, 'class'=>'texto texto-ec']) ?>
    <br />
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
            <th colspan="5" align="center">
                <b>SERVICIOS SOLICITADOS</b>
            </th>
        </tr>
        <tr>
            <td id="listado_detalle"></td>
        </tr>
    </table>
    
    <?= $form->field($model,'tecnico')->dropDownList(ArrayHelper::map(Usuario::find()->where(['id_rol'=>2])->OrderBy('apellido,nombre')->all(), 'id_rol', 'usuario'), 
        ['class'=>'form-control','prompt'=>'Seleccione']) ?>
    
    <?= $form->field($model, 'observacion')->TextArea(); ?>
    
    <?php ActiveForm::end(); ?>

</div>
