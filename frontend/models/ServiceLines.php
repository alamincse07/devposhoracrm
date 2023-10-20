<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_lines".
 *
 * @property int $id
 * @property int $category_id
 * @property string $lines
 */
class ServiceLines extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_lines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'lines'], 'required'],
            [['category_id'], 'integer'],
            [['lines'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'lines' => 'Lines',
        ];
    }
}
