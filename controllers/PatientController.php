<?php

namespace app\controllers;

use Yii;
use app\models\Patient;
use app\models\PatientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PatientController implements the CRUD actions for Patient model.
 */
class PatientController extends Controller
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
                'only' => ['update','index','create','picture'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function(){
                            return Yii::$app->session['role'] == 'S' ||
                                    Yii::$app->session['role'] == 'M' ||
                                    Yii::$app->session['role'] == 'D';
                        }
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    /**
     * Lists all Patient models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PatientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Patient model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $consultationSearch = new \app\models\ConsultationSearch();
        $consultations = $consultationSearch->search([
            $consultationSearch->formName()=>['patient_id'=>$id]
        ]);
        
        $archiveSearch = new \app\models\ArchiveSearch();
        $archives = $archiveSearch->search([
            $archiveSearch->formName()=>['patient_id'=>$id]
        ]);
        
        $contactsSearch = new \app\models\EmergencyContactSearch();
        $contacts = $contactsSearch->search([
            $contactsSearch->formName()=>['patient_id'=>$id]            
        ]);
        
        $debtsSearch = new \app\models\PatientDebtSearch();
        $debts = $debtsSearch->search([
            $debtsSearch->formName()=>['patient_id'=>$id]            
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'consultations' => $consultations,
            'contacts'=>$contacts,
            'archives'=>$archives,
            'debts'=>$debts
        ]);
    }

    /**
     * Creates a new Patient model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Patient();
        

        if ($model->load(Yii::$app->request->post())) {
            $model->organization_id = Yii::$app->session['medicalCenter']; 
            //if(substr($model->birth_date, 2,1)=='-'){
                $model->birth_date = substr($model->birth_date, 6).'-'.
                    substr($model->birth_date, 3,2).'-'.
                    substr($model->birth_date, 0,2);
            //}
            if($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        } else {
            
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Patient model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if(substr($model->birth_date, 2,1)=='-'){
                $model->birth_date = substr($model->birth_date, 6).'-'.
                        substr($model->birth_date, 3,2).'-'.
                        substr($model->birth_date, 0,2);
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Patient model.
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
     * Finds the Patient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Patient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Patient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionPicture($id){
            
            
            
            $model=$this->findModel($id);
 
            header('Pragma: public');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Content-Transfer-Encoding: binary');
            header('Content-length: '.$model->picture_size);
            header('Content-Type: '.$model->content_type);
            header('Content-Disposition: attachment; filename='.$model->picture_name);
            
            
            echo $model->picture;
            
            
        }
}
