<?php

/**
 * This is the model class for table "document_area".
 *
 * The followings are the available columns in table 'document_area':
 * @property string $id
 * @property string $documentType_id
 * @property string $area_id
 *
 * The followings are the available model relations:
 * @property AreaList[] $areaLists
 * @property DocumentActivity[] $documentActivities
 * @property Area $area
 * @property DocumentType $documentType
 */
class DocumentArea extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'document_area';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documentType_id, area_id', 'required'),
			array('documentType_id, area_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, documentType_id, area_id', 'safe', 'on'=>'search'),
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
			'areaLists' => array(self::HAS_MANY, 'AreaList', 'area_id'),
			'documentActivities' => array(self::HAS_MANY, 'DocumentActivity', 'documentArea_id'),
			'area' => array(self::BELONGS_TO, 'Area', 'area_id'),
			'documentType' => array(self::BELONGS_TO, 'DocumentType', 'documentType_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'documentType_id' => 'Document Type',
			'area_id' => 'Area',
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
		$criteria->compare('documentType_id',$this->documentType_id,true);
		$criteria->compare('area_id',$this->area_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DocumentArea the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
