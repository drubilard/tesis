<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Nutrición</title>
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
		<div class="login-cover-image" style="background-image: url(<?php echo base_url();?>assets/img/login-bg/nutricion_2.jpg); width: 100%; height: 100%" data-id="login-cover-image"></div>
		<div class="login-cover-bg"></div>
	</div>
	<!-- end login-cover -->
	
	<!-- begin #page-container -->
	<div id="header" class="header navbar-default row justify-content-center justify-content-md-start">
			<!-- begin navbar-header -->
				<div class="navbar-header col-xs-8 col-md-8 col-lg-10">
					<a href="<?php echo base_url();?>administrar/inicio" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"  > <b>NUTRICIÓN</b></a>
				</div>
	</div>
	<div id="page-container" class=" fade">
		<!-- begin login -->
		<div class="login login-v2" data-pageload-addclass="animated fadeIn">
			<!-- begin brand -->
			<div class="login-header row animated bounceInLeft">
				<div class="brand">
					<img src="<?php echo base_url();?>assets/img/logo/logo.png" style="height: 70px;"> <b>Nutrición</b> Login Paciente
					<small class="frase"><br>Esforzarte para llevar una nutrición adecuada, es la mejor inversión para tu cuerpo y mente que puedes hacer</small>
				</div>
			</div>
			<!-- end brand -->
			<!-- begin login-content -->
			<div class="login-content animated bounceIn">
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
							if ($this->session->flashdata('mensaje_login')!='') {?>
								<div class="alert alert-<?php echo $this->session->flashdata('css');?> "><?php
									echo $this->session->flashdata('mensaje_login');?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   					<span aria-hidden="true">&times;</span>
									</button>
								<?php }?>
								</div>
							
					<div  class="form-group m-b-20">
						<input name="user" type="text" autofocus="true" class="form-control form-control-lg" placeholder="Usuario" value="<?php echo set_value_input(array(),'user','user')?>" />
					</div>
					<div class="form-group m-b-20">
						<input name="clave" type="password" class="form-control form-control-lg" placeholder="Clave" />
					</div>
					<!--<div class="checkbox checkbox-css m-b-20">
						<input type="checkbox" id="remember_checkbox" /> 
						<label for="remember_checkbox">
							Recuérdame
						</label>
					</div>-->
					<div class="login-buttons">
						<button type="submit" class="btn btn-warning btn-block btn-lg">Entrar</button>
					</div>
					<?php echo form_close();?>
			</div>
			<!-- end login-content -->
		</div>
		<!-- end login -->
		
		
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
	<!--[if lt IE 9]>
		<script src="<?php echo base_url();?>assets/crossbrowserjs/html5shiv.js"></script>
		<script src="<?php echo base_url();?>assets/crossbrowserjs/respond.min.js"></script>
		<script src="<?php echo base_url();?>assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
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
