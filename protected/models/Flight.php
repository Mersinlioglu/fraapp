<?php

/**
 * This is the model class for table "flight".
 *
 * The followings are the available columns in table 'flight':
 * @property integer $id
 * @property string $code
 * @property string $departure_time
 *
 * The followings are the available model relations:
 * @property Operation[] $operations
 */
class Flight extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Flight the static model class
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
		return 'flight';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, departure_time', 'required'),
			array('code, departure_time', 'length', 'max'=>55),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code, departure_time', 'safe', 'on'=>'search'),
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
			'operations' => array(self::HAS_MANY, 'Operation', 'flight_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'departure_time' => 'Departure Time',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('departure_time',$this->departure_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getRemainingTime(){


		$now = new DateTime('now');

		$oDate = DateTime::createFromFormat('H:i', $this->departure_time);

// echo $now->getTimestamp() . "<br>";
// return  $oDate->format('H:i');
// echo  $oDate->getTimestamp() . "<br>";

		$interval = date_diff($oDate, $now);
		$diff = $oDate->getTimestamp() - $now->getTimestamp();


		$diffTimestamp = ( time() - ( $oDate->getTimestamp() + (60*60*24)) ) % (60*60*24);
// echo $diffTimestamp . "<br>";

		if($diffTimestamp <0)
			$diffTimestamp *= -1;

		// $minutes = $diffTimestamp / 60;
		// $hours = $diffTimestamp / (60*60);

		return $diffTimestamp;
		// return $interval->format('%h hours %i minutes');
		
	}

	public function getDepartureTimeBefore($minutes){

		$minInSeconds = $minutes * 60 ;

		$oDate = DateTime::createFromFormat('H:i', $this->departure_time);

		$oDate->sub(new DateInterval('PT'.$minInSeconds.'S'));
		// ( $oDate->getTimestamp() - $minInSeconds ) %

		return $oDate->format("H:i");
	}
}