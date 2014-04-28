<?php

class DocumentSectionController extends Controller
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
	public function actionCreate($d , $dar, $dac , $a , $s )
	{
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$existDa = DocumentActivity::model()->findByPk($a);
		if($existDa !== null){

			$existS = Section::model()->findByPk($s);
			if($existS !== null){

				$newSection = DocumentSection::model()->find(array(
					'condition' => 'documentActivity_id = :a and section_id = :s',
					'params' => array(
							':a' => $a,
							':s' => $s,
							),
						)
					);

				$model=new DocumentSection;
				$model->documentActivity_id = $a;
				$model->section_id = $s;

				if($newSection === null){
					$model->save();
				}

			}

		}

		$this->redirect( array( 'documentType/view',
			'id'=>$d , 'dar' => $dar , 'dac' => $dac ,'da' => $a , 'action' => 'seccion'
		));
		
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($d , $dar, $dac , $a , $s)
	{
		$this->loadModel($s)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array( 'documentType/view',
																					'id'=>$d , 
																					'dar' => $dar , 
																					'dac' => $dac ,
																					'da' => $a , 
																					'action' => 'seccion'));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DocumentSection the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DocumentSection::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DocumentSection $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='document-section-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
