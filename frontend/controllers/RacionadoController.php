<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Racionado;
use frontend\models\RacionadoSearch;
use common\models\AccessHelpers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;

/**
 * RacionadoController implements the CRUD actions for Racionado model.
 */
class RacionadoController extends Controller
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
     * Lists all Racionado models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RacionadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Racionado model.
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
     * Creates a new Racionado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Racionado();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CodItem]);
        } else {
            $connection = \Yii::$app->db;
            $items = array();
            /********************** ITEMS ******************************************/
            $query = "SELECT CodProd,Descrip,Descrip2,Descrip3 FROM SAPROD where Activo=1";
            $data1 = $connection->createCommand($query)->queryAll();
            
            for($i=0;$i<count($data1);$i++) {
                $items[]= $data1[$i]['CodProd']." - ".$data1[$i]['Descrip'].$data1[$i]['Descrip2'].$data1[$i]['Descrip3'];
            }

            return $this->render('create', [
                'model' => $model,
                'items' => $items,
            ]);
        }
    }

    /**
     * Updates an existing Racionado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CodItem]);
        } else {
            $connection = \Yii::$app->db;
            $items = array();
            /********************** ITEMS ******************************************/
            $query = "SELECT CodProd,Descrip FROM SAPROD where Activo=1";
            $data1 = $connection->createCommand($query)->queryAll();

            for($i=0;$i<count($data1);$i++) {
                $items[]= $data1[$i]['CodProd'];
            }

            return $this->render('update', [
                'model' => $model,
                'items' => $items,
            ]);
        }
    }

    /**
     * Deletes an existing Racionado model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $connection = \Yii::$app->db;
        $query = "UPDATE ISAU_Racionado SET Activo=0 WHERE CodItem='".$id."'";
        $connection->createCommand($query)->query();
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Racionado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Racionado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Racionado::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
