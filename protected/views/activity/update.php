<?php
/* @var $this ActivityController */
/* @var $model Activity */

$this->breadcrumbs=array(
	'Actividad'=>array('create'),
	$model->activity,
);

?>

<div class="pull-left">
	<h1>Actualizar</h1>
	<h4><?php echo $model->activity; ?></h4>

	<?php $this->renderPartial('_form', array('model'=>$model , 'action' => 'Guardar')); ?>
</div>

<div class="pull-right">
	<?php $this->renderPartial('admin', array('modelAdmin'=>$modelAdmin)); ?>
</div>