<?php

namespace app\controllers;

use Yii;
use app\models\RolAccion;
use app\models\RolAccionSearch;
use app\models\AccessHelpers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RolAccionController implements the CRUD actions for RolAccion model.
 */
class RolAccionController extends Controller
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
     * Lists all RolAccion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RolAccionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RolAccion model.
     * @param integer $id_accion
     * @param integer $id_rol
     * @return mixed
     */
    public function actionView($id_accion, $id_rol)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_accion, $id_rol),
        ]);
    }

    /**
     * Creates a new RolAccion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RolAccion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_accion' => $model->id_accion, 'id_rol' => $model->id_rol]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RolAccion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_accion
     * @param integer $id_rol
     * @return mixed
     */
    public function actionUpdate($id_accion, $id_rol)
    {
        $model = $this->findModel($id_accion, $id_rol);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_accion' => $model->id_accion, 'id_rol' => $model->id_rol]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RolAccion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_accion
     * @param integer $id_rol
     * @return mixed
     */
    public function actionDelete($id_accion, $id_rol)
    {
        $this->findModel($id_accion, $id_rol)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RolAccion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_accion
     * @param integer $id_rol
     * @return RolAccion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_accion, $id_rol)
    {
        if (($model = RolAccion::findOne(['id_accion' => $id_accion, 'id_rol' => $id_rol])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
