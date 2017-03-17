<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%resume}}".
 *
 * @property string $id
 * @property string $uid
 * @property integer $click
 * @property integer $audit
 * @property integer $display
 * @property string $title
 * @property string $name
 * @property string $photo
 * @property integer $sex
 * @property string $height
 * @property integer $birthday
 * @property string $tel
 * @property string $email
 * @property string $residence
 * @property string $birthland
 * @property integer $marriage
 * @property integer $nature
 * @property string $experience
 * @property string $education
 * @property string $major
 * @property integer $intention_jobs_id
 * @property string $wage
 * @property string $good_at
 * @property string $specialty
 * @property integer $addtime
 * @property integer $refreshtime
 */
class Resume extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%resume}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'title', 'name', 'sex', 'height', 'birthday', 'tel', 'email', 'experience', 'education', 'major', 'intention_jobs_id', 'wage', 'good_at', 'specialty', 'addtime', 'refreshtime'], 'required'],
            [['uid', 'click', 'audit', 'display', 'sex', 'birthday', 'marriage', 'nature', 'intention_jobs_id', 'wage', 'addtime', 'refreshtime'], 'integer'],
            [['title'], 'string', 'max' => 80],
            [['name'], 'string', 'max' => 15],
            [[ 'tel', 'major'], 'string', 'max' => 50],//'photo',
            [['height'], 'string', 'max' => 5],
            [['email'], 'string', 'max' => 60],
            [['residence', 'birthland'], 'string', 'max' => 30],
            [['experience', 'education'], 'string', 'max' => 10],
            [['good_at'], 'string', 'max' => 250],
            [['specialty'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'click' => 'Click',
            'audit' => 'Audit',
            'display' => 'Display',
            'title' => 'Title',
            'name' => 'Name',
            'photo' => 'Photo',
            'sex' => 'Sex',
            'height' => 'Height',
            'birthday' => 'Birthday',
            'tel' => 'Tel',
            'email' => 'Email',
            'residence' => 'Residence',
            'birthland' => 'Birthland',
            'marriage' => 'Marriage',
            'nature' => 'Nature',
            'experience' => 'Experience',
            'education' => 'Education',
            'major' => 'Major',
            'intention_jobs_id' => 'Intention Jobs ID',
            'wage' => 'Wage',
            'good_at' => 'Good At',
            'specialty' => 'Specialty',
            'addtime' => 'Addtime',
            'refreshtime' => 'Refreshtime',
        ];
    }
}
