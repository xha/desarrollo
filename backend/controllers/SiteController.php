<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\AccessHelpers;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\RecuperarClaveForm;
use app\models\ActivarForm;
use common\models\Usuario;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\db\Query;
use yii\helpers\Json;
Use app\itbz\fpdf\src\fpdf\fpdf;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['site-index'],
                'rules' => [
                    [
                        'actions' => ['site-index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['site-logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /*
    'class' => AccessControl::className(),
    'rules' => [
        [
            'actions' => ['login', 'error','register','recuperar'],
            'allow' => true,
        ],
        [
            'actions' => ['logout', 'index'],
            'allow' => true,
            'roles' => ['@'],
        ],
    ],
    */

    /*public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        return AccessHelpers::chequeo();
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister() {
        $model = new RegisterForm;
           
        $msg = null;
        
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()))
        {
            if($model->validate()) {
                //Preparamos la consulta para guardar el usuario
                $table = new Usuario;
                $table->usuario = $model->usuario;
                $table->correo = $model->correo;
                $table->cedula = $model->cedula;
                $table->nombre = $model->nombre;
                $table->apellido = $model->apellido;
                $table->sexo = $model->sexo;
                $table->telefono = $model->telefono;
                $table->id_rol = 1;
                $table->id_pregunta = $model->id_pregunta;
                $table->respuesta_seguridad = $model->respuesta_seguridad;
                $table->activo = 0;
                $table->log_in = 0;
                $table->clave = md5("is".$model->clave);
                
                //Si el registro es guardado correctamente
                //print_r($table->getErrors());die;
                if ($table->insert(false))
                {
                    $msg = "Registro Guardado, Debe esperar que un administrador active su cuenta";
                }
                else
                {
                    $msg = "Error al guardar";
                }
            } else {
                $model->getErrors();
            }
          }

        return $this->render('register', [
            'model' => $model,
            'msg' => $msg
        ]);  
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRecuperar()
    {
        $model = new RecuperarClaveForm;
           
        $msg = null;
        
        if ($model->load(Yii::$app->request->post()))
        {
            $clave = md5("is".$model->clave);
            $connection = \Yii::$app->db;

            $query = "UPDATE is_usuario
            SET clave='$clave'
            where usuario='".$model->usuario."' and id_pregunta=".$model->id_pregunta." and respuesta_seguridad='".$model->respuesta_seguridad."' and correo='".$model->correo."'";
            $msg = $connection->createCommand($query)->execute();
            
            if ($msg > 0) {
                $msg = "Registro Guardado";
            } else {
                $msg = "Error al Actualizar";
            };
        }

        return $this->render('recuperar', [
            'model' => $model,
            'msg' => $msg
        ]);
    }

    public function actionActivar()
    {
        $model = new ActivarForm;
        $connection = \Yii::$app->db;
        $msg = null;
        $data = array();
        
        $query = "SELECT usuario FROM IS_USUARIO";
        $data1 = $connection->createCommand($query)->queryAll();

        for($i=0;$i<count($data1);$i++) {
            $data[]= $data1[$i]['usuario'];
        }
        
        if ($model->load(Yii::$app->request->post()))
        {
            $query = "UPDATE is_usuario
            SET id_rol=".$model->id_rol."
            where id_usuario='".$model->id_usuario."'";
            $msg = $connection->createCommand($query)->execute();
            
            if ($msg > 0) {
                $msg = "Registro Actualizado";
            } else {
                $msg = "Error al Actualizar";
            };
        }

        return $this->render('activar', [
            'model' => $model,
            'msg' => $msg,
            'data' => $data
        ]);
    }
}
