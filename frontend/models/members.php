<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%members_charge_log}}".
 *
 * @property string $log_id
 * @property integer $log_uid
 * @property string $log_username
 * @property integer $log_addtime
 * @property string $log_value
 * @property string $log_amount
 * @property integer $log_ismoney
 */
class members extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%members_charge_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['log_uid', 'log_username', 'log_addtime', 'log_value'], 'required'],
            [['log_uid', 'log_addtime', 'log_ismoney'], 'integer'],
            [['log_amount'], 'number'],
            [['log_username'], 'string', 'max' => 60],
            [['log_value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'log_id' => 'Log ID',
            'log_uid' => 'Log Uid',
            'log_username' => 'Log Username',
            'log_addtime' => 'Log Addtime',
            'log_value' => 'Log Value',
            'log_amount' => 'Log Amount',
            'log_ismoney' => 'Log Ismoney',
        ];
    }
}
