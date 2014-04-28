<?php

/**
 * This is the model class for table "document_section".
 *
 * The followings are the available columns in table 'document_section':
 * @property string $id
 * @property string $documentActivity_id
 * @property string $section_id
 *
 * The followings are the available model relations:
 * @property DocumentActivity $documentActivity
 * @property Section $section
 * @property SectionList[] $sectionLists
 */
class DocumentSection extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'document_section';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documentActivity_id, section_id', 'required'),
			array('documentActivity_id, section_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, documentActivity_id, section_id', 'safe', 'on'=>'search'),
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
			'documentActivity' => array(self::BELONGS_TO, 'DocumentActivity', 'documentActivity_id'),
			'section' => array(self::BELONGS_TO, 'Section', 'section_id'),
			'sectionLists' => array(self::HAS_MANY, 'SectionList', 'section_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'documentActivity_id' => 'Document Activity',
			'section_id' => 'Section',
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
		$criteria->compare('documentActivity_id',$this->documentActivity_id,true);
		$criteria->compare('section_id',$this->section_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DocumentSection the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
