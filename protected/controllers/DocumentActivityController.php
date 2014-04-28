<?php

class DocumentActivityController extends Controller
{

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('create' ,'delete'),
				'users'=>array('a'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($dt ,$da , $a)
	{
		$model=new DocumentActivity;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$model->documentArea_id = $da;
		$model->activity_id = $a;

		$existDa = DocumentArea::model()->findByPk($da);
		if($existDa !== null){

			$existA = Activity::model()->findByPk($a);
			if($existA !== null){

				$newActivity = DocumentActivity::model()->find(array(
					'condition' => 'documentArea_id = :da and activity_id = :a',
					'params' => array(
							':da' => $da,
							':a' => $a,
							),
						)
					);

				if($newActivity === null){
					$model->save();
				}

			}

		}

		$this->redirect( array( 'documentType/view',
			'id'=>$dt , 'da' => $da , 'action' => 'actividad'
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id , $dt , $da)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('documentType/view' , 
																						'id' => $dt , 
																						'da' => $da , 
																						'action' => 'actividad'));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DocumentActivity the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DocumentActivity::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DocumentActivity $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='document-activity-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
