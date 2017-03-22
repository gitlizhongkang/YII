<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%major}}".
 *
 * @property string $id
 * @property integer $parentid
 * @property string $categoryname
 * @property integer $category_order
 */
class Major extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%major}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentid', 'categoryname'], 'required'],
            [['parentid', 'category_order'], 'integer'],
            [['categoryname'], 'string', 'max' => 50],
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
 * * 行业分类
 */
    public function craft()
    {
        $cat_info = $this->find()->asArray()->all();
       return  $job_job = $this->tree($cat_info);
    }
}
