<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $customer_name
 * @property string $contact_number
 * @property string $company_name
 * @property string $email
 * @property string $call_number_source
 * @property string $customers_type
 * @property string $customers_categories
 * @property string $gender
 * @property string $city
 * @property string $zone
 * @property string $location
 * @property string $address
 * @property string $app_install
 * @property string $customer_level
 * @property string $added_date
 * @property string $added_by
 * @property string $edit_date
 * @property string $edit_by
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_name', 'contact_number'], 'required'],
            [['gender', 'app_install'], 'string'],
            [['added_date', 'edit_date'], 'safe'],
            [['customer_name', 'contact_number','email', 'company_name', 'call_number_source', 'customers_type', 'customers_categories', 'city', 'zone', 'location', 'address', 'customer_level', 'added_by', 'edit_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_name' => 'Customer Name',
            'contact_number' => 'Contact Number',
            'company_name' => 'Company Name',
			'email' =>'Email',
            'call_number_source' => 'Call Number Source',
            'customers_type' => 'Customers Type',
            'customers_categories' => 'Customers Categories',
            'gender' => 'Gender',
            'city' => 'City',
            'zone' => 'Zone',
            'location' => 'Location',
            'address' => 'Address',
            'app_install' => 'App Install',
            'customer_level' => 'Customer Level',
            'added_date' => 'Added Date',
            'added_by' => 'Added By',
            'edit_date' => 'Edit Date',
            'edit_by' => 'Edit By',
        ];
    }
}
