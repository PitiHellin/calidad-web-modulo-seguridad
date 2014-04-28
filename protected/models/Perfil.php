<?php

/**
 * This is the model class for table "perfil".
 *
 * The followings are the available columns in table 'perfil':
 * @property string $user_id
 * @property string $weekly_hours
 * @property string $category_level
 * @property string $photo
 * @property string $appointment_id
 *
 * The followings are the available model relations:
 * @property Appointment $appointment
 * @property User $user
 * @property Recognition[] $recognitions
 */
class Perfil extends CActiveRecord
{

	public $owner;
	public $appointments;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'perfil';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, weekly_hours, appointment_id', 'required'),
			array('user_id, weekly_hours, appointment_id', 'length', 'max'=>10),
			array('category_level', 'length', 'max'=>100),
			array('photo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, weekly_hours, category_level, photo, appointment_id', 'safe', 'on'=>'search'),
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
			'appointment' => array(self::BELONGS_TO, 'Appointment', 'appointment_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'recognitions' => array(self::MANY_MANY, 'Recognition', 'recognition_perfil(perfil_id, recognition_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'weekly_hours' => 'Weekly Hours',
			'category_level' => 'Category Level',
			'photo' => 'Photo',
			'appointment_id' => 'Appointment',
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

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('weekly_hours',$this->weekly_hours,true);
		$criteria->compare('category_level',$this->category_level,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('appointment_id',$this->appointment_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Perfil the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getOwnerData( $id ){
		$this->owner = User::model()->findByPk( $id );
		$perfil = Perfil::model()->find(array('condition' => 'user_id = :user_id' , 'params' => array(':user_id' => $this->owner->id)));
		$this->appointments = Appointment::model()->findByPk($perfil->appointment_id);

		/*$this->recognitions = RecognitionPerfil::model()->findAll(array(
															'condition' => 'perfil_id = :perfil_id',
															'params' => array(
																	':perfil_id' => $id,
																),
															)
														);*/

	}
}
