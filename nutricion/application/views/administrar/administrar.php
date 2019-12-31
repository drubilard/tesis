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
	<div id="header" class="header navbar-default row justify-content-center justify-content-md-start">
			<!-- begin navbar-header -->
				<div class="navbar-header col-xs-7 col-sm-3  col-md-4 col-lg-4 col-xl-5">
					<a href="" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"  > <b>NUTRICIÓN</b></a>
				</div>
				<div class="navbar-header col-xs-3 col-sm-5  col-md-4 col-lg-5 col-xl-4 ">
					<a href="<?php echo base_url();?>nutricionista/editar_nutricionista/<?php echo $this->session->userdata("id");?>"><span class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/usuario_2.png" >  Bienvenid<?php if($nutri_sexo=="1"){echo "o ".$nutri_nombre;}else{ echo "a ".$nutri_nombre;}?></span></a>
				</div>
				<div class="navbar-header col-xs-2 col-sm-4  col-md-4 col-lg-3 col-xl-3">
					<a href="<?php echo base_url();?>administrar/salir" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logout.png" >  Cerrar Sesión</a>
				</div>
	</div>

	<div id="page-container" class="fade">
		<!-- begin login -->
		<div class="login login-v2 " data-pageload-addclass="animated fadeIn ">
			<!-- begin brand -->
			<div class="login-header row animated bounceInLeft">
				<div class="brand ">
					<img src="<?php echo base_url();?>assets/img/logo/logo.png" style="height: 70px;"> <b>NUTRICIÓN</b> Administración
				</div>

			</div>
			<br>
			
			<!-- end brand -->
			<!-- begin login-content -->
			
					<div class="login-buttons row animated bounceIn">
						<a href="<?php echo base_url();?>paciente/add_paciente" class="btn btn-warning btn-block btn-lg">Nuevo ingreso</a>
						<a href="<?php echo base_url();?>paciente/listado_pacientes" class="btn btn-warning btn-block btn-lg">Pacientes</a>
						<a href="<?php echo base_url();?>administrar/gestion" class="btn btn-warning btn-block btn-lg">Gestión</a>
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

