<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_info}}".
 *
 * @property integer $user_id
 * @property string $name
 * @property integer $sex
 * @property string $height
 * @property string $birthday
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $district_id
 * @property string $residence
 * @property string $education
 * @property string $experience
 * @property integer $marriage
 * @property integer $reg_time
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $birthland;
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
<<<<<<< HEAD
            [['user_id', 'education', 'experience'], 'required'],
            [['user_id', 'sex', 'province_id', 'city_id', 'district_id', 'marriage', 'reg_time'], 'integer'],
            [['name', 'birthday'], 'string', 'max' => 30],
=======
            [['user_id'], 'required'],
            [['user_id', 'marriage', 'reg_time'], 'integer'],
            [['name', 'birthday', 'residence'], 'string', 'max' => 30],
            [['sex'], 'string', 'max' => 3],
>>>>>>> 828e1ae08b72b46c61888a1a6d09448a0b615d19
            [['height'], 'string', 'max' => 5],
            [['education', 'experience','residence'], 'string', 'max' => 50],
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
            'province_id' => 'Province ID',
            'city_id' => 'City ID',
            'district_id' => 'District ID',
            'residence' => 'Residence',
            'education' => 'Education',
            'experience' => 'Experience',
            'marriage' => 'Marriage',
            'reg_time' => 'Reg Time',
        ];
    }
<<<<<<< HEAD
=======


    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }*/
    public function add($arr){
        $this->setAttributes($arr);
        return $this->save($arr);
    }
>>>>>>> 828e1ae08b72b46c61888a1a6d09448a0b615d19
}
