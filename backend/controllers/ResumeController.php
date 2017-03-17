<?php

namespace backend\controllers;

use Yii;
use common\models\Resume;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ResumeController implements the CRUD actions for Resume model.
 */
class ResumeController extends Controller
{
    public $layout = 'zhudi';
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
     * Lists all Resume models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Resume();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Resume model.
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
     * Creates a new Resume model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Resume();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/


    /**
     * Updates an existing Resume model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }*/

    public function actionUpdateOne()
    {
        $get = Yii::$app->request->get();

        $model = $this->findModel($get['id']);
        $model->setAttributes(['audit'=>$get['data']]);

        //返回json数据
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->save()) {
            return ['done' => 1, 'msg' => '修改成功'];
        }
        else
        {
            return ['done' => 0, 'msg' => '修改失败'];
        }
    }

    public function actionUpdateAll()
    {
        $get = Yii::$app->request->get();
        $id = explode(',',$get['ids']);


        //返回json数据
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Resume::updateAll(['audit'=>$get['data']],['id'=>$id])) {
            return ['done' => 1, 'msg' => '修改成功'];
        }
        else
        {
            return ['done' => 0, 'msg' => '修改失败'];
        }
    }


    /**
     * Deletes an existing Resume model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteAll()
    {
        $get = Yii::$app->request->get();
        $id = explode(',',$get['ids']);

        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Resume::deleteAll(['id'=>$id]))
        {
            return ['done' => 1, 'msg' => '删除成功'];
        }
        else
        {
            return ['done' => 0, 'msg' => '删除失败'];
        }
    }


    /**
     * Finds the Resume model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Resume the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resume::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
