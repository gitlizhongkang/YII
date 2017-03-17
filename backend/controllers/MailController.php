<?php

namespace backend\controllers;
use Yii;
class MailController extends \yii\web\Controller
{
    public $layout=false;
    public function init(){
        $this->enableCsrfValidation = false;
    }
    public function actionIndex()
    {
        $email=Yii::$app->request->get("email");
        $companyname=Yii::$app->request->get("companyname");
        return $this->render("mail.html",array("email"=>$email,"companyname"=>$companyname));

    }
    public function  actionDoEmail()
    {
        $email=Yii::$app->request->post("email");
        $from=Yii::$app->request->post("from");
        $subject=Yii::$app->request->post("subject");
        $body=Yii::$app->request->post("body");
        $mail= Yii::$app->mailer->compose();
        $mail->setTo($email);
        $mail->setFrom(array("15803586720@163.com"=>$from));
        $mail->setSubject($subject);
        $mail->setTextBody($body);
        if($mail->send()){
            $msg="发送成功";
        }else{
           $msg="发送失败";
        }
        return $this->render('../result/result.html',array(
            'message'=>$msg,
            'links'=>array(
                array('上一操作',"company/company-list"),
            ),
        ));
    }
}
