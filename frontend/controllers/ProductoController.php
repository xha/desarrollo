<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Producto;
use frontend\models\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
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
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producto model.
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
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Producto();
        $connection = \Yii::$app->db;
        
        if ($model->load(Yii::$app->request->post())) {
            //print_r(Yii::$app->request->post());die;
            if ($model->EsExento==1) $model->iva = "";
            if ($model->iva=="") $model->EsExento = 1;
            
            $model->save();
            
            if ($model->iva!="") {
                $query = "SET NOCOUNT ON; INSERT INTO SATAXPRD(CodProd,CodTaxs,Monto,EsPorct) VALUES ('".$model->CodProd."'"
                        . ",'".$model->iva."',".$model->mtotax.",1);";
                $connection->createCommand($query)->query();
            }
            
            return $this->redirect(['view', 'id' => $model->CodProd]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $connection = \Yii::$app->db;

        if ($model->load(Yii::$app->request->post())) {
            //print_r(Yii::$app->request->post());
            if ($model->EsExento==1) $model->iva = "";
            
            if ($model->iva=="") $model->EsExento = 1;
            
            $model->save();
            
            if ($model->iva!="") {
                $query = "DELETE FROM SATAXPRD WHERE CodProd='".$model->CodProd."' and CodTaxs='".$model->iva."';";
                $connection->createCommand($query)->query();
                
                $query = "SET NOCOUNT ON; INSERT INTO SATAXPRD(CodProd,CodTaxs,Monto,EsPorct) VALUES ('".$model->CodProd."'"
                        . ",'".$model->iva."',".$model->mtotax.",1);";
                $connection->createCommand($query)->query();
            }
            return $this->redirect(['view', 'id' => $model->CodProd]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Producto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
