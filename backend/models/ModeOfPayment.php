<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mode_of_payment".
 *
 * @property int $id
 * @property string $payment_mode
 */
class ModeOfPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mode_of_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_mode'], 'required'],
            [['payment_mode'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_mode' => 'Payment Mode',
        ];
    }
}
