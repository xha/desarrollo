<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model app\models\Documento */
/* @var $form yii\widgets\ActiveForm */
//var_dump($model); die();


$this->title = 'Reporte de Ordenes';
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
 
$cant_ordenes = count($model);
$x = 0;
$conteo = 0;
$connection= \Yii::$app->db;
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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

<div class="vw-resumen-orden-index">
<div class="col-md-12">
    <table class="table table-striped">
        <thead class="thead-inverse">
            <tr>
                <th>Fecha</th>
                <th>Num. de Atención</th>
                <th>Asesor</th>
                <th>Modelo Vehiculo</th>
                <th>Placa</th>
                <th>Técnico</th>
                <th>Item</th>
                <th>Total(Factura)</th>
            </tr>
        </thead>
        <?php while($x < $cant_ordenes){?>
            <tr>
                <td><?= date('d-m-Y', strtotime($model[$x]["fecha"]));?></td>
                <td><?= $model[$x]["numero_atencion"]; ?></td>
                <td><?= $model[$x]["nombre_asesor"]; ?></td>
                <td><?= $model[$x]["modelo"]; ?></td>
                <td><?= $model[$x]["placa"]; ?></td>
                <td>
                <?php  
                //Consulta de tecnico asignado a la orden
                $command = $connection->createCommand("select * from ISAU_DetalleTransaccion where id_transaccion =". $model[$x]["id_transaccion"]);
                $row = $command->queryOne();
                $cant_servicio = count($row);             
                ?>
                </td>
                <td>
                <?php  
                //Consulta de los detalles de los suervicios o repuestos select * from ISAU_DetalleTransaccion
                $command2 = $connection->createCommand("select * from ISAU_DetalleTransaccion where id_transaccion =". $model[$x]["id_transaccion"]);
                $row2 = $command2->queryAll();
                $cant_servicio = count($row2);
                      $y=0;      
                      $servicio="";      
                    while($y < $cant_servicio){
                     $servicio.=$row2[$y]['CodItem']."-".$row2[$y]['descripcion']."<br>Cantidad: ".$row2[$y]['cantidad']."<br>";
                     $y++;
                    }
                    echo $servicio;?>
                </td>
                <td>
                <?= $model[$x]["total"];
                    $conteo=$conteo+$model[$x]["total"];
                    ?>              
                </td>
            </div>								
        <?php $x++; }?>	
    <tr>
        <th colspan="5"><center>Totales:</center></th>
        <th><?php echo "(",$x.") Ordenes";?></th>
        <th><?php echo $conteo." Bs."; ?></th>
    </tr>
</table>
</div>	
</div>













































