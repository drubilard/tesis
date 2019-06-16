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
				<a href="<?php echo base_url();?>registrar/administrar" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"> <b>NUTRICIÓN</b> evaluación</a>
			</div>
		</div>
		<div id="header" class="header navbar-default">
			<nav aria-label="breadcrumb">
  				<ol class="breadcrumb">
    				<li class="breadcrumb-item"><a href="<?php echo base_url();?>registrar/listado_preparaciones"><strong>Listado Preparaciones</strong></a></li>
    				<li class="breadcrumb-item" aria-current="page">Editar preparación</li>
  				</ol>
			</nav>  			
			
		</div>

	<div id="page-container" class="fade">
		<!-- begin login -->
		<div class="" data-pageload-addclass="animated fadeIn">
			<!-- begin brand -->

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
					echo $this->session->flashdata('mensaje');?></div>
				<?php }?>
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre_preparacion" value="<?php echo $preparacion->nombre;?>" class="form-control" autofocus="true" />
            </p>
            
             <p>
            <div class="row m-b-15">
			<div class="col-md-12">
            	<label class="control-label" for="clave" >Tipo: <span class="text-danger">*</span></label>
				<label class="container">Bebestible
  					<input type="radio" value="bebestible" name="tipo" <?php if($preparacion->tipo=="bebestible"){?> checked=""<?php }?>>
 					<span class="checkmark"></span>
				</label>
				<label class="container">Desayuno
  					<input type="radio" value="desayuno" name="tipo" <?php if($preparacion->tipo=="desayuno"){?> checked=""<?php }?>> 
  					<span class="checkmark"></span>
				</label>
				<label class="container">Colación
  					<input type="radio" value="colacion" name="tipo" <?php if($preparacion->tipo=="colacion"){?> checked=""<?php }?>>
  					<span class="checkmark"></span>
				</label>
				<label class="container">Entrada
  					<input type="radio" value="entrada" name="tipo" <?php if($preparacion->tipo=="entrada"){?> checked=""<?php }?>>
  					<span class="checkmark"></span>
				</label>
				<label class="container">Almuerzo
  					<input type="radio" value="almuerzo" name="tipo" <?php if($preparacion->tipo=="almuerzo"){?> checked=""<?php }?>>
  					<span class="checkmark"></span>
				</label>
				<label class="container">Colación Media Tarde
  					<input type="radio" value="colacion media tarde" name="tipo" <?php if($preparacion->tipo=="colacion media tarde"){?> checked=""<?php }?>>
  					<span class="checkmark"></span>
				</label>
				<label class="container">Once
  					<input type="radio" value="once" name="tipo" <?php if($preparacion->tipo=="once"){?> checked=""<?php }?>>
  					<span class="checkmark"></span>
				</label>
				<label class="container">Cena
  					<input type="radio" value="cena" name="tipo" <?php if($preparacion->tipo=="cena"){?> checked=""<?php }?>>
  					<span class="checkmark"></span>
				</label>
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
	<script src="<?php echo base_url();?>assets/js/demo/eliminar.js"></script>
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

