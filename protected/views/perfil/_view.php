<?php
/* @var $this PerfilController */
/* @var $data Perfil */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_id), array('view', 'id'=>$data->user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weekly_hours')); ?>:</b>
	<?php echo CHtml::encode($data->weekly_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_level')); ?>:</b>
	<?php echo CHtml::encode($data->category_level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo')); ?>:</b>
	<?php echo CHtml::encode($data->photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('appointment_id')); ?>:</b>
	<?php echo CHtml::encode($data->appointment_id); ?>
	<br />


</div>