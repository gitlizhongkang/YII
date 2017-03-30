<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property string $id
 * @property string $uid
 * @property string $pay_type
 * @property integer $is_paid
 * @property string $oid
 * @property string $amount
 * @property string $payment_name
 * @property string $points
 * @property string $addtime
 * @property string $payment_time
 * @property string $description
 * @property string $setmeal
 * @property string $notes
 * @property integer $week
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'pay_type', 'is_paid', 'points', 'addtime', 'payment_time', 'setmeal', 'week'], 'integer'],
            [['amount'], 'number'],
            [['oid'], 'string', 'max' => 200],
            [['payment_name'], 'string', 'max' => 20],
            [['description', 'notes'], 'string', 'max' => 150],
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
            'pay_type' => 'Pay Type',
            'is_paid' => 'Is Paid',
            'oid' => 'Oid',
            'amount' => 'Amount',
            'payment_name' => 'Payment Name',
            'points' => 'Points',
            'addtime' => 'Addtime',
            'payment_time' => 'Payment Time',
            'description' => 'Description',
            'setmeal' => 'Setmeal',
            'notes' => 'Notes',
            'week' => 'Week',
        ];
    }
    public function select()
    {
        return Order::find()->asArray()->all();
    }
}
