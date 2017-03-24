<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%resume_job}}".
 *
 * @property integer $id
 * @property integer $resume_id
 * @property integer $job_id
 * @property integer $u_id
 * @property integer $company_id
 * @property integer $status
 */
class ResumeJob extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%resume_job}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['resume_id', 'job_id', 'u_id', 'company_id', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resume_id' => 'Resume ID',
            'job_id' => 'Job ID',
            'u_id' => 'U ID',
            'company_id' => 'Company ID',
            'status' => 'Status',
        ];
    }
    //投递简历
    public function add($arr){
        $this->setAttributes($arr);
        return $this->save();
    }
    //查询是否已经投递
    public function selectOne($job_id,$resume_id){
        return $this->find()->where("job_id='$job_id' and resume_id='$resume_id'")->one();
    }
    //查询某一用户的职位按照职位id分组
    public function groupJob($id){
        $sql="select job_id,count('id') from lg_resume_job where company_id=5 group by job_id";
        $connect=Yii::$app->db;
        $command=$connect->createCommand($sql);
        return $command->queryAll(); 
    }
}
