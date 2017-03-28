<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%points}}".
 *
 * @property string $id
 * @property string $uid
 * @property string $points
 */
class Points extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%points}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid', 'points'], 'integer'],
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
            'points' => 'Points',
        ];
    }
    public function select()
    {
        return Points::find()->asArray()->all();
    }
}
