<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use common\models\JobsCategory;
use common\models\Category;
use common\models\District;
use common\models\Resume;
use backend\models\Company;
use backend\models\Jobs;
use backend\models\Members;
use backend\models\Members_charge_log;
use app\models\ResumeJob;
use yii\data\Pagination;
use yii\helpers\Url;
class ResuController extends Controller
{
    public $layout='left';
    //验证是否登录
    public function beforeAction()
    {
        $session=Yii::$app->session;
        $user=$session->get('user');
        if(!empty($user)){
            return true;
        }else{
            return $this->redirect(['register/login']);
        }
    }
    public function actionIndex1()
    {
        $session=Yii::$app->session;
        $user=$session->get('user');
        $companyinfo=Company::find()->where(["u_id"=>$user['uid']])->asArray()->one();
        $companyid=$companyinfo['id'];
        $where="lg_resume_job.status=1 and lg_resume_job.company_id=$companyid";
        $model=new ResumeJob();
        $data['list']=$model->getList($where);
        return $this->render("index1.html",$data);
    }
    public function actionIndex2()
    {
        $session=Yii::$app->session;
        $user=$session->get('user');
        $companyinfo=Company::find()->where(["u_id"=>$user['uid']])->asArray()->one();
        $companyid=$companyinfo['id'];
        $where="lg_resume_job.status=2 and lg_resume_job.company_id=$companyid";
        $model=new ResumeJob();
        $data['list']=$model->getList($where);
        return $this->render("index2.html",$data);
    }
    public function actionIndex3()
    {
        $session=Yii::$app->session;
        $user=$session->get('user');
        $companyinfo=Company::find()->where(["u_id"=>$user['uid']])->asArray()->one();
        $companyid=$companyinfo['id'];
        $where="lg_resume_job.status=4 and lg_resume_job.company_id=$companyid";
        $model=new ResumeJob();
        $data['list']=$model->getList($where);
        return $this->render("index3.html",$data);
    }
    public function actionIndex4()
    {
        $session=Yii::$app->session;
        $user=$session->get('user');
        $companyinfo=Company::find()->where(["u_id"=>$user['uid']])->asArray()->one();
        $companyid=$companyinfo['id'];
        $where="lg_resume_job.status=3 and lg_resume_job.company_id=$companyid";
        $model=new ResumeJob();
        $data['list']=$model->getList($where);
        return $this->render("index4.html",$data);
    }
    public function actionRefuse()
    {
        $post=Yii::$app->request->post();
        $info=Resume::find()->where(['id'=>$post['deliverIds']])->asArray()->one();
        $mail = Yii::$app->mailer->compose();
        $mail->setTo($info['email']);	//接收人邮箱
        $mail->setSubject("面试回复");	//邮件标题
        $mail->setHtmlBody($post['content']);
        if ($mail->send()){
            $res=ResumeJob::find()->where(['resume_id'=>$post['deliverIds'],'u_id'=>$info['uid']])->one();
            $res->status=3;
            if($res->save()){
                $data['msg']=1;
            }else{
                $data['msg']="操作失败";
            }
        }else{
            $data['msg']="发送失败";
        }
        echo json_encode($data);
    }
    public function actionDel()
    {
        $post=Yii::$app->request->post();
        $info=Resume::find()->where("id in ($post[deliverIds])")->asArray()->all();
        $content="非常荣幸收到您的简历，在我们仔细阅读您的简历之后，却不得不很遗憾的通知您：
                    您的简历与该职位的定位有些不匹配，因此无法进入面试。
                    但您的信息已录入我司人才储备库，当有合适您的职位开放时我们将第一时间联系您，希望在未来我们有机会成为一起拼搏的同事；
                    再次感谢您对我们的信任，祝您早日找到满意的工作。";
        foreach($info as $k=>$v){
            $mail = Yii::$app->mailer->compose();
            $mail->setTo($v['email']);	//接收人邮箱
            $mail->setSubject("面试回复");	//邮件标题
            $mail->setHtmlBody($content);
            if ($mail->send()){
                $res=ResumeJob::find()->where(['resume_id'=>$v['id'],'u_id'=>$v['uid']])->one();
                $res->status=3;
                if($res->save()){
                    $data['msg']=1;
                }else{
                    $data['msg']="操作失败";
                    break;
                }
            }else{
                $data['msg']="发送失败";
                break;
            }
        }
        echo json_encode($data);
    }
    public function actionDaiding()
    {
        $post=Yii::$app->request->post();
        $info=Resume::find()->where(['id'=>$post['deliverIds']])->asArray()->one();
        $res=ResumeJob::find()->where(['resume_id'=>$info['id'],'u_id'=>$info['uid']])->one();
        $res->status=2;
        if($res->save()){
            $data['msg']=1;
        }else{
            $data['msg']="操作失败";
        }
        echo json_encode($data);
    }
    public function actionDingall()
    {
        $post=Yii::$app->request->post();
        $info=Resume::find()->where("id in ($post[deliverIds])")->asArray()->all();
        foreach($info as $k=>$v){
            $res=ResumeJob::find()->where(['resume_id'=>$v['id'],'u_id'=>$v['uid']])->one();
            $res->status=2;
            if($res->save()){
                $data['msg']=1;
            }else{
                $data['msg']="操作失败";
                break;
            }
        }
        echo json_encode($data);
    }
    public function actionDelresume()
    {
        $post=Yii::$app->request->post();
        $res=ResumeJob::deleteAll("id in ($post[deliverIds])");
        if($res){
            $data['msg']=1;
        }else{
            $data['msg']="操作失败";
        }
        echo json_encode($data);
    }
    public function actionDelre()
    {
        $post=Yii::$app->request->post();
        $res=ResumeJob::find()->where(['id'=>$post['deliverIds']])->one();
        $res->delete();
        if($res){
            $data['msg']=1;
        }else{
            $data['msg']="操作失败";
        }
        echo json_encode($data);
    }
    public function actionMianshi()
    {
        $post=Yii::$app->request->post();
        $mail = Yii::$app->mailer->compose('mail1',['info'=>$post]);
        $mail->setTo($post['email']);	//接收人邮箱
        $mail->setSubject($post['subject']);	//邮件标题
        if ($mail->send()){
            $res=ResumeJob::find()->where(['id'=>$post['resumejobId']])->one();
            $res->status=4;
            if($res->save()){
                $data['msg']=1;
            }else{
                $data['msg']="操作失败";
            }
        }else{
            $data['msg']="发送失败";
        }
        echo json_encode($data);
    }
}