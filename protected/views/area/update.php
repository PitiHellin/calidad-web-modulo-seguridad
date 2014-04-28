<?php
/* @var $this AreaController */
/* @var $model Area */

$this->breadcrumbs=array(
	'Areas'=>array('create'),
	$model->area,
);

?>

<div class="pull-left">
	<h1>Actualizar</h1>
	<h4><?php echo $model->area; ?></h4>

	<?php $this->renderPartial('_form', array('model'=>$model , 'action' => 'Guardar')); ?>
</div>

<div class="pull-right">
	<?php $this->renderPartial('admin', array('modelAdmin'=>$modelAdmin)); ?>
</div>