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
  <script src="<?php echo base_url();?>assets/js/demo/jquery.min.js"></script>
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
			<div class="right-content">
				<nav aria-label="breadcrumb" >
  					<ol class="breadcrumb">
    					<li class="breadcrumb-item"><a href="<?php echo base_url();?>registrar/administrar"><strong> Administración</strong></a></li>
    					<li class="breadcrumb-item" aria-current="page">Creación Minuta</li>
  					</ol>
				</nav>
			</div>
		</div>


	<div id="page-container" class="fade">
		<!-- begin login -->
		<div class="" data-pageload-addclass="animated fadeIn">
			<!-- begin brand -->

			<!-- end brand -->
			<!-- begin login-content -->
			<br>
	<div class="row">	
    <div class="col-md-2">
    
    </div>
		<div class=".col-xs-8 .col-sm-8 .col-lg-8. col-md-8">	
			<div class="container" >
    			<div class="panel panel-success">
        			<div class="panel-heading">Listado Preparaciones </div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_desayunos" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Desayunos
						</button>
        				<div class="collapse" id="lista_desayunos">  
                <?php echo form_open(null,array("name"=>"form", "target"=>"_blank"));?>
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($preparaciones as $key=>$preparacion){?>
                      					<label >
                      					<?php if($preparacion->tipo=="desayuno" || $preparacion->tipo=="bebestible"){?>
                      						<input name="nombre_preparacion_d[]" type="checkbox" value="<?php echo $preparacion->id;?>" draggable="true">
                      						<?php echo $preparacion->nombre;?>
                    					</label>
                    					<small><?php echo $preparacion->tipo;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>
    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_colaciones" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Colaciones
						</button>
        				<div class="collapse" id="lista_colaciones"> 
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($preparaciones as $key=>$preparacion){?>
                      					<label>
                      					<?php if($preparacion->tipo=="colacion" || $preparacion->tipo=="bebestible"){?>
                      						<input name="nombre_preparacion_co[]" type="checkbox" value="<?php echo $preparacion->id;?>">
                      						<?php echo $preparacion->nombre;?>
                    					</label>
                    					<small><?php echo $preparacion->tipo;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_entradas" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Entradas
						</button>
        				<div class="collapse" id="lista_entradas"> 
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($preparaciones as $key=>$preparacion){?>
                      					<label>
                      					<?php if($preparacion->tipo=="entrada" || $preparacion->tipo=="bebestible"){?>
                      						<input name="nombre_preparacion_e[]" type="checkbox" value="<?php echo $preparacion->id;?>">
                      						<?php echo $preparacion->nombre;?>
                    					</label>
                    					<small><?php echo $preparacion->tipo;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_almuerzos" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Almuerzos
						</button>
        				<div class="collapse" id="lista_almuerzos">  
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($preparaciones as $key=>$preparacion){?>
                      					<label>
                      					<?php if($preparacion->tipo=="almuerzo" || $preparacion->tipo=="bebestible"){?>
                      						<input name="nombre_preparacion_a[]" type="checkbox" value="<?php echo $preparacion->id;?>">
                      						<?php echo $preparacion->nombre;?>
                    					</label>
                    					<small><?php echo $preparacion->tipo;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_colaciones_tarde" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Colaciones Media Tarde
						</button>
        				<div class="collapse" id="lista_colaciones_tarde">
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($preparaciones as $key=>$preparacion){?>
                      					<label>
                      					<?php if($preparacion->tipo=="colacion media tarde" || $preparacion->tipo=="bebestible"){?>
                      						<input name="nombre_preparacion_cmd[]" type="checkbox" value="<?php echo $preparacion->id;?>">
                      						<?php echo $preparacion->nombre;?>
                    					</label>
                    					<small><?php echo $preparacion->tipo;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                   
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_once" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Once
						</button>
        				<div class="collapse" id="lista_once">  
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($preparaciones as $key=>$preparacion){?>
                      					<label>
                      					<?php if($preparacion->tipo=="once" || $preparacion->tipo=="bebestible"){?>
                      						<input name="nombre_preparacion_o[]" type="checkbox" value="<?php echo $preparacion->id;?>">
                      						<?php echo $preparacion->nombre;?>
                    					</label>
                    					<small><?php echo $preparacion->tipo;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_cena" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Cena
						</button>
        				<div class="collapse" id="lista_cena">

            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($preparaciones as $key=>$preparacion){?>
                      					<label>
                      					<?php if($preparacion->tipo=="cena" || $preparacion->tipo=="bebestible"){?>
                      						<input name="nombre_preparacion_ce[]" type="checkbox" value="<?php echo $preparacion->id;?>">
                      						<?php echo $preparacion->nombre;?>
                    					</label>
                    					<small><?php echo $preparacion->tipo;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>
				</div>
        <button  type="submit" class="btn btn-danger  btn"><span class="glyphicon glyphicon-file" aria-hidden="true" ></span> Generar PDF</button>
			</div>
		</div>
	</div>	
			</div>
			</div>

		</div>
	</div>

		<?php echo form_close();?>
</div>
			<!-- end login-content -->

		<!-- end login -->
		
		
		<!-- Modal -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker3'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
  </div>
</div>


	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->

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

