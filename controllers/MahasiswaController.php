<?php

namespace app\controllers;

use Yii;
use app\models\Mahasiswa;
use app\models\MahasiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\filters\AccessControl;
/**
 * MahasiswaController implements the CRUD actions for Mahasiswa model.
 */
class MahasiswaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'actions'=>[
                        'update',
                        'delete',
                        'view',
                    ],
                    'allow'=>true,
                    'matchCallback'=>function(){
                        return(
                            Yii::$app->user->identity->id_role=='1'
                        );
                    }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','view', 'create'],
                        'roles' => ['@'],
                    ],
                ],
            ],
               
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Mahasiswa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MahasiswaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mahasiswa model.
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
     * Creates a new Mahasiswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mahasiswa();
        $user = new User();

        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($user->password);
        $user->id_role = 3;
        $user->save();
        $model->id = $user->id;
        $model->save();
            return $this->redirect(['view', 'id' => $model->id_mahasiswa]);
        }

        
        return $this->render('create', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * Updates an existing Mahasiswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user = User::find()
        ->andWhere(['id' => $id ])
        ->one();

        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($user->password);
        $user->id_role = 3;
        $user->save();
        $model->id = $user->id;
        $model->save();
            return $this->redirect(['view', 'id' => $model->id_mahasiswa]);
        }


        return $this->render('update', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * Deletes an existing Mahasiswa model.
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
     * Finds the Mahasiswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mahasiswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mahasiswa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionProfil($id)
    {
            $model = Mahasiswa::find()
                ->andWhere(['id' => '8'])
                ->one();

            $user = User::find()
                ->andWhere(['id' => '8'])
                ->one();


        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
            $user->id_role = 3;
            $user->save();
            $model->id = $user->id;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_mahasiswa]);
        }

        return $this->render('update', [
            'model' => $model,
            'user' => $user,
        ]);
    }
}
