<?php
/* @var $this DocumentTypeController */
/* @var $model DocumentType */
/* @var $form CActiveForm */
?>

<div class="form">
	<?php /** @var TbActiveForm $form */
		$form = $this->beginWidget(
   		'bootstrap.widgets.TbActiveForm',
    	array(
       		'id' => 'document-type-form',
        	'type' => 'horizontal',
        	'enableAjaxValidation'=>false,
        	'enableClientValidation' => true,
			'clientOptions' => array( 
						'validateOnSubmit' => true,
						'validateOnChange' => true,
						'validateOnType' => true, 
						)
    		)
		); 
	?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row buttons">
		<?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => $action
            	)
        	); 
        ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->