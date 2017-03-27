<?php

namespace frontend\controllers;


use Yii;
use common\models\User;
use common\models\UserInfo;
use common\models\UserPhoto;
use common\models\District;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\base\DynamicModel;
use yii\captcha\CaptchaValidator;
use yii\validators\EmailValidator;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public $layout = 'header';
    private $userInfo ;

    //将user信息存入初始化 整个控制器可以使用 避免频繁读取
    public function init()
    {
        parent::init();
        $this->userInfo = Yii::$app->session->get('user');
    }


    /**
     * @brief 重写actions验证码
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'maxLength' => 4,
                'minLength' => 4,
                //'testLimit'=>2, //验证二次后失效
            ],
        ];
    }




    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        //渲染模型
        $model = UserInfo::findOne(12);//$this->userInfo['uid']


        //接值入库
        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['index']);
        }

        //年份
        for ($i = 1970; $i <= 2017; $i++){
            $year[$i] = $i;
        }

        //地区
        $province = $this->findArea('parentid = 0');
        $city = $this->findArea('parentid != 0');


        return $this->render('index', [
                'model' => $model,
                'year' => $year,
                'province' => $province,
                'city' => $city,
            ]);
    }


    //查询地区数据
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
     * @brief 照片展示
     * @return string
     */
    public function actionPhoto()
    {
        $upload = new UserPhoto();

        //多文件上传
        if (Yii::$app->request->isPost)
        {
            $upload->photo = UploadedFile::getInstances($upload, 'photo');

            //循环入库
            if($fileArr = $upload->upload())
            {
                //入库
                foreach ($fileArr as $key => $val)
                {
                    $sql = "INSERT INTO lg_user_photo(id,user_id,photo) VALUES (null,'12','{$val}')";  ////上线更改$this->userInfo['uid']
                    Yii::$app->db->createCommand($sql)->execute();
                }
                $this->refresh();
            }
        }

        //状态查询
        $status = Yii::$app->request->get('status');
        if(!isset($status))
        {
            $status = [1,2,3];
        }

        //渲染模型
        $model = UserPhoto::find()
            ->where(['user_id' => 12, 'status' => $status])  //$this->userInfo['uid']
            ->asArray()
            ->all();
        //print_r($model);die;


        return $this->render('photo',[
            'model' => $model,
            'upload' => $upload,
        ]);
    }



    /**
     * @brief 账号安全
     */
    public function actionSafe()
    {
        $model = User::findOne(12);     //$this->userInfo['uid']

        if(Yii::$app->request->isPost)
        {
            //接值
            $post = Yii::$app->request->post();

            //验证是新密码否相等
            $password = $post['password'];
            $comfirmpassword = $post['comfirmpassword'];
            if( !$this->compare($password,$comfirmpassword) )  //不能传入全局变量
            {
                die("新密码不一致");
            }

            //验证旧密码是否一致
            $oldpassword = $model->getOldAttribute('password');

            if( !Yii::$app->security->validatePassword($post['oldpassword'],$oldpassword) )
            {
                die("输入正确的原密码");
            }

            //修改
            $password = Yii::$app->security->generatePasswordHash($password);
            $model->setAttribute('password',$password);
            if($model->save())
            {
                $url = Url::to(['register/login']);
                echo "<script>alert('修改成功,请重新登录');location.href='$url'</script>";die;
            }
        }

        return $this->render('safe',[
            'model' => $model,
        ]);
    }


    /**
     * @brief 发送绑定邮箱邮件
     * @return array
     */
    public function actionSend()
    {
        //返回json数据
        Yii::$app->response->format = Response::FORMAT_JSON;

        //接值
        $post = Yii::$app->request->post();


        //验证邮箱
        $emailValidator = new EmailValidator();

        if (!$emailValidator->validate($post['email']))
        {
            return ['done' => 1, 'msg' => '邮箱错误'];
        }


        //验证码验证
        $captcha = new CaptchaValidator();
        $captcha->captchaAction = 'user/captcha';

        if(!$captcha->validate($post['verifyCode']))
        {
            return ['done' => 2, 'msg' => '验证码错误'];
        }


        //生成密钥
        $code = Yii::$app->getSecurity()->generateRandomString();
        $user = User::findOne(12);  //$this->userInfo['uid]
        $user->setAttribute('code',$code);
        if(!$user->save())
        {
            return ['done' => 3, 'msg' => '生成密钥失败 请稍后再试'];
        }


        //邮件内容
        $href = Yii::$app->urlManager->createAbsoluteUrl(['user/check', 'id' => 12,'token' => $code]); //$this->userInfo['uid]
        $body = "<a href='$href'>$href</a>";

        //发送邮件
        $mail = Yii::$app->mailer->compose();
        $mail->setFrom('15803586720@163.com')
            ->setTo($post['email'])
            ->setSubject('YII绑定邮箱')
            ->setHtmlBody($body);

        if($mail->send()) {
            return ['done' => 0, 'msg' => '发送成功 请去邮箱确认'];
        } else {
            return ['done' => 4, 'msg' => '邮件发送失败 请稍后再试'];
        }
    }

    /**
     * @brief 确认邮件
     */
    public function actionCheck()
    {
        //接值
        $key = Yii::$app->request->get('token');
        $id = Yii::$app->request->get('id');
        //获取用户数据
        $user = User::findOne($id);
        if($user->code === $key)    //判断密钥
        {
            //修改状态
            $user->setAttribute('email_audit',1);
            $user->save();
            $this->redirect(['user/safe']);
        }
    }


    /**
     * @brief 自动验证类模型
     * @param $password
     * @param $comfirmpassword
     * @return bool
     */
    protected function compare($password, $comfirmpassword)
    {
        $validate = DynamicModel::validateData(compact('password','comfirmpassword'), //建立一个数组，包括变量名和它们的值
            [
                ['password', 'compare', 'compareAttribute' => 'comfirmpassword']
            ]);
        if ($validate->hasErrors()) {
            return false;
        } else {
            return true;
        }
    }




}
