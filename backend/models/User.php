<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $user_level
 * @property string $email
 * @property int $status
 * @property string $password
 * @property int $bp_id
 * @property int $cso_id
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'user_level', 'email', 'password'], 'required'],
            [['status', 'bp_id', 'cso_id'], 'integer'],
            [['username', 'user_level', 'email', 'password'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'user_level' => 'User Level',
            'email' => 'Email',
            'status' => 'Status',
            'password' => 'Password',
            'bp_id' => 'Bp ID',
            'cso_id' => 'Cso ID',
        ];
    }
}
