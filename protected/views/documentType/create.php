<?php
/* @var $this DocumentTypeController */
/* @var $model DocumentType */

$this->menu=array(
	array('label'=>'Documentos', 'url'=>array('admin')),
);
?>

<div class="pull-left">
	<h1>Nuevo Documento</h1>

	<?php $this->renderPartial('_form', array('model'=>$model , 'action' => 'Crear')); ?>
</div>

<div class="pull-right">
	<?php $this->renderPartial('admin',array(
		'model'=>$model,
	)); ?>
</div>