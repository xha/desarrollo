<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Usuario;
use app\models\Cliente;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $model app\models\Rol */

$this->title = 'Activar usuario';
$this->params['breadcrumbs'][] = $this->title;
?>

<h3><?= $msg ?></h3>

<div class="activar-form">

	<?php $form = ActiveForm::begin(); ?>

    <label>Usuario</label><br /><br />
    <?= $form->field($model, 'usuario')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
            'clientOptions' => [
                'source' => $data,
            ],
            'class'=>'form-control',
        ]) 
    ?>

    <?= $form->field($model, 'id_rol')->dropDownList(ArrayHelper::map(Rol::find()->where(['activo' => '1'])->OrderBy('nombre')->all(), 'id_rol', 'nombre')); ?>

    <?= $form->field($model, "activado")->checkbox(); ?><br /><br />

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Actualizar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>    

    <?php ActiveForm::end(); ?>
</div>

<script type='text/javascript'>
    function carga_observacion() {
        var cliente = document.getElementById('activarform-observacion').value;
        var usuario = document.getElementById('activarform-id_usuario').value;
        
        if (usuario.value!="") {
            var parametros = "&usuario="+usuario;
            $.get('../site/observacion',parametros,function(data){
                var data = $.parseJSON(data);
                document.getElementById('activarform-observacion').value = data['observacion'];
            });
        }
    }
</script>