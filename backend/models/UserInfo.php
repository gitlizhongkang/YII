<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_info}}".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $sex
 * @property string $height
 * @property string $birthday
 * @property string $birthland
 * @property string $residence
 * @property string $education
 * @property string $experience
 * @property integer $marriage
 * @property integer $reg_time
 * @property integer $status
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'education', 'experience', 'marriage'], 'required'],
            [['user_id', 'marriage', 'reg_time'], 'integer'],
            [['name', 'birthday', 'residence'], 'string', 'max' => 30],
            [['sex'], 'string', 'max' => 3],
            [['height'], 'string', 'max' => 5],
            [['birthland'], 'string', 'max' => 255],
            [['education', 'experience'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'sex' => 'Sex',
            'height' => 'Height',
            'birthday' => 'Birthday',
            'birthland' => 'Birthland',
            'residence' => 'Residence',
            'education' => 'Education',
            'experience' => 'Experience',
            'marriage' => 'Marriage',
            'reg_time' => 'Reg Time',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }*/
}
