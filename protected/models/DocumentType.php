<?php

/**
 * This is the model class for table "document_type".
 *
 * The followings are the available columns in table 'document_type':
 * @property string $id
 * @property string $type
 *
 * The followings are the available model relations:
 * @property Document[] $documents
 * @property DocumentArea[] $documentAreas
 */
class DocumentType extends CActiveRecord
{

	public $list = null;
	public $area = null;
	public $actividad = null;
	public $actividades = null;
	public $seccion = null;
	public $secciones = null;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'document_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type', 'required'),
			array('type', 'length', 'max'=>45),
			array('type' , 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type', 'safe', 'on'=>'search'),
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
			'documents' => array(self::HAS_MANY, 'Document', 'type_id'),
			'documentAreas' => array(self::HAS_MANY, 'DocumentArea', 'documentType_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Nombre',
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
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DocumentType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getAreas($dt){
		//Se seleciona la lista de areas que no estan en el documento
		$sql_list = "SELECT * FROM area WHERE NOT EXISTS ( SELECT 1 FROM document_area 
					WHERE document_area.area_id = area.id AND document_area.documentType_id = $dt)";
		$this->list = Yii::app()->db->createCommand($sql_list)->queryAll(); //Todos los registros que coincidan
		
		//$list = Yii::app()->db->createCommand($sql)->queryRow(); //El primer registro que se encuentre
		
		//Se selecionan las areas que estan en el documento
		$sql_area = "SELECT area.area , document_area.id FROM area LEFT JOIN document_area ON
					 area.id = document_area.area_id WHERE document_area.documentType_id = $dt";
		
		$this->area = Yii::app()->db->createCommand($sql_area)->queryAll();

		//var_dump($this->area);
		//exit();
	}

	public function getActividades($dt , $da){
		$this->area = null;
		//Se selecionan las areas que estan en el documento
		$sql_list = "SELECT area.area , document_area.id FROM area LEFT JOIN document_area ON
					 area.id = document_area.area_id WHERE document_area.documentType_id = $dt";
		
		$this->list = Yii::app()->db->createCommand($sql_list)->queryAll();
		
		if(!empty($da)){
			$sql_area = "SELECT area.area , document_area.id FROM area LEFT JOIN document_area ON
						 area.id = document_area.area_id WHERE EXISTS ( SELECT 1 FROM document_area
						 WHERE document_area.area_id = area.id AND document_area.documentType_id = $dt
						 AND document_area.id = $da)";

			$this->area = Yii::app()->db->createCommand($sql_area)->queryRow();

			$sql_actividades = "SELECT activity.activity , document_activity.id 
								FROM document_activity LEFT JOIN  activity 
								ON activity.id = document_activity.activity_id 
								WHERE document_activity.documentArea_id = $da";

			$this->actividades = Yii::app()->db->createCommand($sql_actividades)->queryAll();

			$sql_activitis = "SELECT * FROM activity WHERE NOT EXISTS ( SELECT 1 FROM document_activity 
								WHERE document_activity.activity_id = activity.id 
								AND document_activity.documentArea_id = $da)";

			$this->actividad = Yii::app()->db->createCommand($sql_activitis)->queryAll();

			//var_dump($this->list);
			//exit();
		}
	}

	public function getSecciones($dt , $dar , $dac , $da){
		$this->actividad = null;
		//Se selecionan las areas que estan en el documento
		$sql_list = "SELECT document_area.id AS documentArea, document_area.area_id , document_activity.id 
					AS documentActivity , document_activity.activity_id , area.area , activity.activity 
					FROM document_area LEFT JOIN document_activity 
					ON document_area.id = document_activity.documentArea_id 
					LEFT JOIN area ON document_area.area_id = area.id 
					LEFT JOIN activity ON document_activity.activity_id = activity.id 
					WHERE document_area.documentType_id = $dt 
					AND document_area.id  = document_activity.documentArea_id";
		
		$this->list = Yii::app()->db->createCommand($sql_list)->queryAll();
		
		if(!empty($da) && !empty($dar) && !empty($dac)){

			$this->area['area_id'] = $dar;
			$this->area['activity_id'] = $dac;
			$this->area['documentActivity'] = $da;
			$this->area['area'] = Area::model()->findByPK($dar)->area;
			$this->area['actividad'] = Activity::model()->findByPK($dac)->activity;

			$sql_secciones = "SELECT section.section , document_section.id 
								FROM document_section LEFT JOIN section 
								ON section.id = document_section.section_id 
								WHERE document_section.documentActivity_id = $da";

			$this->secciones = Yii::app()->db->createCommand($sql_secciones)->queryAll();

			$sql_sections = "SELECT * FROM section WHERE NOT EXISTS ( SELECT 1 FROM document_section 
								WHERE document_section.section_id = section.id 
								AND document_section.documentActivity_id = $da)";

			$this->seccion = Yii::app()->db->createCommand($sql_sections)->queryAll();

			//var_dump($this->area);
			//exit();
		}
	}

}
