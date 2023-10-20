<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ssr_target".
 *
 * @property int $id
 * @property string $target_from
 * @property string $target_to
 * @property string $target_daterange
 * @property int $ssr_id
 * @property int $spot_sales_target
 * @property int $spot_sales_amount_target
 * @property int $sp_sourcing_in_hand_target
 * @property int $client_visit_for_service_assess_target
 * @property int $client_visit_during_service_target
 */
class SsrTarget extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ssr_target';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['target_from', 'target_to', 'ssr_id', 'spot_sales_target', 'spot_sales_amount_target', 'sp_sourcing_in_hand_target', 'client_visit_for_service_assess_target', 'client_visit_during_service_target'], 'required'],
            [['target_from', 'target_to'], 'safe'],
            [['ssr_id', 'spot_sales_target', 'spot_sales_amount_target', 'sp_sourcing_in_hand_target', 'client_visit_for_service_assess_target', 'client_visit_during_service_target'], 'integer'],
            [['target_daterange'], 'string', 'max' => 255],
        ];
    }
	public function getModules()
	{
		return $this->hasOne(BpList::className(), ['id'=>'ssr_id']);
	}
	
	/* Getter for country name */
	public function getModuleName() {
		return $this->modules->bp_name;
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'target_from' => 'Target From',
            'target_to' => 'Target To',
            'target_daterange' => 'Target Daterange',
            'ssr_id' => 'SSO ID',
            'spot_sales_target' => 'Spot Sales Target',
            'spot_sales_amount_target' => 'Spot Sales Amount Target',
            'sp_sourcing_in_hand_target' => 'Sp Sourcing In Hand Target',
            'client_visit_for_service_assess_target' => 'Client Visit For Service Assess Target',
            'client_visit_during_service_target' => 'Client Visit During Service Target',
			'moduleName'=>Yii::t('app', 'SSO'),
        ];
    }
}
