<?php

namespace frontend\controllers;

use app\models\ResumeJob;
use Yii;
use common\models\Resume;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\web\Response;

/**
 * UserController implements the CRUD actions for User model.
 */
class ResumeController extends Controller
{
    public $layout = 'header';


    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        //获取登陆的用户
        $userInfo = Yii::$app->session->get('user');

        //查询简历
        $resume = Resume::find()
            ->select('lg_resume.* , lg_user_photo.photo , lg_jobs_category.categoryname')
            ->join('INNER JOIN','lg_user_photo','photo_id = lg_user_photo.id')
            ->join('INNER JOIN','lg_jobs_category','intention_jobs_id = lg_jobs_category.id')
            ->where(['uid'=> 12, 'audit' => 2])   //正式上线   $userInfo['uid']
            ->asArray()
            ->all();

        //地区


        return $this->render('index',['resume'=>$resume]);
    }



    //创建
    public function actionCreate()
    {
        //获取session
        $userInfo = Yii::$app->session->get('user');


        //查询基本数据填充简历表
        $user = User::find()
            ->select('tel,tel_audit,email,email_audit,head_ic,lg_user_info.*')
            ->join('INNER JOIN','lg_user_info','id = user_id')
            ->where(['id' => 12])  //正式上线   $userInfo['uid']
            ->asArray()
            ->one();

        return $this->render('create', ['user' => $user]);
    }
    public function actionAdd()
    {
        $post = Yii::$app->request->post();
        print_r($post);
    }


    //投递简历状态
    public function actionUse()
    {
        //获取session
        $userInfo = Yii::$app->session->get('user');


        //状态查询
        $status = Yii::$app->request->get('status');
        if(!isset($status))
        {
            $status = [1,2,3,4];
        }
        //查询基本数据填充简历表
        $resumeInfo = Resume::find()
            ->select('title, wage, companyname, jobs_name, status, add_time, check_time, response_time')
            ->join('INNER JOIN','lg_resume_job','lg_resume.id = resume_id')
            ->join('INNER JOIN','lg_jobs','lg_jobs.id = job_id')
            ->where(['uid' => 12, 'status' => $status])  //正式上线   $userInfo['uid']
            ->asArray()
            ->all();
        //echo "<pre>";
        //print_r($resumeInfo);die;
        return $this->render('use', ['resumeInfo' => $resumeInfo]);
    }



}
