<?php

/**
 * This is the model class for table "operation".
 *
 * The followings are the available columns in table 'operation':
 * @property integer $id
 * @property integer $user_id
 * @property integer $flight_id
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
 * @property integer $bagage_doors_closed
 * @property integer $pushback
 *
 * The followings are the available model relations:
 * @property AircraftType $aircrafttype
 * @property User $user
 * @property Flight $flight
 */
class Operation extends CActiveRecord
{

	public $fullName;
	public $aircrafttypename;

	public $date_first;
	public $date_last;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Operation the static model class
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
		return 'operation';
	}

	public function afterSave() 
	{
		//$this->delayCode->save(false);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bagage_doors_closed, op_error_log, cabin_config_ccl, cabin_config_ycl, cabin_config_tcl, cabin_pax_ccl, cabin_pax_ycl, cabin_pax_tcl, cabin_inf, cabin_id_dz', 'default'),
			array('user_id, flight_id, aircrafttype_id, registration_id, before_flight_check_time', 'required'),

			array('user_id, flight_id, aircrafttype_id, before_flight_check_time, onblock, door_opened, gettingout_passangers, cleaning, security_check, boarding_business, boarding_economy, doors_closed, pushback, erp_entry_done', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, flight_id, aircrafttype_id, before_flight_check_time, onblock, door_opened, gettingout_passangers, cleaning, security_check, boarding_business, boarding_economy, doors_closed, pushback, fullName, aircrafttypename, date_first, date_last', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'flight' => array(self::BELONGS_TO, 'Flight', 'flight_id'),
			'registration' => array(self::BELONGS_TO, 'Registration', 'registration_id'),
			'delayCode' => array(self::HAS_ONE, 'DelayCode', 'opid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'flight_id' => 'Flight',
			'aircrafttype_id' => 'Aircrafttype',
			'before_flight_check_time' => 'Checking start time',
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
		$criteria->alias = 'o';

		$criteria->compare('o.id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('flight_id',$this->flight_id);
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

		// $criteria->join= 'JOIN user u ON (u.id=o.user_id)';
		$criteria->with=array('user', 'aircrafttype');
		$criteria->compare('user.name',$this->fullName, true);
		$criteria->compare('aircrafttype.name',$this->aircrafttypename, true);

		if((isset($this->date_first) && trim($this->date_first) != "") && (isset($this->date_last) && trim($this->date_last) != "")) {
			list($day_first, $month_first, $year_first) = explode('.', $this->date_first);
			list($day_last, $month_last, $year_last) = explode('.', $this->date_last);
			$time_first = mktime(0, 0, 0, $month_first, $day_first, $year_first);
			$time_last = mktime(0, 0, 0, $month_last, $day_last, $year_last);
			$criteria->addBetweenCondition('before_flight_check_time', ''.$time_first.'', ''.$time_last.'');
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function searchUser()
    {
        $criteria=new CDbCriteria;
		$criteria->alias = 'o';

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('flight_id',$this->flight_id);
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

		$criteria->join= 'JOIN user u ON (u.id=o.user_id)';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
    }



    public function getAverageBusinessPresence() {

		$average = 0;
    	if($this->cabin_config_ccl != 0)
    		$average = $this->cabin_pax_ccl / $this->cabin_config_ccl * 100;
    	
    	return round($average, 2);
    }

    public function getAverageEconomyPresence() {

    	$average = 0;
    	if($this->cabin_config_ycl != 0)
    		$average = $this->cabin_pax_ycl / $this->cabin_config_ycl * 100;

    	return round($average, 2);

    }
}