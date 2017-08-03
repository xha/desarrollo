<?php

namespace app\controllers;

use Yii;
use app\models\RolUsuario;
use app\models\RolUsuarioSearch;
use app\models\AccessHelpers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;

/**
 * RolUsuarioController implements the CRUD actions for RolUsuario model.
 */
class RolUsuarioController extends Controller
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
     * Lists all RolUsuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RolUsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RolUsuario model.
     * @param integer $id_usuario
     * @param integer $id_rol
     * @return mixed
     */
    public function actionView($id_usuario, $id_rol)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_usuario, $id_rol),
        ]);
    }

    /**
     * Creates a new RolUsuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RolUsuario();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_usuario' => $model->id_usuario, 'id_rol' => $model->id_rol]);
        } else {
            $connection = \Yii::$app->db;
            $query = "select u.uid,u.name 
                    from users u 
                    left join is_rol_usuario ru on u.uid=ru.id_usuario where ru.id_usuario is null and u.uid>0";
            $pendientes = $connection->createCommand($query)->queryAll();

            return $this->render('create', [
                'model' => $model,
                'pendientes' => $pendientes,
            ]);
        }
    }

    /**
     * Updates an existing RolUsuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_usuario
     * @param integer $id_rol
     * @return mixed
     */
    public function actionUpdate($id_usuario, $id_rol)
    {
        $model = $this->findModel($id_usuario, $id_rol);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_usuario' => $model->id_usuario, 'id_rol' => $model->id_rol]);
        } else {
            $connection = \Yii::$app->db;
            $query = "select uid,name 
                    from users
                    where uid=".$id_usuario;
            $pendientes = $connection->createCommand($query)->queryAll();
            return $this->render('update', [
                'model' => $model,
                'pendientes' => $pendientes,
            ]);
        }
    }

    /**
     * Deletes an existing RolUsuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_usuario
     * @param integer $id_rol
     * @return mixed
     */
    public function actionDelete($id_usuario, $id_rol)
    {
        $this->findModel($id_usuario, $id_rol)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RolUsuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_usuario
     * @param integer $id_rol
     * @return RolUsuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_usuario, $id_rol)
    {
        if (($model = RolUsuario::findOne(['id_usuario' => $id_usuario, 'id_rol' => $id_rol])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function getIdUsers()
    {
        return $this->hasOne(Users::className(), ['uid' => 'uid']);
    }
}
