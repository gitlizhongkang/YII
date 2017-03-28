<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Ad;
use common\models\JobsCategory;
use common\models\Category;
use common\models\District;
use backend\models\Company;
use backend\models\Jobs;
use backend\models\Members;
use backend\models\Members_charge_log;
use app\models\ResumeJob;
use yii\data\Pagination;
use yii\helpers\Url;

class JobController extends Controller
{
	public $layout='left';
	//验证是否登录
	public function beforeAction(){
		$session=Yii::$app->session;
		$user=$session->get('user');
		if(!empty($user)){
			return true;			
		}else{
			return $this->redirect(['register/login']);
		}
	}
	//发布职位
	public function actionIndex(){
		$session=Yii::$app->session;
		$user=$session->get('user');
		$id=$user['uid'];
		$job=new Jobs;
		$count=$job->jobCount($id);
		if(Yii::$app->request->isPost){
			$members= new Members;
			$point=$members->getPoint($id);
			if($point['points']<10){
				return $this->render('success.html',['count'=>$count,'type'=>4]);
				//积分不足
			}else{
				if($count<5){
				$arr=Yii::$app->request->post();
				$arr['tag_cn']=implode(',',$arr['tag_cn']);
				$arr['require']=implode(',',$arr['require']);
				$arr['district_cn']=$arr['province'].'/'.$arr['city'].'/'.$arr['place'];
				$arr['age']=$arr['age1'].'-'.$arr['age2'];
				unset($arr['province'],$arr['city'],$arr['place'],$arr['age1'],$arr['age2']);
				$arr['u_id']=$id;
				$arr['addtime']=time();
				$arr['deadline']=time()+30*24*60*60;
				$company=new company;
				$info=$company->get($id);
				$arr['companyname']=$info['companyname'];
				$arr['company_id']=$info['id'];
				$arr['company_addtime']=$info['addtime'];
				$arr['company_audit']=$info['audit'];
				$arr['trade_cn']=$info['trade'];
				$arr['scale_cn']=$info['scale'];
				$arr['street_cn']=$info['street'];
				$aa=$job->add($arr);
				//添加职位				
				if($aa){
					$count1=$count+1;
					$log=new Members_charge_log;
					$logs['log_value']='发布职位扣除：(-10)';
					$logs['log_uid']=$id;
					$logs['log_username']=$user['email'];
					$logs['log_addtime']=time();
					$logs['log_amount']=0;
					$aa=$log->add($logs);
					//添加日志					
					$members->updatePoint($id);
					//修改积分					
					return $this->render('success.html',['count'=>$count1,'type'=>1]);
					//发布职位成功
				}else{
					return $this->render('success.html',['count'=>$count1,'type'=>3]);
				}								
			}else{				
					return $this->render('success.html',['count'=>$count,'type'=>2]);
					//已达上线
				}				
			}						
		}else{
			$cache=Yii::$app->cache;
			if(!empty($cache->get('data'))){
				$data=$cache->get('data');

			}else{
				$category=new category;
				$data['nature']=$category->cate('QS_jobs_nature');
				$data['education']=$category->cate('QS_education');
				$data['wage']=$category->cate('QS_wage');
				$data['experience']=$category->cate('QS_experience');
				$data['tag']=$category->cate('QS_jobtag');
				$data['require']=$category->cate('QS_resumetag');
				$jobCate=new JobsCategory;
				$data['cate']=$jobCate->select1();
				$district=new District;
				$data['area']=$district->parent();
				$info=$data;
				unset($info['count']);
				$cache->set('data',$info);
			}
			$data['count']=$count;
			return $this->render('create.html',$data);
		}
		
	}
	//城市联动
	public function actionDistrict(){
		$parentid=Yii::$app->request->post('parentid');
		$district=new District;
		$area=$district->child($parentid);
		// print_r($area);die;
		echo json_encode($area);
	}
	//职位列表
	public function actionJob(){
		$session=Yii::$app->session;
		$user=$session->get('user');
		$id=$user['uid'];
		// echo $id;die;
		$job=new Jobs;
		$time=time();
		$where="1=1 and u_id=$id";
		$type=Yii::$app->request->get('type');
		if($type==1){
			$where.=" and deadline>=$time";
		}elseif($type==2){
			$where.=" and deadline<$time";
		}		
		$arr=$job->getList($where);
		$count=$job->getCount($where);
		$company=new company;
		$info=$company->get($id);
		$resumeJob=new ResumeJob;
		$resume=$resumeJob->groupJob($info['id']);
		foreach ($arr['list'] as $k => $v) {
			foreach ($resume as $k1 => $v1) {
				if($v1['job_id']==$v['id']){
					$arr['list'][$k]['count']=$v1["count('id')"];
				}else{
					$arr['list'][$k]['count']='0';
				}
			}			
		}
		// print_r($arr['list']);die;
		return $this->render('positions.html',['arr'=>$arr,'count'=>$count,'type'=>$type]);
	}
	//删除职位
	public function actionDelete(){
		$id=Yii::$app->request->get('id');
		$res=Jobs::find()->where(['id'=>$id])->one();
		if($res->delete()){
			$sql="update lg_resume_job set status='5' where job_id=$id";
	        $connect=Yii::$app->db;
	        $command=$connect->createCommand($sql);
        	echo 1;
        }else{
        	echo 0;
        } 
	}
	//职位下线
	public function actionDown(){
		$id=Yii::$app->request->get('id');
		$time=time()-10;
		$sql="update lg_jobs set deadline='$time' where id=$id";
        $connect=Yii::$app->db;
        $command=$connect->createCommand($sql);
        if($command->execute()){
        	echo 1;
        }else{
        	echo 0;
        } 
	}
	//修改职位
	public function actionUpdate(){
		if(Yii::$app->request->isPost){
			$arr=Yii::$app->request->post();
			$arr['tag_cn']=implode(',',$arr['tag_cn']);
			$arr['require']=implode(',',$arr['require']);
			$arr['district_cn']=$arr['province'].'/'.$arr['city'].'/'.$arr['place'];
			$arr['age']=$arr['age1'].'-'.$arr['age2'];
			$id=$arr['id'];
			unset($arr['province'],$arr['city'],$arr['place'],$arr['age1'],$arr['age2'],$arr['id']);
			// print_r($arr);die;
			$job=new Jobs;
			$aa=$job->updateJob($id,$arr);
			//修改职位				
			if($aa){					
				return $this->redirect(['job/job','type'=>1]);
				//修改职位成功
			}
		}else{
			$id=Yii::$app->request->get('id');
			$arr=Jobs::find()->where(['id'=>$id])->asArray()->one();
			$arr['tag_cn']=explode(',',$arr['tag_cn']);
			$arr['require']=explode(',',$arr['require']);
			$area=explode('/',$arr['district_cn']);
			$arr['province']=$area[0];
			$arr['city']=$area[1];
			$arr['place']=$area[2];
			$age=explode('-',$arr['age']);
			$arr['age1']=$age[0];
			$arr['age2']=$age[1];
			// print_r($arr);die;
			$cache=Yii::$app->cache;
			if(!empty($cache->get('data'))){
				$data=$cache->get('data');
			}else{
				$category=new category;
				$data['nature']=$category->cate('QS_jobs_nature');
				$data['education']=$category->cate('QS_education');
				$data['wage']=$category->cate('QS_wage');
				$data['experience']=$category->cate('QS_experience');
				$data['tag']=$category->cate('QS_jobtag');
				$data['require']=$category->cate('QS_resumetag');
				$jobCate=new JobsCategory;
				$data['cate']=$jobCate->select1();
				$district=new District;
				$data['area']=$district->parent();
				$info=$data;
				unset($info['count']);
				$cache->set('data',$info);
			}
			$data['arr']=$arr;
			return $this->render('update.html',$data);
		}											
	}
}