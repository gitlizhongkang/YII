<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Ad;
use common\models\Jobs;
use common\models\Hots;

class ListController extends Controller
{
	public $layout='/header';
	public function actionIndex(){		
		$JoBModel=new jobs;
		if($arr=Yii::$app->request->get()){
			// Array ( [r] => list/index [kw] => 前端开发 [dq] => 上海 ) 
			$kw=isset($arr['kw'])?$arr['kw']:"";
			$fs=isset($arr['fs'])?$arr['fs']:"";
			$dq=isset($arr['dq'])?$arr['dq']:"全国";
			$where="1=1";
			if($kw==""){
				$where.="";
			}else{
				if($fs=="公司"){
					$where.=" and companyname like '%$kw%'";
				}else{
					$where.=" and jobs_name like '%$kw%'";
				}
			}
			if($dq=="全国"){
				$where.="";
			}else{
				$where.=" and district_cn = '$dq'";
			}
			$jobs=$JoBModel->getAll($where);
			// print_r($where);die;
			$HotsModel=new Hots;
			$HotsWhere="way = '$fs' and words = '$kw'";
			$HotsOne=$HotsModel->GetOne($HotsWhere);
			// print_r($HotsOne);die;
			if($HotsOne){
				$SetHots=$HotsModel->setAudit($HotsOne['id'],'num',$HotsOne['num']+1);
			}else{
				$date['words']=$kw;
				$date['way']=$fs;
				$date['num']=1;
				$AddHots=$HotsModel->getAdd($date);
			}
			$Hots=$HotsModel->GetRankList();
			// print_r($jobs);die;
			return $this->render('list.html',['data'=>$jobs,'dq'=>$dq,'hots'=>$Hots,'jobsList'=>$jobs['list'],'pages'=>$jobs['pages']]);
		}
	}

}