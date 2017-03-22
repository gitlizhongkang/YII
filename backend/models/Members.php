<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%members}}".
 *
 * @property integer $uid
 * @property string $username
 * @property string $email
 * @property string $mobile
 * @property string $password
 * @property integer $reg_time
 * @property string $reg_ip
 * @property integer $last_login_time
 * @property string $last_login_ip
 * @property string $qq_nick
 * @property integer $qq_blind_time
 * @property integer $points
 */
class Members extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%members}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reg_time', 'last_login_time', 'qq_blind_time', 'points'], 'integer'],
            [['username', 'email', 'mobile', 'password', 'reg_ip', 'last_login_ip', 'qq_nick'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'username' => 'Username',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'password' => 'Password',
            'reg_time' => 'Reg Time',
            'reg_ip' => 'Reg Ip',
            'last_login_time' => 'Last Login Time',
            'last_login_ip' => 'Last Login Ip',
            'qq_nick' => 'Qq Nick',
            'qq_blind_time' => 'Qq Blind Time',
            'points' => 'Points',
        ];
    }
}
