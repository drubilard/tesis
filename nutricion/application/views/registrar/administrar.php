<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>NUTRICIÓN</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/font-awesome/5.3/css/all.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/theme/default.css" rel="stylesheet" id="theme" />
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
				<a href="<?php echo base_url();?>registrar/inicio" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"  > <b>NUTRICIÓN</b> evaluación</a>
			</div>

		</div>
		<div id="header" class="header navbar-default">
			<nav aria-label="breadcrumb">
  				<ol class="breadcrumb">
    				<li class="breadcrumb-item"><a href="<?php echo base_url();?>registrar/administrar"><strong> Administrar</strong></a></li>
    				<li class="breadcrumb-item" aria-current="page"></li>
  				</ol>
			</nav>
			
		</div>

	<div id="page-container" class="fade">
		<!-- begin login -->
		<div class="login login-v2" data-pageload-addclass="animated fadeIn">
			<!-- begin brand -->
			<div class="login-header">
				<div class="brand">
					<img src="<?php echo base_url();?>assets/img/logo/logo.png" style="height: 70px;"> <b>NUTRICIÓN</b> Evaluación Nutricional
				</div>

			</div>
			<br>
				<?php 
					$errors=validation_errors('<li>','</li>');
					if ($errors !="") {?>
						<div class="alert alert-danger">
							<ul>
								<?php echo $errors;?>
							</ul>
						</div>

							<?php }?>
				<div class="alert-<?php echo $this->session->flashdata('css');?> "><?php
					echo $this->session->flashdata('mensaje');?>		
				</div>
			
			<!-- end brand -->
			<!-- begin login-content -->
			
					<div class="login-buttons">
						<!--<button  data-toggle="modal" data-target="#modal_pacientes" type="button" class="btn btn-warning btn-block btn-lg" disabled="">Consultar Ficha</button>-->
						<a href="<?php echo base_url();?>registrar/add" class="btn btn-warning btn-block btn-lg">Nueva Ficha</a>
						<a href="<?php echo base_url();?>registrar/gestion" class="btn btn-warning btn-block btn-lg">Gestión</a>
					</div>


			<!-- end login-content -->
		</div>

		<!-- end login -->
		
		
	</div>
		<!-- Modal -->
	<div class="modal fade" id="modal_pacientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title" id="myModalLabel">Consulta de Paciente</h4>
      			</div>
      			<div class="modal-body">
        			<?php echo form_open(null,array("class"=>"margin-bottom-0"));?>
          				<div class="form-group">
            				<label for="recipient-name" class="control-label">Nombre:</label>
            				<select name="usuario_vacacion" id="paciente_id" required="true">
            						<option value="-1">--selección de persona--</option>
            					<?php foreach($pacientes as $user){?>
  									<option value="<?php echo $user->rut_paciente;?>"><?php echo $user->nombres, " ", $user->apellidos?></option>
  								<?php }?>
							</select>
							<hr>
							<div id="tipo_consulta">
							<label for="recipient-name" class="control-label">Consultar por:</label>
							<select name="tipo_consulta" required="true">
            						<option value="-1">--selección de persona--</option>
  									<option value="1">Patologías y Hábitos</option>
  									<option value="2">Ficha Clínica</option>
  									<option value="3">Evaluación</option>
  									<option value="1">Dieta</option>
							</select>
							</div>
          				</div>
          				<div class="modal-footer">
        					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        					<button type="submit" class="btn btn-primary">Save changes</button>
      					</div>
      					<?php echo form_close();?>
      			</div>
      		</div>

    	</div>
  	</div>


	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

	<script src="<?php echo base_url();?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/js-cookie/js.cookie.js"></script>
	<script src="<?php echo base_url();?>assets/js/apps.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/demo/despliegue_tipo_consulta.js"></script>
	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->

	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
</body>
</html>

