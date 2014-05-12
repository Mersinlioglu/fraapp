<?php

class TaskController extends Controller
{
	public function actionIndex()
	{

		$criteria=new CDbCriteria();
		$criteria->with=array('aTicketAssignments');
		$criteria->condition='aTicketAssignments.user_id = '. Yii::app()->user->getId();

		$dataProvider=new CActiveDataProvider('Ticket', array('criteria'=>$criteria,));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));

	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);

		if(isset($_POST['assignToMe']) ) {
			$model->editor_id = Yii::app()->user->getId();
			$model->accepted = time();
			$model->save();


			$oUser = User::GetLoggedInUser();


			$emailBody = "Merhaba " . $oUser->username . "\r\n\r\n";
			$emailBody .= "'" . $model->title . "' isimli görev " . $oUser->name . " " . $oUser->lastname . " tarafindan üstlenilmistir.\r\n\r\n";

  			$contactMailer = new Mailer();
  			$contactMailer->addAddress($model->oCreator->email);
  			$contactMailer->setSubject("Task assigned: " . $model->title);
  			$contactMailer->setBody($emailBody);
  			$contactMailer->setAutoSignature();
  			$contactMailer->send();

		}

		if(isset($_POST['setAsDone'])) {
			$model->done = time();
			$model->save();


			$oUser = User::GetLoggedInUser();

			$emailBody = "Merhaba " . $oUser->username . "\r\n\r\n";
			$emailBody .= "'" . $model->title . "' isimli görev " . $oUser->name . " " . $oUser->lastname . " tarafindan tamamlanmistir.\r\n\r\n";

			$contactMailer = new Mailer();
			$contactMailer->addAddress($model->oCreator->email);
			$contactMailer->setSubject("Task done: " . $model->title);
			$contactMailer->setBody($emailBody);
			$contactMailer->setAutoSignature();
			$contactMailer->send();
		}

		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function loadModel($id)
	{
		$model=Ticket::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		return $model;
	}


	public function actionSetAsDone(){

		$oTicket = Ticket::model()->findByPk($_POST['id']);
		$oTicket->done = time();
		$oTicket->save();

		$this->renderPartial('setAsDone', array('model'=>$oTicket));
	}

	public function actionAssignToMe(){

		$oTicket = Ticket::model()->findByPk($_POST['id']);
		$oTicket->editor_id = Yii::app()->user->getId();
		// $oTicket->save();

		$this->renderPartial('assignToMe', array('model'=>$oTicket), false, true);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{

		// $criteria=new CDbCriteria();
		// $criteria->with=array('aTicketAssignments');
		// $criteria->condition='aTicketAssignments.user_id = '. Yii::app()->user->getId();

		// $dataProvider=new CActiveDataProvider('Ticket', array('criteria'=>$criteria,));

		$model=new Ticket('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ticket']))
			$model->attributes=$_GET['Ticket'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}