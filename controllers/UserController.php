<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\filters\AccessControl;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['update','index','create'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function(){
                            return Yii::$app->session['role'] == 'S' ||
                                    Yii::$app->session['role'] == 'A';
                        }
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }
    
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionAdmin()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionSettings(){
        $model = $this->findModel(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', 
                    Yii::t('app', 'Your changes have been saved succesfully'));
            return $this->redirect(['site/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    
    public function actionLogin()
    {
        
        $model = User::findOne([
            'email'=>Yii::$app->request->post('email'),
            'active'=>'Y'
        ]);
        
        //\Yii::warning('Email=>' . Yii::$app->request->post('email'));
        //print_r($model);
        if($model){
            //\Yii::warning('Entro 1');
            if($model->check(Yii::$app->request->post('password')) && 
                    Yii::$app->user->login($model)){
                //\Yii::warning('Entro 2');
                return $this->redirect(['site/index']);
            }else{
                \Yii::$app->getSession()->setFlash('danger', 
                        Yii::t('app', 'Invalid Password...'));
                return $this->redirect(['site/index']);
            }
        }
        //\Yii::warning('No Entro 3');
        \Yii::$app->getSession()->setFlash('danger', 
                Yii::t('app', 'User not registered or your account it is not activated'));
        return $this->redirect(['site/index',
            'error'=>Yii::t('app','Invalid user or password').'...'.Yii::$app->request->post('email')]);
    }
    
    public function actionPanel()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('panel', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //$url = Url::toRoute(['/site/activate','id'=>$model->id,'h'=>$model->verification_code]);
            $url = Yii::$app->params['websiteUrl'].'/user/activate?id='.$model->id.'&a='.$model->verification_code;
            $html = '<h1>'.Yii::t('app', 'MEDEX').'</h1><hr/>'.
                    '<p>'.
                    Yii::t('app', 'An account has been created for you to use MEDEX. To activate your account please click the next link:').'</p>'.
                    Html::a(Yii::t('app','Activate Your MEDEX Account'),$url).'<hr/>';
            
            //Send email
            User::sendMail('donotreply@medex.com',$model->email,
                    Yii::t('app', 'MEDEX Activation Account'), $html);
            /*
            Yii::$app->mailer->compose()
            ->setFrom('donotreply@clasinaves.com')
            ->setTo($model->email)
            ->setSubject('Activacion de cuenta')
            ->setHtmlBody($html)
            ->send();
             * */
            //
            return $this->redirect(['user/index']);
        } else {
            $error = '';
            if(Yii::$app->request->post()){
                //print_r($model);
                $error = Yii::t('app','Record has not been saved');
            }
            return $this->render('create', [
                'model' => $model,
                'error'=>$error
            ]);
        }
    }

    /**
     * Updates an existing User model.
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
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionActivate($id, $a){
        $model=User::findOne($id);
        $verificationCode = $a;
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if ($model->load(Yii::$app->request->post())) {
			$model->password = crypt($model->password);
                        $model->active = "Y";
			if ($model->save()) {
                            \Yii::$app->getSession()->setFlash('info', 
                                    '<strong>'.$model->username.' '.Yii::t('app', 
                                            'Your Account has been activated succesfully.'));
                            //Yii::t('app', 'User not registered or your account it is not activated'));
                            //
                            //Yii::app()->user->setFlash(
                            //'info', 
                            //'<strong>' . $model->first_name . ' tu cuenta ha sido activada' . 
                            //'!</strong> Ya puedes empezar a utilizarla.');
                            $this->redirect(array('site/index'));
			}
		}
                
                if($model->verification_code != $a){
                    Yii::$app->getSession()->setFlash(
                            'error', 
                            '<strong>' . $model->username . ' '.
                            Yii::t('app','Your Account could not be activated, there is a problema with the sent data'));
                            $this->redirect(array('site/index'));
                }
                if($model->active=="Y"){
                    Yii::$app->getSession()->setFlash(
                            'info', 
                            '<strong>' . $model->username . ' '.
                            Yii::t('app', 'Your Account already have been activated. You can login with the credentials'));
                            $this->redirect(array('site/index'));
                }

		return $this->render('activate', [
                    'model' => $model,
                    'a'=>$a
                ]);
            
            
    }
    
    
}
