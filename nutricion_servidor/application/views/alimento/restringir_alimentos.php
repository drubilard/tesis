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
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/css/glyphicons.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/logo/logo.png" />

	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url();?>assets/plugins/pace/pace.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
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
				<div class="navbar-header col-xs-8 col-md-8 col-lg-10">
					<a href="<?php echo base_url();?>administrar/administrar" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"  > <b>NUTRICIÓN</b> evaluación</a>
				</div>
				<div class="navbar-header col-xs-4 col-md-4 col-lg-2">
					<a href="<?php echo base_url();?>administrar/salir" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logout.png" >  Cerrar Sesión</a>
				</div>
	</div>
		<div id="header" class="header navbar-default">
			<nav aria-label="breadcrumb">
  				<ol class="breadcrumb">
    				<li class="breadcrumb-item"><a href="<?php echo base_url();?>administrar/administrar"><strong>Administrar</strong></a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>paciente/listado_pacientes"><strong>Listado pacientes</strong></a></li>
					<li class="breadcrumb-item" aria-current="page">Descartar alimentos</li>
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
			
			<div class="container-fluid">
    <div class="panel panel-success">

        <div class="panel-heading">Listado de alimentos que desea descartar</div>
        <div class="panel-body">
            <?php
            if($this->session->flashdata('mensaje')!='')
            {
               ?>
			   	<div class="alert alert-<?php echo $this->session->flashdata('css')?>"><?php echo $this->session->flashdata('mensaje')?>
				   	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   <span aria-hidden="true">&times;</span>
					</button>
				</div>
               <?php 
            }
            ?>
        
		<div class="container-fluid">
				<div class="row">
					<div class="col-md-3 col-xs-12">
						<div class="input-group">
						</div>
					</div>
					<div class="col-md-6 col-xs-5">

					</div>
					<div class="col-md-3 col-xs-5">
    						<div class="input-group">
								<span class="input-group-addon "><span class=" glyphicon glyphicon-search" aria-hidden="true"></span></span>
      							<input type="text" autofocus="true" name="busqueda" class="form-control form-control-lg" id="b_contraido_id" placeholder="buscar alimento..">
							</div>
					</div>
				</div>
			</div>
            <div class="panel-body">
				<div class="table-responsive">
                <form method="post">
                    <input type="hidden" name="rut" value="<?php echo $datos[0]->rut;?>">
  					<table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th><center>Nº</center></th>
                        <th><center>Nombre</center></th>
						<th><center>Tipo</center></th>
                        <th><center>Descartar</center></th>
                    </tr>
                </thead>
                <tbody id="body_alimentos">
                
                </tbody>
            </table>
            </form>
			<div class="text-center paginacion">
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
	<script src="<?php echo base_url();?>assets/js/demo/busqueda_alimentos_restringir.js"></script>
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

