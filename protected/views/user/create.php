<?php
/* @var $this UserController */
/* @var $model User */
	
	$this->breadcrumbs=array(
		'Usuarios'=>array('index'),
		'Registro',
	);
?>

<h1>Registro de Usuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model , 'action' => 'Registrar')); ?>