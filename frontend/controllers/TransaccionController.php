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
use common\models\AccessHelpers;

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

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        return AccessHelpers::chequeo();
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
    
    public function actionCerrar()
    {
        $searchModel = new TransaccionSearch();
        $dataProvider = $searchModel->searchAbrir(0,1);

        return $this->render('cerrar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mensaje' => '',
        ]);
    }
    
    public function actionCerrarOrden($id,$num) {
        $codubic = Yii::$app->user->identity->CodUbic;
        $connection = \Yii::$app->db;
        
        $query = "SET NOCOUNT ON; EXEC SP_ISAU_CERRAR_ORDEN $id, '".$codubic."'";
        $salida = $connection->createCommand($query)->queryOne();
        
        if ($salida['salida']==0) {
            $msg = "Orden $num Cerrada con éxito ";
        } else {
            $msg = "Error al Cerrar la Orden $num";
        }
        
        $searchModel = new TransaccionSearch();
        $dataProvider = $searchModel->searchAbrir(0,1);

        return $this->render('cerrar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mensaje' => $msg,
        ]);
    }
    
    public function actionAbrir()
    {
        $searchModel = new TransaccionSearch();
        $dataProvider = $searchModel->searchAbrir(0,0);

        return $this->render('abrir', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mensaje' => '',
        ]);
    }
    
    public function actionAbrirOrden($id, $num) {
        $connection = \Yii::$app->db;
        
        $query = "SET NOCOUNT ON; EXEC SP_ISAU_REABRIR_ORDEN $id, ".$num;
        $salida = $connection->createCommand($query)->queryOne();
        
        if ($salida['salida']==0) {
            $msg = "Orden $num Abierta con éxito ";
        } else {
            $msg = "Error al Abrir la Orden $num";
        }
        
        $searchModel = new TransaccionSearch();
        $dataProvider = $searchModel->searchAbrir(0,0);

        return $this->render('abrir', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mensaje' => $msg,
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
                
                $total = $campos[3] * $campos[4];
                $query2 = "SET NOCOUNT ON; INSERT INTO ISAU_DetalleTransaccion(id_transaccion,EsServ,CodItem,descripcion,cantidad,costo,total) VALUES (".$model->id_transaccion.""
                        . ",'".$campos[8]."','".$campos[1]."','".$campos[2]."',".$campos[3].",".$campos[4].",".$total.") SELECT Scope_Identity() as ultimo;";
                $ultimo = $connection->createCommand($query2)->queryOne();
                
                if ($campos[5]>0) {
                    $monto_tax = 0;
                    $query3 = "SELECT * FROM SATAXES WHERE CodTaxs='".$campos[9]."'";
                    $satax = $connection->createCommand($query3)->queryOne();
                    $monto_tax = $satax['MtoTax'];

                    $query2 = "INSERT INTO ISAU_TaxDetalleTransaccion(id_detalle_transaccion,CodItem,CodTaxs,monto,gravable,mtotax) VALUES ('".$ultimo['ultimo']."',"
                            . "'".$campos[1]."','".$campos[9]."',".$campos[5].",".$total.",".$monto_tax.")";
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
                $query2 = "INSERT INTO isau_taxtransaccion(id_transaccion,CodTaxs,monto,mtotax,gravable) VALUES (".$id.",'".$sataxvta[$i]['CodTaxs']."',"
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
            $query = "UPDATE ISAU_Transaccion SET gravable=".$d_total['total'].", total=".$total.", tax=".$tax." WHERE id_transaccion=".$id;
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
        $dataProvider = $searchModel->searchSolicitud();
        
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
            
            $query2 = "DELETE FROM ISAU_DetalleTransaccion WHERE EsServ=1 and id_transaccion=".$id;
            $connection->createCommand($query2)->query();
            
            $query2 = "DELETE FROM isau_TaxTransaccion WHERE id_transaccion=".$id;
            $connection->createCommand($query2)->query();
            
            $query2 = "DELETE FROM ISAU_TallerTransaccion WHERE id_transaccion=".$id;
            $connection->createCommand($query2)->query();
            
            $detalle = explode("¬",$_POST['i_items']);  
            
            $total=0;
            for ($i=0;$i < count($detalle) - 1;$i++) {
                $campos = explode("#",$detalle[$i]);
                //Nro Código Descripción Cantidad Precio Tax Total Serv Imp Mecanico Observacion
                $total = $campos[3] * $campos[4];
                $query2 = "SET NOCOUNT ON; INSERT INTO ISAU_DetalleTransaccion(id_transaccion,EsServ,CodItem,descripcion,cantidad,costo,total) VALUES (".$model->id_transaccion.""
                        . ",'".$campos[7]."','".$campos[1]."','".$campos[2]."',".$campos[3].",".$campos[4].",".$total.") SELECT Scope_Identity() as ultimo;";
                $ultimo = $connection->createCommand($query2)->queryOne();
                
                if ($campos[5]>0) {
                    //$grav = round(($campos[3] * $campos[4]),2);
                    $monto_tax = 0;
                    $query3 = "SELECT * FROM SATAXES WHERE CodTaxs='".$campos[8]."'";
                    $satax = $connection->createCommand($query3)->queryOne();
                    $monto_tax = $satax['MtoTax'];

                    $query2 = "INSERT INTO ISAU_TaxDetalleTransaccion(id_detalle_transaccion,CodItem,CodTaxs,monto,gravable,mtotax) VALUES ('".$ultimo['ultimo']."',"
                            . "'".$campos[1]."','".$campos[8]."',".$campos[5].",".$total.",".$monto_tax.")";
                    $connection->createCommand($query2)->query();
                }
                /*************************************** TALLER ***********************************************/
                if ($campos[9]!="") {
                    $query2 = "INSERT INTO ISAU_TallerTransaccion(id_transaccion,CodMeca,observacion,asignador) "
                            . " VALUES (".$model->id_transaccion.",'".$campos[9]."','".$campos[10]."',".$_POST['asignador'].")";
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
                $query2 = "INSERT INTO isau_TaxTransaccion(id_transaccion,CodTaxs,monto,mtotax,gravable) VALUES (".$id.",'".$sataxvta[$i]['CodTaxs']."',"
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
            $query = "UPDATE ISAU_Transaccion SET gravable=".$d_total['total'].", total=".$total.", tax=".$tax." WHERE id_transaccion=".$id;
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
            $query = "SELECT CodServ,Descrip FROM SASERV where Activo=1";
            $data1 = $connection->createCommand($query)->queryAll();

            for($i=0;$i<count($data1);$i++) {
                $items[]= $data1[$i]['CodServ']." - ".$data1[$i]['Descrip'];
            }
            /********************** MECANICOS ******************************************/
            $query = "SELECT CodMeca, Descrip "
                    . "FROM SAMECA "
                    . "WHERE Activo=1";
            $data1 = $connection->createCommand($query)->queryAll();

            $mecanico="";
            for($i=0;$i<count($data1);$i++) {
                $mecanico.= "<option value='".$data1[$i]['CodMeca']."'>".$data1[$i]['Descrip']."</option>";
            }
            
            return $this->render('taller-index', [
                'model' => $model,
                'items' => $items,
                'mecanico' => $mecanico,
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
            
            /*$query = "SELECT count(*)+1 as numero_atencion FROM ISAU_Transaccion where fecha_transaccion "
                    . "between '$fecha_transaccion 00:00:00' and '$fecha_transaccion 23:59:59'";
            $data1 = $connection->createCommand($query)->queryOne();
            $model->numero_atencion = $data1['numero_atencion'];*/
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
                    $monto_tax = 0;
                    $query3 = "SELECT * FROM SATAXES WHERE CodTaxs='".$campos[9]."'";
                    $satax = $connection->createCommand($query3)->queryOne();
                    $monto_tax = $satax['MtoTax'];

                    $query2 = "INSERT INTO ISAU_TaxDetalleTransaccion(id_detalle_transaccion,CodItem,CodTaxs,monto,gravable,mtotax) VALUES ('".$ultimo['ultimo']."',"
                            . "'".$campos[1]."','".$campos[9]."',".$campos[5].",".$total.",".$monto_tax.")";
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
                $query2 = "INSERT INTO isau_taxtransaccion(id_transaccion,CodTaxs,monto,mtotax,gravable) VALUES (".$model->id_transaccion.",'".$sataxvta[$i]['CodTaxs']."',"
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
            return $this->redirect(['index', 'id' => $model->id_transaccion]);
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
                WHERE v.activo=1 and v.id_modelo=m.id_modelo and v.id_tipo_vehiculo=t.id_tipo_vehiculo ".$extra;
        $pendientes = $connection->createCommand($query)->queryOne();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }    
    
    public function actionBuscarVehiculoActivo($placa) {
        $connection = \Yii::$app->db;
        date_default_timezone_set("America/Caracas");
        $fecha = time();
        $fecha = date('Ymd',$fecha);
        
        $query = "SELECT count(t.id_transaccion) as conteo 
                  FROM ISAU_Transaccion t, ISAU_Vehiculo v 
                  WHERE t.activo=1 and t.fecha='$fecha' and v.placa='".$placa."'";
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
                where d.EsServ=$serv and d.id_transaccion=".$id_transaccion;

        $pendientes = $connection->createCommand($query)->queryAll();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }
    
    public function actionBuscarDetalleTaller($id_transaccion) {
        $connection = \Yii::$app->db;
        
        $query = "select dt.id_detalle_transaccion, dt.CodItem, dt.descripcion, dt.cantidad, dt.costo, dt.total, 
                    tdt.CodTaxs, tdt.monto, tdt.mtotax,t.CodMeca,t.observacion, sa.Descrip
                    from ISAU_DetalleTransaccion dt
                    left join ISAU_TaxDetalleTransaccion tdt on tdt.id_detalle_transaccion=dt.id_detalle_transaccion
                    left join ISAU_TallerTransaccion t on dt.id_transaccion=t.id_transaccion
                    left join SAMECA sa on t.CodMeca=sa.CodMeca
                    where dt.id_transaccion=$id_transaccion and dt.EsServ=1";

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
    
    public function actionBuscarNumero($numero_atencion) {
        $connection = \Yii::$app->db;
        date_default_timezone_set("America/Caracas");
        $fecha = time();
        $fecha = date('Ymd',$fecha);
        
        $query = "SELECT count(numero_atencion) as conteo from ISAU_Transaccion WHERE numero_atencion=$numero_atencion "
                . " and CONVERT(varchar(10), fecha, 112)='$fecha'";

        $pendientes = $connection->createCommand($query)->queryOne();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    } 
    
    /**************************************** IMPRIMIR ORDEN ***************************************/
    public function actionImprimeOrden($id = null) {
        $connection = \Yii::$app->db;
        require_once ('reporte_pdf.php');
        $extra = "";
        
        if($id!="") $extra=" and id_transaccion=".$id;
        
        $query = "SELECT * FROM vw_resumen_transaccion 
                WHERE 1=1 ".$extra;
        $pendientes = $connection->createCommand($query)->queryone();
        $pdf = new \fpdf\FPDF('P','mm','Letter');
        $pdf->SetAutoPageBreak(false,35);
        /*****************************************************************************************************************/
        $pdf->AddPage(); 
        $logo = "../../img/saint.jpg";
        $pdf->Image($logo,12,11,20,15);     
        $yactual = $pdf->getY(); 
        /*****************************************************************************************************************/
        $pdf->SetFont('Arial','B',13); 
        $pdf->SetFillColor(255,255,255);
        $pdf->MultiCell(193,5,"Automotores IPSFA",0,'C');
        $pdf->MultiCell(193,5,"Los Proceres",0,'C');
        $pdf->SetFont('Arial','',9);    
        $pdf->MultiCell(193,5,"Rif: G-20003692-3",0,'C');
        $pdf->ln();
        $pdf->SetFont('Arial','B',9);    
        $pdf->MultiCell(193,5,utf8_decode("RECEPCIÓN DE VEHÍCULOS"),0,'C');
        $pdf->ln();
        $pdf->Cell(60,6,utf8_decode('Hora de recepción vehículo: ').$pendientes['hora'],0,0,'C');
        $pdf->Cell(210,6,utf8_decode('Fecha: ').$pendientes['fecha'],0,1,'C');
        
        $pdf->Cell(60,6,utf8_decode('Hora de entrada en Caja:___________ '),0,0,'C');
        $pdf->Cell(210,6,utf8_decode('Número de Atención: ').$pendientes['numero_atencion'],0,1,'C');
        
        $pdf->MultiCell(185,7,utf8_decode("DATOS DEL CLIENTE"),0,'C');
        
        $pdf->SetFillColor(192,192,192); 
        $pdf->Cell(33,6,'Nombre del Cliente',1,0,'L', true);
        $pdf->Cell(85,6,$pendientes['nombre_pagador'],1,0,'L');
        $pdf->Cell(22,6,utf8_decode('Cédula o RIF'),1,0,'L', true);
        $pdf->Cell(45,6,$pendientes['pagador'],1,1,'L');
        
        $pdf->Cell(33,6,utf8_decode('Teléfonos'),1,0,'L', true);
        $pdf->Cell(85,6,$pendientes['Movil'],1,0,'L');
        $pdf->Cell(22,6,utf8_decode('Email'),1,0,'L', true);
        $pdf->Cell(45,6,$pendientes['Email'],1,1,'L');
   
        $pdf->MultiCell(185,7,utf8_decode("DATOS DEL VEHÍCULOS"),0,'C');
        
        $pdf->SetFillColor(192,192,192); //Gris 
        $pdf->Cell(15,6,'Modelo',1,0,'L', true);
        $pdf->Cell(23,6,$pendientes['modelo'],1,0,'L');
        $pdf->Cell(15,6,utf8_decode('Año'),1,0,'L', true);
        $pdf->Cell(15,6,$pendientes['anio'],1,0,'L');
        $pdf->Cell(15,6,utf8_decode('Color'),1,0,'L', true);
        $pdf->Cell(15,6,$pendientes['color'],1,0,'L');
        $pdf->Cell(15,6,utf8_decode('Placa'),1,0,'L', true);
        $pdf->Cell(25,6,$pendientes['placa'],1,0,'L');
        $pdf->Cell(24,6,utf8_decode('Km de Entrada'),1,0,'L', true);
        $pdf->Cell(23,6,$pendientes['km'],1,1,'L');
                
        //Servicio Solictado
        $query_serv = "select CodItem,descripcion
                       from ISAU_DetalleTransaccion
                       where EsServ=1 and id_transaccion=".$id;
        $servicio = $connection->createCommand($query_serv)->queryAll();
        $conteo= count($servicio);
        $i=0;
        $cadena_serv="";
        $pdf->MultiCell(185,7,'Servicio Solicitado',1,1,'C');
        $pdf->SetFillColor(255,255,255); 
        while ($i<$conteo) {
            $pdf->MultiCell(185,7,"(".$servicio[$i]['CodItem'].") ".$servicio[$i]['descripcion'],1,1,'C');
            $i++;
        }
        $pdf->SetFillColor(192,192,192); //Gris 
        $pdf->Cell(185,6,'Observaciones',1,1,'L', true);
        $pdf->SetFillColor(255,255,255); //BLANCO
        $pdf->MultiCell(185,7,'',1,1,'C');
        
        //Repuestos Solicitados
        $pdf->MultiCell(185,8,utf8_decode("REPUESTOS REQUERIDOS PARA EL SERVICIO"),0,'C');
        $query_rep = "select CodItem, descripcion, cantidad
                       from ISAU_DetalleTransaccion
                       where EsServ=0 and id_transaccion=".$id;
        $repuesto = $connection->createCommand($query_rep)->queryAll();
        $conteo= count($repuesto);
        $i=0;
        $pdf->SetFillColor(192,192,192); //Gris 
        $pdf->Cell(185,6,'Repuestos Solicitados',1,1,'L', true);
        $pdf->SetFillColor(255,255,255);

        while ($i<$conteo) {
            $pdf->MultiCell(185,10,"(".$repuesto[$i]['CodItem'].") ".$repuesto[$i]['descripcion']." cant. (".$repuesto[$i]['cantidad'].") \n",1,1,'L');
            $i++;
        }
         
        
        //Tecnico Asignado
        $pdf->MultiCell(185,8,utf8_decode(""),0,'C');
        $query_tec = "select a.CodMeca, Descrip from ISAU_TallerTransaccion a
                left join SAMECA b on a.CodMeca=b.CodMeca where id_transaccion=".$id;
        $tecnico = $connection->createCommand($query_tec)->queryOne();
        $pdf->SetY(165);
        $pdf->Cell(185,6,utf8_decode('Técnico Asignado: ').$tecnico['CodMeca']." ".$tecnico['Descrip'],0,1,'R');
        $pdf->Cell(185,6,utf8_decode('Monto Total del Servicio: ').$pendientes['total']." Bs.",0,1,'R');

        //Inseccion del Vehiculo
        $pdf->MultiCell(185,8,utf8_decode("INSPECCIÓN DEL VEHÍCULO"),0,'C');
        $query_inp = "select a.id_inspeccion, descripcion, observacion
        from ISAU_TransaccionInspeccion a
        inner join ISAU_Inspeccion b on a.id_inspeccion=b.id_inspeccion
        where id_transaccion=".$id." order by a.id_inspeccion";
        $inspeccion = $connection->createCommand($query_inp)->queryAll();
        $conteo_inp= count($inspeccion);
        $y=0;
        
        $pdf->SetFillColor(192,192,192); //Gris 
        $pdf->SetY(185);
        $pdf->SetX(125);
        
        
        $pdf->Cell(70,4,utf8_decode('Inspección exterior'),1,1,'C', true);
        while ($y < 4) {
            $pdf->SetX(125);
            $pdf->Cell(35,4,$inspeccion[$y]['descripcion'],1,0,'L', FALSE);
            $pdf->Cell(35,4,$inspeccion[$y]['observacion'],1,1,'L', FALSE);
            $y++;
        }
        
        //Mostramos los accesorios
        $pdf->Sety(185);
        $pdf->Cell(100,4,utf8_decode('Inspección de accesorios'),1,1,'C', true);
        while ($y <= 13) {
            $pdf->Cell(40,4,$inspeccion[$y]['descripcion'],1,0,'L', FALSE);
            $pdf->Cell(10,4,$inspeccion[$y]['observacion'],1,1,'L', FALSE);
            $y++;
        }
        $pdf->Sety(189);
        while ($y < $conteo_inp) {
        $pdf->SetX(60);
            $pdf->Cell(40,4,$inspeccion[$y]['descripcion'],1,0,'L', FALSE);
            $pdf->Cell(10,4,$inspeccion[$y]['observacion'],1,1,'L', FALSE);
            $y++;
        }
        
        
        
        //ACEPTACION DE LOS TERMINOS
        $pdf->SetFillColor(255,255,255); //Gris 
        $pdf->Sety(230);
        $pdf->SetFont('Arial','',9); 
        $pdf->MultiCell(185,4,utf8_decode("Por la presente, autorizo que sea realizado el servcio solicitado. Estoy de acuerdo que la empresa no se hace responsable por perdidas o daños al vehiculo dejados en el. Asimismo acepto que el personal autorizado, haga las pruebas necesarias con el fin de verificar el òptimo funcionamiento del mismo, me comprometo a retirar el vehiculo una vez terminado el servicio y pagando los gastos ocasionados por la presentación del servicio y/o venta de repuesto respectivo"),0,'L'); 
        $pdf->MultiCell(185,8,utf8_decode("                ________________________                                                                        _____________________________"),0,1,'C');
        $pdf->MultiCell(185,8,utf8_decode("                             Firma del Cliente                                                                                            Firma del Asesor         "),0,1,'C');
        
        $pdf->Output('');
        exit;
    }
}
