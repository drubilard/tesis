<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title>NUTRICIÓN</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/logo/logo.png" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
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
				<a href="<?php echo base_url();?>administrador/crear_usuario" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"> <b>NUTRICIÓN</b> evaluación</a>
			</div>
		</div>

	<div class="container-fluid" class="">
		<!-- begin login -->
		<div class="login login-v2 " data-pageload-addclass="animated fadeIn ">
			<!-- begin brand -->
			<div class="login-header row animated bounceInLeft">
				<div class="brand ">
					<img src="<?php echo base_url();?>assets/img/logo/logo.png" style="height: 70px;"> <b>NUTRICIÓN</b> Registro de nutricionista
				</div>

			</div>
			<br>

			
			<!-- end brand -->
			<!-- begin login-content -->
			
				<div class="login-buttons row animated bounceIn">
						
				<div class="container">
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
								<div class="alert alert-<?php echo $this->session->flashdata('css');?> "><?php
									echo $this->session->flashdata('mensaje');?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   					<span aria-hidden="true">&times;</span>
									</button>
								</div>

                            <?php }?>
                        <label for="nombre" class="control-label">Rut:<span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<input type="text" class="form-control" autofocus="true" name="rut" maxlength="9"  placeholder="Rut sin puntos ni guión" value="<?php echo set_value_input(array(),'rut','rut')?>" />
							</div>
						</div>
						<label for="nombre" class="control-label">Nombre <span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo set_value_input(array(),'nombre','nombre')?>" />
							</div>
							<div class="col-md-6 m-b-15">
								<input type="text" class="form-control" name="apellido" placeholder="Apellido" value="<?php echo set_value_input(array(),'apellido','apellido')?>"/>
							</div>
						</div>
						<label class="control-label" for="sexo" >Sexo: <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<label class="container">Masculino
  									<input type="radio" name="sexo" value="1">
 									 <span class="checkmark"></span>
								</label>
								<label class="container">Femenino
  									<input type="radio" checked=""  name="sexo" value="2">
  									<span class="checkmark"></span>
								</label>
							</div>
                        </div>
                        <label for="usuario" class="control-label">Usuario:<span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php echo set_value_input(array(),'usuario','usuario')?>" />
							</div>
                        </div>
                        <label for="correo" class="control-label">Correo:<span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<input type="text" class="form-control" name="correo" placeholder="Correo" value="<?php echo set_value_input(array(),'correo','correo')?>" />
							</div>
                        </div>
                        <label for="contraseña" class="control-label">Contraseña:<span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<input type="password" class="form-control" name="contrasena" placeholder="Contraseña" >
							</div>
                        </div>
                        <label for="contraseña" class="control-label">Repetir contraseña:<span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<input type="password" class="form-control" name="contrasena_2" placeholder="Repetir contraseña" />
							</div>
                        </div>
						<div class="register-buttons">
							<button type="submit" class="btn btn-warning btn-block btn-lg"> Crear Cuenta </button>
						</div>
						<hr />
						<p class="text-center">
							&copy; Drubilar All Rights Reserved <?php echo date('Y');?>
						</p>
					<?php echo form_close();?>
				</div>
				<!-- end register-content -->
					</div>


			<!-- end login-content -->
		</div>

		<!-- end login -->
		
		
	</div>
		<!-- Modal -->


	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/js-cookie/js.cookie.js"></script>
	<script src="<?php echo base_url();?>assets/js/apps.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/demo/formato_rut.js"></script>
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

