<?php

namespace backend\models;

use Yii;
use yii\data\Pagination;
/**
 * This is the model class for table "{{%members}}".
 *
 * @property integer $uid
 * @property string $username
 * @property string $email
 * @property string $mobile
 * @property string $password
 * @property integer $reg_time
 * @property string $reg_ip
 * @property integer $last_login_time
 * @property string $last_login_ip
 * @property string $qq_nick
 * @property integer $qq_blind_time
 * @property integer $points
 */
class Members extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%members}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reg_time', 'last_login_time', 'qq_blind_time', 'points','code_time'], 'integer'],
            [['username', 'email', 'mobile', 'password', 'reg_ip', 'last_login_ip', 'qq_nick','code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'username' => 'Username',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'password' => 'Password',
            'reg_time' => 'Reg Time',
            'reg_ip' => 'Reg Ip',
            'last_login_time' => 'Last Login Time',
            'last_login_ip' => 'Last Login Ip',
            'qq_nick' => 'Qq Nick',
            'qq_blind_time' => 'Qq Blind Time',
            'points' => 'Points',
            'code'=>'Code',
            'code_time'=>'Code Time',
        ];
    }
    public function getList($where)
    {
        $arr=Members::find()->select("*")->join("inner join","lg_company as c","c.u_id=lg_members.uid")->where($where);
        $pages = new Pagination(['totalCount' => $arr->count(),'pageSize'=>2]);
        $list=$arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $info['pages']=$pages;
        $info['list']=$list;
        return $info;
    }
    //删除职位资料
    public function del($id)
    {
        return Members::deleteAll("uid in ($id)");

    }
     //添加
    public function add($arr){
        $this->setAttributes($arr);
        $this->save();
        return $this->attributes['uid'];
    }
    //验证邮箱
    public function checkEmail($email){
        return $this->find()->where(['email'=>$email])->one();
    }
     //添加code  修改积分
    public function updateOne($id,$info){
        $res=$this->find()->where(['uid'=>$id])->one();
        $res->setAttributes($info);
        return $res->save();
    }
    //根据code查询用户信息
    public function checkCode($code){
         return $this->find()->where(['code'=>$code])->one();
    }
    //直接修改积分
     public function updatePoint($id){
        $sql="update lg_members set points=points-10 where uid=$id";
        $connect=Yii::$app->db;
        $command=$connect->createCommand($sql);
        return $command->execute();       
    }
    //获得某个用户的积分数
    public function getPoint($id){
        return $this->find()->select('points')->where(['uid'=>$id])->one();
    }
}
