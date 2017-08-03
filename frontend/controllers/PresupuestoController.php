<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Presupuesto;
use frontend\models\PresupuestoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;


/**
 * PresupuestoController implements the CRUD actions for Presupuesto model.
 */
class PresupuestoController extends Controller
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
     * Lists all Presupuesto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PresupuestoSearch( [ 'TipoFac' => 'F']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = ['defaultOrder' => ['NumeroD'=>SORT_DESC, 'FechaE'=>SORT_ASC]];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Presupuesto model.
     * @param string $CodSucu
     * @param string $NumeroD
     * @param string $TipoFac
     * @return mixed
     */
    public function actionView($CodSucu, $NumeroD, $TipoFac)
    {
        return $this->render('view', [
            'model' => $this->findModel($CodSucu, $NumeroD, $TipoFac),
        ]);
    }

    public function actionProcesar()
    {
        $model = new Presupuesto();
        return $this->render('procesar', [
                'model' => $model,
            ]);
    }

    /**
     * Creates a new Presupuesto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Presupuesto();
        $connection = \Yii::$app->db;
        $data = array();
        
        $query = "SELECT CodClie,Descrip FROM SACLIE where Activo=1";
        $data1 = $connection->createCommand($query)->queryAll();
        
        for($i=0;$i<count($data1);$i++) {
            $data[]= $data1[$i]['CodClie']." - ".$data1[$i]['Descrip'];
        }

        if ($model->load(Yii::$app->request->post())) {
            //var_dump($model->attributes);
            print_r($_POST);
            date_default_timezone_set("America/Caracas");
            $hora = time();
            $hora = date('H:i:s',$hora);
            $arr_fecha_compra=explode("-",$model->FechaE);
            $model->FechaE = $arr_fecha_compra[2].$arr_fecha_compra[1].$arr_fecha_compra[0]." ".$hora;
            $model->FechaV = $model->FechaE;
            $model->FechaI = $model->FechaE;
            $model->CodEsta = gethostname();
            /*************************************************************************************************/
            //BUSCO EL CORRELATIVO QUE SIGUE DE PRESUPUESTO
            $query = "SELECT (ValueInt+1) as presupuesto FROM SACORRELSIS WHERE FieldName='PrxProf'";
            $nro_presupuesto = $connection->createCommand($query)->queryOne();
            $model->NumeroD = $nro_presupuesto['presupuesto'];/*************************************************************************************************/
            //BUSCO DATOS DEL CLIENTE
            $query = "SELECT * FROM SACLIE WHERE CodClie='".$model->CodClie."'";
            $cliente = $connection->createCommand($query)->queryOne();
            //print_r($_POST);die;
            //if($model->validate()) {
            $model->Direc1 = $cliente['Direc1'];
            $model->Direc2 = $cliente['Direc2'];
            $model->ID3 = $cliente['ID3'];
            $model->Descrip = $cliente['Descrip'];
            /*************************************************************************************************/
            //GUARDO EL MODELO, OJO
            $model->save();
            /*************************************************************************************************/
            //AUMENTO EL CORRELATIVO DEL PRESUPUESTO
            $query = "UPDATE SACORRELSIS SET ValueInt=(ValueInt+1) WHERE FieldName='PrxProf'";
            $connection->createCommand($query)->query();
            /*************************************************************************************************/
            $detalle = explode("¬",$_POST['i_items']);  
            $query = "DELETE FROM SAITEMFAC WHERE TipoFac='F' and NumeroD='".$model->NumeroD."'";
            $connection->createCommand($query)->query();
            for ($i=0;$i < count($detalle) - 1;$i++) {
                $campos = explode("#",$detalle[$i]);
                //Nro   Código  Descripción     Cantidad    Precio  Tax     Descuento   Total   Serv CodTax
                if ($campos[5]>0) {
                    $exen = 0;
                    $EsExento=0;
                    $grav = round(($campos[3] * $campos[4]),2);
                    
                    $monto_tax = 0;
                    $query3 = "SELECT * FROM SATAXES WHERE CodTaxs='".$campos[9]."'";
                    $satax = $connection->createCommand($query3)->queryOne();
                    $monto_tax = $satax['MtoTax'];

                    $query2 = "INSERT INTO SATAXITF(CodSucu,TipoFac,NumeroD,NroLinea,NroLineaC,CodTaxs,CodItem,Monto,TGravable,MtoTax) VALUES ('".$model->CodSucu."','F',".$model->NumeroD.",".($i+1).",0,'".$campos[9]."','".$campos[1]."',".$campos[5].",".$campos[7].",".$monto_tax.")";
                    $connection->createCommand($query2)->query();
                } else {
                    $grav = 0;
                    $EsExento=1;
                    $exen = round(($campos[3] * $campos[4]),2);
                }

                $query2 = "INSERT INTO SAITEMFAC(CodSucu, TipoFac, NumeroD, NroLinea, NroLineaC, CodItem, CodUbic, CodVend, Descrip1, Refere, Signo, CantMayor, Cantidad, TotalItem, Costo, Precio, MtoTax, PriceO, Descto, NroUnicoL, FechaE, EsServ, EsExento) VALUES ('".$model->CodSucu."','F',".$model->NumeroD.",".($i+1).",0,".$campos[1].",'".$model->CodUbic."','".$model->CodVend."','".$campos[2]."','".$campos[1]."',1,".$campos[3].",".$campos[3].",".$campos[7].",0,".$campos[4].",".$campos[5].",".$campos[4].",".$campos[6].",0,'".$model->FechaE."',".$campos[8].",$EsExento);";
                $connection->createCommand($query2)->query();
            }
            /********************************************************************************************************************/
            //ACTUALIZO LA TABLA SATAXVTA
            $query3 = "SELECT CodTaxs,MtoTax,sum(Monto) as Monto, sum(TGravable) as TGravable 
                    FROM SATAXITF 
                    WHERE TipoFac='F' and NumeroD='".$model->NumeroD."'
                    GROUP BY CodTaxs,MtoTax";
            $sataxvta = $connection->createCommand($query3)->queryAll();

            for ($i=0;$i<count($sataxvta);$i++) {
                $query2 = "INSERT INTO SATAXVTA(CodSucu,TipoFac,NumeroD,CodTaxs,Monto,MtoTax,TGravable,EsReten) VALUES ('".$model->CodSucu."','F',".$model->NumeroD.",'".$sataxvta[$i]['CodTaxs']."','".$sataxvta[$i]['Monto']."',".$sataxvta[$i]['MtoTax'].",".$sataxvta[$i]['TGravable'].",0)";
                $connection->createCommand($query2)->query();
            }
            /********************************************************************************************************************/
            return $this->redirect(['view', 'CodSucu' => $model->CodSucu, 'NumeroD' => $model->NumeroD, 'TipoFac' => $model->TipoFac]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'data' => $data,
            ]);
        }
    }

    /**
     * Updates an existing Presupuesto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $CodSucu
     * @param string $NumeroD
     * @param string $TipoFac
     * @return mixed
     */
    public function actionUpdate($CodSucu, $NumeroD, $TipoFac)
    {
        $model = $this->findModel($CodSucu, $NumeroD, $TipoFac);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'CodSucu' => $model->CodSucu, 'NumeroD' => $model->NumeroD, 'TipoFac' => $model->TipoFac]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Presupuesto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $CodSucu
     * @param string $NumeroD
     * @param string $TipoFac
     * @return mixed
     */
    public function actionDelete($CodSucu, $NumeroD, $TipoFac)
    {
        $this->findModel($CodSucu, $NumeroD, $TipoFac)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Presupuesto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $CodSucu
     * @param string $NumeroD
     * @param string $TipoFac
     * @return Presupuesto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($CodSucu, $NumeroD, $TipoFac)
    {
        if (($model = Presupuesto::findOne(['CodSucu' => $CodSucu, 'NumeroD' => $NumeroD, 'TipoFac' => $TipoFac])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionBuscarItems($codigo,$tipo) {
        $connection = \Yii::$app->db;

        if ($tipo==1) {
            $query = "SELECT CodServ,Descrip
                    from SASERV
                    where activo=1 and CodServ='".$codigo."'";
        } else {
            $query = "SELECT CodProd,Descrip
                    from SAPROD
                    where activo=1 and CodProd='".$codigo."'";
        }
        $pendientes = $connection->createCommand($query)->queryAll();
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

    public function actionBuscarEncabezado($numerod) {
        $connection = \Yii::$app->db;
        /*create table ISCO_PRESUPUESTOS (
            numerod varchar(20) not null,
            fecha datetime default GETDATE(),
            usuario varchar(50) not null,
            activo bit default 1);*/
        $query = "SELECT * from SAFACT where TipoFac='F' and NumeroD='".$numerod."' 
                    and NOT EXISTS (SELECT *
                   FROM   ISCO_PRESUPUESTOS 
                   WHERE  SAFACT.NumeroD = ISCO_PRESUPUESTOS.NumeroD) ";
        $pendientes = $connection->createCommand($query)->queryAll();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }  

    public function actionBuscarDetalle($numerod) {
        $connection = \Yii::$app->db;

        $query = "SELECT * from SAITEMFAC where TipoFac='F' and NumeroD='".$numerod."' Order By NroLinea";
        $pendientes = $connection->createCommand($query)->queryAll();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }  

    public function actionProcesarCondominio($numerod,$usuario) {
        $connection = \Yii::$app->db;

        $query = "SET ANSI_NULLS ON; SET ANSI_WARNINGS ON; SET NOCOUNT ON; EXEC ISCO_CONDOMINIO '".$numerod."','".$usuario."'";

        $pendientes = $connection->createCommand($query)->queryAll();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }  
}
