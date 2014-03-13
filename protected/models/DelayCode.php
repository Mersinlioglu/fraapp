<?php

/**
 * This is the model class for table "delay_code".
 *
 * The followings are the available columns in table 'delay_code':
 * @property integer $opid
 * @property string $cod1
 * @property integer $min1
 * @property string $cod2
 * @property integer $min2
 * @property string $cod3
 * @property integer $min3
 * @property string $cod4
 * @property integer $min4
 */
class DelayCode extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DelayCode the static model class
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
		return 'delay_code';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('opid, cod2, min2, cod3, min3, cod4, min4', 'default'),
			array('opid, min1, min2, min3, min4', 'numerical', 'integerOnly'=>true),
			array('cod1, cod2, cod3, cod4', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('opid, cod1, min1, cod2, min2, cod3, min3, cod4, min4', 'safe', 'on'=>'search'),
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
			'oOperation'=>array(self::BELONGS_TO, 'Operation', 'opid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'opid' => 'Opid',
			'cod1' => 'Cod1',
			'min1' => 'Min1',
			'cod2' => 'Cod2',
			'min2' => 'Min2',
			'cod3' => 'Cod3',
			'min3' => 'Min3',
			'cod4' => 'Cod4',
			'min4' => 'Min4',
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

		$criteria->compare('opid',$this->opid);
		$criteria->compare('cod1',$this->cod1,true);
		$criteria->compare('min1',$this->min1);
		$criteria->compare('cod2',$this->cod2,true);
		$criteria->compare('min2',$this->min2);
		$criteria->compare('cod3',$this->cod3,true);
		$criteria->compare('min3',$this->min3);
		$criteria->compare('cod4',$this->cod4,true);
		$criteria->compare('min4',$this->min4);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}