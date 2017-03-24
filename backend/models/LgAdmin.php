<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lg_admin".
 *
 * @property integer $admin_id
 * @property string $admin_name
 * @property string $pwd
 * @property integer $add_time
 */
class LgAdmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lg_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['add_time'], 'integer'],
            [['admin_name', 'pwd'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'admin_name' => 'Admin Name',
            'pwd' => 'Pwd',
            'add_time' => 'Add Time',
        ];
    }
    public function getAdd($date){
         $this->setAttributes($date); //增加
         $this ->save();
    }
    public function getLastId(){
        $id = $this->attributes['admin_id'];
        return $id;
    }
}
