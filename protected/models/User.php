<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property string $user
 * @property string $password
 * @property string $type
 *
 * The followings are the available model relations:
 * @property Document[] $documents
 * @property Perfil[] $perfils
 */
class User extends CActiveRecord
{	
	public $repeat_password;
	public $verifyCode;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array( 'name , last_name , email , user , password , repeat_password' , 'required' ),
				array('user', 'length', 'max'=>40,'min'=>3),
				array('name', 'length', 'max'=>50,'min'=>3),
				array('last_name', 'length', 'max'=>50,'min'=>2),
				array('password', 'length', 'max'=>128,),
				array('password','ext.SPasswordValidator.SPasswordValidator', 'up' => 1, 'min' => 10 , 'low' =>1 , 'digit' =>1, 'spec' =>1),
				array('repeat_password', 
					'compare', 
					'compareAttribute'=>'password', 
					'message' => 'Las contraseñas deben coincidir'),
				array('email', 'email'),
				array('user','unique'),
				array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, last_name, email, user, type', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'documents' => array(self::HAS_MANY, 'Document', 'user_id'),
			'perfils' => array(self::HAS_MANY, 'Perfil', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
					'name' => 'Nombre(s):',
					'last_name' => 'Apellidos:',
					'email' => 'Correo Electrónico',
					'user' => 'Usuario',
					'password' => 'Contraseña',
					'repeat_password' => 'Repite tu contraseña',
					'type' => 'Tipo',
					'verifyCode' => 'Código de verificación'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	protected function beforeSave()
	{
		if( parent::beforeSave() )
		{	
			$this->password = crypt( $this->password );
			return true;
		}
		return false;
	}
	
}
