<?php

namespace backend\controllers;


use Yii;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\Response;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new User();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //关联模型查询的结果
        $model = User::find()->joinWith('userinfo')->where(['id' => $id])->one();

        /**
         * 或者转换成数组  处理成一维数组 传给DetailView::widget 也可以 此方法可以接受对象和数组
         */

        return $this->render('view', [
            'model' => $model,
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
        $post = Yii::$app->request->post();
        //文件上传
        if (Yii::$app->request->isPost)
        {
            $model->head_ic = UploadedFile::getInstance($model, 'head_ic');
            if ($file = $model->upload())
            {
                $model->head_ic = $file;
            }
        }

        //赋值 入库
        if ($model->load($post) && $model->save())
        {
            /*$id = $model->attributes['id'];
            $infoModel = new UserInfo();
            $infoModel->attributes(['user_id' => 8]);
            $infoModel->save();*/
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('create', [
                'model' => $model,
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
        $oldImg = $model->head_ic;
        $post = Yii::$app->request->post();

        //文件上传
        if (Yii::$app->request->isPost)
        {
            $model->head_ic = UploadedFile::getInstance($model, 'head_ic');
            if ($file = $model->upload())
            {
                $model->head_ic = $file;
            }
            else
            {
                $model->head_ic = $oldImg;
            }
        }

        //赋值 入库
        if ($model->load($post) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

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

    public function actionDeleteAll()
    {
        $get = Yii::$app->request->get();
        $id = explode(',',$get['ids']);

        if(User::deleteAll(['id'=>$id]))
        {
            return 1;
        }
        else
        {
            return 0;
        }
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
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
