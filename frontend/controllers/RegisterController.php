<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Members;
use backend\models\User;
use yii\helpers\Url;

class RegisterController extends Controller
{
	public $layout=false;
	//注册页面
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
				// $data['points']=100;
				$members=new Members;
				$uid=$members->add($data);
			}
			$info['email']=$arr['email'];
			$info['uid']=$uid;
			$session=Yii::$app->session;
			$session->set('uid',$info);
			return $this->redirect(['/index/index']);
		}else{
			return $this->render('register.html');
		}		
	}
	//验证邮箱的唯一性
	public function actionCheckEmail(){
		$email=Yii::$app->request->get('email');
		$user=new User;
		$res1=$user->checkEmail($email);
		$members=new Members;
		$res2=$members->checkEmail($email);
		if(!empty($res1)||!empty($res2)){
			echo 1;
		}else{
			echo 0;
		}
	}
	public function actionLogin(){
		if(Yii::$app->request->isPost){
			$email=Yii::$app->request->post('email');
			$pwd=Yii::$app->request->post('password');		
			$user=new User;
			$res1=$user->checkEmail($email);				
			$members=new Members;
			$res2=$members->checkEmail($email);
			if(!empty($res1)||!empty($res2)){
				if(!empty($res1)){
					$pwd=Yii::$app->security->validatePassword($pwd,$res1['password']);
				}elseif(!empty($res2)){
					$pwd=Yii::$app->security->validatePassword($pwd,$res2['password']);
				}				
				if(!$pwd){
					echo '<script>alert("密码错误");location.href="'.Url::to(['register/login']).'"</script>';
				}else{
					echo '<script>alert("登录成功");location.href="'.Url::to(['index/index']).'"</script>';
				}
			}else{
					echo '<script>alert("用户名不存在");location.href="'.Url::to(['register/login']).'"</script>';
			}			
		}else{
			return $this->render('login.html');
		}		
	}
}