<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Transaccion;
use frontend\models\TransaccionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;


/**
 * TransaccionController implements the CRUD actions for Transaccion model.
 */
class TransaccionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Transaccion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransaccionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionSolicitud()
    {
        $searchModel = new TransaccionSearch();
        $dataProvider = $searchModel->searchSolicitud();
        
        return $this->render('solicitud', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionSolicitudIndex($id)
    {
        $model = $this->findModel($id);
        $connection = \Yii::$app->db;
        
        if ($model->load(Yii::$app->request->post())) {
            //print_r(Yii::$app->request->post());
            
            $query2 = "DELETE FROM ISAU_DetalleTransaccion WHERE EsServ=0 and id_transaccion=".$id;
            $connection->createCommand($query2)->query();
            
            $query2 = "DELETE FROM isau_taxtransaccion WHERE id_transaccion=".$id;
            $connection->createCommand($query2)->query();
            
            $query2 = "DELETE FROM ISAU_SolicitudTransaccion WHERE id_transaccion=".$id;
            $connection->createCommand($query2)->query();
            
            $detalle = explode("¬",$_POST['i_items']);  
            
            $total=0;
            $gravable=0;
            for ($i=0;$i < count($detalle) - 1;$i++) {
                $campos = explode("#",$detalle[$i]);
                //Nro 	Código 	Descripción 	Cantidad 	Precio 	Tax 	Descuento 	Total 	Serv 	Imp
                
                $query2 = "SET NOCOUNT ON; INSERT INTO ISAU_DetalleTransaccion(id_transaccion,EsServ,CodItem,descripcion,cantidad,costo,total) VALUES (".$model->id_transaccion.""
                        . ",'".$campos[8]."','".$campos[1]."','".$campos[2]."',".$campos[3].",".$campos[4].",".$campos[7].") SELECT Scope_Identity() as ultimo;";
                $ultimo = $connection->createCommand($query2)->queryOne();
                
                if ($campos[5]>0) {
                    $grav = round(($campos[3] * $campos[4]),2);
                    $gravable+=$grav;
                    $monto_tax = 0;
                    $query3 = "SELECT * FROM SATAXES WHERE CodTaxs='".$campos[9]."'";
                    $satax = $connection->createCommand($query3)->queryOne();
                    $monto_tax = $satax['MtoTax'];

                    $query2 = "INSERT INTO ISAU_TaxDetalleTransaccion(id_detalle_transaccion,CodItem,CodTaxs,monto,gravable,mtotax) VALUES ('".$ultimo['ultimo']."',"
                            . "'".$campos[1]."','".$campos[9]."',".$campos[5].",".$campos[7].",".$monto_tax.")";
                    $connection->createCommand($query2)->query();
                }
                /*************************************** ALMACEN ***********************************************/
                if ($campos[8]==0) {
                    $query2 = "INSERT INTO ISAU_SolicitudTransaccion(id_transaccion,CodProd,cantidad,almacenista) "
                            . " VALUES (".$model->id_transaccion.",'".$campos[1]."',".$campos[3].",".$_POST['almacenista'].")";
                    $connection->createCommand($query2)->query();
                }
            }
            /******************************************* TAX ***************************************************/
            $query3 = "SELECT d.CodTaxs,d.mtotax,sum(d.monto) as monto, sum(d.gravable) as gravable
                    FROM ISAU_TaxDetalleTransaccion d, ISAU_DetalleTransaccion dt
                    WHERE dt.id_detalle_transaccion=d.id_detalle_transaccion and dt.id_transaccion=".$model->id_transaccion."
                    GROUP BY d.CodTaxs,d.MtoTax";
            $sataxvta = $connection->createCommand($query3)->queryAll();
            
            $tax=0;
            for ($i=0;$i<count($sataxvta);$i++) {
                $query2 = "INSERT INTO isau_taxtransaccion(id_transaccion,CodTaxs,monto,gravable,mtotax) VALUES (".$id.",'".$sataxvta[$i]['CodTaxs']."',"
                        . "'".$sataxvta[$i]['monto']."',".$sataxvta[$i]['mtotax'].",".$sataxvta[$i]['gravable'].")";
                $connection->createCommand($query2)->query();
                $tax+=$sataxvta[$i]['monto'];
            }
            /****************************************************************************************************/
            $query3 = "SELECT sum(total) as total
                    FROM ISAU_DetalleTransaccion 
                    WHERE id_transaccion=".$model->id_transaccion;
            $d_total = $connection->createCommand($query3)->queryOne();
            
            $total = $d_total['total'] + $tax;
            $query = "UPDATE ISAU_Transaccion SET gravable=".$gravable.", total=".$total.", tax=".$tax." WHERE id_transaccion=".$id;
            $connection->createCommand($query)->query();
            
            $query = "UPDATE ISAU_SolicitudTransaccion set activo=0 WHERE id_transaccion=".$id;
            $connection->createCommand($query)->query();
            /****************************************************************************************************/
            $searchModel = new TransaccionSearch();
            $dataProvider = $searchModel->searchSolicitud();

            return $this->render('solicitud', [
                'dataProvider' => $dataProvider,
            ]);
        } else {
            $connection = \Yii::$app->db;
            $items = array();
            /********************** ITEMS ******************************************/
            $query = "SELECT CodProd,Descrip FROM SAPROD where Activo=1";
            $data1 = $connection->createCommand($query)->queryAll();

            for($i=0;$i<count($data1);$i++) {
                $items[]= $data1[$i]['CodProd']." - ".$data1[$i]['Descrip'];
            }

            return $this->render('solicitud-index', [
                'model' => $model,
                'items' => $items,
            ]);
        }
    }
    
    public function actionTaller()
    {
        $searchModel = new TransaccionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('taller', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionTallerIndex($id)
    {
        $model = $this->findModel($id);
        $connection = \Yii::$app->db;
        
        if ($model->load(Yii::$app->request->post())) {
            //print_r(Yii::$app->request->post());
            
            $query2 = "DELETE FROM ISAU_DetalleTransaccion WHERE EsServ=0 and id_transaccion=".$id;
            $connection->createCommand($query2)->query();
            
            $query2 = "DELETE FROM isau_taxtransaccion WHERE id_transaccion=".$id;
            $connection->createCommand($query2)->query();
            
            $query2 = "DELETE FROM ISAU_SolicitudTransaccion WHERE id_transaccion=".$id;
            $connection->createCommand($query2)->query();
            
            $detalle = explode("¬",$_POST['i_items']);  
            
            $total=0;
            $gravable=0;
            for ($i=0;$i < count($detalle) - 1;$i++) {
                $campos = explode("#",$detalle[$i]);
                //Nro 	Código 	Descripción 	Cantidad 	Precio 	Tax 	Descuento 	Total 	Serv 	Imp
                
                $query2 = "SET NOCOUNT ON; INSERT INTO ISAU_DetalleTransaccion(id_transaccion,EsServ,CodItem,descripcion,cantidad,costo,total) VALUES (".$model->id_transaccion.""
                        . ",'".$campos[8]."','".$campos[1]."','".$campos[2]."',".$campos[3].",".$campos[4].",".$campos[7].") SELECT Scope_Identity() as ultimo;";
                $ultimo = $connection->createCommand($query2)->queryOne();
                
                if ($campos[5]>0) {
                    $grav = round(($campos[3] * $campos[4]),2);
                    $gravable+=$grav;
                    $monto_tax = 0;
                    $query3 = "SELECT * FROM SATAXES WHERE CodTaxs='".$campos[9]."'";
                    $satax = $connection->createCommand($query3)->queryOne();
                    $monto_tax = $satax['MtoTax'];

                    $query2 = "INSERT INTO ISAU_TaxDetalleTransaccion(id_detalle_transaccion,CodItem,CodTaxs,monto,gravable,mtotax) VALUES ('".$ultimo['ultimo']."',"
                            . "'".$campos[1]."','".$campos[9]."',".$campos[5].",".$campos[7].",".$monto_tax.")";
                    $connection->createCommand($query2)->query();
                }
                /*************************************** ALMACEN ***********************************************/
                if ($campos[8]==0) {
                    $query2 = "INSERT INTO ISAU_SolicitudTransaccion(id_transaccion,CodProd,cantidad,almacenista) "
                            . " VALUES (".$model->id_transaccion.",'".$campos[1]."',".$campos[3].",".$_POST['almacenista'].")";
                    $connection->createCommand($query2)->query();
                }
            }
            /******************************************* TAX ***************************************************/
            $query3 = "SELECT d.CodTaxs,d.mtotax,sum(d.monto) as monto, sum(d.gravable) as gravable
                    FROM ISAU_TaxDetalleTransaccion d, ISAU_DetalleTransaccion dt
                    WHERE dt.id_detalle_transaccion=d.id_detalle_transaccion and dt.id_transaccion=".$model->id_transaccion."
                    GROUP BY d.CodTaxs,d.MtoTax";
            $sataxvta = $connection->createCommand($query3)->queryAll();
            
            $tax=0;
            for ($i=0;$i<count($sataxvta);$i++) {
                $query2 = "INSERT INTO isau_taxtransaccion(id_transaccion,CodTaxs,monto,gravable,mtotax) VALUES (".$id.",'".$sataxvta[$i]['CodTaxs']."',"
                        . "'".$sataxvta[$i]['monto']."',".$sataxvta[$i]['mtotax'].",".$sataxvta[$i]['gravable'].")";
                $connection->createCommand($query2)->query();
                $tax+=$sataxvta[$i]['monto'];
            }
            /****************************************************************************************************/
            $query3 = "SELECT sum(total) as total
                    FROM ISAU_DetalleTransaccion 
                    WHERE id_transaccion=".$model->id_transaccion;
            $d_total = $connection->createCommand($query3)->queryOne();
            
            $total = $d_total['total'] + $tax;
            $query = "UPDATE ISAU_Transaccion SET gravable=".$gravable.", total=".$total.", tax=".$tax." WHERE id_transaccion=".$id;
            $connection->createCommand($query)->query();
            
            $query = "UPDATE ISAU_SolicitudTransaccion set activo=0 WHERE id_transaccion=".$id;
            $connection->createCommand($query)->query();
            /****************************************************************************************************/
            $searchModel = new TransaccionSearch();
            $dataProvider = $searchModel->searchSolicitud();

            return $this->render('taller', [
                'dataProvider' => $dataProvider,
            ]);
        } else {
            $connection = \Yii::$app->db;
            $items = array();
            /********************** ITEMS ******************************************/
            $query = "SELECT CodProd,Descrip FROM SAPROD where Activo=1";
            $data1 = $connection->createCommand($query)->queryAll();

            for($i=0;$i<count($data1);$i++) {
                $items[]= $data1[$i]['CodProd']." - ".$data1[$i]['Descrip'];
            }

            return $this->render('taller-index', [
                'model' => $model,
                'items' => $items,
            ]);
        }
    }

    /**
     * Displays a single Transaccion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transaccion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transaccion();
        $connection = \Yii::$app->db;
        $clientes = array();
        $placas = array();
        $items = array();
        /********************** CLIENTES ***************************************/
        $query = "SELECT CodClie,Descrip FROM SACLIE where Activo=1";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $clientes[]= $data1[$i]['CodClie']." - ".$data1[$i]['Descrip'];
        }
        /********************** PLACAS *****************************************/
        $query = "SELECT placa FROM ISAU_Vehiculo where Activo=1";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $placas[]= $data1[$i]['placa'];
        }
        /********************** ITEMS ******************************************/
        $query = "SELECT CodProd,Descrip FROM SAPROD where Activo=1";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $items[]= $data1[$i]['CodProd']." - ".$data1[$i]['Descrip'];
        }
        
        $query = "SELECT CodServ,Descrip FROM SASERV where Activo=1";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $items[]= $data1[$i]['CodServ']." - ".$data1[$i]['Descrip'];
        }
                
        if ($model->load(Yii::$app->request->post())) {
            //print_r(Yii::$app->request->post());die;
            date_default_timezone_set("America/Caracas");
            $fecha_transaccion = time();
            $hora = date('H:i:s',$fecha_transaccion);
            $hora2 = date('Hi',$fecha_transaccion);
            $fecha_transaccion = date('Ymd',$fecha_transaccion);
            
            $query = "SELECT count(*)+1 as numero_atencion FROM ISAU_Transaccion where fecha_transaccion "
                    . "between '$fecha_transaccion 00:00:00' and '$fecha_transaccion 23:59:59'";
            $data1 = $connection->createCommand($query)->queryOne();
            $model->numero_atencion = $data1['numero_atencion'];
            $model->CodSucu = '0000';
            $model->fecha_transaccion = $fecha_transaccion." ".$hora;
            $arr_fecha_compra=explode("-",$model->fecha);
            $model->fecha = $arr_fecha_compra[2].$arr_fecha_compra[1].$arr_fecha_compra[0];
            /******************************************* GUARDO ************************************************/
            $model->save();
            /********************* ESTA VAINA TIENE QUE SE UN SP ***********************************************/
            /******************************************* DETALLE ***********************************************/
            $detalle = explode("¬",$_POST['i_items']);  
            
            for ($i=0;$i < count($detalle) - 1;$i++) {
                $campos = explode("#",$detalle[$i]);
                //Nro 	Código 	Descripción 	Cantidad 	Precio 	Tax 	Descuento 	Total 	Serv 	Imp
                $total = ($campos[3]*$campos[4]);
                $query2 = "SET NOCOUNT ON; INSERT INTO ISAU_DetalleTransaccion(id_transaccion,EsServ,CodItem,descripcion,cantidad,costo,total) VALUES (".$model->id_transaccion.""
                        . ",'".$campos[8]."','".$campos[1]."','".$campos[2]."',".$campos[3].",".$campos[4].",".$total.") SELECT Scope_Identity() as ultimo;";
                $ultimo = $connection->createCommand($query2)->queryOne();
                
                if ($campos[5]>0) {
                    $grav = round(($campos[3] * $campos[4]),2);
                    
                    $monto_tax = 0;
                    $query3 = "SELECT * FROM SATAXES WHERE CodTaxs='".$campos[9]."'";
                    $satax = $connection->createCommand($query3)->queryOne();
                    $monto_tax = $satax['MtoTax'];

                    $query2 = "INSERT INTO ISAU_TaxDetalleTransaccion(id_detalle_transaccion,CodItem,CodTaxs,monto,gravable,mtotax) VALUES ('".$ultimo['ultimo']."',"
                            . "'".$campos[1]."','".$campos[9]."',".$campos[5].",".$campos[7].",".$monto_tax.")";
                    $connection->createCommand($query2)->query();
                }
                /*************************************** ALMACEN ***********************************************/
                if ($campos[8]==0) {
                    $query2 = "INSERT INTO ISAU_SolicitudTransaccion(id_transaccion,CodProd,cantidad,almacenista) "
                            . " VALUES (".$model->id_transaccion.",'".$campos[1]."',".$campos[3].",".$model->asesor.")";
                    $connection->createCommand($query2)->query();
                }
            }
            /******************************************* TAX ***************************************************/
            $query3 = "SELECT d.CodTaxs,d.mtotax,sum(d.monto) as monto, sum(d.gravable) as gravable
                    FROM ISAU_TaxDetalleTransaccion d, ISAU_DetalleTransaccion dt
                    WHERE dt.id_detalle_transaccion=d.id_detalle_transaccion and dt.id_transaccion=".$model->id_transaccion."
                    GROUP BY d.CodTaxs,d.MtoTax";
            $sataxvta = $connection->createCommand($query3)->queryAll();
            
            for ($i=0;$i<count($sataxvta);$i++) {
                $query2 = "INSERT INTO isau_taxtransaccion(id_transaccion,CodTaxs,monto,gravable,mtotax) VALUES (".$model->id_transaccion.",'".$sataxvta[$i]['CodTaxs']."',"
                        . "'".$sataxvta[$i]['monto']."',".$sataxvta[$i]['mtotax'].",".$sataxvta[$i]['gravable'].")";
                $connection->createCommand($query2)->query();
            }
            /******************************************* INSPECCION ***********************************************/
            $inspecciones = explode("¬",$_POST['i_inspecciones']);  
            
            for ($i=0;$i < count($inspecciones) - 1;$i++) {
                $campos = explode("#",$inspecciones[$i]);

                $query2 = "INSERT INTO ISAU_TransaccionInspeccion(id_transaccion,id_inspeccion,observacion) "
                        . "VALUES (".$model->id_transaccion.",".$campos[0].",'".$campos[1]."')";
                $connection->createCommand($query2)->query();
            }
            /******************************************************************************************************/
            return $this->redirect(['view', 'id' => $model->id_transaccion]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'clientes' => $clientes,
                'placas' => $placas,
                'items' => $items,
            ]);
        }
    }

    /**
     * Updates an existing Transaccion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_transaccion]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Transaccion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transaccion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaccion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaccion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /************************************************* AGREGADOS *******************************************/
    public function actionBuscarInspeccion() {
        $connection = \Yii::$app->db;

        $query = "SELECT * from ISAU_Inspeccion where activo=1";

        $pendientes = $connection->createCommand($query)->queryAll();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }    
    
    public function actionBuscarCliente($cliente) {
        $connection = \Yii::$app->db;

        $query = "SELECT * from SACLIE where Activo=1 and CodClie='".$cliente."'";

        $pendientes = $connection->createCommand($query)->queryOne();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }    
    
    public function actionBuscarVehiculo($placa = null,$id_vehiculo = null) {
        $connection = \Yii::$app->db;
        
        if ($id_vehiculo!="") {
            $extra = "and v.id_vehiculo='".$id_vehiculo."'";
        } else {
            $extra = "and v.placa='".$placa."'";
        }
        
        $query = "SELECT v.id_vehiculo,v.placa,m.descripcion as modelo, t.descripcion as tipo,v.color,v.propietario,v.anio
                FROM isau_vehiculo v, isau_modelo m, ISAU_TipoVehiculo t
                WHERE v.activo=1 ".$extra;
        $pendientes = $connection->createCommand($query)->queryOne();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }    
    
    public function actionBuscarItems($codigo) {
        $connection = \Yii::$app->db;

        $query = "SELECT CodServ,Descrip,Precio1,1 as EsServ
                from SASERV
                where activo=1 and CodServ='".$codigo."'";
        $pendientes = $connection->createCommand($query)->queryOne();
        
        if (count($pendientes)<3) {
            $query = "SELECT CodProd,Descrip,Precio1,0 as EsServ
                from SAPROD
                where activo=1 and CodProd='".$codigo."'";
            $pendientes = $connection->createCommand($query)->queryOne();
        }
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }    

    public function actionBuscarImpuestos($codigo,$tipo) {
        $connection = \Yii::$app->db;

        if ($tipo==1) {
            $query = "SELECT CodTaxs,Monto
                    from SATAXSRV
                    where CodServ='".$codigo."'";
        } else {
            $query = "SELECT CodTaxs,Monto
                    from SATAXPRD
                    where CodProd='".$codigo."'";
        }

        $pendientes = $connection->createCommand($query)->queryAll();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }  
    
    public function actionBuscarDetalleSolicitud($id_transaccion,$serv = null) {
        $connection = \Yii::$app->db;
        
        if ($serv=="") $serv=0;
        $query = "select d.CodItem,d.descripcion,d.cantidad,d.costo,d.total,td.CodTaxs,td.monto
                from ISAU_DetalleTransaccion d
                left join ISAU_TaxDetalleTransaccion td on d.id_detalle_transaccion=td.id_detalle_transaccion 
                where d.EsServ=$serv and d.id_transaccion='".$id_transaccion."'";

        $pendientes = $connection->createCommand($query)->queryAll();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }
    
    public function actionBuscarOrden($id_transaccion = null, $nro = null, $fecha_transaccion = null) {
        $connection = \Yii::$app->db;
        $extra = "";
        if ($id_transaccion!="") $extra.= " and id_transaccion=".$id_transaccion;
        if ($nro!="") $extra.= " and numero_atencion=".$nro;
        if ($fecha_transaccion!="") $extra.= " and fecha='".$fecha_transaccion."'";
        
        $query = "SELECT * from vw_resumen_transaccion WHERE 1=1 ".$extra;

        $pendientes = $connection->createCommand($query)->queryOne();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    } 
}
