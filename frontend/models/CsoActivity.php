<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cso_activity".
 *
 * @property int $id
 * @property string $call_number_source
 * @property string $contact_number
 * @property string $client_name
 * @property string $client_type
 * @property string $gender
 * @property string $city
 * @property string $zone
 * @property string $location
  * @property string $address
 * @property string $call_date
 * @property string $cso_name
 * @property string $call_start_time
 * @property string $call_end_time
 * @property string $call_duration
 * @property string $call_status
 * @property string $call_type
 * @property string $notes
 * @property string $service_category
 * @property string $service_line
 * @property string $action
 * @property string $apointment_date
 * @property string $status
 * @property string $service_order_number
 * @property string $order_gateway
 * @property string $assigned_bp_name
 * @property string $assigned_bp_number
 * @property string $assigned_sp_name
 * @property string $assigned_sp_number
 * @property string $sp_quotation
 * @property string $negotiated_price
 * @property string $customer_agreed_price
 * @property string $demurrage
 * @property string $discount_amount
 * @property string $sp_service_charge
 * @property string $psl_service_charge
 * @property string $vat
 * @property string $total_invoice_amount
 * @property string $customer_level
 * @property string $dialer_id
 */
class CsoActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cso_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['call_number_source', 'contact_number', 'client_name', 'client_type', 'gender', 'city', 'call_date', 'cso_name', 'call_type', 'call_status'], 'required'],
            [['gender'], 'string'],
            [['call_date', 'apointment_date'], 'safe'],
            [['call_number_source', 'contact_number', 'client_name', 'client_type', 'city', 'zone', 'location', 'cso_name', 'call_start_time', 'call_end_time', 'call_duration', 'call_status', 'call_type', 'service_category', 'service_line', 'action', 'status', 'service_order_number', 'order_gateway', 'assigned_bp_name', 'assigned_bp_number', 'assigned_sp_name', 'assigned_sp_number', 'sp_quotation', 'negotiated_price', 'customer_agreed_price', 'demurrage', 'discount_amount', 'sp_service_charge', 'psl_service_charge', 'vat', 'total_invoice_amount', 'customer_level', 'dialer_id','address'], 'string', 'max' => 255],
            [['notes','address'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'call_number_source' => 'Call Number Source',
            'contact_number' => 'Contact Number',
            'client_name' => 'Client Name',
            'client_type' => 'Client Type',
            'gender' => 'Gender',
            'city' => 'City',
            'zone' => 'Zone',
            'location' => 'Location',
			'address' =>'Address',
            'call_date' => 'Call Date',
            'cso_name' => 'Cso Name',
            'call_start_time' => 'Call Start Time',
            'call_end_time' => 'Call End Time',
            'call_duration' => 'Call Duration',
            'call_status' => 'Call Status',
            'call_type' => 'Call Type',
            'notes' => 'Notes',
            'service_category' => 'Service Category',
            'service_line' => 'Service Line',
            'action' => 'Action',
            'apointment_date' => 'Apointment Date',
            'status' => 'Status',
            'service_order_number' => 'Service Order Number',
            'order_gateway' => 'Order Gateway',
            'assigned_bp_name' => 'Assigned Bp Name',
            'assigned_bp_number' => 'Assigned Bp Number',
            'assigned_sp_name' => 'Assigned Sp Name',
            'assigned_sp_number' => 'Assigned SP Number',
            'sp_quotation' => 'SP Quotation',
            'negotiated_price' => 'Negotiated Price',
            'customer_agreed_price' => 'Customer Agreed Price',
            'demurrage' => 'Demurrage',
            'discount_amount' => 'Discount Amount',
            'sp_service_charge' => 'SP Service Charge',
            'psl_service_charge' => 'Psl Service Charge',
            'vat' => 'VAT',
            'total_invoice_amount' => 'Total Invoice Amount',
            'customer_level' => 'Customer Level',
            'dialer_id' => 'Dialer ID',
        ];
    }
}
