<?php
/* @var $this SectionController */
/* @var $model Section */

$this->breadcrumbs=array(
	'Secciones',
);

?>

<div class="pull-left">
	<h1>Agregar Sección</h1>

	<?php $this->renderPartial('_form', array('model'=>$model , 'action' => 'Agregar')); ?>
</div>

<div class="pull-right">
	<?php $this->renderPartial('admin', array('modelAdmin'=>$modelAdmin)); ?>
</div>