<?php

namespace app\controllers;

use Yii;
use app\models\SparePart;
use app\models\SparePartSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SparePartController implements the CRUD actions for SparePart model.
 */
class SparePartController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all SparePart models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SparePartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new SparePart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SparePart();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SparePart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * return single spare part details in json format
     * @return mixed
     */
    public function actionSpareDetails(){

        $spare_part_response = [];    

        try {
            if( Yii::$app->request->post('spare_part_id') !== null ){
                $spare_part_response = [
                    'spare_part_details' => $this->findModel(Yii::$app->request->post('spare_part_id')),
                    'code' => 200
                ];
            } else {
                $spare_part_response = [
                    'spare_part_details' => null,
                    'code' => 500
                ];
                // do your query stuff here
            }
        }catch(Exception $e){
            $spare_part_response = [
                'spare_part_details' => $e,
                'code' => 500
            ];
        }
    
        // return Json    
        return \yii\helpers\Json::encode($spare_part_response);

    }

    /**
     * Deletes an existing SparePart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SparePart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SparePart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SparePart::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
