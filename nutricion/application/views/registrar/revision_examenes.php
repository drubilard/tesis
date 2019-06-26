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
			<div class="right-content">
				<nav aria-label="breadcrumb" >
  					<ol class="breadcrumb">
    					<li class="breadcrumb-item"><a href="<?php echo base_url();?>registrar/administrar"><strong> Administración</strong></a></li>
    					<li class="breadcrumb-item" aria-current="page">Revisión Exámenes</li>
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
		<div class="col-md-4">	
			<div class="container" >
    			<div class="panel panel-success">
        			<div class="panel-heading">Preferir </div>
        				<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_proteinas_animal_pref" aria-expanded="false" aria-controls="collapseExample" id="button-examenes" >
  							Proteínas animales
						</button>
        				<div class="collapse" id="lista_proteinas_animal_pref">  
							<?php echo form_open(null,array("name"=>"form"));?>
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="proteinas animales"){?>
                      						<input  name="nombre_alimento_preferir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_pescados_pref" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Pescados
						</button>
        				<div class="collapse" id="lista_pescados_pref">  
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label >
                      					<?php if($alimento->opcion=="pescado"){?>
                      						<input name="nombre_alimento_preferir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>
    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_levaduras_pref" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Levaduras
						</button>
        				<div class="collapse" id="lista_levaduras_pref"> 
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="levaduras"){?>
                      						<input name="nombre_alimento_preferir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_azucares_pref" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Azucares
						</button>
        				<div class="collapse" id="lista_azucares_pref"> 
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="azucares"){?>
                      						<input name="nombre_alimento_preferir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_estimulantes_pref" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Estimulantes
						</button>
        				<div class="collapse" id="lista_estimulantes_pref">  
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="estimulantes"){?>
                      						<input name="nombre_alimento_preferir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_frutos_secos_pref" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Frutos secos
						</button>
        				<div class="collapse" id="lista_frutos_secos_pref">
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="frutos secos"){?>
                      						<input name="nombre_alimento_preferir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                   
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_gramineas_pref" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Gramineas
						</button>
        				<div class="collapse" id="lista_gramineas_pref">  
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="gramineas"){?>
                      						<input name="nombre_alimento_preferir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_legumbres_pref" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Legumbres
						</button>
        				<div class="collapse" id="lista_legumbres_pref">

            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="legumbres"){?>
                      						<input name="nombre_alimento_preferir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_productos_lacteos_pref" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Productos lacteos
						</button>
        				<div class="collapse" id="lista_productos_lacteos_pref">

            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="productos lacteos"){?>
                      						<input name="nombre_alimento_preferir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_verduras_pref" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Verduras
						</button>
        				<div class="collapse" id="lista_verduras_pref">

            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="verduras"){?>
                      						<input name="nombre_alimento_preferir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_frutas_pref" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Frutas
						</button>
        				<div class="collapse" id="lista_frutas_pref">
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="frutas"){?>
                      						<input name="nombre_alimento_prefenir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>


				</div>
			</div>
		</div>	
		<div class="col-md-4">	
			<div class="container" >
    			<div class="panel panel-success">
        			<div class="panel-heading">Prevenir </div>
        				<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_proteinas_animal_prev" aria-expanded="false" aria-controls="collapseExample" id="button-examenes" >
  							Proteínas animales
						</button>
        				<div class="collapse" id="lista_proteinas_animal_prev">  
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="proteinas animales"){?>
                      						<input name="nombre_alimento_prevenir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_pescados_prev" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Pescado
						</button>
        				<div class="collapse" id="lista_pescados_prev">  
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="pescado"){?>
                      						<input name="nombre_alimento_prevenir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>
    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_levaduras_prev" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Levaduras
						</button>
        				<div class="collapse" id="lista_levaduras_prev"> 
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="levaduras"){?>
                      						<input name="nombre_alimento_prevenir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_azucares_prev" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Azucares
						</button>
        				<div class="collapse" id="lista_azucares_prev"> 
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="azucares"){?>
                      						<input name="nombre_alimento_prevenir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_estimulantes_prev" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Estimulantes
						</button>
        				<div class="collapse" id="lista_estimulantes_prev">  
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="estimulantes"){?>
                      						<input name="nombre_alimento_prevenir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                      
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_frutos_secos_prev" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Frutos secos
						</button>
        				<div class="collapse" id="lista_frutos_secos_prev">
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="frutos secos"){?>
                      						<input name="nombre_alimento_prevenir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                   
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_gramineas_prev" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Gramineas
						</button>
        				<div class="collapse" id="lista_gramineas_prev">  
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="gramineas"){?>
                      						<input name="nombre_alimento_prevenir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_legumbres_prev" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Legumbres
						</button>
        				<div class="collapse" id="lista_legumbres_prev">
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="legumbres"){?>
                      						<input name="nombre_alimento_prevenir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_productos_lacteos_prev" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Productos lacteos
						</button>
        				<div class="collapse" id="lista_productos_lacteos_prev">
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="productos lacteos"){?>
                      						<input name="nombre_alimento_prevenir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_verduras_prev" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Verduras
						</button>
        				<div class="collapse" id="lista_verduras_prev">
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="verduras"){?>
                      						<input name="nombre_alimento_prevenir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_frutas_prev" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Frutas
						</button>
        				<div class="collapse" id="lista_frutas_prev">
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="frutas"){?>
                      						<input name="nombre_alimento_prevenir[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>


				</div>
			</div>
			<button class="btn btn-warning btn-block btn-lg">Guardar</button>
					<br>
		<br>
		<br>
		</div>
		<div class="col-md-4">	
			<div class="container" >
    			<div class="panel panel-success">
        			<div class="panel-heading">Evitar </div>
        				<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_proteinas_animal_evit" aria-expanded="false" aria-controls="collapseExample" id="button-examenes" >
  							Proteínas animales
						</button>
        				<div class="collapse" id="lista_proteinas_animal_evit">  
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="proteinas animales"){?>
                      						<input name="nombre_alimento_evitar[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_pescados_evit" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Pescado
						</button>
        				<div class="collapse" id="lista_pescados_evit">  
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="pescado"){?>
                      						<input name="nombre_alimento_evitar[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>
    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_levaduras_evit" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Levaduras
						</button>
        				<div class="collapse" id="lista_levaduras_evit"> 
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="levaduras"){?>
                      						<input name="nombre_alimento_evitar[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimentos->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_azucares_evit" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Azucares
						</button>
        				<div class="collapse" id="lista_azucares_evit"> 
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="azucares"){?>
                      						<input name="nombre_alimento_evitar[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                    
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_estimulantes_evit" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Estimulantes
						</button>
        				<div class="collapse" id="lista_estimulantes_evit">  
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="estimulantes"){?>
                      						<input name="nombre_alimento_evitar[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                   
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_frutos_secos_evit" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Frutos secos
						</button>
        				<div class="collapse" id="lista_frutos_secos_evit">
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="frutos secos"){?>
                      						<input name="nombre_alimento_evitar[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>                   
        					</div>

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_gramineas_evit" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Gramineas
						</button>
        				<div class="collapse" id="lista_gramineas_evit">  
            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="gramineas"){?>
                      						<input name="nombre_alimento_evitar[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_legumbres_evit" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Legumbres
						</button>
        				<div class="collapse" id="lista_legumbres_evit">

            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="legumbres"){?>
                      						<input name="nombre_alimento_evitar[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_productos_lacteos_evit" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Productos lacteos
						</button>
        				<div class="collapse" id="lista_productos_lacteos_evit">

            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="productos lacteos"){?>
                      						<input name="nombre_alimento_evitar[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_verduras_evit" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Verduras
						</button>
        				<div class="collapse" id="lista_verduras_evit">

            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="verduras"){?>
                      						<input name="nombre_alimento_evitar[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
									</div>
								</div>                      

    					</div>
    					<button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#lista_frutas_evit" aria-expanded="false" aria-controls="collapseExample" id="button-examenes">
  						Frutas
						</button>
        				<div class="collapse" id="lista_frutas_evit">

            					<div class="row m-b-15">
									<div class="col-md-12">
            							<?php foreach($alimentos as $key=>$alimento){?>
                      					<label>
                      					<?php if($alimento->opcion=="frutas"){?>
                      						<input name="nombre_alimento_evitar[]" type="checkbox" value="<?php echo $alimento->id;?>">
                      						<?php echo $alimento->alimento_info;?>
                    					</label>
                    					<small><?php echo $alimento->opcion;?></small>
                    					<hr>
                    					<?php }
                    					}?>
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

