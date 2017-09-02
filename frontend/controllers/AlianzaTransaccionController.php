<?php

namespace frontend\controllers;

use Yii;
use frontend\models\AlianzaTransaccion;
use frontend\models\AlianzaTransaccionSearch;
use common\models\AccessHelpers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;

/**
 * AlianzaTransaccionController implements the CRUD actions for AlianzaTransaccion model.
 */
class AlianzaTransaccionController extends Controller
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

     *      * Lists all AlianzaTransaccion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlianzaTransaccionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AlianzaTransaccion model.
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
     * Creates a new AlianzaTransaccion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AlianzaTransaccion();
        $connection = \Yii::$app->db;
        
        if ($model->load(Yii::$app->request->post())) {
            /******************************************* GUARDO ************************************************/
            $model->save();
            /******************************************* DETALLE ***********************************************/
            //Nro 	Código 	Descripción 	Cantidad 	Precio 	Tax 	Descuento 	Total 	Serv 	Imp 	Opt
            $detalle = explode("¬",$_POST['i_items']);  
            
            for ($i=0;$i < count($detalle) - 1;$i++) {
                $campos = explode("#",$detalle[$i]);
                //Nro 	Código 	Descripción 	Cantidad 	Precio 	Tax 	Descuento 	Total 	Serv 	Imp
                $total = ($campos[3]*$campos[4]);
                $query2 = "SET NOCOUNT ON; INSERT INTO ISAU_DetalleAlianzaTransaccion(id_at,CodProd,descripcion,CodTaxs,cantidad,costo,tax,total) "
                        . "VALUES (".$model->id_at.",'".$campos[1]."','".$campos[2]."','".$campos[9]."',".$campos[3].",".$campos[4].",".$campos[5].","
                        . "".$total.");";
                $connection->createCommand($query2)->query();
            }
            
            return $this->redirect(['view', 'id' => $model->id_at]);
        } else {
            $items = array();
            /********************** ITEMS ******************************************/
            $query = "SELECT CodProd,Descrip FROM SAPROD where Activo=1";
            $data1 = $connection->createCommand($query)->queryAll();

            for($i=0;$i<count($data1);$i++) {
                $items[]= $data1[$i]['CodProd']." - ".$data1[$i]['Descrip'];
            }

            return $this->render('create', [
                'model' => $model,
                'items' => $items,
            ]);
        }
    }

    /**
     * Updates an existing AlianzaTransaccion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $connection = \Yii::$app->db;
        
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            
            $query2 = "DELETE FROM ISAU_DetalleAlianzaTransaccion WHERE id_at=".$model->id_at;
            $connection->createCommand($query2)->query();
            /******************************************* DETALLE ***********************************************/
            $detalle = explode("¬",$_POST['i_items']);  
            
            for ($i=0;$i < count($detalle) - 1;$i++) {
                $campos = explode("#",$detalle[$i]);
                //Nro 	Código 	Descripción 	Cantidad 	Precio 	Tax 	Descuento 	Total 	Serv 	Imp
                $total = ($campos[3]*$campos[4]);
                $query2 = "SET NOCOUNT ON; INSERT INTO ISAU_DetalleAlianzaTransaccion(id_at,CodProd,descripcion,CodTaxs,cantidad,costo,tax,total) "
                        . "VALUES (".$model->id_at.",'".$campos[1]."','".$campos[2]."','".$campos[9]."',".$campos[3].",".$campos[4].",".$campos[5].",".$total.");";
                $connection->createCommand($query2)->query();
            }
            
            return $this->redirect(['view', 'id' => $model->id_at]);
        } else {
            $items = array();
            /********************** ITEMS ******************************************/
            $query = "SELECT CodProd,Descrip FROM SAPROD where Activo=1";
            $data1 = $connection->createCommand($query)->queryAll();

            for($i=0;$i<count($data1);$i++) {
                $items[]= $data1[$i]['CodProd']." - ".$data1[$i]['Descrip'];
            }
            
            return $this->render('update', [
                'model' => $model,
                'items' => $items,
            ]);
        }
    }

    public function actionBuscarDetalleOrden($id_at) {
        $connection = \Yii::$app->db;

        $query = "select * from ISAU_DetalleAlianzaTransaccion where id_at=".$id_at;

        $pendientes = $connection->createCommand($query)->queryAll();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }
    
    public function actionBuscarAt($id_at) {
        $connection = \Yii::$app->db;

        $query = "SELECT t.numero_atencion,FORMAT(t.fecha, 'dd-MM-yyyy') as fecha 
                  FROM ISAU_AlianzaTransaccion a, ISAU_Transaccion t 
                  WHERE a.id_transaccion=t.id_transaccion and a.id_at=".$id_at;

        $pendientes = $connection->createCommand($query)->queryOne();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }
    /**
     * Deletes an existing AlianzaTransaccion model.
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
     * Finds the AlianzaTransaccion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AlianzaTransaccion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AlianzaTransaccion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
