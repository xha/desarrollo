<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Servicio;
use frontend\models\ServicioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\AccessHelpers;

/**
 * ServicioController implements the CRUD actions for Servicio model.
 */
class ServicioController extends Controller
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
     * Lists all Servicio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServicioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Servicio model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Servicio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Servicio();
        $connection = \Yii::$app->db;

        if ($model->load(Yii::$app->request->post())) {
            //print_r(Yii::$app->request->post());die;
            if ($model->EsExento==1) $model->iva = "";
            if ($model->iva=="") $model->EsExento = 1;
            
            $model->save();
            
            if ($model->iva!="") {
                $query = "SET NOCOUNT ON; INSERT INTO SATAXSRV(CodServ,CodTaxs,Monto,EsPorct) VALUES ('".$model->CodServ."'"
                        . ",'".$model->iva."',".$model->mtotax.",1);";
                $connection->createCommand($query)->query();
            }
            
            return $this->redirect(['view', 'id' => $model->CodServ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Servicio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $connection = \Yii::$app->db;

        if ($model->load(Yii::$app->request->post())) {
            //print_r(Yii::$app->request->post());die;
            if ($model->EsExento==1) $model->iva = "";
            if ($model->iva=="") $model->EsExento = 1;
            
            $model->save();
            
            if ($model->iva!="") {
                $query = "DELETE FROM SATAXSRV WHERE CodServ='".$model->CodServ."' and CodTaxs='".$model->iva."';";
                $connection->createCommand($query)->query();
                
                $query = "SET NOCOUNT ON; INSERT INTO SATAXSRV(CodServ,CodTaxs,Monto,EsPorct) VALUES ('".$model->CodServ."'"
                        . ",'".$model->iva."',".$model->mtotax.",1);";
                $connection->createCommand($query)->query();
            }
            
            return $this->redirect(['view', 'id' => $model->CodServ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Servicio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $connection = \Yii::$app->db;
        $query = "UPDATE SASERV SET Activo=0 WHERE CodServ='".$id."'";
        $connection->createCommand($query)->query();
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Servicio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Servicio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Servicio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
