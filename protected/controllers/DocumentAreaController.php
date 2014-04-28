<?php

class DocumentAreaController extends Controller
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
				'actions'=>array('create','delete'),
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
	public function actionCreate($dt , $a)
	{
		$model=new DocumentArea;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$model->documentType_id = $dt;
		$model->area_id = $a;

		$existDt = DocumentType::model()->findByPk($dt);
		if($existDt !== null){
			$existA = Area::model()->findByPk($a);
			if($existA !== null){
				$newArea = DocumentArea::model()->find(array(
					'condition' => 'documentType_id = :dt and area_id = :a',
					'params' => array(
							':dt' => $dt,
							':a' => $a,
							),
						)
					);

				if($newArea === null){
					$model->save();
				}
			}
		}

		$this->redirect( array( 'documentType/view',
			'id'=>$dt , 'action' => 'area'
		));
	}

	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id , $dt , $action)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('documentType/view' , 'id' => $dt , 'action' => $action));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DocumentArea the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DocumentArea::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DocumentArea $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='document-area-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
