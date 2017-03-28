<?php
namespace app\models;
use Yii;
use common\models\Resume;
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
    //关联查询
    public function getList($where)
    {
            $list=ResumeJob::find()->select("lg_resume_job.id as rjid,j.id as job_id,jobs_name,j.companyname,r.id as rid,r.name,r.title,r.sex,r.tel,r.email,r.residence,r.experience,r.education,lg_resume_job.add_time")->join("inner join","lg_resume as r","r.id=lg_resume_job.resume_id")->join("inner join","lg_jobs as j","j.id=lg_resume_job.job_id")->where($where)->asArray()->all();
            foreach($list as $k=>$v){
                $list1=Resume::find()->select("p.photo")->join("inner join","lg_user_photo as p","p.id=lg_resume.photo_id")->where("lg_resume.id=$v[rid]")->asArray()->one();
                $list[$k]['photo']=$list1['photo'];
            }
            return $list;
    }
}
