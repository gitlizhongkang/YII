<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Admin;
use yii\helpers\Url;


class LoginController extends Controller
{
	public $layout=false;
	//登录页面
	public function actionIndex(){
		return $this->renderpartial('login.html');		
	}
	//登录验证
	public function actionLogin(){
		$session=Yii::$app->session;
		$code=$session->get('code');
		$admin_name=Yii::$app->request->post('admin_name');
		$pwd=md5(Yii::$app->request->post('pwd'));
		$CheckCode=Yii::$app->request->post('CheckCode');
		if($CheckCode==$code){
			$model=new Admin;		
		    if($arr=$model->checkLogin($admin_name,$pwd)){
		    	$session->set('admin_name',$admin_name);
		    	$session->set('admin_id',$arr['admin_id']);
		    	$session->remove('code');
		    	return $this->redirect(['index/index']);
		    }else{
		    	echo "<script>alert('用户名或密码不正确');location.href='".Url::to(['login/index'])."'</script>";
		    }	 
		}else{
			echo "<script>alert('验证码不正确');location.href='".Url::to(['login/index'])."'</script>";
		}		
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
	public function actionLogout(){
		$session=Yii::$app->session;
		$session->remove('admin_name');
		$session->remove('admin_id');
		return $this->redirect(['login/index']);
	}
}