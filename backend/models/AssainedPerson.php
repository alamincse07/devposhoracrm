<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assained_person".
 *
 * @property int $id
 * @property string $name
 * @property string $mobile
 */
class AssainedPerson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assained_person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'mobile'], 'required'],
            [['name', 'mobile'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'mobile' => 'Mobile',
        ];
    }
}
