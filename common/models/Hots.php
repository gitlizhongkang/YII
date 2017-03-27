<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lg_hots".
 *
 * @property integer $id
 * @property string $words
 * @property string $way
 * @property integer $num
 */
class Hots extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lg_hots';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num'], 'integer'],
            [['words'], 'string', 'max' => 255],
            [['way'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'words' => 'Words',
            'way' => 'Way',
            'num' => 'Num',
        ];
    }
    //全部热词
    public function getList(){
        $arr=Hots::find()->orderBy("num desc")->asArray()->all();
        return $arr;
    }
    //前十条热词
    public function GetRankList(){
         $arr=Hots::find()->orderBy("num desc")->limit(10)->asArray()->all();
        return $arr;
    }
    //一条热词
    public function GetOne($where){
        $arr=Hots::find()->where($where)->asArray()->one();
        return $arr;
    }
    //修改
    public function setAudit($id,$key,$value)
    {
        $data =Hots::find()->where(['id'=>$id])->one();
        $data->$key= $value;
        return $data->save();
    }
    //增加
    public function getAdd($date){
         $this->setAttributes($date); //增加
         $this ->save();
    }
}
