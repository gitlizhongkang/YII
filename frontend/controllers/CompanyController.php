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
            if($companyinfo['email_code']==''){
                return $this->render("bindstep3.html");
            }else{
                $info['msg']=1;
                return $this->render("bindstep3.html",$info);
            }
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
        $body="点击验证邮箱"."<a href='http://www.front.com/index.php?r=company/check-email&email_code=$email_code'>http://www.front.com/index.php?r=company/check-email&email_code=".$email_code."</a>";
        $mail->setSubject("邮箱验证");	//邮件标题
        $mail->setHtmlBody($body);	//发送内容(可写HTML代码)
        if ($mail->send()){
            $info['msg']=1;
        }
        return $this->render("bindstep3.html",$info);
    }
    //验证邮箱
    public function actionCheckEmail()
    {
        $code=Yii::$app->request->get("email_code");
        $companyinfo=Company::find()->where(["email_code"=>$code])->asArray()->one();
         if($companyinfo['email_code']){
             $test=Company::find()->where(["id"=>$companyinfo['id']])->one();
             $test->email_code="";
             $test->check_email=1;
             $res=$test->save();
             if($res){
                 $info['msg']="恭喜你，公司邮箱验证完毕，请完善公司信息";
                 $info['code']=1;
             }else{
                 $info['msg']="公司邮箱验证失败,请重新发起验证";
                 $info['code']=2;
             }
         }else{
             $info['code']=3;
             $info['msg']='这是什么';
         }
        return $this->render('success.html',$info);
    }
    //公司詳細信息
    public function actionGongsi(){
            $CompanyModel=new Company;
            $id=yii::$app->request->get("id");
            $date['CompanyDetail']=$CompanyModel->getOne1($id);
            print_r($date);die;
            
            return $this->render('gongsi.html');
        }
    public function actionGongsi1(){
            $CompanyModel=new Company;
            $id=yii::$app->request->get("id");
            $CompanyDetail=$CompanyModel->getOne1($id);
            // print_r($CompanyDetail);die;
            return $this->render('gongsi1.html');
        }
}