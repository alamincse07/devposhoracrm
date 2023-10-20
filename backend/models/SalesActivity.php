<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sales_activity".
 *
 * @property int $id
 * @property int $customer_id
 * @property string $invoice_no
 * @property string $invoice_date
 * @property string $sales_catagories
 * @property string $service_order_gateway
 * @property string $service_date
 * @property string $services_category
 * @property string $services_line
 * @property string $company_name_b2b
 * @property string $customer_name
 * @property string $customer_mobile
 * @property string $customer_email
 * @property string $customer_address
 * @property string $sp_name
 * @property string $sp_cell_number
 * @property string $city
  * @property string $zone
    * @property string $sales_status
 * @property string $location
 * @property string $address
 * @property string $mode_of_payments
  * @property string $receiver_name
   * @property string $field_representative
 * @property string $name_of_representative
 * @property string $poshora_received_date
 * @property double $invoice_bill
 * @property double $ssl_charge
 * @property double $vat
 * @property double $service_charge
 * @property double $ssl_charge_factoring
 * @property double $poshora_charge
 * @property double $sp_service_charges
 * @property double $poshora_received
 * @property double $additional_received
 * @property double $sp_spare_parts
 * @property double $sp_discount_demurrage
 * @property double $poshora_spare_parts
 * @property double $poshora_discount_demurrage
 * @property double $net_bill_claimed
 * @property double $deduction_vat
 * @property double $deduction_ait
 * @property double $net_paid
 * @property string $remarks
  * @property string $added_date
 * @property string $added_by
 * @property string $edit_date
 * @property string $edit_by
 */
class SalesActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'invoice_no', 'invoice_date', 'sales_catagories', 'service_order_gateway', 'service_date', 'services_category', 'services_line', 'invoice_bill', 'added_date', 'added_by', 'added_date', 'edit_date'], 'required'],
            [['customer_id'], 'integer'],
            [['invoice_date', 'service_date', 'poshora_received_date'], 'safe'],
            [['invoice_bill', 'ssl_charge', 'vat', 'service_charge', 'ssl_charge_factoring', 'poshora_charge', 'sp_service_charges', 'poshora_received', 'additional_received', 'sp_spare_parts', 'sp_discount_demurrage', 'poshora_spare_parts', 'poshora_discount_demurrage', 'net_bill_claimed', 'deduction_vat', 'deduction_ait', 'net_paid'], 'number'],
            [['remarks'], 'string'],
            [['invoice_no', 'sales_catagories', 'service_order_gateway', 'services_category', 'services_line', 'company_name_b2b', 'customer_name', 'customer_mobile', 'customer_email', 'customer_address', 'sp_name', 'sp_cell_number', 'city', 'location', 'address', 'mode_of_payments', 'receiver_name', 'field_representative', 'name_of_representative','sales_status','zone', 'added_by', 'edit_by'], 'string', 'max' => 255],
        ];
    }
	
	public function getSercat()
	{
		return $this->hasOne(ServiceCategory::className(), ['id'=>'services_category']);
	}
	
	/* Getter for country name */
	public function getSercatName() {
		return $this->sercat->category;
	}
	public function getSerline()
	{
		return $this->hasOne(ServiceLines::className(), ['id'=>'services_line']);
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
            'customer_id' => 'Customer ID',
            'invoice_no' => 'Invoice No',
            'invoice_date' => 'Invoice Date',
            'sales_catagories' => 'Sales Catagories',
            'service_order_gateway' => 'Service Order Gateway',
            'service_date' => 'Service Date',
            'services_category' => 'Services Category',
            'services_line' => 'Services Line',
            'company_name_b2b' => 'Company Name B2b',
            'customer_name' => 'Customer Name',
            'customer_mobile' => 'Customer Mobile',
            'customer_email' => 'Customer Email',
            'customer_address' => 'Customer Address',
            'sp_name' => 'SP Name',
            'sp_cell_number' => 'SP Cell Number',
            'city' => 'City',
			'zone' =>'Zone',
            'location' => 'Location',
            'address' => 'Address',
            'mode_of_payments' => 'Mode Of Payments',
			 'receiver_name' =>'Receiver Name', 
			 'field_representative' =>'Field Representative', 
            'name_of_representative' => 'Name Of Representative',
            'poshora_received_date' => 'Poshora Received Date',
			'sales_status' =>'Sales Status',
            'invoice_bill' => 'Invoice Bill',
            'ssl_charge' => 'SSL Charge',
            'vat' => 'VAT',
            'service_charge' => 'Service Charge',
            'ssl_charge_factoring' => 'SSL Charge Factoring',
            'poshora_charge' => 'Poshora Charge',
            'sp_service_charges' => 'SP Service Charges',
            'poshora_received' => 'Poshora Received',
            'additional_received' => 'Additional Received',
            'sp_spare_parts' => 'SP Spare Parts',
            'sp_discount_demurrage' => 'SP Discount Demurrage',
            'poshora_spare_parts' => 'Poshora Spare Parts',
            'poshora_discount_demurrage' => 'Poshora Discount Demurrage',
            'net_bill_claimed' => 'Net Bill Claimed',
            'deduction_vat' => 'Deduction VAT',
            'deduction_ait' => 'Deduction AIT',
            'net_paid' => 'Net Paid',
            'remarks' => 'Remarks',
			 'added_date' => 'Added Date',
            'added_by' => 'Added By',
            'edit_date' => 'Edit Date',
            'edit_by' => 'Edit By',
			'sercatName'=>Yii::t('app', 'Service Category'),
			'serlineName'=>Yii::t('app', 'Service Line'),
        ];
    }
}
