<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property string $item_name
 * @property string $user_id
 * @property integer $created_at
 *
 * @property AuthItem $itemName
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at','user_id'], 'integer'],
            [['item_name'], 'string', 'max' => 64],
            [['mes'], 'string', 'max' => 255],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['item_name' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_name' => 'Item Name',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'mes' => 'Mes' ,
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'item_name']);
    }
    public function getList()
    {
//        $arr=AuthAssignment::find();
//        $pages = new Pagination(['totalCount' => $arr->count(),'pageSize'=>2]);
//        $list=AuthAssignment::find()->offset($pages->offset)->limit($pages->limit)->all();
//        $info['pages']=$pages;
//        $info['list']=$list;
//        return $info;
        //查询
        $db=\Yii::$app->db;
        $userInfo=$db->createCommand('select * from `auth_assignment` join lg_admin on auth_assignment.user_id = lg_admin.admin_id ')->queryAll();//执行
        //AR
        // $userInfo=AuthAssignment::find()->select('*')->join('JOIN', 'lg_admin', 'auth_assignment.user_id = lg_admin.admin_id')->asArray();
         // $userInfo=AuthAssignment::find()->all();
        return $userInfo; //赋值
       
    }
    public function getAdd($date){
         $this->setAttributes($date); //增加
         $this ->save();
    }
    public function getDel($user_id){
        return $this->deleteall("user_id in($user_id)");
    }
    public function getLike($item_name){
        // return  $arr=$this->find()->where(['like','item_name',"$item_name"])->asArray()->all();
        $db=\Yii::$app->db;
        $arr=$db->createCommand("select * from `auth_assignment` join lg_admin on auth_assignment.user_id = lg_admin.admin_id where item_name like '%$item_name%' ")->queryAll();//执行
        return  $arr;
    }
    public function getPower($user_id){
        $db=\Yii::$app->db;
        $arr=$db->createCommand("select child from `auth_assignment` join auth_item_child on auth_assignment.item_name = auth_item_child.parent where user_id = $user_id ")->queryAll();//执行
        return  $arr;
    }
}
