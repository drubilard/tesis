<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Nutrición | Registro</title>>
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
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">

		<!-- begin register -->
		<div class="register register-with-news-feed">
			<!-- begin news-feed -->
			<div class="news-feed">
				<div class="news-image" style="background-image: url(<?php echo base_url();?>assets/img/login-bg/nutricion_registro.jpg)"></div>
				<div class="news-caption">
					<h4 class="caption-title"><b>Nutrición</b> Registro</h4>
					<p>
						Solo porque no estas enfermo no significa que estas saludable.
				</div>
			</div>
			<!-- end news-feed -->
			<!-- begin right-content -->
			<div class="right-content">
			<nav aria-label="breadcrumb" >
  				<ol class="breadcrumb">
    				<li class="breadcrumb-item"><a href="<?php echo base_url();?>registrar/administrar"><strong> Administración</strong></a></li>
    				<li class="breadcrumb-item" aria-current="page">Nueva Ficha</li>
  				</ol>
			</nav>
				<!-- begin register-header -->
				<h1 class="register-header">

					<img src="<?php echo base_url();?>assets/img/logo/logo.png" style="height: 70px;">Registrar Paciente
					<small>Dime lo que comes y te diré lo que eres.</small>
				</h1>
				<!-- end register-header -->
				<!-- begin register-content -->
				<div class="register-content">
					<?php echo form_open(null,array("class"=>"margin-bottom-0"));?>
						<?php 
							$errors=validation_errors('<li>','</li>');
							if ($errors !="") {?>
								<div class="alert alert-danger">
									<ul>
										<?php echo $errors;?>
									</ul>
								</div>

							<?php }
							if ($this->session->flashdata('mensaje')!='') {?>
								<div class="alert-<?php echo $this->session->flashdata('css');?> "><?php
									echo $this->session->flashdata('mensaje');?></div>

							<?php }?>
						<label for="nombre" class="control-label">Nombre <span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo set_value_input(array(),'nombre','nombre')?>" />
							</div>
							<div class="col-md-6 m-b-15">
								<input type="text" class="form-control" name="apellido" placeholder="Apellido" value="<?php echo set_value_input(array(),'apellido','apellido')?>"/>
							</div>
						</div>
						<label for="nombre" class="control-label">Rut:<span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<input type="text" class="form-control" name="rut_paciente" placeholder="ej:12345678-9" value="<?php echo set_value_input(array(),'rut_paciente','rut_paciente')?>" />
							</div>
						</div>
						<label for="nombre" class="control-label">Fecha Nacimiento:<span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<input type="date" class="form-control" name="fecha_nacimiento_pac" placeholder="" value="<?php echo set_value_input(array(),'fecha_nacimiento_pac','fecha_nacimiento_pac')?>" />
							</div>
						</div>
						<label for="email" class="control-label">Email <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<input type="email" class="form-control" name="email" placeholder="Email address" value="<?php echo set_value_input(array(),'email','email')?>"/>
							</div>
						</div>
						<label for="email" class="control-label">Vuelva a ingresar Email <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<input type="email" class="form-control" name="email2" placeholder="Email address" value="<?php echo set_value_input(array(),'email2','email2')?>"/>
							</div>
						</div>

						<label class="control-label" for="clave" >Sexo: <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<label class="container">Masculino
  									<input type="radio" name="sexo" value="1">
 									 <span class="checkmark"></span>
								</label>
								<label class="container">Femenino
  									<input type="radio" name="sexo" value="2">
  									<span class="checkmark"></span>
								</label>
							</div>
						</div>
						<div class="register-buttons">
							<button type="submit" class="btn btn-warning btn-block btn-lg"> Agregar Patologías y Hábitos </button>
						</div>
						<hr />
						<p class="text-center">
							&copy; Drubilar All Rights Reserved 2018
						</p>
					<?php echo form_close();?>
				</div>
				<!-- end register-content -->
			</div>
			<!-- end right-content -->
		</div>
		<!-- end register -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
	<!--[if lt IE 9]>
		<script src="../assets/crossbrowserjs/html5shiv.js"></script>
		<script src="../assets/crossbrowserjs/respond.min.js"></script>
		<script src="../assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo base_url();?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/js-cookie/js.cookie.js"></script>
	<script src="<?php echo base_url();?>assets/js/theme/default.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>
</html>
