<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%payment}}".
 *
 * @property string $id
 * @property string $listorder
 * @property string $typename
 * @property string $byname
 * @property string $p_introduction
 * @property string $notes
 * @property string $partnerid
 * @property string $ytauthkey
 * @property string $fee
 * @property string $parameter1
 * @property string $parameter2
 * @property string $parameter3
 * @property integer $p_install
 */
class Pay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['listorder', 'p_install'], 'integer'],
            [['typename', 'byname', 'p_introduction'], 'required'],
            [['notes'], 'string'],
            [['typename'], 'string', 'max' => 15],
            [['byname', 'parameter1', 'parameter2', 'parameter3'], 'string', 'max' => 50],
            [['p_introduction', 'ytauthkey'], 'string', 'max' => 100],
            [['partnerid'], 'string', 'max' => 80],
            [['fee'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'listorder' => 'Listorder',
            'typename' => 'Typename',
            'byname' => 'Byname',
            'p_introduction' => 'P Introduction',
            'notes' => 'Notes',
            'partnerid' => 'Partnerid',
            'ytauthkey' => 'Ytauthkey',
            'fee' => 'Fee',
            'parameter1' => 'Parameter1',
            'parameter2' => 'Parameter2',
            'parameter3' => 'Parameter3',
            'p_install' => 'P Install',
        ];
    }
    public function select()
    {
        return Pay::find()->asArray()->all();
    }
}
