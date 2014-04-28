<?php
/* @var $this PerfilController */
/* @var $model Perfil */

$this->breadcrumbs=array(
	'Perfils'=>array('index'),
	$model->user_id=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Perfil', 'url'=>array('index')),
	array('label'=>'Create Perfil', 'url'=>array('create')),
	array('label'=>'View Perfil', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'Manage Perfil', 'url'=>array('admin')),
);
?>

<h1>Update Perfil <?php echo $model->user_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>