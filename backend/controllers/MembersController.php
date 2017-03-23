<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Company;
use backend\models\Jobs;
use backend\models\Members;
use backend\models\Members_charge_log;
use yii\data\Pagination;

class MembersController extends Controller
{
    public $layout=false;
    public function init(){
        $this->enableCsrfValidation = false;
    }
    //会员列表
    public function actionMembersList()
    {
        $time=Yii::$app->request->get("time");
        $where="1=1";
        if($time!=''){
            $now_time=time();
            $addtime=$time*24*3600;
            $where.=" and $now_time-lg_members.reg_time<=$addtime";
        }
        $model=new Members;
        $membersList=$model->getList($where);
        return $this->render("members_list.html",['membersList'=>$membersList['list'],'pages'=>$membersList['pages'],'time'=>$time]);
    }
    //删除会员
    public function actionDelMembers()
    {
        $id=Yii::$app->request->get("id");
        $del_company=Yii::$app->request->get("del_company");
        $del_jobs=Yii::$app->request->get("del_jobs");
        if($del_company==1){
            $model1=new Company;
            $model1->udel($id);
        }
        if($del_jobs==1){
            $model2=new Jobs;
            $model2->udel($id);
        }
        $model3=new Members;
        $res= $model3->del($id);
        if($res){
            $msg="操作成功";
        }else{
            $msg="操作失败";
        }
        return $this->render('../result/result.html',array(
            'message'=>$msg,
            'links'=>array(
                array('上一操作',"members/members-list"),
            ),
        ));
    }
    //会员添加

    //会员修改

    //充值记录
    public function actionMembersPay()
    {
        $id=Yii::$app->request->get("id");
        $model=new Members_charge_log;
        $list=$model->get_one($id);
        print_r($list);die;
    }
}