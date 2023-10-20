<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bp_activity".
 *
 * @property int $id
 * @property int $bp_id
 * @property string $bp_name
 * @property string $assigned_person
 * @property string $date
 * @property string $week_day
 * @property string $company_name
 * @property string $clients_representative_name
 * @property string $clients_representative_number
 * @property string customer_email
 * @property string $work_start_time
 * @property string $work_end_time
 * @property string $work_duration
 * @property string $city
 * @property string $zone
 * @property string $address
 * @property string $daily_status
 * @property string $assigned_activities
 * @property string $job_type
 * @property string $customers_categories
 * @property string $query_status
 * @property string $service_category
 * @property string $service_line
 * @property int $leaflet_distribution_number
 * @property string $apps_installed
 * @property string $notes
 */
class BpActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bp_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bp_id', 'bp_name', 'assigned_person', 'date', 'clients_representative_name', 'clients_representative_number', 'address','city', 'zone'], 'required'],
            [['bp_id', 'leaflet_distribution_number'], 'integer'],
            [['date'], 'safe'],
            [['apps_installed'], 'string'],
            [['bp_name', 'assigned_person', 'week_day', 'company_name', 'clients_representative_name', 'clients_representative_number', 'customer_email', 'work_start_time', 'work_end_time', 'work_duration', 'city', 'zone', 'address', 'daily_status', 'assigned_activities', 'job_type', 'customers_categories', 'query_status', 'service_category', 'service_line'], 'string', 'max' => 255],
            [['notes'], 'string', 'max' => 512],
        ];
    }
	public function getModules()
	{
		return $this->hasOne(City::className(), ['id'=>'city']);
	}
	
	/* Getter for country name */
	public function getModuleName() {
		return $this->modules->name;
	}
	
	public function getZones()
	{
		return $this->hasOne(Zone::className(), ['id'=>'zone']);
	}
	
	/* Getter for country name */
	public function getZoneName() {
		return $this->zones->name;
	}
	public function getSercat()
	{
		return $this->hasOne(ServiceCategory::className(), ['id'=>'service_category']);
	}
	
	/* Getter for country name */
	public function getSercatName() {
		return $this->sercat->category;
	}
	public function getSerline()
	{
		return $this->hasOne(ServiceLines::className(), ['id'=>'service_line']);
	}
	
	/* Getter for country name */
	public function getSerlineName() {
		return $this->serline->lines;
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bp_id' => 'SSO ID',
            'bp_name' => 'SSO Name',
            'assigned_person' => 'Assigned Person',
            'date' => 'Date',
            'week_day' => 'Week Day',
            'company_name' => 'Company Name',
            'clients_representative_name' => 'Clients Representative Name',
            'clients_representative_number' => 'Clients Representative Number',
			'customer_email' =>'Customer Email',
            'work_start_time' => 'Work Start Time',
            'work_end_time' => 'Work End Time',
            'work_duration' => 'Work Duration',
            'city' => 'City',
            'zone' => 'Zone',
            'address' => 'Address',
            'daily_status' => 'Daily Status',
            'assigned_activities' => 'Assigned Activities',
            'job_type' => 'Job Type',
            'customers_categories' => 'Customers Categories',
            'query_status' => 'Query Status',
            'service_category' => 'Service Category',
            'service_line' => 'Service Line',
            'leaflet_distribution_number' => 'Leaflet Distribution Number',
            'apps_installed' => 'Apps Installed',
            'notes' => 'Notes',
			'moduleName'=>Yii::t('app', 'City'),
			'zoneName'=>Yii::t('app', 'Zone'),
			'sercatName'=>Yii::t('app', 'Service Category'),
			'serlineName'=>Yii::t('app', 'Service Line'),
        ];
    }
}
