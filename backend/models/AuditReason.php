<?php
namespace app\models;
use Yii;
/**
 * This is the model class for table "{{%audit_reason}}".
 *
 * @property integer $id
 * @property integer $jobs_id
 * @property integer $company_id
 * @property integer $resume_id
 * @property string $reason
 * @property integer $addtime
 */
class AuditReason extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%audit_reason}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jobs_id', 'company_id', 'resume_id', 'addtime'], 'integer'],
            [['reason', 'addtime'], 'required'],
            [['reason'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jobs_id' => 'Jobs ID',
            'company_id' => 'Company ID',
            'resume_id' => 'Resume ID',
            'reason' => 'Reason',
            'addtime' => 'Addtime',
        ];
    }
    public function add($data)
    {
       $this->setAttributes($data);
        return $this->save();
    }
}
