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
        return $this->render("mail.html",array("email"=>$email));
    }
    public function  actionDoEmail()
    {
        $email=Yii::$app->request->post("email");
        $subject=Yii::$app->request->post("subject");
        $body=Yii::$app->request->post("body");
        $mail= Yii::$app->mailer->compose();
        $mail->setTo($email);

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
