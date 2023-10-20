<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assigned_activities".
 *
 * @property int $id
 * @property string $activity
 */
class AssignedActivities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assigned_activities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity'], 'required'],
            [['activity'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity' => 'Activity',
        ];
    }
}
