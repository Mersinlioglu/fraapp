<?php

/**
 * This is the model class for table "estimated_operation_time".
 *
 * The followings are the available columns in table 'estimated_operation_time':
 * @property integer $aircrafttype_id
 * @property integer $before_flight_check_time
 * @property integer $onblock
 * @property integer $door_opened
 * @property integer $gettingout_passangers
 * @property integer $cleaning
 * @property integer $security_check
 * @property integer $boarding_business
 * @property integer $boarding_economy
 * @property integer $doors_closed
 * @property integer $pushback
 *
 * The followings are the available model relations:
 * @property AircraftType $aircrafttype
 */
class EstimatedOperationTime extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EstimatedOperationTime the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'estimated_operation_time';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aircrafttype_id, before_flight_check_time, onblock, door_opened, gettingout_passangers, cleaning, security_check, boarding_business, boarding_economy, doors_closed, pushback', 'default'),
			array('aircrafttype_id, before_flight_check_time, onblock, door_opened, gettingout_passangers, cleaning, security_check, boarding_business, boarding_economy, doors_closed, pushback', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('aircrafttype_id, before_flight_check_time, onblock, door_opened, gettingout_passangers, cleaning, security_check, boarding_business, boarding_economy, doors_closed, pushback', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'aircrafttype' => array(self::BELONGS_TO, 'AircraftType', 'aircrafttype_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'aircrafttype_id' => 'Aircrafttype',
			'before_flight_check_time' => 'Before Flight Check Time',
			'onblock' => 'Onblock',
			'door_opened' => 'Door Opened',
			'gettingout_passangers' => 'Gettingout Passangers',
			'cleaning' => 'Cleaning',
			'security_check' => 'Security Check',
			'boarding_business' => 'Boarding Business',
			'boarding_economy' => 'Boarding Economy',
			'doors_closed' => 'Doors Closed',
			'pushback' => 'Pushback',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('aircrafttype_id',$this->aircrafttype_id);
		$criteria->compare('before_flight_check_time',$this->before_flight_check_time);
		$criteria->compare('onblock',$this->onblock);
		$criteria->compare('door_opened',$this->door_opened);
		$criteria->compare('gettingout_passangers',$this->gettingout_passangers);
		$criteria->compare('cleaning',$this->cleaning);
		$criteria->compare('security_check',$this->security_check);
		$criteria->compare('boarding_business',$this->boarding_business);
		$criteria->compare('boarding_economy',$this->boarding_economy);
		$criteria->compare('doors_closed',$this->doors_closed);
		$criteria->compare('pushback',$this->pushback);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}