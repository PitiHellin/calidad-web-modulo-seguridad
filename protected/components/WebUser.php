<?php
/**
* 
*/
class WebUser extends CWebUser
{
	
	/**
	 * @var string|array the URL for login. If using array, the first element should be
	 * the route to the login action, and the rest name-value pairs are GET parameters
	 * to construct the reauthentication URL (e.g. array('/site/login')). If this property is null,
	 * a 403 HTTP exception will be raised instead.
	 * @see CController::createUrl
	 */
	public $reauthUrl=array('/site/reauth');
	/**
	* @var string El tiempo en segundos tras el cual una reautenticación expirará. Si está configuración
	* no se especifica o se trata de un valor nulo la reautenticación no expirará sino hasta que expire
	* la sesión.
	*/
	public $reauthTimeout = 10;

	public function getLastReauthenticationTime(){
		return $this->getState('__lastReauth');
	}

	public function setLastReauthenticationTime($lastTime){
		$this->setState('__lastReauth', $lastTime);
	}

	/**
	* Verifica si el usuario ha sido reautenticado
	* @return boolean true si el usuario ha sido reautenticado y su reautenticación
	* es aún valida
	*/
	public function getIsReauthenticated(){
		$lastReauth = $this->getLastReauthenticationTime();
		if($lastReauth !== null){
			if($this->reauthTimeout != null){
				return (time() - $lastReauth) < $this->reauthTimeout;
			} else {
				return true;	
			}
		}
		return false;
	}

}