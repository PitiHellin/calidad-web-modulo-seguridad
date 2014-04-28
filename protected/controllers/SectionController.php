<?php

class SectionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create' , 'update' ,'delete'),
				'users'=>array('a'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
		$modelAdmin = new Section('search');
		$modelAdmin->unsetAttributes();  // clear any default values

		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Section']))
		{
			$model->attributes=$_POST['Section'];
			if($model->save())
				$this->redirect(array('create'));
		}

		if(isset($_GET['Section'])){
			$modelAdmin->attributes=$_GET['Section'];
		}

		$this->render('update',array(
			'model'=>$model , 'modelAdmin'=>$modelAdmin
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
	 * Manages all models.
	 */
	public function actionCreate()
	{
		$model=new Section;
		$modelAdmin = new Section('search');
		$modelAdmin->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Section'])){
			$modelAdmin->attributes=$_GET['Section'];
		}

		if(isset($_POST['Section']))
		{
			$model->attributes=$_POST['Section'];
			if($model->save())
				$model = new Section;
		}


		$this->render('create',array(
			'model' => $model , 'modelAdmin'=>$modelAdmin,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Section the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Section::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Section $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='section-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}