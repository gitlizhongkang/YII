<?php

namespace app\common\models;

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
}
