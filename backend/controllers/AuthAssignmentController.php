<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\AuthAssignment;
use app\models\AuthItemChild;
use app\models\Admin;
use backend\controllers\MyController;

/**
 * RuleController implements the CRUD actions for AuthRule model.
 */
class AuthAssignmentController extends MyController
{
    public $layout=false;
    public function actionIndex()
    {
        $model=new AuthAssignment;
        $userInfo=$model->getList();
        $AuthAssignmentList=$model->getList();
        return $this->render('index.html',['AuthAssignmentList'=>$AuthAssignmentList]);
    }
    public function actionAdd()
    {
    	if (Yii::$app->request->isPost) {
        	$post=Yii::$app->request->post();
        	$data['admin_name']=$post['admin_name'];
        	$data['pwd']=md5($post['password']);
        	$data['add_time']=time();
        	$lgmodel=new Admin;
  		    $lgmodel->getAdd($data);
  		    $id=$lgmodel->getLastId();
        	$date['item_name']=$post['item_name'];
          $date['user_id']=$id;
        	$date['created_at']=time();
        	$date['mes']=$post['mes'];
        	$model=new AuthAssignment;
        	$arr=$model->getAdd($date);
        	return $this->redirect(['index']);die;
        }
    	$model=new AuthItemChild;
    	$roleList=$model->getList();
      return $this->render('add.html',['roleList'=>$roleList]);
    }
    public function actionDelete()
    { 
      $user_id=Yii::$app->request->post();
      $model=new AuthAssignment();
      if($model->getDel($user_id['user_id'])){
        return 1;
      }else{
        return 0;
      }

    }
    public function actionSoso()
    { 
      $admin_name=Yii::$app->request->post();
      $model=new Admin();
      $arr=$model->getLike($admin_name['admin_name']);
      if($arr){
        return json_encode($arr);
      }else{
        return 0;
      }
    }
}