<?php

namespace frontend\controllers;

use app\models\ResumeJob;
use common\models\UserInfo;
use common\models\UserPhoto;
use Yii;
use common\models\Resume;
use common\models\User;
use common\models\District;
use yii\helpers\Url;
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
    private $userInfo ;


    //将user信息存入初始化 整个控制器可以使用 避免频繁读取
    public function init()
    {
        parent::init();
        $this->userInfo = Yii::$app->session->get('user');
    }

    //非法登陆
    public function beforeAction($action)
    {
        if(empty($this->userInfo))
        {
            $this->redirect(['register/login']);
            return false;
        }
        return true;
    }



    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {

        //查询简历
        $resume = Resume::find()
            ->select('lg_resume.* , lg_user_photo.photo')
            ->join('INNER JOIN','lg_user_photo','photo_id = lg_user_photo.id')
            ->where(['uid'=> $this->userInfo['uid']])
            ->asArray()
            ->all();


        return $this->render('index',[
            'resume'=>$resume,
        ]);
    }


    /**
     * @brief 查看详情
     */
    public function actionView()
    {
        $this->layout = false;

        $id = Yii::$app->request->get('id');
        //查询简历
        $resume = Resume::find()
            ->select('lg_resume.* , lg_user_photo.photo')
            ->join('INNER JOIN','lg_user_photo','photo_id = lg_user_photo.id')
            ->where(['lg_resume.id'=> $id])
            ->asArray()
            ->one();
        //查询籍贯
        $areaId = [$resume['province_id'],$resume['city_id']];
        $area = District::find()
            ->where(['id' => $areaId])
            ->asArray()
            ->all();

        return $this->render('view',[
            'resume'=>$resume,
            'area'=>$area,
        ]);
    }




    /**
     * @brief 创建
     * @return string
     */
    public function actionCreate()
    {
        //判断个人信息完整
        $checkInfo = UserInfo::find()
            ->where(['user_id' => $this->userInfo['uid']])
            ->asArray()
            ->one();
        unset($checkInfo['order']);
        unset($checkInfo['collect']);
        unset($checkInfo['district_id']);

        if(in_array('',$checkInfo,true))
        {
            $url = Url::to(['user/index']);
            echo "<script>alert('请完善个人信息后，再创建简历');location.href='$url'</script>";
        }

        //判断个人头像完整
        $checkPhoto = UserPhoto::find()
            ->where(['user_id' => $this->userInfo['uid'], 'status' =>2])
            ->asArray()
            ->one();

        if(empty($checkPhoto))
        {
            $url = Url::to(['user/photo']);
            echo "<script>alert('上传简历头像，再创建简历');location.href='$url'</script>";
        }


        //创建简历
        $id = Yii::$app->request->get('id');
        if(isset($id))
        {
            $user = Resume::find()
                /*->select('lg_resume.*,lg_user_photo.photo')
                ->join('INNER JOIN','lg_user_photo','photo_id = lg_user_photo.id')*/
                ->where(['lg_resume.id' => $id])
                ->asArray()
                ->one();
            $userPhoto = UserPhoto::findOne($user['photo_id']);
            $user['photo'] = isset($userPhoto->photo)?$userPhoto->photo:'uploads/14.jpg';
            //print_r($user);die;
        }
        else
        {
            //查询基本数据填充简历表
            $user = User::find()
                ->select('tel,email,lg_user_info.*')
                ->join('INNER JOIN','lg_user_info','id = user_id')
                ->where(['id' => $this->userInfo['uid']])
                ->asArray()
                ->one();
        }

        //查询照片
        $photo = UserPhoto::find()
            ->select('id,photo')
            ->where(['user_id' => $this->userInfo['uid'], 'status' => 2])
            ->asArray()
            ->all();
        //print_r($photo);die;

        //地区
        $province = $this->findArea('parentid = 0');
        $cityId = $user['city_id'];
        $city = District::find()
            ->where(['id' => $cityId])
            ->asArray()
            ->one();
        //$city = $this->findArea('parentid != 0');
        //print_r($user);die;

        return $this->render('create', [
            'user' => $user,
            'photo' => $photo,
            'province' => $province,
            'city' => $city,
        ]);
    }
    public function actionAdd()
    {
        //返回json
        Yii::$app->response->format = Response::FORMAT_JSON;

        $post = Yii::$app->request->post();
        $post['uid'] = $this->userInfo['uid'];
        //print_r($post);die;

        $resume = new Resume();
        //判断是修改还是新增
        $id = Yii::$app->request->get('id');
        if(isset($id))
        {
           $resume = Resume::findOne($id);
        }
        $resume->setAttributes($post);

        if($resume->save())
        {
            return ['done' => 1, 'msg' => '添加成功', 'id' => $resume->attributes['id']];
        }
        else
        {
            return ['done' => 2, 'msg' => '添加失败'];
        }

    }

    /**
     * @brief查询地区数据
     * @param $condition
     * @return array
     */
    public function findArea($condition)
    {
        $data = District::find()
            ->select('id,categoryname')
            ->where($condition)
            ->asArray()
            ->all();
        $area = [];
        foreach ($data as $key => $val)
        {
            $area[$val['id']] = $val['categoryname'];
        }

        return $area;
    }




    /**
     * @brief 投递简历状态
     * @return string
     */
    public function actionUse()
    {
        //状态查询
        $status = Yii::$app->request->get('status');
        if(!isset($status))
        {
            $status = [1,2,3,4];
        }
        //查询基本数据填充简历表
        $resumeInfo = Resume::find()
            ->select('title, wage, lg_jobs.companyname, jobs_name, status, add_time, check_time, response_time')
            ->join('INNER JOIN','lg_resume_job','lg_resume.id = resume_id')
            ->join('INNER JOIN','lg_jobs','lg_jobs.id = job_id')
            ->where(['uid' => $this->userInfo['uid'], 'status' => $status])
            ->asArray()
            ->all();
        //echo "<pre>";
        //print_r($resumeInfo);die;
        return $this->render('use', ['resumeInfo' => $resumeInfo]);
    }



}
