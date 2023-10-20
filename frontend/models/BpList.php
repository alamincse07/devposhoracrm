<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bp_list".
 *
 * @property int $id
 * @property string $bp_name
 * @property string $mobile
 * @property int $zone
 */
class BpList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bp_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bp_name', 'mobile'], 'required'],
            [['zone'], 'integer'],
            [['bp_name', 'mobile'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bp_name' => 'SSR Name',
            'mobile' => 'Mobile',
            'zone' => 'Zone',
        ];
    }
}
