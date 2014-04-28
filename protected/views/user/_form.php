<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget( 'CActiveForm' ,
									array(
											'id' => '_form',
											'enableAjaxValidation'=>false,
											'enableClientValidation' => true,
											'clientOptions' => array( 
												'validateOnSubmit' => true,
												'validateOnChange' => true,
												'validateOnType' => true, 
												)
										)
								 ); 
?>

<div class="left">
	<div class="row">
		<?php echo $form->labelEx( $model , 'name') ?>
		<?php echo $form->textField($model,'name' , array( 'placeholder' => 'Nombre(s)' ) ); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model , 'last_name') ?>
		<?php echo $form->textField($model,'last_name' , array( 'placeholder' => 'Apellidos' ) ); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model , 'email') ?>
		<?php echo $form->textField($model,'email' , array( 'placeholder' => 'Correo Electrónico' ) ); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model , 'user') ?>
		<?php echo $form->textField($model,'user' , array( 'placeholder' => 'Usuario' ) ); ?>
		<?php echo $form->error($model,'user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model , 'password') ?>
		<?php echo $form->passwordField($model,'password' , array( 'placeholder' => 'Contraseña' ) ); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model , 'repeat_password') ?>
		<?php echo $form->passwordField($model,'repeat_password' , array( 'placeholder' => 'Repite la contraseña' ) ); ?>
		<?php echo $form->error($model,'repeat_password'); ?>
	</div>
</div>

<div class="right">

	<?php if(isset(Yii::app()->user->type) and ( Yii::app()->user->type == 'a')):?>
		<div class="row">
			<?php echo $form->labelEx( $model , 'type') ?>
			<?php echo $form->textField($model, 'type' , array( 'placeholder' => 'Tipo de usuario' ) ); ?>
			<?php echo $form->error($model,'type'); ?>
		</div>
	<?php endif ?>

	<?php if(CCaptcha::checkRequirements()): ?>
		<div class="row">
			<?php echo $form->labelEx($model,'verifyCode'); ?>
			<div>
				<?php $this->widget('CCaptcha'); ?>
				<br/>
				<br/>
				<?php echo $form->textField($model,'verifyCode' , 
					array( 'placeholder' => 'Escribe el código de verificacón aquí' ) ); 
				?>
			</div>
			<div class="hint">Por favor,ingrese las letras que se muestran arriba.
				<br/>Las letras no son sensibles a mayusculas.
			</div>
				<?php echo $form->error($model,'verifyCode'); ?>
		</div>
	<?php endif; ?>
	<br/>
	<br/>

	<div align="center">
		<button class="button" type="submit">
			<?php echo $action; ?>
		</button>
	</div>
</div>

<?php $this->endWidget(); ?>
</div>