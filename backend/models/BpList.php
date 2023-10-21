<?php

namespace app\models;
use app\models\Zone;
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
	
	public function getModules()
	{
		return $this->hasOne(Zone::className(), ['id'=>'zone']);
	}
	
	/* Getter for country name */
	public function getModuleName() {
		return $this->modules->name;
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bp_name' => 'SSO Name',
            'mobile' => 'Mobile',
            'zone' => 'Zone',
			'moduleName'=>Yii::t('app', 'Zone'),
        ];
    }
}
