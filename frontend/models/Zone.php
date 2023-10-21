<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zone".
 *
 * @property int $id
 * @property int $city_id
 * @property string $name
 */
class Zone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zone';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'name'], 'required'],
            [['city_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City ID',
            'name' => 'Name',
        ];
    }
}
