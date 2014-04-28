<?php
/* @var $this PerfilController */
/* @var $model Perfil */


$this->breadcrumbs=array(
	$model->owner->user,
);

?>

<center>
	<h2>Perfil de <?php echo $model->owner->user; ?></h2>
</center>

<div align="center">

<div class="left">
	<div class="contenedorImg">
		<?php echo CHtml::image(Yii::app()->baseUrl.'/images/photo_perfil.jpg', '' , array('width'=>200 , 'height'=>200));?>
		<h5><?php echo $model->owner->name . ' ' . $model->owner->last_name; ?></h5>
	</div>
</div>

	<div class="contenedor">

		<div class="data">
			<h4>Nombre:</h4>
			<h5> <?php echo $model->owner->name . ' ' . $model->owner->last_name; ?> </h5>
		</div>
		<br>
		<div class="data">
			<h4>Correo Electrónico:</h4>
			<h5> <?php echo $model->owner->email; ?> </h5>
		</div>
		<br>
		<div class="data">
			<h4>Usuario:</h4>
			<h5> <?php echo $model->owner->user; ?> </h5>
		</div>
		<br>
		<div class="data">
			<h4>Tipo de Usuario:</h4>
			<h5> <?php echo ($model->owner->type === 'a') ? 'Administrador(a)' : 'Simple Mortal'; ?> </h5>
		</div>
		<br>
		<br>
		<a class="button" id="button" href="<?php echo Yii::app()->homeUrl . 'user/update/' . $model->user_id ?>">
			Editar
		</a>
		<br>
		<br>

	</div>

	<div class="right">
	<div class="contenedor">

		<div class="data">
			<h4>Nombramiento:</h4>
				<h5>
					<?php echo $model->appointments['appointment']; ?>
				</h5>
		</div>
		<br>
		<div class="data">
			<h4>Total de Horas Semanales Contratadas:</h4>
			<h5> <?php echo $model->weekly_hours; ?> horas </h5>
		</div>
		<br>
		<div class="data">
			<h4>Categoría y Nivel:</h4>
			<h5> <?php echo $model->category_level; ?> </h5>
		</div>
		<br>
		<?php /*
		<div class="data">
			<h4>Reconocimientos:</h4>
			<?php foreach( $model->recognitions as $recognition ): ?>
				<div class="dataContenedor">
					<h5>
						<?php echo 'SNI: ' . $recognition['SNI']; ?><br>
						<?php echo 'Nivel: ' . $recognition['level']; ?><br>
						<?php echo 'PROMEP: ' . $recognition['PROMEP']; ?>
					</h5>
				</div>
			<?php endforeach ?>
		</div> */?>
		<br>
		<br>
		<a class="button" id="button" href="<?php echo Yii::app()->homeUrl . 'perfil/update/' . $model->user_id ?>">
			Editar
		</a>
		<br>
		<br>
	</div>
</div>

</div>