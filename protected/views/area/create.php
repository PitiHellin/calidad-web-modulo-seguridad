<?php
/* @var $this AreaController */
/* @var $model Area */

$this->breadcrumbs=array(
	'Areas',
);

?>

<div class="pull-left">
	<h1>Agregar Area</h1>

	<?php $this->renderPartial('_form', array('model'=>$model , 'action' => 'Agregar')); ?>
</div>

<div class="pull-right">
	<?php $this->renderPartial('admin', array('modelAdmin'=>$modelAdmin)); ?>
</div>