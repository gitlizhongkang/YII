<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Members;
use backend\models\User;
use backend\models\Userinfo;

class RegisterController extends Controller
{
	public $layout=false;
	public function actionIndex(){
		if(Yii::$app->request->isPost){
			$arr=Yii::$app->request->post();
			$data['email']=$arr['email'];
			$data['password']=Yii::$app->security->generatePasswordHash($arr['password']);
			if($arr['type']==0){
				$data['last_login_time']=time();
				$data['last_login_ip']=$_SERVER['REMOTE_ADDR'];
				$user=new User;
				$uid=$user->add($arr);
			}elseif($arr['type']==1){
				$data['reg_time']=time();
				$data['reg_ip']=$_SERVER['REMOTE_ADDR'];
				$members=new Members;
				$uid=$members->add($data);
			}
			$info['email']=$arr['email'];
			$info['uid']=$arr['uid'];
			$session=Yii::$app->session;
			$session->set('uid',$info);
			return $this->redirect(['/index/index']);
		}else{
			return $this->render('register.html');
		}		
	}
}