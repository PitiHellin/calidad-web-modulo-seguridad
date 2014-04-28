<?php
/* @var $this DocumentTypeController */
/* @var $model DocumentType */

$this->breadcrumbs=array(
	'Documentos'=>array('create'),
	$model->type=>array('view','id'=>$model->id),
	'Actualizar',
);

?>

<div class="pull-left">
	<h1>Actualizar<br><?php echo $model->type; ?></h1>

	<?php $this->renderPartial('_form', array('model'=>$model , 'action' => 'Guardar')); ?>
</div>

<div class="pull-right">
	<?php $this->renderPartial('admin',array(
		'model'=>$model,
	)); ?>
</div>