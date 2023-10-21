<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "social_media_query".
 *
 * @property int $id
 * @property string $query_datetime
 * @property string $name
 * @property string $query_type
 * @property string $response_datetime
 * @property string $query_details
 * @property string $category
 * @property string $hide_del_ban
 * @property string $cso_name
 * @property string $response_time_duration
 * @property string $remarks
 * @property string $media
  * @property string $query_date
   * @property string $query_time
    * @property string $response_date
	 * @property string $response_time
	  * @property string $mobile
	   * @property string $service_category
	    * @property string $service_line
 */
class SocialMediaQuery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'social_media_query';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name', 'query_type',  'query_details', 'category', 'cso_name',], 'required'],
            [['query_datetime', 'response_datetime','query_date', 'response_date','query_time', 'response_time','service_category', 'service_line','mobile'], 'safe'],
            [['hide_del_ban', 'remarks', 'media','query_details'], 'string'],
            [['name', 'query_type', 'category', 'cso_name', 'response_time_duration', 'response_date','query_time', 'response_time','service_category', 'service_line','mobile'], 'string', 'max' => 255],
          
        ];
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
            'query_datetime' => 'Query Datetime',
            'name' => 'Name',
            'query_type' => 'Query Type',
            'response_datetime' => 'Response Datetime',
            'query_details' => 'Query Details',
            'category' => 'Category',
            'hide_del_ban' => 'Hide Del Ban',
            'cso_name' => 'CSO Name',
            'response_time_duration' => 'Response Time Duration',
            'remarks' => 'Remarks',
            'media' => 'Media',
			 'response_date' => 'Response Date',
			 'query_time' => 'Query Time', 
			  'response_time' => 'Response Time', 
			 'query_date' => 'Query Date',
			 'service_category' => 'Service Category', 
			 'service_line' => 'Service Line',
			 'mobile' => 'Mobile',
			 'sercatName'=>Yii::t('app', 'Service Category'),
			'serlineName'=>Yii::t('app', 'Service Line'),
        ];
    }
}
