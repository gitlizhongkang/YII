<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for VerifyCode".
 */
class Verify extends Model
{

    public $verifyCode;     //验证码这个变量是必须建的，因为要储存验证码的值

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['verifyCode', 'required'],
            ['verifyCode', 'captcha','captchaAction'=>'test/captcha'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => '',
        ];
    }

}
