<?php
/* @var $this ActivityController */
/* @var $model Activity */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#activity-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administración de Actividades</h1>

<br>
<br>
<p>
	Opcionalmente podrias utilizar operadores de comparación:<br>
	(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>)<br>
	al principio de cada consulta que desees realizar para hacer tus consultas mas precisas.
</p>
<br>

<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
		'modelAdmin'=>$modelAdmin,
	)); ?>
</div><!-- search-form -->


<?php
	$gridColumns = array( 'id' , 'activity' , array('class' => 'CButtonColumn' , 'template' => '{update} {delete}',) );
	$groupGridColumns = $gridColumns;
	$groupGridColumns[] = array(
		'name' => 'firstLetter',
		'value' => 'substr($data->activity, 0, 1)',
		'headerHtmlOptions' => array('style'=>'display:none'),
		'htmlOptions' =>array('style'=>'display:none')
	);
 
	$this->widget('bootstrap.widgets.TbGroupGridView', array(
		'id'=>'activity-grid',
		'filter'=>$modelAdmin,
		'type'=>'striped bordered',
		'dataProvider' => $modelAdmin->search(),
		'template' => "{items}",
		'extraRowColumns'=> array('firstLetter'),
		'extraRowExpression' => '"<b style=\"font-size: 3em; color: #333;\">".substr($data->activity, 0, 1)."</b>"',
		'extraRowHtmlOptions' => array('style'=>'padding:10px'),
		'columns' => $groupGridColumns
		)
	);
?>