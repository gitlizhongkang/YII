<?php

namespace app\models;

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
            'content' => 'Content',
        ];
    }
}
