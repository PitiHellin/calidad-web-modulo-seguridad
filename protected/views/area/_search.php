<?php
/* @var $this AreaController */
/* @var $model Area */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($modelAdmin,'id'); ?>
		<?php echo $form->textField($modelAdmin,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($modelAdmin,'area'); ?>
		<?php echo $form->textField($modelAdmin,'area',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'type' => 'success',
                'label' => 'Buscar'
            	)
        	); 
        ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->