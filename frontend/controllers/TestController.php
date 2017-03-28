<?php

namespace frontend\controllers;


use Yii;
use yii\web\Controller;
use common\models\Verify;
use yii\helpers\Url;
use yii\base\DynamicModel;
use yii\captcha\CaptchaValidator;

/**
 * UserController implements the CRUD actions for User model.
 */
class TestController extends Controller
{

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
                'testLimit'=>2, //验证三次后失效
            ],
        ];
    }


    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {

        $verify = new Verify();
        if(Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            $verifyCode = $post['verifyCode'];//['Verify']

            //111111111
            //var_dump($this->compare($verifyCode));die;

            //2222222222
            $captcha = new CaptchaValidator();
            $captcha->captchaAction = 'test/captcha';
            var_dump($captcha->validate($verifyCode));die;

            //33333333333
            //var_dump($verify->load($post) && $verify->validate());die;


        }
        return $this->render('index',[
            'verify' => $verify,
        ]);
    }


    /**
     * @brief 自动验证类模型
     * @param $verifyCode
     * @return bool
     */
    protected function compare($verifyCode)
    {
        $validate = DynamicModel::validateData(['verifyCode' => $verifyCode], //建立一个数组，包括变量名和它们的值
            [
                ['verifyCode', 'captcha','captchaAction'=>'test/captcha']
            ]);
        if ($validate->hasErrors()) {
            return false;
        } else {
            return true;
        }
    }




}
