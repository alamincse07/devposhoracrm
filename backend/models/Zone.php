<?php

namespace app\models;
use app\models\City;

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
	public function getModules()
	{
		return $this->hasOne(City::className(), ['id'=>'city_id']);
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
            'city_id' => 'City ID',
            'name' => 'Name',
			'moduleName'=>Yii::t('app', 'City'),
        ];
    }
}
