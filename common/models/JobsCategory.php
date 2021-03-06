<?php

namespace common\models;

use Yii;
/**
 * This is the model class for table "{{%jobs_category}}".
 *
 * @property string $id
 * @property integer $parentid
 * @property string $categoryname
 * @property integer $category_order
 * @property string $stat_jobs
 * @property string $stat_resume
 * @property string $content
 */
class JobsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%jobs_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentid', 'categoryname', 'stat_jobs', 'stat_resume'], 'required'],
            [['parentid', 'category_order'], 'integer'],
            [['content'], 'string'],
            [['categoryname'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parentid' => 'Parentid',
            'categoryname' => 'Categoryname',
            'category_order' => 'Category Order',
            'content' => 'Content',
        ];
    }

// 无限极分类，递归
    public function tree($cat_info,$parentid = 0,$leave=0)
    {
        static $tree = array();
        foreach($cat_info as $key=>$val)
        {
            if($val['parentid'] == $parentid)
            {
                $val['leave'] = $leave;
                $tree[] = $val;
                $this->tree($cat_info,$val['id'],$leave+1);
            }
        }
        return $tree;
    }
//查询职业表
    public function select()
    {
        $cat_info = $this->find()->asArray()->all();
        return  $job_job = $this->tree($cat_info);
       
    }
    public function select1()
    {
        $cat_info = $this->find()->asArray()->all();
        return  $job_job = $this->get_job($cat_info);
      
    }
    //职位分类重新排序
    public function get_job($job)
    {
        foreach ($job as $k => $v) {
            if($v['parentid']==0){
                $arr[$v['categoryname']] = array();
                foreach ($job as $k1 => $v1) {
                    if ($v['id'] == $v1['parentid']) {
                        $arr[$v['categoryname']][$v1['categoryname']] = array();
                        foreach ($job as $k2 => $v2) {
                            if ($v1['id'] == $v2['parentid']) {
                                $arr[$v['categoryname']][$v1['categoryname']][$v2['id']] = $v2['categoryname'];
                            }
                        }
                    }
                }
            }
        }
        return $arr;
    }

}


   

   