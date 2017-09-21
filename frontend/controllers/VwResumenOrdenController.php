<?php

namespace frontend\controllers;

use Yii;
use frontend\models\VwResumenOrden;
use frontend\models\VwResumenOrdenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

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
        $model = new VwResumenOrden();
        return $this->render('reporteOrdenes', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single VwResumenOrden model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = new VwResumenOrden();
        return $this->render('reporteOrdenes', [
            'model' => $model,
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
        return $this->render('reporteOrdenes', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VwResumenOrden model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = new VwResumenOrden();
        return $this->render('reporteOrdenes', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VwResumenOrden model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = new VwResumenOrden();
        return $this->render('reporteOrdenes', [
            'model' => $model,
        ]);
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

        return $this->render('reporteOrdenes', [
            'model' => $model,
        ]);
    }    
    
    public function actionBuscarOrden($consulta = null) {
        $connection = \Yii::$app->db;

        $query = "SELECT * from vw_resumen_orden where 1=1";
        $query.= $consulta;
        $query.= " ORDER BY numero_atencion,fecha DESC";

        $pendientes = $connection->createCommand($query)->queryAll();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }    
}
