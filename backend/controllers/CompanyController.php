<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Company;
use app\models\Job;
use yii\data\Pagination;

class CompanyController extends Controller
{
   public $layout=false;
   //企业列表
   public function actionCompanyList()
   {

     $model=new Company;
     $companyList=$model->getList();
     return $this->render("company_list.html",['companyList'=>$companyList['list'],'pages'=>$companyList['pages'],]);
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