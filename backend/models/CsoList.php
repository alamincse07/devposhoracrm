<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cso_list".
 *
 * @property int $id
 * @property string $cso_name
 * @property string $mobile
 */
class CsoList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cso_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cso_name', 'mobile'], 'required'],
            [['cso_name', 'mobile'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cso_name' => 'Cso Name',
            'mobile' => 'Mobile',
        ];
    }
}
