<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Company;
use app\models\AuditReason;
use app\models\Jobs;
use yii\data\Pagination;

class JobsController extends Controller
{
    public $layout=false;
    public function actionJobsList()
    {
        $audit=Yii::$app->request->get("audit","");
        $time=Yii::$app->request->get("time","");
        $dead=Yii::$app->request->get("dead","");
        $where="1=1";
        if($audit!=''){
            $where.=" and audit=$audit";
        }
        if($time!=''){
            $addtime=time()-$time*24*3600;
            $where.=" and now()-addtime<=$addtime";
        }
        if($dead!=''){
            $dead=time()-$time*24*3600;
            $where.=" and now()-setmeal_deadline<=$dead";
        }
        $model=new Jobs;
        $jobsList=$model->getList($where);
        return $this->render("jobs_list.html",['jobsList'=>$jobsList['list'],'pages'=>$jobsList['pages'],'audit'=>$audit,'time'=>$time,'dead'=>$dead]);
    }
    //审核职位
    public function actionSetAudit()
    {
        $audit=Yii::$app->request->get("audit");
        $id=Yii::$app->request->get("id");
        $reason=Yii::$app->request->get("reason");
        $model=new Jobs;
        if($audit==3){
            $time=time();
            $data=array('jobs_id'=>$id,'reason'=>$reason,'addtime'=>$time);
            $mod=new AuditReason;
            $mod->add($data);
        }
        $sql="update lg_jobs set audit=$audit where id=$id";
        $res=\Yii::$app->db->createCommand($sql)->query();
        if($res){
            $msg="操作成功";
        }else{
            $msg="操作失败";
        }
        return $this->render('../result/result.html',array(
            'message'=>$msg,
            'links'=>array(
                array('上一操作',"jobs/jobs-list"),
            ),
        ));
    }
    //删除企业
    public function actionDelJobs()
    {
        $id=Yii::$app->request->get("id");
        $del_jobs=Yii::$app->request->get("del_jobs");
        $model=new Jobs;
        $res= $model->del($id);
        if($res){
            $msg="操作成功";
        }else{
            $msg="操作失败";
        }
        return $this->render('../result/result.html',array(
            'message'=>$msg,
            'links'=>array(
                array('上一操作',"jobs/jobs-list"),
            ),
        ));
    }
}