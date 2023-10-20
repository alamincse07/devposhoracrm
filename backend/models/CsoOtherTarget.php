<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cso_other_target".
 *
 * @property int $id
 * @property string $target_from
 * @property string $target_to
 * @property string $target_daterange
 * @property int $cso_id
 * @property int $sales_conversion_target
 * @property int $sales_amount_target
 * @property int $call_target
 */
class CsoOtherTarget extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cso_other_target';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['target_from', 'target_to', 'cso_id'], 'required'],
            [['target_from', 'target_to'], 'safe'],
            [['cso_id', 'sales_conversion_target', 'sales_amount_target', 'call_target'], 'integer'],
            [['target_daterange'], 'string', 'max' => 255],
        ];
    }
	public function getModules()
	{
		return $this->hasOne(CsoList::className(), ['id'=>'cso_id']);
	}
	
	/* Getter for country name */
	public function getModuleName() {
		return $this->modules->cso_name;
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
            'cso_id' => 'Cso ID',
            'sales_conversion_target' => 'Sales Conversion Target',
            'sales_amount_target' => 'Sales Amount Target',
            'call_target' => 'Call Target',
			'moduleName'=>Yii::t('app', 'CSO'),
        ];
    }
}
