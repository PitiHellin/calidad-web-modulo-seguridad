<?php

/**
 * This is the model class for table "document_activity".
 *
 * The followings are the available columns in table 'document_activity':
 * @property string $id
 * @property string $documentArea_id
 * @property string $activity_id
 *
 * The followings are the available model relations:
 * @property ActivityList[] $activityLists
 * @property Activity $activity
 * @property DocumentArea $documentArea
 * @property DocumentSection[] $documentSections
 */
class DocumentActivity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'document_activity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documentArea_id, activity_id', 'required'),
			array('documentArea_id, activity_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, documentArea_id, activity_id', 'safe', 'on'=>'search'),
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
			'activityLists' => array(self::HAS_MANY, 'ActivityList', 'activity_id'),
			'activity' => array(self::BELONGS_TO, 'Activity', 'activity_id'),
			'documentArea' => array(self::BELONGS_TO, 'DocumentArea', 'documentArea_id'),
			'documentSections' => array(self::HAS_MANY, 'DocumentSection', 'documentActivity_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'documentArea_id' => 'Document Area',
			'activity_id' => 'Activity',
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
		$criteria->compare('documentArea_id',$this->documentArea_id,true);
		$criteria->compare('activity_id',$this->activity_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DocumentActivity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
