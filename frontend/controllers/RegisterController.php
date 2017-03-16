<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Members;

class RegisterController extends Controller
{
	public $layout=false;
	public function actionIndex(){
		print_r(Yii::$app->getRequest()->getQueryParam('id'));die;

		if(Yii::$app->request->isPost){
			$arr=Yii::$app->request->post();
			$data['email']=$arr['email'];
			$data['password']=Yii::$app->security->generatePasswordHash($arr['password']);
			$data['reg_time']=time();
			$data['reg_ip']=$_SERVER['REMOTE_ADDR'];
			if($arr['type']==0){

			}elseif($arr['type']==1){
				$members=new Members;
				$members->add($data);
			}
		}else{
			return $this->render('register.html');
		}		
	}
}