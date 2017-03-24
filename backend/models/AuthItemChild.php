<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_item_child".
 *
 * @property string $parent
 * @property string $child
 *
 * @property AuthItem $parent0
 * @property AuthItem $child0
 */
class AuthItemChild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_item_child';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['parent' => 'name']],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['child' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'parent' => 'Parent',
            'child' => 'Child',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChild0()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'child']);
    }

    public function getList(){
        return $role=AuthItemChild::find()->groupBy(['parent'])->select('parent')->all();
    }
    public function getDel($parents){
        return $this->deleteall("parent = '$parents'");
    }
    public function getAdd($date){
         $this->setAttributes($date); //增加
         return $this ->save();
    }
    public function getRows($parent){
        return $role=AuthItemChild::find()->select('child')->where("parent='$parent'")->asArray()->all();
    }
    public function getAddAll($data,$parent){
        $this->deleteall("parent = '$parent'");
        return Yii::$app->db->createCommand()->batchInsert(AuthItemChild::tableName(), ['parent', 'child'], $data)->execute(); //增加
    }
}
