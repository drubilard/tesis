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
				<a href="<?php echo base_url();?>registrar/administrar" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"> <b>NUTRICIÓN</b> Editar paciente</a>
			</div>
		</div>
		<div id="header" class="header navbar-default">
			<nav aria-label="breadcrumb">
  				<ol class="breadcrumb">
				  	<li class="breadcrumb-item"><a href="<?php echo base_url();?>registrar/administrar"><strong>Administrar</strong></a></li>
    				<li class="breadcrumb-item" aria-current="page">Editar paciente</li>
  				</ol>
			</nav>  			
			
		</div>

	<div class="container-fluid" class="">
		<!-- begin login -->
		<div class="login login-v2 " data-pageload-addclass="animated fadeIn ">
			<!-- begin brand -->
			<div class="login-header row animated bounceInLeft">
				<div class="brand ">
					<img src="<?php echo base_url();?>assets/img/logo/logo.png" style="height: 70px;"> <b>NUTRICIÓN</b> Editar paciente
				</div>

			</div>
			<br>

			
			<!-- end brand -->
			<!-- begin login-content -->
			
				<div class="login-buttons row animated bounceIn">
						
				<div class="container-fluid">
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
                        <label for="nombre" class="control-label">Rut:<span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<input type="text" class="form-control" name="rut_paciente" placeholder="ej:12345678-9" value="<?php echo $datos->rut?>" />
							</div>
						</div>
						<label for="nombre" class="control-label">Nombre <span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<input type="text" class="form-control" name="nombre_paciente" placeholder="Nombre" value="<?php echo $datos->nombre?>" />
							</div>
							<div class="col-md-6 m-b-15">
								<input type="text" class="form-control" name="apellido_paciente" placeholder="Apellidos" value="<?php echo $datos->apellido?>"/>
							</div>
						</div>
						<label for="fecha_nacimiento" class="control-label">Fecha de Nacimiento:<span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-6 m-b-15">
								<input type="date" class="form-control" name="fecha_nacimiento_p" value="<?php echo $datos->fecha_nacimiento?>" />
							</div>
						</div>
						<label class="control-label" for="sexo" >Sexo: <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<label class="container">Masculino
                            <input type="radio" name="sexo" <?if($datos->sexo=="1"){?>checked="checked"<?php }?> value="1">
 									 <span class="checkmark"></span>
								</label>
								<label class="container">Femenino
  									<input type="radio" name="sexo"<?if($datos->sexo=="2"){?>checked="checked"<?php }?> value="2">
  									<span class="checkmark"></span>
								</label>
							</div>
                        </div>
                        
						<div class="register-buttons">
							<button type="submit" class="btn btn-warning btn-block btn-lg"> Enviar </button>
						</div>
						<hr />
						<p class="text-center">
							&copy; Drubilar All Rights Reserved 2018
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
	<script src="<?php echo base_url();?>assets/js/demo/despliegue_tipo_consulta.js"></script>
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

