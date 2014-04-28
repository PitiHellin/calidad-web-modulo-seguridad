<?php
/* @var $this SectionController */
/* @var $model Section */

$this->breadcrumbs=array(
	'Secciones'=>array('create'),
	$model->section,
);

?>

<div class="pull-left">
	<h1>Actualizar</h1>
	<h4><?php echo $model->id; ?></h4>

	<?php $this->renderPartial('_form', array('model'=>$model , 'action' => 'Guardar')); ?>
</div>

<div class="right">
	<?php $this->renderPartial('admin', array('modelAdmin'=>$modelAdmin)); ?>
</div>