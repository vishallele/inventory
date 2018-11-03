<?php

namespace app\controllers;

use Yii;
use app\models\BillMaster;
use app\models\BillSearch;
use app\models\BillDetails;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\SparePart;
use app\models\Customer;

/**
 * BillController implements the CRUD actions for BillMaster model.
 */
class BillController extends Controller
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
     * Lists all BillMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BillSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BillMaster model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BillMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BillMaster();
        $spare_parts = ArrayHelper::map(SparePart::find()->all(),'id','spare_part_serial_no');
        $customers = ArrayHelper::map(Customer::find()->all(),'id','company_name');

        $count = count(Yii::$app->request->post('BillDetails', []));
        $arrBillDetails = [new BillDetails()];
        
        for($i = 1; $i < $count; $i++) {
            $arrBillDetails[] = new BillDetails();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Model::loadMultiple($arrBillDetails, Yii::$app->request->post()) && Model::validateMultiple($arrBillDetails)) {
                foreach ($arrBillDetails as $BillDetails) {
                    $BillDetails->save(false);
                }
                return $this->redirect('index');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'arrBillDetails' => $arrBillDetails,
            'spare_parts' =>$spare_parts,
            'customers' => $customers
        ]);
    }

    /**
     * Updates an existing BillMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BillMaster model.
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
     * Finds the BillMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BillMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BillMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
