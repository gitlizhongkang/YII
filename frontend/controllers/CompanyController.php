<?php
namespace frontend\controllers;

use common\models\District;
use Yii;
use yii\web\Controller;
use common\models\Ad;
use common\models\JobsCategory;
use common\models\CompanyProduct;
use common\models\CompanyLeader;
use common\models\Category;
use backend\models\Company;
use yii\data\Pagination;
use yii\web\UploadedFile;

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
        if($companyinfo['logo']==''){
            return $this->redirect(["company/improve1","companyid"=>$companyinfo['id']]);
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
                 $info['companyid']=$companyinfo['id'];
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
    //完善公司资料
    public function actionImprove1()
    {
        if(Yii::$app->request->isPost){
            $post=Yii::$app->request->post();
            $data['shortname']=$post['companyShortName'];
            $data['logo']=$post['logo'];
            $data['website']=$post['companyUrl'];
            $data['city']=$post['city'];
            $data['trade']=$post['trade'];
            $data['trade_id']=$post['trade_id'];
            $data['scale_id']=$post['scale_id'];
            $data['scale']=$post['scale'];
            $data['message']=$post['message'];
            $result=Company::find()->where(['id'=>$post['companyId']])->one();
            $result->setAttributes($data);
            $res=$result->save();
            if($res){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            $companyid=Yii::$app->request->get("companyid");
            if(empty($companyid)){
                $info['code']=3;
                $info['msg']='这是什么';
                return $this->render('success.html',$info);
            }
            $session = Yii::$app->session;
            $userinfo = $session->get('user');
            $uid=$userinfo['uid'];
            $data['companyinfo']=Company::find()->where(["u_id"=>$uid])->asArray()->one();
            $data['scalelist']=Category::find()->where("c_alias = 'QS_scale'")->asArray()->all();
            $data['tradelist']=Category::find()->where("c_alias = 'QS_trade'")->asArray()->all();
            return $this->render('improve1.html',$data);
        }
    }
    public function actionImprove2()
{
    if(Yii::$app->request->isPost){
        $post=Yii::$app->request->post();
        $result=Company::find()->where(['id'=>$post['companyId']])->one();
        $data['labels']=$post['labels'];
        $result->setAttributes($data);
        $res=$result->save();
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }else{
        $companyid=Yii::$app->request->get("companyid");
        if(empty($companyid)){
            $info['code']=3;
            $info['msg']='这是什么';
            return $this->render('success.html',$info);
        }
        $data['taglist']=Category::find()->where("c_alias = 'QS_jobtag'")->asArray()->all();
        $data['companyid']=$companyid;
        return $this->render('improve2.html',$data);
    }
}
    public function actionImprove3()
    {
        if(Yii::$app->request->isPost){
            $post=Yii::$app->request->post();
            $model=new CompanyLeader();
            foreach($post['leaderInfos'] as $k=>$v){
                $_model = clone $model;
                $_model->setAttributes($v);
                $_model->save();
            }
            return $this->redirect(['improve4','companyid'=>$post['companyId']]);
        }else{
            $companyid=Yii::$app->request->get("companyid");
            if(empty($companyid)){
                $info['code']=3;
                $info['msg']='这是什么';
                return $this->render('success.html',$info);
            }
            $data['companyid']=$companyid;
            return $this->render('improve3.html',$data);
        }
    }
    public function actionImprove4()
    {
        if(Yii::$app->request->isPost){
            $post=Yii::$app->request->post();
            $model=new CompanyProduct();
            foreach($post['productInfos'] as $k=>$v){
            $_model = clone $model;
            $_model->setAttributes($v);
            $_model->save();
            }
            return $this->redirect(['improve5','companyid'=>$post['companyId']]);
        }else{
            $companyid=Yii::$app->request->get("companyid");
            if(empty($companyid)){
                $info['code']=3;
                $info['msg']='这是什么';
                return $this->render('success.html',$info);
            }
            $data['companyid']=$companyid;
            return $this->render('improve4.html',$data);
        }
    }
    public function actionImprove5()
    {
        if(Yii::$app->request->isPost){
            $post=Yii::$app->request->post();
            $result=Company::find()->where(['id'=>$post['companyId']])->one();
            $data['contents']=$post['companyProfile'];
            $result->setAttributes($data);
            $res=$result->save();
            return $this->redirect(['improve5'],$data);
        }else{
            $companyid=Yii::$app->request->get("companyid");
            if(empty($companyid)){
                $info['code']=3;
                $info['msg']='这是什么';
                return $this->render('success.html',$info);
            }
            $data['companyid']=$companyid;
            return $this->render('improve5.html',$data);
        }
    }
    //处理上传图片
    public function actionCheckLogo()
    {
        $upload=new UploadedFile(); //实例化上传类
        $name=$upload->getInstanceByName('myfile'); //获取文件原名称
        $img=$_FILES['myfile']; //获取上传文件参数
        $upload->tempName=$img['tmp_name']; //设置上传的文件的临时名称
        $img_path='uploads/'.$name; //设置上传文件的路径名称(这里的数据进行入库)
        $arr=$upload->saveAs($img_path); //保存文件
        if($arr){
            $data['msg']=1;
            $data['path']=$img_path;
        }else{
            $data['msg']=2;
        }
        echo json_encode($data);
    }
}