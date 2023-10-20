<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cso_call_source_target".
 *
 * @property int $id
 * @property string $target_from
 * @property string $target_to
 * @property string $target_daterange
 * @property int $cso_id
 * @property string $call_source
 * @property int $target
 */
class CsoCallSourceTarget extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cso_call_source_target';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['target_from', 'target_to', 'cso_id', 'call_source', 'target'], 'required'],
            [['target_from', 'target_to'], 'safe'],
            [['cso_id', 'target'], 'integer'],
            [['target_daterange', 'call_source'], 'string', 'max' => 255],
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
            'call_source' => 'Call Source',
            'target' => 'Target',
			'moduleName'=>Yii::t('app', 'CSO'),
        ];
    }
}
