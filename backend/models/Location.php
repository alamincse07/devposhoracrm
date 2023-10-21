<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property int $city_id
 * @property int $zone_id
 * @property string $name
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'zone_id', 'name'], 'required'],
            [['city_id', 'zone_id'], 'integer'],
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
	
	public function getZone()
	{
		return $this->hasOne(Zone::className(), ['id'=>'zone_id']);
	}
	
	/* Getter for country name */
	public function getZoneName() {
		return $this->zone->name;
	}
	
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City ID',
            'zone_id' => 'Zone ID',
            'name' => 'Name',
			'moduleName'=>Yii::t('app', 'City'),
			'zoneName'=>Yii::t('app', 'Zone'),
        ];
    }
}
