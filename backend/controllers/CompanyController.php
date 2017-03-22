<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Company;
use backend\models\AuditReason;
use backend\models\Jobs;
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
         $now_time=time();
         $addtime=$time*24*3600;
         $where.=" and $now_time-lg_company.addtime<=$addtime";
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
        if($audit==3){
            $time=time();
            $data=array('company_id'=>$id,'reason'=>$reason,'addtime'=>$time);
            $mod=new AuditReason;
            $mod->add($data);
        }

        $res=$model->setAudit($id,"audit",$audit);
       if($res){
          $msg="操作成功";
       }else{
          $msg="操作失败";
       }
        return $this->render('../result/result.html',array(
            'message'=>$msg,
            'links'=>array(
                array('上一操作',"company/company-list"),
            ),
        ));
    }
    //删除企业
    public function actionDelCompany()
    {
        $id=Yii::$app->request->get("id");
        $del_jobs=Yii::$app->request->get("del_jobs");
        $model=new Company;
        $res= $model->del($id);
        if($res){
            $msg="操作成功";
        }else{
            $msg="操作失败";
        }
        return $this->render('../result/result.html',array(
            'message'=>$msg,
            'links'=>array(
                array('上一操作',"company/company-list"),
            ),
        ));
    }

}