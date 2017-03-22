<?php
namespace frontend\controllers;

use common\models\District;
use Yii;
use yii\web\Controller;
use common\models\Ad;
use common\models\JobsCategory;
use common\models\Category;
use backend\models\Company;
use yii\data\Pagination;

class CompanyController extends Controller
{
    public $layout='/header';
    public function actionIndex()
    {
        $session=Yii::$app->session;
        $userinfo=$session->get('user');
        $uid=$userinfo['uid'];
        $sql="select * from lg_company where u_id=$uid";
        $companyinfo=Yii::$app->db->createCommand($sql)->queryOne();
        if(!isset($companyinfo['id'])){
            return $this->render("bindstep1.html");
        }
        if(empty($companyinfo['companyname'])){
            return $this->render("bindstep2.html");
        }
        if($companyinfo['check_email']==0){
            return $this->render("bindstep3.html");
        }
    }
    public function actionBlind1()
    {
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $session = Yii::$app->session;
            $userinfo = $session->get('user');
            $data['u_id'] = $uid=$userinfo['uid'];
            $data['telphone'] = $post['contact'];
            $data['email'] = $post['receiveEmail'];
            $data['addtime'] = time();
            $sql="select email,telphone from lg_company where u_id=$uid";
            $companyinfo=Yii::$app->db->createCommand($sql)->queryOne();
            if($companyinfo['email']){
                $test=Company::find()->where(["u_id"=>$uid])->one();
                if($companyinfo['email']!=$data['email']){
                    $test->email="$data[email]";
                }
                if($companyinfo['telphone']!=$data['telphone']){
                    $test->telphone="$data[telphone]";
                }
                $res=$test->save();
            }else{
                $test = new Company;
                $res = $test->add($data);
            }
            if ($res) {
                echo 1;
            } else {
                echo 0;
            }
        }else{
            $session=Yii::$app->session;
            $userinfo=$session->get('user');
            $uid=$userinfo['uid'];
            $sql="select email,telphone from lg_company where u_id=$uid";
            $companyinfo=Yii::$app->db->createCommand($sql)->queryOne();
            return $this->render("bindstep1.html",$companyinfo);
        }
    }
    public function actionBlind2()
    {
        if(Yii::$app->request->isPost){
            $post=Yii::$app->request->post();
            $companyname=$post['companyName'];
            $session=Yii::$app->session;
            $userinfo=$session->get('user');
            $uid=$userinfo['uid'];
            $test=Company::find()->where(["u_id"=>$uid])->one();
            $test->companyname="$companyname";
            $res=$test->save();
            if($res){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            return $this->render("bindstep2.html");
        }
    }
    public function actionBlind3()
    {
        $session = Yii::$app->session;
        $userinfo = $session->get('user');
        $uid=$userinfo['uid'];
        $companyinfo=Company::find()->where(["u_id"=>$uid])->asArray()->one();
        $test=Company::find()->where(["u_id"=>$uid])->one();
        $email_code=md5($uid);
        $test->email_code="$email_code";
        $res=$test->save();
        $mail = Yii::$app->mailer->compose();
        $mail->setTo($companyinfo['email']);	//接收人邮箱
        $body="点击验证邮箱"."<a href='http://www.front.com/index.php?r=company/check-email/code='>http://www.front.com/index.php?r=company/check-email/code=".$email_code."</a>";
        $mail->setSubject("邮箱验证");	//邮件标题
        $mail->setHtmlBody($body);	//发送内容(可写HTML代码)
        if ($mail->send()){
            $info['msg']=1;
        }else{
            $info['msg']=0;
        }
        return $this->render("bindstep3.html",$info);
    }
}