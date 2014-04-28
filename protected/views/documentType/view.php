<?php
/* @var $this DocumentTypeController */
/* @var $model DocumentType */

$this->breadcrumbs=array(
	'Documentos'=>array('create'),
	$model->type,
);

?>

<div class="clearfix">
<div class="pull-left">
	<?php 
		$this->widget(
    		'bootstrap.widgets.TbButtonGroup',
    		array(
        		'size' => 'large',
        		'type' => 'danger',
        		'buttons' => array(
            		array(
                		'label' => $action,
                		'items' => array(
                    		array('label' => 'Agrega Areas', 'url' => array('view' , 'id' => $model->id , 'action' => 'area')),
                    		array('label' => 'Agrega Actividades', 'url' => array('view' , 'id' => $model->id , 'action' => 'actividad')),
                    		array('label' => 'Agrega Secciones', 'url' => array('view' , 'id' => $model->id , 'action' => 'seccion')),
                    		'---',
                    		array('label' => 'Ver Estructura', 'url' => array('view' , 'id' => $model->id)),
                		)
            		),
        		),
    		)
		);

	?>
</div>
</div>

<center>
    <?php
        /////AREAS///////////
        if(isset($_GET['action']) && ($_GET['action'] ==='area')):
    ?>
            <div class="pull-left">
                <div class="contenedor">
    <?php
                    $areas = array();

                    if($model->list !== null){
                        
                        foreach ($model->list as $area) {
            
                            $areas[] = array('label' => $area['area'] , 
                                            'url' => array('documentArea/create' , 
                                                            'dt' => $model->id , 
                                                            'a' => $area['id']));
                        }

                        $this->widget(
                            'bootstrap.widgets.TbButtonGroup',
                            array(
                                'type' => 'primary',
                                'stacked' => true,
                                'size' => 'small',
                                'toggle' => 'radio',
                                'buttons' => $areas,
                            )
                        );

                    }
    ?>

                </div>
            </div>

        <div class="contenedor">
            
            <center>

                <h1><?php echo $model->type; ?></h1>
    
    <?php

                $docAreas = array();
            
                if($model->area !== null){
                    foreach ($model->area as $docArea) {
                        $docAreas[] = array('label' => 'ELIMINAR(' . $docArea['area'] . ')', 
                                            'url' => array('documentArea/delete' , 
                                                'id' => $docArea['id'] , 
                                                'dt' => $model->id , 
                                                'action' => 'area'));
                    }

                    $this->widget(
                        'bootstrap.widgets.TbButtonGroup',
                        array(
                            'type' => 'primary',
                            'stacked' => true,
                            'size' => 'small',
                            'toggle' => 'radio',
                            'buttons' => $docAreas,
                        )
                    );

                }

    ?>
            </center>

        </div>

    <?php 
        endif;
        /////AREAS///////////
    ?>

</center>

<center>
    
    <?php
        /////ACTIVIDAD///////////
        if(isset($_GET['action']) && ($_GET['action'] ==='actividad')):
    ?>
        
        <div class="pull-left">
            <div class="contenedor">
    <?php
                $areas = array();

                if($model->list !== null){
        
                    foreach ($model->list as $area) {
            
                        $areas[] = array('label' => $area['area'] , 'url' => array('documentType/view' ,
                                                                                'id' => $model->id ,
                                                                                'da' => $area['id'],
                                                                                'action' => 'actividad'));
                    }

                    $this->widget(
                        'bootstrap.widgets.TbButtonGroup',
                        array(
                            'type' => 'primary',
                            'stacked' => true,
                            'size' => 'mini',
                            'toggle' => 'radio',
                            'buttons' => $areas,
                        )
                    );

                }
    ?>

            </div>
        </div>

        <div class="contenedor">
            <center>
                <h1><?php echo $model->type; ?></h1>
                <h3><?php if(!empty($model->area)) echo $model->area['area'] ?></h3>
    <?php
    
                $docActividades = array();
                
                if($model->actividades !== null){
                    foreach ($model->actividades as $docActividad) {
                        $docActividades[] = array('label' => 'ELIMINAR(' . $docActividad['activity'] . ')', 
                                            'url' => array(
                                                'documentActivity/delete' , 
                                                'id' => $docActividad['id'] , 
                                                'dt' => $model->id , 
                                                'da' => $model->area['id']));
                    }

                    $this->widget(
                        'bootstrap.widgets.TbButtonGroup',
                        array(
                            'type' => 'success',
                            'stacked' => true,
                            'size' => 'small',
                            'toggle' => 'radio',
                            'buttons' => $docActividades,
                        )
                    );

                }

    ?>

            </center>
        </div>

        
    
    <?php
            $docActivitis = array();
    
            if(!empty($model->actividad)){
    ?>
                    <div class="pull-right">
            <div class="contenedor">
            <?php
                    foreach ($model->actividad as $docActividad) {
                        $docActivitis[] = array('label' => $docActividad['activity'], 
                                                'url' => array('documentActivity/create' , 
                                                                'dt' => $model->id,
                                                                'da' => $model->area['id'],
                                                                'a' => $docActividad['id']));
                    }

                    $this->widget(
                        'bootstrap.widgets.TbButtonGroup',
                        array(
                            'type' => 'warning',
                            'stacked' => true,
                            'size' => 'mini',
                            'toggle' => 'radio',
                            'buttons' => $docActivitis,
                        )
                    );
    ?>

  </div>
        </div>
    <?php
                }

    ?>
          
    <?php 
        endif;
        /////ACTIVIDAD///////////
    ?>

</center>

<center>
    
    <?php
        /////SECCIONES///////////
        if(isset($_GET['action']) && ($_GET['action'] ==='seccion')):
    ?>
        
        <div class="pull-left">
            <div class="contenedor">
    <?php
                $areas = array();

                if($model->list !== null){
        
                    foreach ($model->list as $area) {
            
                        $areas[] = array('label' =>  '(' . $area['area'] . ') => ' . $area['activity'] , 'url' => array('documentType/view' ,
                                                                                'id' => $model->id ,
                                                                                'dar' => $area['area_id'],
                                                                                'dac' => $area['activity_id'],
                                                                                'da' => $area['documentActivity'],
                                                                                'action' => 'seccion'));
                    }

                    $this->widget(
                        'bootstrap.widgets.TbButtonGroup',
                        array(
                            'type' => 'primary', 
                            'stacked' => true,
                            'size' => 'mini',
                            'toggle' => 'radio',
                            'buttons' => $areas,
                        )
                    );

                }
    ?>

            </div>
        </div>

        <div class="contenedor">
            <center>
                <h1><?php echo $model->type; ?></h1>
                <h3><?php if(!empty($model->area)) echo $model->area['area'] . '<br>' . $model->area['actividad'] ?></h3>
    <?php
    
                $docSecciones = array();
                
                if($model->secciones !== null){
                    foreach ($model->secciones as $docSeccion) {
                        $docSecciones[] = array('label' => 'ELIMINAR(' . $docSeccion['section'] . ')', 
                                            'url' => array(
                                                'documentSection/delete' , 
                                                'd' => $model->id , 
                                                'dar' => $model->area['area_id'] , 
                                                'dac' => $model->area['activity_id'] , 
                                                'a' => $model->area['documentActivity'],
                                                's' => $docSeccion['id']));
                    }

                    $this->widget(
                        'bootstrap.widgets.TbButtonGroup',
                        array(
                            'type' => 'success',
                            'stacked' => true,
                            'size' => 'small',
                            'toggle' => 'radio',
                            'buttons' => $docSecciones,
                        )
                    );

                }

    ?>

            </center>
        </div>

        
    
    <?php
            $docSeccions = array();
    
            if(!empty($model->seccion)){
    ?>
                    <div class="pull-right">
            <div class="contenedor">
            <?php
                    foreach ($model->seccion as $docSeccion) {
                        $docSeccions[] = array('label' => $docSeccion['section'], 
                                                'url' => array('documentSection/create' , 
                                                                'd' => $model->id,
                                                                'dar' => $model->area['area_id'],
                                                                'dac' => $model->area['activity_id'],
                                                                'a' => $model->area['documentActivity'],
                                                                's' => $docSeccion['id']));
                    }

                    $this->widget(
                        'bootstrap.widgets.TbButtonGroup',
                        array(
                            'type' => 'warning',
                            'stacked' => true,
                            'size' => 'mini',
                            'toggle' => 'radio',
                            'buttons' => $docSeccions,
                        )
                    );
    ?>

  </div>
        </div>
    <?php
                }

    ?>
          
    <?php 
        endif;
        /////SECCIONES///////////
    ?>

</center>