<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $username
 * @property string $name
 * @property string $lastname
 * @property integer $gender
 * @property integer $birth
 * @property integer $type
 * @property string $street
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property integer $country
 * @property string $phone
 * @property string $phone_internal
 * @property integer $active
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property UserType $type0
 */
class User extends CActiveRecord
{

	const ADMIN = 4;
	const DIRECTOR = 1;
	private $salt = "apIdj12p3tEr308u./43Fnhsdi8jkna sd78()),..-asd";

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	public function beforeSave(){

		if($this->isNewRecord){
			$this->password = md5($this->salt.$this->password);
		}

		return parent::beforeSave();
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('birth, type, street, city, state, zipcode, country, phone, phone_internal, active', 'default'),
			array('email, password, username, name, lastname, gender', 'required'),
			array('id, gender, birth, type, active, deleted', 'numerical', 'integerOnly'=>true),
			array('email, street, city, state', 'length', 'max'=>64),
			array('password, username, name, lastname, phone, phone_internal', 'length', 'max'=>32),
			array('zipcode', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, password, username, name, lastname, gender, birth, type, street, city, state, zipcode, country, phone, phone_internal, active, deleted', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'UserType', 'type'),
			'aTickets'=>array(self::MANY_MANY, 'Ticket', 'ticket_assignment(user_id, ticket_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'password' => 'Password',
			'username' => 'Username',
			'name' => 'Name',
			'lastname' => 'Lastname',
			'gender' => 'Gender',
			'birth' => 'Birth',
			'type' => 'Type',
			'street' => 'Street',
			'city' => 'City',
			'state' => 'State',
			'zipcode' => 'Zipcode',
			'country' => 'Country',
			'phone' => 'Phone',
			'phone_internal' => 'Phone Internal',
			'active' => 'Active',
			'deleted' => 'Deleted',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('birth',$this->birth);
		$criteria->compare('type',$this->type);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('country',$this->country);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('phone_internal',$this->phone_internal,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function isAdmin() {
		if(self::isGuest())
			return false;
		
		$oUser = self::GetLoggedInUser();
		return ($oUser && $oUser->type->id == SELF::ADMIN) ?  true : false;
	}

	public static function GetLoggedInUser(){

		if(!isset(Yii::app()->user))
			return NULL;
		
		if(Yii::app()->user->isGuest)
			return NULL;

		return User::model()->findByPk(Yii::app()->user->id);
	}

	public function getFullName(){
		return $this->name." ".$this->lastname;
	}

	public static function getUserTypeList(){
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'id <> 4';
		$criteria->order = 'name DESC';

		$aTypes=UserType::model()->findAll($criteria);

		return CHtml::listData($aTypes, 'id', 'name');
	}

	public static function getAllUsers(){
		return User::model()->findAll();
	}

	public function setPassword($pass=""){
		if($pass!=""){
			
		}
	}


}