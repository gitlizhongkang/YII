<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Ad;
use common\models\Jobs;
use common\models\Hots;
use common\models\Category;

class ListController extends Controller
{
	public $layout='/header';
	public function actionIndex(){	
		$JoBModel=new jobs;
		if($arr=Yii::$app->request->get()){
			// Array ( [r] => list/index [kw] => 前端开发 [dq] => 上海 ) 
			// http://www.frontend.com/web/index.php?r=list&yx=1000~1500%E5%85%83/%E6%9C%88&gj=%E6%97%A0%E7%BB%8F%E9%AA%8C&xl=%E5%88%9D%E4%B8%AD&gx=%E5%85%A8%E8%81%8C
			$kw=isset($arr['kw'])?$arr['kw']:"";
			$fs=isset($arr['fs'])?$arr['fs']:"";
			$yx=isset($arr['yx'])?$arr['yx']:"";
			$gj=isset($arr['gj'])?$arr['gj']:"";
			$xl=isset($arr['xl'])?$arr['xl']:"";
			$gx=isset($arr['gx'])?$arr['gx']:"";
			$sj=isset($arr['sj'])?$arr['sj']:"";
			$dq=isset($arr['dq'])?$arr['dq']:"全国";
			$dateStr = date('Y-m-d', time());
			$time = strtotime($dateStr);  
			$where="1=1 and deadline > $time";
			//搜索方式
			if($kw==""){
				$where.="";
			}else{
				if($fs=="公司"){
					$where.=" and companyname like '%$kw%'";
				}else{
					$where.=" and jobs_name like '%$kw%'";
				}
			}
			//地区
			if($dq=="全国"){
				$where.="";
			}else{
				$where.=" and district_cn = '$dq'";
			}
			//月薪
			if($yx==""){
				$where.="";
			}else{
				$where.=" and wage_cn = '$yx'";
			}
			//工作经验
			if($gj==""){
				$where.="";
			}else{
				$where.=" and experience_cn = '$gj'";
			}
			//最低学历
			if($xl==""){
				$where.="";
			}else{
				$where.=" and education_id >= '$xl'";
			}
			//工作性质
			if($gx==""){
				$where.="";
			}else{
				$where.=" and nature_cn = '$gx'";
			}
			//时间
			if($sj == "今天"){
				$where.=" and addtime > $time";
			}else if($sj == "3天内"){
				$where.=" and addtime > $time-3600*24*2";
			}else if($sj == "一周内"){
				$where.=" and addtime > $time-3600*24*6";
			}else if($sj == "一月内"){
				$where.=" and addtime > ($time-3600*24*29)";
			}else{
				$where.="";
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
			$CateModel=new Category;
			$cate=$CateModel->getList();
			// print_r($cate);die;
			$date['QS_wage']=$CateModel->getArray($cate[13]['c_alias']);
			$date['QS_jobs_nature']=$CateModel->getArray($cate[4]['c_alias']);
			$date['QS_education']=$CateModel->getArray($cate[2]['c_alias']);
			$date['QS_experience']=$CateModel->getArray($cate[3]['c_alias']);
			// print_r($date);die;
			return $this->render('list.html',['data'=>$jobs,'dq'=>$dq,'hots'=>$Hots,'jobsList'=>$jobs['list'],'pages'=>$jobs['pages'],'date'=>$date]);
		}
	}

}