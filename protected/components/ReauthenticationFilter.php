<?php
/**
* Filtro para la reautenticación para características sensibles.
* Debe ser usado en el método filters del controlador. Es importante
* que sea especificado después del filtro accessControl.
* 
* Ejemplo:
*
* class MyController extends Controller {
*	...
*	public function filters(){
*		return array(
*			'accessControl',
*			array(
*				'application.components.ReauthenticationFilter + metodoSensible',
*			),
*		);
*	}	
*	...	
* }
* @author Fabián
*/
class ReauthenticationFilter extends CFilter
{

	protected function preFilter($filterChain)
    {
		$webuser = Yii::app()->user;
       	if(!$webuser->getIsReauthenticated()) {
       		$controller = Yii::app()->getController();
       		Yii::app()->user->returnUrl = Yii::app()->request->url;
       		$controller->redirect($webuser->reauthUrl);
       		return false;
       	}
       	$webuser->setLastReauthenticationTime(time());
       	return true;
    }
 
    protected function postFilter($filterChain)
    {
        // logic being applied after the action is executed
    }
}