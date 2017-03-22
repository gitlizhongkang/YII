<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Resume;
use backend\models\Jobs;
use app\models\ResumeJob;

class TouController extends Controller
{
	public $layout=false;
	public function actionIndex(){
		$session=\Yii::$app->session;
		$user=$session->get('user');
		$id=Yii::$app->request->get('id');
		$jobs=new Jobs;
		$arr=$jobs->getOne(1);
		$resume=new Resume;
		$info=$resume->select($user['uid']);
		$controller=Yii::$app->controller->id;
		return $this->render('toudi.html',['jobs'=>$arr,'resume'=>$info,'user'=>$user,'controller'=>$controller]);
	}
	public function actionTou(){
		$arr=Yii::$app->request->get();
		unset($arr['r']);
		$resumeJob=new ResumeJob;
		$aa=$resumeJob->selectOne($arr['job_id'],$arr['resume_id']);
		// print_r($aa);die;
		if(!empty($aa)){
			echo 2;
		}else{
			if($resumeJob->add($arr)){
				echo 1;
			}else{
				print_r($resumeJob->errors);
			}
		}		
	}
}