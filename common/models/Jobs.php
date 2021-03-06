<?php

namespace common\models;

use Yii;
use yii\data\Pagination;
/**
 * This is the model class for table "{{%jobs}}".
 *
 * @property string $id
 * @property string $u_id
 * @property string $jobs_name
 * @property string $companyname
 * @property string $company_id
 * @property string $company_addtime
 * @property integer $company_audit
 * @property integer $recommend
 * @property integer $emergency
 * @property string $highlight
 * @property integer $stick
 * @property string $nature_cn
 * @property string $sex_cn
 * @property string $age
 * @property integer $amount
 * @property integer $topclass
 * @property integer $category
 * @property integer $subclass
 * @property string $category_cn
 * @property string $trade_cn
 * @property string $scale_cn
 * @property string $district_cn
 * @property string $street_cn
 * @property string $tag_cn
 * @property string $education_cn
 * @property string $experience_cn
 * @property string $wage_cn
 * @property integer $negotiable
 * @property string $contents
 * @property string $addtime
 * @property string $deadline
 * @property string $refreshtime
 * @property string $setmeal_deadline
 * @property integer $setmeal_id
 * @property string $setmeal_name
 * @property integer $audit
 * @property integer $display
 * @property string $click
 * @property string $key
 * @property integer $user_status
 * @property double $map_x
 * @property double $map_y
 * @property integer $add_mode
 */
class Jobs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%jobs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_id', 'jobs_name', 'companyname', 'company_id', 'company_addtime', 'highlight', 'stick', 'nature_cn', 'sex_cn', 'age', 'amount', 'topclass', 'category', 'subclass', 'trade_cn', 'scale_cn', 'district_cn', 'tag_cn', 'education_cn', 'experience_cn', 'wage_cn', 'negotiable', 'contents', 'addtime', 'deadline', 'refreshtime', 'setmeal_id', 'setmeal_name', 'key', 'map_x', 'map_y'], 'required'],
            [['u_id', 'company_id', 'company_addtime', 'company_audit', 'recommend', 'emergency', 'stick', 'amount', 'topclass', 'category', 'subclass', 'negotiable', 'addtime', 'deadline', 'refreshtime', 'setmeal_deadline', 'setmeal_id', 'audit','display', 'click', 'user_status', 'add_mode'], 'integer'],
            [['contents', 'key'], 'string'],
            [['map_x', 'map_y'], 'number'],
            [['jobs_name', 'nature_cn', 'trade_cn', 'scale_cn', 'education_cn', 'experience_cn', 'wage_cn'], 'string', 'max' => 30],
            [['companyname', 'street_cn'], 'string', 'max' => 50],
            [['highlight'], 'string', 'max' => 7],
            [['sex_cn'], 'string', 'max' => 3],
            [['age'], 'string', 'max' => 10],
            [['category_cn', 'district_cn', 'tag_cn'], 'string', 'max' => 100],
            [['setmeal_name'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'u_id' => 'U ID',
            'jobs_name' => 'Jobs Name',
            'companyname' => 'Companyname',
            'company_id' => 'Company ID',
            'company_addtime' => 'Company Addtime',
            'company_audit' => 'Company Audit',
            'recommend' => 'Recommend',
            'emergency' => 'Emergency',
            'highlight' => 'Highlight',
            'stick' => 'Stick',
            'nature_cn' => 'Nature Cn',
            'sex_cn' => 'Sex Cn',
            'age' => 'Age',
            'amount' => 'Amount',
            'topclass' => 'Topclass',
            'category' => 'Category',
            'subclass' => 'Subclass',
            'category_cn' => 'Category Cn',
            'trade_cn' => 'Trade Cn',
            'scale_cn' => 'Scale Cn',
            'district_cn' => 'District Cn',
            'street_cn' => 'Street Cn',
            'tag_cn' => 'Tag Cn',
            'education_cn' => 'Education Cn',
            'experience_cn' => 'Experience Cn',
            'wage_cn' => 'Wage Cn',
            'negotiable' => 'Negotiable',
            'contents' => 'Contents',
            'addtime' => 'Addtime',
            'deadline' => 'Deadline',
            'refreshtime' => 'Refreshtime',
            'setmeal_deadline' => 'Setmeal Deadline',
            'setmeal_id' => 'Setmeal ID',
            'setmeal_name' => 'Setmeal Name',
            'audit' => 'Audit',
            'display' => 'Display',
            'click' => 'Click',
            'key' => 'Key',
            'user_status' => 'User Status',
            'map_x' => 'Map X',
            'map_y' => 'Map Y',
            'add_mode' => 'Add Mode',
        ];
    }
    //查询职位
    public function getList($where)
    {
        $arr=Jobs::find()->select("*")->join('JOIN','lg_members', 'lg_members.uid=lg_jobs.u_id')->where($where);
        $pages = new Pagination(['totalCount' => $arr->count(),'pageSize'=>2]);
        $list=$arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $info['pages']=$pages;
        $info['list']=$list;
        return $info;
    }
    public function getAll($where)
    {
        $arr=Jobs::find()->select("*")->where($where);
        $pages = new Pagination(['totalCount' => $arr->count(),'pageSize'=>10]);
        $list=$arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $info['pages']=$pages;
        $info['list']=$list;
        return $info;
    }
    //删除职位资料
    public function del($id)
    {
        return Jobs::deleteAll("id in ($id)");
    }
    //查询单条企业信息
    public function getOne($id)
    {
        return Jobs::find()->where(['id'=>$id])->one();
    }
}
