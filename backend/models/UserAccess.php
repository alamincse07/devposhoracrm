<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_access".
 *
 * @property int $id
 * @property int $user_id
 * @property string $cname
 * @property string $actions
 */
class UserAccess extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', ], 'required'],
            [['user_id'], 'integer'],
            [['cname', 'actions'], 'string', 'max' => 255],
        ];
    }
public function getModules()
	{
		return $this->hasOne(User::className(), ['id'=>'user_id']);
	}
	
	/* Getter for country name */
	public function getModuleName() {
		return $this->modules->username;
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'cname' => 'Link',
            'actions' => 'Actions',
			'moduleName'=>Yii::t('app', 'Username'),
        ];
    }
}
