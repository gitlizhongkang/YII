<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Members;
use common\models\User;
use common\models\UserInfo;
use yii\helpers\Url;
use backend\models\Members_charge_log;

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
				$uid=$user->add($data);
				//添加个人用户
				$userInfo=new UserInfo;
				$info['user_id']=$uid;
				$info['reg_time']=time();
				$aa=$userInfo->add($info);
				//添加用户详细信息				
			}elseif($arr['type']==1){
				$data['reg_time']=time();
				$data['reg_ip']=$_SERVER['REMOTE_ADDR'];
				$data['points']=100;
				$members=new Members;
				$uid=$members->add($data);
				//添加企业用户
				$log=new Members_charge_log;
				$logs['log_value']='注册会员系统自动赠送：(+100),(剩余:100)';
				$logs['log_uid']=$uid;
				$logs['log_username']=$arr['email'];
				$logs['log_addtime']=time();
				$logs['log_amount']=0;
				$aa=$log->add($logs);
				//添加日志
			}			
			if($uid){
				$info['email']=$arr['email'];
				$info['uid']=$uid;
				$info['type']=$arr['type'];
				$session=Yii::$app->session;
				$session->set('user',$info);
				return $this->redirect(['index/index']);
			}else{
				echo '<script>alert("注册失败");location.href="'.Url::to(['register/index']).'"</script>';
			}
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
	//登录页面
	public function actionLogin(){
		$controller=isset($_GET['controller'])?$_GET['controller']:'';
		// echo $controller;die;		
		if(Yii::$app->request->isPost){		
			$session=Yii::$app->session;
			$code=$session->get('code');	
			$email=Yii::$app->request->post('email');
			$pwd=Yii::$app->request->post('password');
			$auto=Yii::$app->request->post('autoLogin');
			$checkCode=Yii::$app->request->post('code');
			if($checkCode==$code){
				$user=new User;
				$res1=$user->checkEmail($email);
				//验证邮箱				
				$members=new Members;
				$res2=$members->checkEmail($email);
				if(!empty($res1)||!empty($res2)){
					if(!empty($res1)){
						$pwd=Yii::$app->security->validatePassword($pwd,$res1['password']);
						//验证密码
						$info['uid']=$res1['id'];
						$info['type']=0;
						$data['last_login_time']=time();
						$data['last_login_ip']=$_SERVER['REMOTE_ADDR'];	
						$user->updateOne($res1['id'],$data);				
					}elseif(!empty($res2)){
						$pwd=Yii::$app->security->validatePassword($pwd,$res2['password']);
						$info['uid']=$res2['uid'];
						$info['type']=1;
						if(empty($res2['last_login_ip'])){
							$log=new Members_charge_log;
							$logs['log_value']='首次登录自动赠送：(+5)';
							$logs['log_uid']=$res2['uid'];
							$logs['log_username']=$email;
							$logs['log_addtime']=time();
							$logs['log_amount']=0;
							$aa=$log->add($logs);
							//添加日志
							$data['last_login_time']=time();
							$data['last_login_ip']=$_SERVER['REMOTE_ADDR'];	
							$data['points']=$res2['points']+5;
							$members->updateOne($res2['uid'],$data);
							//修改积分
						}
					}				
					if(!$pwd){
						echo '<script>alert("密码错误");location.href="'.Url::to(['register/login']).'"</script>';
					}else{					
						$info['email']=$email;
						$lifetime=3*24*60*60;
						session_set_cookie_params($lifetime);
						$session=Yii::$app->session;
						$session->open();
						$session->setTimeout($lifetime);
						$session->set('user',$info);
						//存储用户信息
						if(!empty($controller)){
							return $this->redirect(["$controller/index"]);
						}else{
							return $this->redirect(["index/index"]);
						}					
					}
				}else{
						echo '<script>alert("用户名不存在");location.href="'.Url::to(['register/login']).'"</script>';
				}
			}else{
				echo '<script>alert("验证码错误");location.href="'.Url::to(['register/login']).'"</script>';
			}								
		}else{
			return $this->render('login.html');
		}		
	}
	//退出
	public function actionLogout(){
		$session=Yii::$app->session;
		$session->remove('user');
		return $this->redirect(['register/login']);
	}
	//生成验证码
	public function actionCode(){
		$image=imagecreatetruecolor(100, 30);
		$bgcolor=imagecolorallocate($image,255,255,255);
		imagefill($image,0,0,$bgcolor);
		$captch_code='';
		for($i=0;$i<4;$i++){
			$fontsize=20;
			$fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
			$data='abcdefghijklmnpqrstuvwxyz123456789';
			$fontcontent=substr($data,rand(0,strlen($data)),1);
			$captch_code.=$fontcontent;
			$x=($i*100/4)+rand(5,10);
			$y=rand(5,10);
			imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
		}
		$session=Yii::$app->session;
		$session->set('code',$captch_code);
		// $_SESSION['code']=$captch_code;
		// echo $_SESSION['code'];
		//加点干扰
		for($i=0;$i<200;$i++){
			$pointcolor=imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));
			imagesetpixel($image, rand(1,99), rand(1,99), $pointcolor);
		}
		//加线干扰
		for($i=0;$i<3;$i++){
			$linecolor=imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
			imageline($image, rand(1,99), rand(1,29), rand(1,99),rand(1,29),$linecolor);
		}
		header('content-type:image/png');
		imagepng($image);
	}
	//重置密码
	public function actionReset(){
		return $this->render('reset.html');
	}
	//发送邮件
	public function actionFind(){
		$email=Yii::$app->request->get('email');
		$user=new User;
		$res1=$user->checkEmail($email);
		$members=new Members;
		$res2=$members->checkEmail($email);
		if(empty($res1)&&empty($res2)){
			echo 0;
		}else{			
			$mailer = new \yii\swiftmailer\Mailer();
	        $mailer->transport=[
	            'class' => 'Swift_SmtpTransport',
	            'host' => 'smtp.163.com',
	            'username' => 'mhrmaohongrui@163.com',
	            'password' => 'mhr553421',
	            'port' => '25',
	            'encryption' => 'tls',//    tls | ssl
	        ];
	        $mailer->messageConfig=[
	            'charset'=>'UTF-8',
	            'from'=>['mhrmaohongrui@163.com'=>'admin']
	        ];
	        $mailer->useFileTransport = false;
	        $code=time().rand(1000,9999);
	        $mail= $mailer->compose('mail',['code'=>$code]);
	        $mail->setTo($email);
	        $mail->setSubject("重置密码");
	        $mail->setTextBody('');
	        if($mail->send()){
	        	//code入库
	        	$info['code_time']=time();
	        	$info['code']=$code;
	        	if(!empty($res1)){
	        		$id=$res1['id'];	        		
					$aa=$user->updateOne($id,$info);				
				}elseif(!empty($res2)){
					$uid=$res2['uid'];
					$aa=$members->updateOne($uid,$info);
				}
	        	if($aa){
	        		echo 1;
	        	}
	        }else{
	        	echo 2;
	        }
		}        
	}
	//重置密码修改页面
	public function actionUpdatePwd(){
		$code=Yii::$app->request->get('code');
		$user=new User;
		$res1=$user->checkCode($code);
		$time=time();
		if(!empty($res1)){
			if(($time-$res1['code_time'])>24*60*60){
				echo '您的验证已经过期！！！点击<a href="'.Url::to(['register/reset']).'">重新发送邮件</a>';
			}else{
				$data['uid']=$res1['id'];
				$data['utype']='0';	
				return $this->render('resetPwd.html',$data);
			}					
		}else{
			$members=new Members;
			$res2=$members->checkCode($code);
			if(!empty($res2)){
				if(($time-$res2['code_time'])>24*60*60){
					echo '您的验证已经过期！！！点击<a href="'.Url::to(['register/reset']).'">重新发送邮件</a>';
				}else{
					$data['uid']=$res2['uid'];
					$data['utype']='1';	
					return $this->render('resetPwd.html',$data);
				}	
			}else{
				echo '您的验证无效！！！点击<a href="'.Url::to(['register/reset']).'">重新发送邮件</a>';
			}
		}		
	}
	//修改密码
	public function actionUpdatePwdDo(){
		$arr=Yii::$app->request->get();
		$id=$arr['uid'];
		$info['password']=Yii::$app->security->generatePasswordHash($arr['pwd']);
		$info['code']='';
		$info['code_time']='';
		if($arr['utype']==0){
			$user=new User;
			$aa=$user->updateOne($id,$info);
		}elseif($arr['utype']==1){
			$members=new Members;
			$aa=$members->updateOne($id,$info);
		}
		if($aa){
			echo 1;
		}else{
			echo 0;
		}
	}
}