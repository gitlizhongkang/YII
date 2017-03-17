<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $account
 * @property string $password
 * @property string $tel
 * @property string $email
 * @property string $head_ic
 * @property integer $last_login_time
 * @property string $last_login_ip
 */
class User extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_login_time','status'], 'integer'],
            [['account', 'email'], 'string', 'max' => 50],
            [['password', 'last_login_ip'], 'string', 'max' => 32],
            [['tel'], 'string', 'max' => 11],
            //[['head_ic'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account' => 'Account',
            'password' => 'Password',
            'tel' => 'Tel',
            'email' => 'Email',
            'head_ic' => 'Head Ic',
            'last_login_time' => 'Last Login Time',
            'last_login_ip' => 'Last Login Ip',
            'status' => 'Status',
        ];
    }

    /**
     * @inheritdoc 上传
     */
    public function upload()
    {
        if ($this->validate() && isset($this->head_ic)) {
            $file = 'uploads/' . $this->head_ic->baseName . '.' . $this->head_ic->extension;
            $this->head_ic->saveAs($file);
            return $file;
        } else {
            return false;
        }
    }


    /**user id关联userinfo user_id模型
     * @return \yii\db\ActiveQuery
     */
    public function getUserinfo()
    {
        return $this->hasOne(UserInfo::className(), ['user_id' => 'id']);
    }
    //添加
    public function add($arr){
        $this->setAttributes($arr);
        $this->save($arr);
        return $this->attributes['id'];
    }
    //验证邮箱
    public function checkEmail($email){
        return $this->find()->where(['email'=>$email])->one();
    }
    //登录验证
    public function checkLogin($email,$pwd){
        return $this->find()->where(['and', 'email="$email"', 'password="$pwd"'])->one();
    }
}
