<?php

namespace app\controllers;

use Yii;
use app\models\Consultation;
use app\models\ConsultationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * ConsultationController implements the CRUD actions for Consultation model.
 */
class ConsultationController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['update','index','create','calendar','cita'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function(){
                            return Yii::$app->session['role'] == 'S' ||
                                    Yii::$app->session['role'] == 'D' ||
                                    Yii::$app->session['role'] == 'M';
                        }
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    /**
     * Lists all Consultation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConsultationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCalendar()
    {
//        $searchModel = new ConsultationSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $now = new \DateTime('now');
        $inicio = $now->format('Y-m').'-01';
        if(Yii::$app->session['role'] == 'D'){
            $citas = Consultation::find()
                ->andFilterWhere(['=','organization_id',Yii::$app->session['medicalCenter']])
                ->andFilterWhere(['=','doctor_id',Yii::$app->session['doctorId']])                    
                ->andFilterWhere(['>=','consultation_date',$inicio])->all();
        }else{
            $citas = Consultation::find()
                ->andFilterWhere(['=','organization_id',Yii::$app->session['medicalCenter']])
                ->andFilterWhere(['>=','consultation_date',$inicio])->all();
        }
        
        return $this->render('calendar', [
            'citas' => $citas,
        ]);
    }

    /**
     * Displays a single Consultation model.
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
     * Creates a new Consultation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($patientId)
    {
        $model = new Consultation();

        if ($model->load(Yii::$app->request->post())){
            $model->consultation_date = substr($model->consultation_date, 6).'-'.
                    substr($model->consultation_date, 3,2).'-'.
                    substr($model->consultation_date, 0,2);
            $model->user_id = Yii::$app->user->id;
            $model->organization_id = Yii::$app->session['medicalCenter'];
            if($model->save()){         
                return $this->redirect(['patient/view', 'id' => $model->patient_id]);
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
     * Updates an existing Consultation model.
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
    
    public function actionCancel($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){ 
            $model->status = 'C';
            $model->cancelation_date = new \yii\db\Expression('NOW()');
            $model->cancelation_user_id = Yii::$app->user->id;
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('cancel', [
                'model' => $model,
            ]);
        }
    }
    
    
    public function actionCita($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){
            $model->status = 'R';
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('cita', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Consultation model.
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
     * Finds the Consultation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Consultation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Consultation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
