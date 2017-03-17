<?php
namespace backend\models;
use Yii;

class Mail extends \yii\db\ActiveRecord {

    public $to;
    public $subject;
    public $body;

    public function rules() {
        return array(
            array('to, subject, body', 'required'),
            array('to, subject, body ','safe'),
        );
    }

    public function attributeLabels() {
        return array(
            'to' => '收信人',
            'subject' => '标题',
            'body' => '邮件内容',
        );
    }
}
?>