<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		//$this->username //usuario enviado desde el login
		//$this->password //Contraseña enviada desde el login
		
		$user = User::model()->find( array(
			'condition' => 'user = :user',
			'params' => array(
				':user' => $this->username,
			),
		) ); //SELECT * FROM usuario WHERE usuario = $this->username LIMIT 1
		
		//var_dump($user);
		//exit();

		if( $user === null )
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif( crypt( $this->password , $user->password ) !== $user->password )
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->errorCode=self::ERROR_NONE;

			/*En las vistas tendremos disponible type usted puede setear lo que requiera */
			$this->setState('user_id', $user->id);
			$this->setState('type', $user->type);
			$this->setState('user' , $user->user);
			$this->username = $user->type;

		}
		return !$this->errorCode;
	}
}