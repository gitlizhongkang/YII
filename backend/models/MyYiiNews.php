<?php
namespace backend\models;

use Yii;

class MyYiiNews extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lg_jobs';
    }

//增
//方法1
public function create1($data)//AR模式1
{
    
    $this->setAttributes($data);
    return $this->insert();
}
// 方法2       
public function create2($data)//AR模式2
{
    $this->setAttributes($data);
    $this->isNewRecord = true;
    $this->id = 0;
    return $this->save();       
}

//方法3
public function create3($data) //DAO模式
{  
    $sql = "insert into yii_news(title,content)values('{$data['title']}','{$data['content']}')";
    return yii::$app->db->createCommand($sql)->execute();
}

//删除
public function del1($id)//AR模式
    {
        return $this->deleteAll(['id'=>$id]);
    }
public function del2($id)//DAO模式
    {
        $sql = "delete from yii_news where id='$id'";
        return yii::$app->db->createCommand($sql)->execute();
    }
//修改
public function save1($data)
    {   //AR模式
        return  $this->setAttributes($data) && $this->save();
    }
public function save2($data)
    {   //DAO模式
        $sql = "update yii_news set title='{$data['title']}',content='{$data['content']}'";
        return yii::$app->db->createCommand($sql)->execute();
    }

//查
public function getOne($id)
    {
        return $this->find()->where(['id'=>4])->andWhere(['1'=>'1'])->orWhere(['0'=>1])->asArray()->one();;
    }
public function getOne2($id)
    {
        $sql = "select * from yii_news where id='$id' and 1=1 or 0=1";
        return yii::$app->db->createCommand($sql)->queryOne();
    }
public function getAll()
    {
        return $this->find()->all();
    }
public function getAlll($wheree,$orderr)
    {
        return $this->find()->where($wheree)->orderBy($orderr)->asArray()->all();
    }
public function getAll2($condition)
    {
        $sql='select * from yii_news ';// where $condtion
        return yii::$app->db->createCommand($sql)->queryAll();
    }
}