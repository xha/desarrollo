<?php

namespace frontend\controllers;

use Yii;
use frontend\models\VwResumenOrden;
use frontend\models\VwResumenOrdenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VwResumenOrdenController implements the CRUD actions for VwResumenOrden model.
 */
class VwResumenOrdenController extends Controller
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
     * Lists all VwResumenOrden models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VwResumenOrdenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VwResumenOrden model.
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
     * Creates a new VwResumenOrden model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VwResumenOrden();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_transaccion]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing VwResumenOrden model.
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
     * Deletes an existing VwResumenOrden model.
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
     * Finds the VwResumenOrden model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VwResumenOrden the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VwResumenOrden::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionReporteOrdenes()
    {
        $model = new VwResumenOrden();
        $consulta="";
        if ($model->load(Yii::$app->request->post())) {    
   
            $connection= \Yii::$app->db;
            
            $consulta="select * from  vw_resumen_orden where id_transaccion>0";
            
            if ($model->numero_atencion){
                $consulta.=" and asesor=".$model->nombre_asesor;
            }  
            
            if (($model->fecha) && ($model->fecha_transaccion)){
                $consulta.=" and fecha_transaccion between '".$model->fecha." 00:00' and '".$model->fecha_transaccion." 23:59'";
            }
            
            if ($model->modelo){
                $consulta.=" and id_modelo=".$model->modelo;
            }
            
            if ($model->placa){
                $consulta.=" and placa between '%".$model->modelo."%'";
            }                
            
            if ($model->activo){
                $consulta.=" and activo=".$model->activo;
            }                
            
            $command = $connection->createCommand($consulta);
            $row = $command->queryAll();
            
            if($row){
                return $this->render('listado_ordenes', [
                    'model' => $row,
                ]);
            }else{
                \Yii::$app->getSession()->setFlash('danger', 'Los paremetro indicanos no arrojaron resultado');
                    return $this->render('reporteOrdenes', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('reporteOrdenes', [
                'model' => $model,
            ]);
        }

    }    
}
