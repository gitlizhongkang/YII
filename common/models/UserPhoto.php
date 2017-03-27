<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%user_photo}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $photo
 * @property integer $status
 */
class UserPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_photo}}';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status'], 'integer'],
            [['photo'], 'safe'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'photo' => 'Photo',
            'status' => 'Status',
        ];
    }


    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UserPhoto::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }


    /**
     * @return array
     */
    public function upload()
    {
        $fileArr = [];
        foreach ($this->photo as $fileObj)
        {
            //文件名
            $filePath = $this->fileName($fileObj);
            //保存文件
            $fileObj->saveAs($filePath);

            //文件名数组
            $fileArr[] = $filePath;
        }
        return $fileArr;
    }


    /**
     * @param $fileObj
     * @return string
     */
    protected function fileName($fileObj)
    {
        return 'uploads/' . time() . rand(11,99) . '.' . $fileObj->extension;
    }
}
