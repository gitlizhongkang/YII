<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%district}}".
 *
 * @property string $id
 * @property string $parentid
 * @property string $categoryname
 * @property integer $category_order
 * @property string $stat_jobs
 * @property string $stat_resume
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%district}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentid', 'category_order'], 'integer'],
            [['categoryname', 'stat_jobs', 'stat_resume'], 'required'],
            [['categoryname'], 'string', 'max' => 30],
            [['stat_jobs', 'stat_resume'], 'string', 'max' => 15],
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
            'stat_jobs' => 'Stat Jobs',
            'stat_resume' => 'Stat Resume',
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
/**
 * 地区分类
 */
    public function district()
    {
        $cat_info = $this->find()->asArray()->all();
        return $data = $this->tree($cat_info);
    }
}
