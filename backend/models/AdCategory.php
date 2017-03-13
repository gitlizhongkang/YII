<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%ad_category}}".
 *
 * @property integer $category_id
 * @property string $categoryname
 * @property integer $num
 * @property integer $expense
 */
class AdCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryname', 'expense'], 'required'],
            [['num', 'expense'], 'integer'],
            [['categoryname'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'categoryname' => 'Categoryname',
            'num' => 'Num',
            'expense' => 'Expense',
        ];
    }
    //查询所有
     public function select()
    {
        return $this->find()->all();
    }
    //根据id查询名称
    public function selectName($category_id)
    {
        return $this->findOne($category_id);
    }
}
