<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%company_product}}".
 *
 * @property integer $id
 * @property integer $companyId
 * @property string $photo
 * @property string $product
 * @property string $productUrl
 * @property string $productProfile
 */
class CompanyProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companyId'], 'integer'],
            [['photo', 'product', 'productUrl', 'productProfile'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companyId' => 'Company ID',
            'photo' => 'Photo',
            'product' => 'Product',
            'productUrl' => 'Product Url',
            'productProfile' => 'Product Profile',
        ];
    }
}
