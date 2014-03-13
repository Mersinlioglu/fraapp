<?php

/**
 * This is the model class for table "aircraft_type".
 *
 * The followings are the available columns in table 'aircraft_type':
 * @property integer $id
 * @property string $name
 * @property integer $ground_time
 *
 * The followings are the available model relations:
 * @property Operation[] $operations
 */
class AircraftType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AircraftType the static model class
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
		return 'aircraft_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, ground_time', 'required'),
			array('ground_time', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>55),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, ground_time', 'safe', 'on'=>'search'),
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
			'operations' => array(self::HAS_MANY, 'Operation', 'aircrafttype_id'),
			'estimatedOperationTime' => array(self::BELONGS_TO, 'EstimatedOperationTime', 'estimated_operation_time_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'ground_time' => 'Ground Time',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('ground_time',$this->ground_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}