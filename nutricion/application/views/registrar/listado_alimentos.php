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
			<nav aria-label="breadcrumb">
  				<ol class="breadcrumb">
    				<li class="breadcrumb-item"><a href="<?php echo base_url();?>registrar/gestion"><strong>Gestión</strong></a></li>
    				<li class="breadcrumb-item" aria-current="page">Listado de alimentos</li>
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

        <div class="panel-heading">Listado de alimentos</div>
        <div class="panel-body">
            <?php
            if($this->session->flashdata('mensaje')!='')
            {
               ?>
               <div class="alert alert-<?php echo $this->session->flashdata('css')?>"><?php echo $this->session->flashdata('mensaje')?></div>
               <?php 
            }
            ?>
        
            <p>
                <a href="<?php echo base_url()?>registrar/add_alimento" class="btn btn-warning"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar</a>
            </p>
            <table class="table table-bordered table-sprited table-hover">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    	$i=1;
                        foreach($alimentos as $alimento)
                        {
                            ?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $alimento->alimento_info;?></td>
                                <td><?php echo $alimento->opcion;?></td>
                                <td>
                                    <a href="<?php echo base_url()?>registrar/editar_alimento/<?php echo $alimento->id?>/<?php echo $pagina?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                    <a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>registrar/eliminar_alimento/<?php echo $alimento->id?>/<?php echo $pagina?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                            <?php
                           	$i++;
                        }
                    ?>
                
                </tbody>
                
            </table>
            
            <p class="pull-right"><?php echo $this->pagination->create_links()?></p>
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

