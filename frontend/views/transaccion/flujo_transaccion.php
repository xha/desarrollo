<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use frontend\models\Transaccion;
use kartik\money\MaskMoney;
use kartik\detail\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\tabs\TabsX;
/* @var $this yii\web\View */
/* @var $model app\models\Documento */
/* @var $form yii\widgets\ActiveForm */
//var_dump($model); die();


$this->title = 'Consultar de la orden';
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
 

$connection= \Yii::$app->db;
$command = $connection->createCommand("select * from vw_resumen_orden where id_transaccion = $model->id_transaccion");
$row = $command->queryAll();
$cant_docs = count($row);

//$model_workflow = new Workflow();
//$status = $model_workflow->getLists();
//$cant_status = count($model_workflow->getLists());

//Consulta de los detalles de los suervicios o repuestos select * from ISAU_DetalleTransaccion
$command2 = $connection->createCommand("select * from ISAU_DetalleTransaccion where id_transaccion = $model->id_transaccion");
$row2 = $command2->queryAll();
$cant_servicio = count($row2);

////Consulta de los detalles de los suervicios o repuestos select * from ISAU_DetalleTransaccion
//$mov = $movimiento->getMovs($model->id_documento);
//$cant_movimiento = count($mov);

$detalle_transaccion = new Transaccion();
$transaccion_result = $detalle_transaccion->getOrden($model->id_transaccion);
$cant_transaccion = count($transaccion_result);


$x = 0;
$y = 0;
$l=0;
$r=0;
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<br>
<br>

<style type="text/css">
.stepwizard-step p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 98%;
    height: 1px;
    background-color: #ccc;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}





.modal-lg {
    width: 100%;
    margin: 10% 20px 20px 0;
    padding: 30px;
    border-radius: 0;
}

.modal-lg .modal-content {
    border-radius: 0;
}

.modal.slide .modal-dialog {
    -webkit-transition: -webkit-transform .3s ease-out;
    -o-transition:      -o-transform .3s ease-out;
    transition:         transform .3s ease-out;
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
}

.modal.in .modal-dialog {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
}

</style>


<div class="estados-form">
	
	
<!-- 
PRUEBA DE VARIOS DOCUMENTOS
NOTA: TRASLADAR EL FORMULARIO DE ARRIBA A LOS TABS DE ABAJO PARA VER INFORMACION DETALLADA DE CADA DOCUMENTO
-->

<ul class="nav nav-tabs">
<?php while($l < $cant_transaccion){?>
    <li class="<?= ($l == 0) ? "active": "" ?>"><a data-toggle="tab" href="<?= "#menu".$l?>"><?="<b>Número de Cono:</b> (". $transaccion_result[$l]["numero_atencion"].") / <b>Fecha: </b>".date('d-m-Y', strtotime($row[$l]["fecha_transaccion"]))."<b> Placa: </b>". $row[$l]["placa"]?></a></li>
<?php $l++; } $l=0; ?>
</ul>

<br>

<div class="tab-content">

<?php while($l < $cant_transaccion){?>
    <div id="<?= "menu".$l ?>" class="<?= ($l == 0) ? "tab-pane fade in active": "tab-pane fade" ?>">
	   				
        <div class="row">
                <div class="col-lg-12" id="content-prueba">
                    <div class="panel panel-primary">
                        <div class="panel-heading"> <i class="fa fa-handshake-o "></i> Recepción del Vehiculo</div>
                        <div class="col-md-12">
                            <div class="col-md-4">
                                    <label>Fecha de la Recpción: </label>
                                    <?= date('d-m-Y', strtotime($row[$l]["fecha_transaccion"])); ?>
                            </div>								
                            <div class="col-md-4">
                                    <label>Hora de Recepción: </label>
                                    <?= date( 'h:i a', strtotime($row[$l]["fecha_transaccion"])); ?>
                            </div>								

                            <div class="col-md-4">
                                    <label>Asesor: </label>
                                    <?= $row[$l]["nombre_asesor"];?>
                            </div>								
                        </div>
                        <div class="col-md-12"><h4>Servicio/Repuesto Solicitados</h4></div>
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Codigo del Servicio</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                            <?php while($y < $cant_servicio){?>
                                <tr>
                                    <td><?= $row2[$y]["CodItem"]; ?></td>
                                    <td><?= $row2[$y]["descripcion"]; ?></td>
                                    <td><?= $row2[$y]["cantidad"]; ?></td>
                                </div>								
                            <?php $y++; }?>	
                        </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" id="content-prueba">
                    <div class="panel panel-primary">
                        <div class="panel-heading"> <i class="fa fa-car"></i> Datos del Vehiculo</div>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                    <label>Placa: </label>
                                    <?= $row[$l]["placa"]; ?>
                            </div>								
                            <div class="col-md-2">
                                    <label>Marca: </label>
                                    <?= $row[$l]["marca"]; ?>
                            </div>								

                            <div class="col-md-2">
                                    <label>Modelo: </label>
                                    <?= $row[$l]["modelo"];?>
                            </div>								
                            <div class="col-md-2">
                                    <label>Color: </label>
                                    <?= $row[$l]["color"];?>
                            </div>								
                            <div class="col-md-2">
                                    <label>Año: </label>
                                    <?= $row[$l]["anio"];?>
                            </div>								
                            <div class="col-md-2">
                                    <label>Serial del Motor: </label>
                                    <?= $row[$l]["serial_motor"];?>
                            </div>								
                        </div>
                        <div class="col-md-12">
                            <fieldset>
                                <legend>Inspección del Vehiculo</legend>
                            </fieldset>
                        </div>
                    </div>
                </div>
        </div> <!-- FIN DIV DEL ROW-->
    </div>
<?php $l++; } ?>
</div>



</div>



<script type="text/javascript">

$(function(){
    $('#modalButton').click(function(){
       $('#modal').modal('show')
                  .find('#modalContent')
                  .load($(this).attr('value'));
        //document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
    });
 
 
    $('.custom_button').click(function(){
        $('#modal').modal('show')
                   .find('#modalContent')
                   .load($(this).attr('value'));
         //dynamiclly set the header for the modal
          //document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
 
    });
 
 
});




</script>














































