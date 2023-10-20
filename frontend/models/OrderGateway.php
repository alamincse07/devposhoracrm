<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_gateway".
 *
 * @property int $id
 * @property string $gateway
 */
class OrderGateway extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_gateway';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gateway'], 'required'],
            [['gateway'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gateway' => 'Gateway',
        ];
    }
}
