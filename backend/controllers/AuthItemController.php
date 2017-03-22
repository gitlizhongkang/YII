<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\AuthAssignment;
use app\models\AuthItemChild;
use app\models\AuthItem;
use app\models\Admin;
/**
 * RuleController implements the CRUD actions for AuthRule model.
 */
class AuthItemController extends Controller
{
	public $layout=false;
    public function actionIndex(){
    	$model=new AuthItem;
    	$arr=$model->getList();
    	$get=Yii::$app->request->get();
        $parent=$get['parent'];
        $ItemChild=new AuthItemChild;
        $getRows=$ItemChild->getRows($parent);
        foreach ($getRows as $key => $value) {
        	$newRow[]=$getRows[$key]['child'];
        }
        foreach ($arr as $key => $value) {
    		if($arr[$key]['group']==$value['group']){
    			if(in_array($arr[$key]['name'],$newRow)){
        		$arr[$key]['status']=1;
	        	}else{
	        		$arr[$key]['status']=0;
	        	}
	        	$value=$arr[$key];
    			$group[$arr[$key]['group']][]=$value;
    		}    		
    	}
    	return $this->render('index.html',['group'=>$group,'parent'=>$parent]);
    }
    public function actionAdd(){
        $post=Yii::$app->request->post();
        $parent=$post['parent'];
        foreach ($post['child'] as $key => $value) {
            $powers[$key][]=$post['parent'];
            $powers[$key][]=$post['child'][$key];
        }
        $model=new AuthItemChild;
        $arr=$model->getAddAll($powers,$parent);
        if($arr){
            $msg="修改成功";
       }else{
          $msg="修改失败";
       }
        return $this->render('../result/result.html',array(
            'message'=>$msg,
            'links'=>array(
                array('上一操作',"auth-item-child/index"),
            ),
        ));
    }
}