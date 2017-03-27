<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Job;
use app\models\AuthAssignment;
use app\models\AuthItemChild;
use app\models\AuthItem;
use app\models\Admin;
use app\models\AuthRule;

/**
 * RuleController implements the CRUD actions for AuthRule model.
 */
class AuthItemChildController extends MyController
{
    public $layout=false;
    public function actionIndex(){
    	$model=new AuthItemChild;
    	$arr=$model->getList();
    	return $this->render('index.html',['parent'=>$arr]);
    }
    public function actionDelete(){
    	$parents=Yii::$app->request->post();
	    $model=new AuthItemChild();
	    if($model->getDel($parents['parents'])){
	        return 1;
	    }else{
	        return 0;
	    }
    }
    public function actionAdd()
    {
    	if (Yii::$app->request->isGet) {
        	$get=Yii::$app->request->get();
        	$data['name']=$get['item_name_'];
        	$data['type']=1;
        	$AuthItemModel=new AuthItem;
  		    $res=$AuthItemModel->getAdd($data);
  		    if($res){
                $model=new AuthItemChild;
                $date['parent']=$get['item_name_'];
                $date['child']='index/index';
                $res=$model->getAdd($date);
                if($res){
                    return $this->redirect(['index']);die;
                }else{

                }
            }else{

            }
        	
        }
    	$model=new AuthItemChild;
    	$roleList=$model->getList();
      return $this->render('add.html',['roleList'=>$roleList]);
    }
}