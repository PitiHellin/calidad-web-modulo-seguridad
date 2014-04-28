<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<div class="clearfix">
	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); 
	?>
	<div class="middle">

		<div class="alert">
			Es necesario que ingrese su contraseña para poder acceder a estas características.
		</div>

		<div class="middle">
			<?php
				$errors = $model->getErrors();
			
				foreach ($errors as $er) {
					foreach ($er as $e) {
						$this->widget('bootstrap.widgets.TbLabel', array( 'type' => 'important' , 'label' => $e ));
						echo "<br>";
					}
				}
			?>
		</div>
		<br>

		<div class="contenedor">
			<div>
				Usuario: 
				<?php echo $model->username; ?>
				<?php //echo $form->textField($model,'username' , array( 'placeholder' => 'Usuario' ) ); ?>
			</div>

			<div>
				<?php echo $form->passwordField($model,'password' , array( 'placeholder' => 'Contraseña' ) ); ?>
			</div>

			<div align="center">
				<button	class="button" type="submit">Continuar</button>
			</div>
		</div>

	</div>

	<?php $this->endWidget(); ?>
</div>