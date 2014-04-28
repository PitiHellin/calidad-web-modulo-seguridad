<?php
/* @var $this ActivityController */
/* @var $model Activity */

$this->breadcrumbs=array(
	'Actividades',
);

?>

<div class="pull-left">
	<h1>Agregar Actividad</h1>

	<?php $this->renderPartial('_form', array('model'=>$model , 'action' => 'Agregar')); ?>
</div>

<div class="pull-right">
	<?php $this->renderPartial('admin', array('modelAdmin'=>$modelAdmin)); ?>
</div>