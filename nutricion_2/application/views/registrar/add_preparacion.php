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
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/demo/ajustes_planilla.js"></script>
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
				<a href="<?php echo base_url();?>registrar/administrar" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"> <b>NUTRICIÓN</b> evaluación</a>
			</div>
		</div>
	<div id="header" class="header navbar-default">
			<nav aria-label="breadcrumb">
  				<ol class="breadcrumb">
				  	<li class="breadcrumb-item"><a href="<?php echo base_url();?>registrar/administrar"><strong>Administrar</strong></a></li>
				 	<li class="breadcrumb-item"><a href="<?php echo base_url();?>registrar/gestion"><strong>Gestión</strong></a></li>
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>registrar/listado_preparaciones"><strong>Gestión preparaciones</strong></a></li>
    				<li class="breadcrumb-item" aria-current="page">Agregar preparación</li>
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
        <div class="panel-heading">Agregar Preparación</div>
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
					<div class="alert alert-<?php echo $this->session->flashdata('css');?> "><?php
					echo $this->session->flashdata('mensaje');?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					   		<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php }?>
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" placeholder="Nombre preparación" autofocus="true" value="<?php echo set_value_input(array(),'nombre','nombre')?>" class="form-control" autofocus="true" />
            </p>
            
             <p>
			<div class="row m-b-15">
			<div class="col-md-12">
			<label class="control-label" for="clave" >Tipo: <span class="text-danger">*</span></label>
				<select name="tipo" id="tipo">
					<option value="desayuno">Desayuno</option>
					<option value="colacion_1">Colación</option>
					<option value="entrada">Entrada</option>
					<option value="almuerzo">Almuerzo</option>
					<option value="colacion_2">Colación media tarde</option>
					<option value="once">Once</option>
					<option value="cena">Cena</option>
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

