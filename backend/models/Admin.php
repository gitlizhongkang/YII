<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property integer $admin_id
 * @property string $admin_name
 * @property string $pwd
 * @property integer $add_time
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_name'],'required','message'=>'用户名不能为空'],
            [['pwd'],'required','message'=>'密码不能为空'],
            [['add_time'], 'integer'],
            [['admin_name', 'pwd'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'admin_name' => 'Admin Name',
            'pwd' => 'Pwd',
            'add_time' => 'Add Time',
        ];
    }
    public function checkLogin($admin_name,$pwd)
    {
        return Admin::find()->where(['admin_name'=>$admin_name,'pwd'=>$pwd])->one();
    }
    public function getAdd($date){
         $this->setAttributes($date); //增加
         $this ->save();
    }
    public function getLastId(){
        $id = $this->attributes['admin_id'];
        return $id;
    }
    public function getLike($admin_name){
        // return  $arr=$this->find()->where(['like','item_name',"$item_name"])->asArray()->all();
        $db=\Yii::$app->db;
        $arr=$db->createCommand("select * from `auth_assignment` join lg_admin on auth_assignment.user_id = lg_admin.admin_id where admin_name like '%$admin_name%' ")->queryAll();//执行
        return  $arr;
    }
}
