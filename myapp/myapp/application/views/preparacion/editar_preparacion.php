<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>NUTRICIÓN</title>

	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/css/glyphicons.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/logo/logo.png" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url();?>assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin login-cover -->
	<div class="login-cover">
		<div class="login-cover-image" style="background-image: url(<?php echo base_url();?>assets/img/login-bg/nutricion_3.jpg)" data-id="login-cover-image"></div>
		<div class="login-cover-bg"></div>
	</div>
	<!-- end login-cover -->
	
	<!-- begin #page-container -->

		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="<?php echo base_url();?>administrar/administrar" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"> <b>NUTRICIÓN</b> evaluación</a>
			</div>
		</div>
		<div id="header" class="header navbar-default">
			<nav aria-label="breadcrumb">
  				<ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="<?php echo base_url();?>administrar/administrar"><strong>Administrar</strong></a></li>
					  <li class="breadcrumb-item"><a href="<?php echo base_url();?>administrar/gestion"><strong>Gestion</strong></a></li>
					  <li class="breadcrumb-item"><a href="<?php echo base_url();?>preparacion/listado_preparaciones"><strong>Gestión de preparaciones</strong></a></li>
					  <li class="breadcrumb-item" aria-current="page">Editar preparación</li>	  
				</ol>
			</nav>  			
			
		</div>

	<div id="page-container" class="fade">
		<!-- begin login -->
		<div class="" data-pageload-addclass="animated fadeIn">
			<!-- begin brand -->

			<br>
			<!-- end brand -->
			<!-- begin login-content -->
			
	<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">Editar </div>
        <div class="panel-body">
            <?php echo form_open(null,array("name"=>"form"));?>
            <?php
                //acá visualizamos los mensajes de error
                $errors=validation_errors('<li>','</li>');
                if($errors!="")
                {?>
                	<div class="alert alert-danger">
                    	<ul>
                    <?php echo $errors;?>
                    	</ul>
                    </div>
          <?php }
                if ($this->session->flashdata('mensaje')!='') {?>
					<div class="alert-<?php echo $this->session->flashdata('css');?> "><?php
					echo $this->session->flashdata('mensaje');?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   		<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre_preparacion"  value="<?php echo $preparacion->nombre;?>" class="form-control" autofocus="true" />
            </p>
			<p>
                <label for="nombre">Aporte de calorías:</label>
                <input type="text" name="kcal"  value="<?php echo $preparacion->kcal;?>" class="form-control" placeholder="eje: 1500 kcal" />
            </p>
            
             <p>
            <div class="row m-b-15">
				<div class="col-lg-4 col-md-6">
					<label class="control-label" for="clave" >Tipo: <span class="text-danger">*</span></label>
					<select name="tipo" id="tipo">
						<option value="desayuno" <?php if ($preparacion->tipo=="desayuno"){ ?> selected <?php }?>>Desayuno</option>
						<option value="colacion_1" <?php if ($preparacion->tipo=="colacion_1"){ ?> selected <?php }?>>Colación</option>
						<option value="entrada" <?php if ($preparacion->tipo=="entrada"){ ?> selected <?php }?>>Entrada</option>
						<option value="almuerzo" <?php if ($preparacion->tipo=="almuerzo"){ ?> selected <?php }?>>Almuerzo</option>
						<option value="colacion_2" <?php if ($preparacion->tipo=="colacion_2"){ ?> selected <?php }?>>Colación media tarde</option>
						<option value="once" <?php if ($preparacion->tipo=="once"){ ?> selected <?php }?>>Once</option>
						<option value="cena" <?php if ($preparacion->tipo=="cena"){ ?> selected <?php }?>>Cena</option>
					</select>
				</div>
				<div class="col-lg-4 col-md-6">
					<label class="control-label" for="clave" >Tipo de estado nutricional: <span class="text-danger">*</span></label>
						<select name="tipo_nutri" id="tipo_nutri">
							<option value="enflaquecido" <?php if ($preparacion->tipo_nutri=="enflaquecido"){?>selected <?php }?>>Enflaquecido</option>
							<option value="adecuado" <?php if ($preparacion->tipo_nutri=="adecuado"){?>selected <?php }?>>Adecuado</option>
							<option value="promedio" <?php if ($preparacion->tipo_nutri=="promedio"){?>selected <?php }?>>Promedio</option>
							<option value="sobrepeso" <?php if ($preparacion->tipo_nutri=="sobrepeso"){?>selected <?php }?>>Sobrepeso</option>
							<option value="obeso" <?php if ($preparacion->tipo_nutri=="obeso"){?>selected <?php }?>>Obeso</option>
						</select>
				</div>
			</div>
            
            <hr />
            <input type="submit" value="Enviar" class="btn btn-warning" />
            <?php echo form_close();?> 
            
        </div>
    </div>
</div>
	</div>	
			<!-- end login-content -->

		<!-- end login -->
		
		
		<!-- Modal -->



	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

	<script src="<?php echo base_url();?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/js-cookie/js.cookie.js"></script>
	<script src="<?php echo base_url();?>assets/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->

	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>
</html>

