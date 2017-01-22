<?php

namespace app\controllers;

use Yii;
use app\models\PatientDebt;
use app\models\PatientDebtSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PatientDebtController implements the CRUD actions for PatientDebt model.
 */
class PatientDebtController extends Controller
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
     * Lists all PatientDebt models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PatientDebtSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PatientDebt model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $planSearch = new \app\models\DebtPlanSearch();
        $plan = $planSearch->search([
            $planSearch->formName()=>['patient_debt_id'=>$id]
        ]);
        return $this->render('view', [
            'model' => $model,
            'plan'=>$plan
        ]);
    }

    /**
     * Creates a new PatientDebt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($patientId)
    {
        $model = new PatientDebt();

        if ($model->load(Yii::$app->request->post())){ 
            $model->first_payment = substr($model->first_payment, 6).'-'.
                    substr($model->first_payment, 3,2).'-'.
                    substr($model->first_payment, 0,2);
            $model->user_id = Yii::$app->user->id;
            $model->organization_id = Yii::$app->session['medicalCenter'];
            $model->debt_date = new \yii\db\Expression('NOW()');
            if($model->save()) {           
                // Generate payments plan
                $montoCuota = round($model->amount / $model->num_months,2);
                $saldo = 0.00;
                for($i=0; $i<$model->num_months;$i++){
                    $cuota = new \app\models\DebtPlan();
                    $cuota->patient_debt_id = $model->id;                    
                    if($i == ($model->num_months - 1)){
                        $montoCuota = ($model->amount - $saldo);
                    }
                    $saldo += $montoCuota;
                    $cuota->principal_amount = $montoCuota;
                    $cuota->principal_paid = 0.00;
                    // $cuota->payment_date = date('Y-m-d', strtotime("+".$i+" months", strtotime($model->first_payment)));                    
                    $cuota->payment_date = strtotime("+$i month", strtotime($model->first_payment));                    
                    $cuota->payment_date = date('Y-m-d',$cuota->payment_date);
                    $cuota->save();
                }
                return $this->redirect(['patient/view', 'id'=> $model->patient_id]);
            }
        } else {
            $patient = \app\models\Patient::findOne($patientId);
            return $this->render('create', [
                'model' => $model,
                'patient'=>$patient
            ]);
        }
    }

    /**
     * Updates an existing PatientDebt model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PatientDebt model.
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
     * Finds the PatientDebt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PatientDebt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PatientDebt::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
