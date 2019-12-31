
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
  <link href="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/css/glyphicons.css" rel="stylesheet" />
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
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>paciente/listado_pacientes"><strong>Pacientes</strong></a></li>
    				<li class="breadcrumb-item"><a href="<?php echo base_url();?>minuta/gestion_minuta/<?php echo $id?>"><strong>Gestión minuta</strong></a></li>
                    <li class="breadcrumb-item" aria-current="page">Crear minuta</li>

                </ol>
			</nav>  			
			
		</div>
  <div id="page-container" class="fade">
    <!-- begin login -->
    <div class= " <?php if(detectar_SO()){ echo 'login login-v2';}else{ echo 'container-fluid';}?> " data-pageload-addclass="animated fadeIn ">
      <!-- begin brand -->
      <br>
      <br>
      <!-- end brand -->
      <!-- begin login-content -->
      <form method="post">
        <div class="row">
          <div class="col-lg-2">
            <button type="submit"  class="btn btn-danger"><span class="glyphicon glyphicon-download"></span> Crear y descargar</button>
          </div>
          <div class="col-lg-8">
          <?php if ($this->session->flashdata('mensaje_minuta')!='') {?>
                <div class="alert alert-<?php echo $this->session->flashdata('css');?> "><?php
                  echo $this->session->flashdata('mensaje_minuta');?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

              <?php }?>
          </div>
          <div class="col-lg-2">
          </div>
        </div>
        <br>
        <br>
<div class="row">  
  <div class="col-lg-2 col-md-2 col-sm-2">
  </div>    
  <div id="accordion" class="col-lg-8 col-md-8 col-sm-8">
      
      <div class="card">
        <div class="card-header" id="headingOne">
          <center><h5 class="mb-0">
            <button type="button" class="btn btn-warning <?php if (detectar_SO()){  echo 'btn-minuta-xs';} else { echo 'btn-minuta-lg';}?>" data-toggle="collapse" data-target="#desayuno" aria-expanded="true" aria-controls="desayuno">
              Desayuno
            </button>
          </h5></center>
        </div>
        <div id="desayuno" class="collapse" aria-labelledby="headingOne1" data-parent="#accordion">
          <div class="card-body">
            <!-- ingresar-->
            <?php foreach($preparaciones as $preparacion){?>
                <?php if ($preparacion->tipo=='desayuno'){?><input type="checkbox" name="preparaciones_minuta_des[]" value="<?php echo $preparacion->idpreparacion;?>"> <span class="color-preparacion"> <?php echo $preparacion->nombre." (".strtoupper($preparacion->tipo_nutri).")";?></span>
                <hr><?php }?>
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header" id="headingOne">
          <center><h5 class="mb-0">
            <button type="button" class="btn btn-warning <?php if (detectar_SO()){  echo 'btn-minuta-xs';} else { echo 'btn-minuta-lg';}?>" data-toggle="collapse" data-target="#colacion_1" aria-expanded="true" aria-controls="colacion_1">
              Colación
            </button>
          </h5></center>
        </div>
        <div id="colacion_1" class="collapse" aria-labelledby="headingOne1" data-parent="#accordion">
          <div class="card-body">
            <!-- ingresar-->
            <?php foreach($preparaciones as $preparacion){?>
                <?php if ($preparacion->tipo=='colacion_1'){?><input type="checkbox" name="preparaciones_minuta_col[]" value="<?php echo $preparacion->idpreparacion;?>"> <span class="color-preparacion"> <?php echo $preparacion->nombre." (".strtoupper($preparacion->tipo_nutri).")";?></span>
                <hr><?php }?>
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header" id="headingOne">
          <center><h5 class="mb-0">
            <button type="button" class="btn btn-warning <?php if (detectar_SO()){  echo 'btn-minuta-xs';} else { echo 'btn-minuta-lg';}?>" data-toggle="collapse" data-target="#entrada" aria-expanded="true" aria-controls="entrada">
              Entrada
            </button>
          </h5></center>
        </div>
        <div id="entrada" class="collapse" aria-labelledby="headingOne1" data-parent="#accordion">
          <div class="card-body">
            <!-- ingresar-->
            <?php foreach($preparaciones as $preparacion){?>
                <?php if ($preparacion->tipo=='entrada'){?><input type="checkbox" name="preparaciones_minuta_ent[]" value="<?php echo $preparacion->idpreparacion;?>"> <span class="color-preparacion"> <?php echo $preparacion->nombre." (".strtoupper($preparacion->tipo_nutri).")";?></span>
                <hr><?php }?>
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header" id="headingOne">
          <center><h5 class="mb-0">
            <button type="button" class="btn btn-warning <?php if (detectar_SO()){  echo 'btn-minuta-xs';} else { echo 'btn-minuta-lg';}?>" data-toggle="collapse" data-target="#almuerzo" aria-expanded="true" aria-controls="almuerzo">
              Almuerzo
            </button>
          </h5></center>
        </div>
        <div id="almuerzo" class="collapse" aria-labelledby="headingOne1" data-parent="#accordion">
          <div class="card-body">
            <!-- ingresar-->
            <?php foreach($preparaciones as $preparacion){?>
                <?php if ($preparacion->tipo=='almuerzo'){?><input type="checkbox" name="preparaciones_minuta_alm[]" value="<?php echo $preparacion->idpreparacion;?>"> <span class="color-preparacion">  <?php echo $preparacion->nombre." (".strtoupper($preparacion->tipo_nutri).")";?></span>
                <hr><?php }?>
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header" id="headingOne">
          <center><h5 class="mb-0">
            <button type="button" class="btn btn-warning <?php if (detectar_SO()){  echo 'btn-minuta-xs';} else { echo 'btn-minuta-lg';}?>" data-toggle="collapse" data-target="#colacion_2" aria-expanded="true" aria-controls="colacion_2">
              Colación media tarde
            </button>
          </h5></center>
        </div>
        <div id="colacion_2" class="collapse" aria-labelledby="headingOne1" data-parent="#accordion">
          <div class="card-body">
            <!-- ingresar-->
            <?php foreach($preparaciones as $preparacion){?>
                <?php if ($preparacion->tipo=='colacion_2'){?><input type="checkbox" name="preparaciones_minuta_col_2[]" value="<?php echo $preparacion->idpreparacion;?>"> <span class="color-preparacion"> <?php echo $preparacion->nombre." (".strtoupper($preparacion->tipo_nutri).")";?></span>
                <hr><?php }?>
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header" id="headingOne">
          <center><h5 class="mb-0">
            <button type="button" class="btn btn-warning <?php if (detectar_SO()){  echo 'btn-minuta-xs';} else { echo 'btn-minuta-lg';}?>" data-toggle="collapse" data-target="#once" aria-expanded="true" aria-controls="once">
              Once
            </button>
          </h5></center>
        </div>
        <div id="once" class="collapse" aria-labelledby="headingOne1" data-parent="#accordion">
          <div class="card-body">
            <!-- ingresar-->
            <?php foreach($preparaciones as $preparacion){?>
                <?php if ($preparacion->tipo=='once'){?><input type="checkbox" name="preparaciones_minuta_on[]" value="<?php echo $preparacion->idpreparacion;?>"> <span class="color-preparacion"> <?php echo $preparacion->nombre." (".strtoupper($preparacion->tipo_nutri).")";?></span>
                <hr><?php }?>
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header" id="headingOne">
          <center><h5 class="mb-0">
            <button type="button" class="btn btn-warning <?php if (detectar_SO()){  echo 'btn-minuta-xs';} else { echo 'btn-minuta-lg';}?>" data-toggle="collapse" data-target="#cena" aria-expanded="true" aria-controls="cena">
              Cena
            </button>
          </h5></center>
        </div>
        <div id="cena" class="collapse" aria-labelledby="headingOne1" data-parent="#accordion">
          <div class="card-body">
            <!-- ingresar-->
            <?php foreach($preparaciones as $preparacion){?>
                <?php if ($preparacion->tipo=='cena'){?><input type="checkbox" name="preparaciones_minuta_cen[]" value="<?php echo $preparacion->idpreparacion;?>"> <span class="color-preparacion"> <?php echo $preparacion->nombre." (".strtoupper($preparacion->tipo_nutri).")";?></span>
                <hr><?php }?>
            <?php } ?>
          </div>
        </div>
      </div>
      </form>
    <div class="col-lg-2 col-md-2 col-sm-2">

    </div>  
  </div>  
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





  


  


