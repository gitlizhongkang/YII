<?php

namespace backend\controllers;

use Yii;
use common\models\UserPhoto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * UserPhotoController implements the CRUD actions for UserPhoto model.
 */
class UserPhotoController extends Controller
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
     * Lists all UserPhoto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserPhoto();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Updates an existing Resume model.
     */

    public function actionUpdateOne()
    {
        $get = Yii::$app->request->get();

        $model = $this->findModel($get['id']);
        $model->setAttributes(['status'=>$get['data']]);

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
        if (UserPhoto::updateAll(['status'=>$get['data']],['id'=>$id])) {
            return ['done' => 1, 'msg' => '修改成功'];
        }
        else
        {
            return ['done' => 0, 'msg' => '修改失败'];
        }
    }


    /**
     * Deletes an existing UserPhoto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
     * Finds the UserPhoto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserPhoto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserPhoto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
