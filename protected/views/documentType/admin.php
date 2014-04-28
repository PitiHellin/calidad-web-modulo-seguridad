<?php
/* @var $this DocumentTypeController */
/* @var $model DocumentType */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#document-type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administración de Documentos</h1>

<br>
<br>
<p>
	Opcionalmente podrias utilizar operadores de comparación:<br>
	(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>)<br>
	al principio de cada consulta que desees realizar para hacer tus consultas mas precisas.
</p>
<br>

<?php
	$gridColumns = array( 'id' , 'type' , array('class' => 'CButtonColumn') );
	$groupGridColumns = $gridColumns;
	$groupGridColumns[] = array(
		'name' => 'firstLetter',
		'value' => 'substr($data->type, 0, 1)',
		'headerHtmlOptions' => array('style'=>'display:none'),
		'htmlOptions' =>array('style'=>'display:none')
	);
 
	$this->widget('bootstrap.widgets.TbGroupGridView', array(
		'filter'=>$model,
		'type'=>'striped bordered',
		'dataProvider' => $model->search(),
		'template' => "{items}",
		'extraRowColumns'=> array('firstLetter'),
		'extraRowExpression' => '"<b style=\"font-size: 3em; color: #333;\">".substr($data->type, 0, 1)."</b>"',
		'extraRowHtmlOptions' => array('style'=>'padding:10px'),
		'columns' => $groupGridColumns
		)
	);
?>