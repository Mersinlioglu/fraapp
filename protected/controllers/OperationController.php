<?php

class OperationController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'beforeFlight', 'duringOperation', 'afterOperation', 'admin',),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Operation;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Operation']))
		{
			$model->attributes=$_POST['Operation'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionBeforeFlight()
	{
		if(Yii::app()->user->isGuest)
			$this->redirect(array('site/login'));

		$model=new Operation;
		$model->user_id = Yii::app()->user->getId();
		$model->before_flight_check_time = time();

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Operation']))
		{
			$model->attributes=$_POST['Operation'];
			if($model->save())
				$this->redirect(array('duringOperation','id'=>$model->id));
		}

		$this->render('beforeFlight',array(
			'model'=>$model,
		));
	}

	public function actionDuringOperation($id)
	{
		if(Yii::app()->user->isGuest)
			$this->redirect(array('site/login'));
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Operation']))
		{
			$model->attributes=$_POST['Operation'];
			if($model->save())
				$this->redirect(array('afterOperation','id'=>$model->id));
		}

		$this->render('duringOperation',array(
			'model'=>$model,
		));
	}


	public function actionAfterOperation($id){

		$model=$this->loadModel($id);

		$delayCode = new DelayCode;
		if ($model->delayCode) {
			$delayCode = $model->delayCode;
		}


		if(isset($_POST['Operation']))
		{
			$model->attributes = $_POST['Operation'];

			if($model->save()){

		/*		if($model->delayCode) {
					$model->delayCode->attributes = $_POST['DelayCode'];
					$model->delayCode->opid = $model->id;
					$model->delayCode->save();
				} else {
					$delayCode->attributes = $_POST['DelayCode'];
					$delayCode->opid = $model->id;
					$delayCode->save();
				}
				*/
				//$delayCode->save(false);
				$this->render('finish');
			}
		}

		$this->render('afterOperation',array(
			'model' => $model,
			'delayCode' => $delayCode,
		));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Operation']))
		{
			$model->attributes=$_POST['Operation'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Operation');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Operation('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Operation']))
			$model->attributes=$_GET['Operation'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Operation the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Operation::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Operation $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='operation-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
