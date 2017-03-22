<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%group}}".
 *
 * @property string $g_id
 * @property string $g_alias
 * @property string $g_name
 * @property integer $g_sys
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['g_alias', 'g_name'], 'required'],
            [['g_sys'], 'integer'],
            [['g_alias'], 'string', 'max' => 60],
            [['g_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'g_id' => 'G ID',
            'g_alias' => 'G Alias',
            'g_name' => 'G Name',
            'g_sys' => 'G Sys',
        ];
    }
/** 
 * * 其他分类
 */
    public function rests()
    {
        return $cat_info = $this->find()->asArray()->all();
    }

}
