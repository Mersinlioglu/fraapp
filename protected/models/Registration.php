<?php

class Registration extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserType the static model class
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
		return 'registration';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'default'),
			array('code', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			// 'ticketAssignments' => array(self::HAS_MANY, 'TicketAssignment', 'ticket_id'),
			// 'aUsers'=>array(self::MANY_MANY, 'User', 'ticket_assignment(user_id, ticket_id)'),
			// 'oCreator'=>array(self::BELONGS_TO, 'User', 'creator_id'),
			// 'oEditor'=>array(self::BELONGS_TO, 'User', 'editor_id'),
			// 'aTicketAssignments'=>array(self::HAS_MANY, 'TicketAssignment', 'ticket_id','together'=>true),

		);
	}


}

?>