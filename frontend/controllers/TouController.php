<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Resume;
use backend\models\Jobs;
use app\models\ResumeJob;
use common\models\UserInfo;
use backend\models\Company;

class TouController extends Controller
{
	public $layout=false;
	public function actionIndex(){
		$session=\Yii::$app->session;
		$user=$session->get('user');
		if(empty($user)){
			return $this->redirect(['register/login']);
		}
		$uid=$user['uid'];
		$id=Yii::$app->request->get('id');
		$jobs=new Jobs;
		$arr=$jobs->getOne($id);
		$place=explode('/',$arr['district_cn']);
		$arr['city']=$place[1];	
		$company_id=$arr['company_id'];
		$aa=Company::find()->select('logo')->where(['id'=>$company_id])->asArray()->one();
		$logo=$aa['logo'];
		$resume=new Resume;
		$info=$resume->select($user['uid']);
		$controller=Yii::$app->controller->id;
		$res=UserInfo::find()->where(['user_id'=>$uid])->asArray()->one();
		$collect=explode(',',$res['collect']);
		return $this->render('toudi.html',['jobs'=>$arr,'resume'=>$info,'user'=>$user,'controller'=>$controller,'collect'=>$collect,'logo'=>$logo,'type'=>$user['type']]);
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
	public function actionCollection(){
		$id=Yii::$app->request->post('job_id');
		$type=Yii::$app->request->post('type');
		$session=\Yii::$app->session;
		$user=$session->get('user');
		if(empty($user)){
			return 2;
		}else{
			$uid=$user['uid'];
			// $model=new UserInfo;
			$arr=UserInfo::find()->where(['user_id'=>$uid])->one();
			if($type==1){
				if($arr->collect==''){
					$arr->collect=$id;
				}else{
					$arr->collect=$arr->collect.','.$id;			
				}
				
			}elseif($type==0){
				$collect=explode(',',$arr->collect);
				foreach ($collect as $k => $v) {
					if($v==$id){
						unset($collect[$k]);
					}
				}
				$arr->collect=implode(',',$collect);
			}
			if($arr->save()){
				return 1;
			}else{
				return 0;
			}		
		}		
	}
}