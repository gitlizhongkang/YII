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
	//前台jobs页面
	public $layout='/header';
	public function actionIndex(){	
		$JoBModel=new jobs;
		if($arr=Yii::$app->request->get()){
			$zf=isset($arr['zf'])?$arr['zf']:"";//职位分类
			$zw=isset($arr['zw'])?$arr['zw']:"";//职位
			$kw=isset($arr['kw'])?$arr['kw']:"";
			$fs=isset($arr['fs'])?$arr['fs']:"";
			$yx=isset($arr['yx'])?$arr['yx']:"";
			$gj=isset($arr['gj'])?$arr['gj']:"";
			$xl=isset($arr['xl'])?$arr['xl']:"";
			$gx=isset($arr['gx'])?$arr['gx']:"";
			$sj=isset($arr['sj'])?$arr['sj']:"";
			$dq=isset($arr['dq'])?$arr['dq']:"全国";
			if($dq==""){$dq="全国";}
			$dateStr = date('Y-m-d', time());
			$time = strtotime($dateStr);  
			$where="1=1 and audit = 2 and deadline > $time";
			//职位
			if($zw==""){
				$where.="";
			}else{
				$where.=" and jobs_name = '$zw'";
			}
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
			//职位分类
			if($zf==""){
				$where.="";
			}else{
				$where.=" and category_cn = '$zf'";
			}
			//地区
			if($dq=="全国"){
				$where.="";
			}else{
				$where.=" and district_cn like '%$dq%'";
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
			$where.=" order by addtime desc";
			// print_r($where);die;
			$jobs=$JoBModel->getAll($where);
			$HotsModel=new Hots;
			$HotsWhere="way = '$fs' and words = '$kw'";
			$HotsOne=$HotsModel->GetOne($HotsWhere);
			if($HotsOne){
				$SetHots=$HotsModel->setAudit($HotsOne['id'],'num',$HotsOne['num']+1);
			}else{
				$date['words']=$kw;
				$date['way']=$fs;
				$date['num']=1;
				$AddHots=$HotsModel->getAdd($date);
			}
			//热搜
			$Hots=$HotsModel->GetRankList();
			$CateModel=new Category;
			$cate=$CateModel->getList();
			$date['QS_wage']=$CateModel->getArray($cate[13]['c_alias']);
			$date['QS_jobs_nature']=$CateModel->getArray($cate[4]['c_alias']);
			$date['QS_education']=$CateModel->getArray($cate[2]['c_alias']);
			$date['QS_experience']=$CateModel->getArray($cate[3]['c_alias']);
			return $this->render('list.html',['data'=>$jobs,'dq'=>$dq,'hots'=>$Hots,'jobsList'=>$jobs['list'],'pages'=>$jobs['pages'],'date'=>$date]);
		}
	}

}