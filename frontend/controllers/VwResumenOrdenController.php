<?php

namespace frontend\controllers;

use Yii;
use frontend\models\VwResumenOrden;
use frontend\models\VwResumenOrdenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use common\models\AccessHelpers;

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

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        return AccessHelpers::chequeo();
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

        $query = "SELECT * "
                . "FROM vw_resumen_orden "
                . "WHERE 1=1";
        $query.= $consulta;
        $query.= " ORDER BY numero_atencion,fecha DESC";

        $pendientes = $connection->createCommand($query)->queryAll();
        //$pendientes = $comand->readAll();
        echo Json::encode($pendientes);
    }    
    
    /**************************************** IMPRIMIR RESUMEN ***************************************/
    public function actionImprimeResumen($consulta = null) {
        $connection = \Yii::$app->db;
        $query = "SELECT * from vw_resumen_orden where 1=1";
        $query.= $consulta;
        $query.= " ORDER BY fecha DESC";

        $pendientes = $connection->createCommand($query)->queryAll();
        $pdf = new \fpdf\FPDF('L','mm','Letter');
        $pdf->SetAutoPageBreak(false,35);
        /*****************************************************************************************************************/
        $pdf->AddPage(); 
        $logo = "../../img/saint.jpg";
        $pdf->Image($logo,12,11,20,15);     
        $yactual = $pdf->getY(); 
        /*****************************************************************************************************************/
        $pdf->SetFont('Arial','B',13); 
        $pdf->SetFillColor(255,255,255);
        $pdf->MultiCell(260,5,"Automotores IPSFA",0,'C');
        $pdf->MultiCell(260,5,"Los Proceres",0,'C');
        $pdf->SetFont('Arial','',10);    
        $pdf->MultiCell(260,5,"Rif: G-20003692-3",0,'C');
        $pdf->ln();
        $pdf->SetFont('Arial','B',10);    
        $pdf->MultiCell(260,5,utf8_decode("RESUMEN DE ORDENES"),0,'C');
        $pdf->ln();
        $pdf->SetFont('Arial','B',9);    
        $pdf->SetFillColor(200,200,200);
        $titulo = array('Nro','Fecha','Asesor','Placa','Modelo','Total','Rif','Representante','Estatus');
        $pdf->Cell(10,4,'No',1,0,'C', TRUE);
        $pdf->Cell(15,4,'Cono',1,0,'C', TRUE);
        $pdf->Cell(20,4,'Fecha',1,0,'C', TRUE);
        $pdf->Cell(40,4,'Asesor',1,0,'C', TRUE);
        $pdf->Cell(20,4,'Placa',1,0,'C', TRUE);
        $pdf->Cell(30,4,'Modelo',1,0,'C', TRUE);
        $pdf->Cell(90,4,'Representante',1,0,'C', TRUE);
        $pdf->Cell(30,4,'Total',1,0,'C', TRUE);
        $pdf->ln();
        
        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',9);
        for ($i=0;$i<count($pendientes);$i++) {
            $pdf->Cell(10,4,$i+1,1,0,'C', TRUE);
            $pdf->Cell(15,4,$pendientes[$i]['numero_atencion'],1,0,'C', TRUE);
            $pdf->Cell(20,4,$pendientes[$i]['fecha'],1,0,'C', TRUE);
            $pdf->Cell(40,4,$pendientes[$i]['nombre_asesor'],1,0,'C', TRUE);
            $pdf->Cell(20,4,$pendientes[$i]['placa'],1,0,'C', TRUE);
            $pdf->Cell(30,4,$pendientes[$i]['modelo'],1,0,'C', TRUE);
            $pdf->Cell(90,4,$pendientes[$i]['nombre_pagador'],1,0,'L', TRUE);
            $pdf->Cell(30,4,number_format($pendientes[$i]['total'],2,'.',','),1,0,'R', TRUE);
            $pdf->ln();
        }
        
        $pdf->Output('');
        exit;
    }
}
