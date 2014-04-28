<!DOCTYPE html>
 
<html lang="<?php echo Yii::app()->language;?>">
 	<head>
 		<?php
 		/*
 			<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
 			<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
 		*/
		?>

			<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
 			<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
 			<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
		

 		<meta charset="<?php echo Yii::app()->charset;?>">
		
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>
 
	<body>

		<?php $this->beginWidget(
    		'bootstrap.widgets.TbHeroUnit',
   			array(
      		  //'heading' => CHtml::encode(Yii::app()->name),
    		)	
		); 
		?>
			<?php echo CHtml::image(Yii::app()->baseUrl.'/images/fmat2.png');?>
		<?php $this->endWidget(); ?>
		

		<header>

			<?php
				$id = (isset(Yii::app()->user->user_id)) ? Yii::app()->user->user_id : '';
				$user = (isset(Yii::app()->user->user)) ? Yii::app()->user->user : '';
				$admin = (isset(Yii::app()->user->type) and Yii::app()->user->type == 'a') ? true : false ;
				$documents = DocumentType::model()->findAll();

				$docs = null;

				foreach ($documents as $document) {
					$docs[] =  array( 'label' => $document['type'] , 'url' => array('documentType/viewDocument' , 'id' => $document['id']));
				}
				//var_dump($docs);

				$this->widget('bootstrap.widgets.TbNavbar', array(
 					'type'=>'inverse', // null or 'inverse'
 					'brand'=>CHtml::encode(Yii::app()->name),
 					'brandUrl'=>array('/site/index'),
 					'collapse'=>true, // requires bootstrap-responsive.css
 
 					'items'=>array(
 						array(
 							'class'=>'bootstrap.widgets.TbMenu',
 							'items'=>array(
 								array('label'=>'Inicio', 'url'=>array('/site/index') , 'visible'=>Yii::app()->user->isGuest),
								array('label'=>'Inicio', 'url'=>array('/perfil/view' , 'id' => $id) , 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Registro', 'url'=>array('/user/create') , 'visible'=>Yii::app()->user->isGuest),
								array('label'=>'Usuarios', 'url'=>array('/user/admin'), 'visible'=>$admin),
								array('label'=>'Documentos', 'url'=>'#', 
									'items'=> array(
										array('label'=>'Nuevo', 'url'=>'#',
												'items'=> $docs,
											),
										array('label'=>'Ver Todos', 'url' => '#'),
										array('label'=>'Administración', 'url'=> '#',
											'items' => array(
														array( 'label' => 'Documentos' , 'url' => array('/documentType/create')),
														array( 'label' => 'Areas' , 'url' => array('/area/create')),
														array( 'label' => 'Actividades' , 'url' => array('/activity/create')),
														array( 'label' => 'Secciones' , 'url' => array('/section/create'))
													),
												'visible'=>$admin),
									), 
									'visible'=>!Yii::app()->user->isGuest
								),
 							),
 						),
 				
 						array(
 							'class'=>'bootstrap.widgets.TbMenu',
 							'htmlOptions'=>array('class'=>'pull-right'),
 							'items'=>array(
 									array('label'=>'Acerca de', 'url'=>array('/site/page', 'view'=>'about')),
									array('label'=>'Salir ('.$user.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
 								),
 							),
 						),
					)
				);
			?>

		</header>

		<div class="container" id="main">
			<?php if(isset($this->breadcrumbs)):?>
 				<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array('links'=>$this->breadcrumbs,)); ?>
 			<?php endif?>
 	
 			<?php echo $content; ?>
 			<hr>
 
 			<footer>
 				Copyright &copy; <?php echo date('Y'); ?> by UADY Facultad de Matematicas.<br/>
				Todos los derechos reservados.<br/>
				<?php echo Yii::powered(); ?>
 			</footer>
 
		</div>

	</body>
</html>