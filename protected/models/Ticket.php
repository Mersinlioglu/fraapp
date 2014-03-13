<?php

/**
 * This is the model class for table "ticket".
 *
 * The followings are the available columns in table 'ticket':
 * @property integer $id
 * @property integer $creator_id
 * @property string $title
 * @property string $description
 * @property string $start_date
 * @property string $end_date
 *
 * The followings are the available model relations:
 * @property TicketAssignment[] $ticketAssignments
 */
class Ticket extends CActiveRecord
{

	public $aUserAssignmentIDs=null;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ticket the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function onAfterFind(){
		$this->getUserAssignmentIDs();
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ticket';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('editor_id,accepted', 'default'),
			array('creator_id, title, description, start_date, end_date', 'required'),
			array('id, creator_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, creator_id, title, description, start_date, end_date', 'safe', 'on'=>'search'),
		);
	}


	protected function beforeSave() {
		
		if ($this->isNewRecord){
			$this->start_date = date("Y-m-d",strtotime($this->start_date));
			$this->end_date = date("Y-m-d",strtotime($this->end_date));
		}
		
		return parent::beforeSave();
	}

	protected function afterSave() {
		


		
		return parent::beforeSave();
	}


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			// 'ticketAssignments' => array(self::HAS_MANY, 'TicketAssignment', 'ticket_id'),
			'aUsers'=>array(self::MANY_MANY, 'User', 'ticket_assignment(user_id, ticket_id)'),
			'oCreator'=>array(self::BELONGS_TO, 'User', 'creator_id'),
			'oEditor'=>array(self::BELONGS_TO, 'User', 'editor_id'),
			'aTicketAssignments'=>array(self::HAS_MANY, 'TicketAssignment', 'ticket_id','together'=>true),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'creator_id' => 'Creator',
			'title' => 'Title',
			'description' => 'Description',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'aTicketAssignments' => 'Ticket Assignments',
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
		$criteria->compare('creator_id',$this->creator_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getAssignedUsers($separor=","){
		
		$string = "";

		foreach ($this->aUsers as $key => $oUser) {
			$string.= ' '.$oUser->fullname.$separor;
		}

		$string = substr($string, 0, strlen($string)-1);

		return $string;
	}

	public function getUserAssignmentIDs(){

		if($this->aUserAssignmentIDs==null){

			$this->aUserAssignmentIDs = array();

			$criteria=new CDbCriteria;
			$criteria->condition='ticket_id=:ticket_id';
			$criteria->select = 'user_id';
			$criteria->params=array(':ticket_id'=>$this->id);
			$aUserAssignments = TicketAssignment::model()->findAll($criteria);

			foreach ($aUserAssignments as $assigment) {
			    $this->aUserAssignmentIDs[] = $assigment->user_id;
			}

		}

		return $this->aUserAssignmentIDs;
	}

}