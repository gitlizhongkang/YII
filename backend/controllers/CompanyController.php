<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Company;
use app\models\AuditReason;
use app\models\Job;
use yii\data\Pagination;

class CompanyController extends Controller
{
   public $layout=false;
   //企业列表
   public function actionCompanyList()
   {
     $audit=Yii::$app->request->get("audit","");
     $time=Yii::$app->request->get("time","");
     $where="1=1";
     if($audit!=''){
         $where.=" and audit=$audit";
     }
     if($time!=''){
         $addtime=time()-$time*24*3600;
         $where.=" and now()-addtime<=$addtime";
     }
     $model=new Company;
     $companyList=$model->getList($where);
     return $this->render("company_list.html",['companyList'=>$companyList['list'],'pages'=>$companyList['pages'],'audit'=>$audit,'time'=>$time]);
   }
   //认证企业
    public function actionSetAudit()
    {
        $audit=Yii::$app->request->get("audit");
        $id=Yii::$app->request->get("id");
        $reason=Yii::$app->request->get("reason");
        $model=new Company;
        $res=$model->setAudit($id,$audit);
       if($res){
           $msg=1;
       }else{
           $msg=2;
       }
       if($audit==3){
           $time=time();
           $data=array('company_id'=>$id,'reason'=>$reason,'addtime'=>$time);
           $mod=new AuditReason;
           $mod->add($data);
           $msg=1;
       }
       echo $msg;

    }
  //职位列表
   public function actionJobList()
   {
   	 echo 1;die;
   }
  //订单管理
   public function actionOrderManage()
   {
   	 echo 1;die;
   }
  //企业推广
   public function actionCompanySpread()
   {
   	echo 1;die;
   }
}