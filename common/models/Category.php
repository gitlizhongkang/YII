<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $c_id
 * @property string $c_parentid
 * @property string $c_alias
 * @property string $c_name
 * @property integer $c_order
 * @property string $c_index
 * @property string $c_note
 * @property string $stat_jobs
 * @property string $stat_resume
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_parentid', 'c_alias', 'c_name', 'c_order', 'c_index', 'c_note', 'stat_jobs', 'stat_resume'], 'required'],
            [['c_parentid', 'c_order'], 'integer'],
            [['c_alias', 'c_name'], 'string', 'max' => 30],
            [['c_index'], 'string', 'max' => 1],
            [['c_note'], 'string', 'max' => 60],
            [['stat_jobs', 'stat_resume'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_id' => 'C ID',
            'c_parentid' => 'C Parentid',
            'c_alias' => 'C Alias',
            'c_name' => 'C Name',
            'c_order' => 'C Order',
            'c_index' => 'C Index',
            'c_note' => 'C Note',
            'stat_jobs' => 'Stat Jobs',
            'stat_resume' => 'Stat Resume',
        ];
    }
    //获取分类
    public function cate($cate){
        return $this->find()->where(['c_alias'=>$cate])->all();
    }
}
