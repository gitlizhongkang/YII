<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%company_leader}}".
 *
 * @property integer $id
 * @property integer $companyId
 * @property string $photo
 * @property string $name
 * @property string $position
 * @property string $weibo
 * @property string $remark
 */
class CompanyLeader extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company_leader}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companyId'], 'integer'],
            [['photo', 'name', 'position', 'weibo', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companyId' => 'Company ID',
            'photo' => 'Photo',
            'name' => 'Name',
            'position' => 'Position',
            'weibo' => 'Weibo',
            'remark' => 'Remark',
        ];
    }
}
