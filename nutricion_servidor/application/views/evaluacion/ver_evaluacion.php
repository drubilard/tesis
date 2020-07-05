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
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/css/style-responsive.min.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/css/theme/default.css" rel="stylesheet" id="theme" />
  <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/logo/logo.png" />
  <!-- ================== END BASE CSS STYLE ================== -->
  
  <!-- ================== BEGIN BASE JS ================== -->
  <script src="<?php echo base_url();?>assets/plugins/pace/pace.min.js"></script>
  <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">

  
  <!-- begin login-cover -->
  <div class="login-cover">
    <div class="login-cover-image" style="background-image: url(<?php echo base_url();?>assets/img/login-bg/nutricion_3.jpg)" data-id="login-cover-image"></div>
    <div class="login-cover-bg"></div>
  </div>
  <!-- end login-cover -->
  
  <!-- begin #page-container -->

  <div id="header" class="header navbar-default row justify-content-center justify-content-md-start">
      <!-- begin navbar-header -->
        <div class="navbar-header col-xs-8 col-md-8 col-lg-9">
          <a href="<?php echo base_url();?>paciente/documentos" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"  > <b>NUTRICIÓN</b> evaluación</a>
        </div>
        <div class="navbar-header col-xs-4 col-md-4 col-lg-2">
          <a href="<?php echo base_url();?>administrar/salir" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logout.png" >  Cerrar Sesión</a>
        </div>
  </div>
  <div id="header" class="header navbar-default">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>paciente/documentos"><strong>Administración</strong></a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>paciente/listado_evaluaciones/<?php echo $datos_paciente->rut?>"><strong>Consultar evaluaciones</strong></a></li>
            <li class="breadcrumb-item" aria-current="page">Ver evaluación</li>
          </ol>
      </nav>      
      
    </div>

  <div id="page-container" class="fade">
    <!-- begin login -->
    <div class="login login-v3" data-pageload-addclass="animated fadeIn">
      <!-- begin brand -->
      <div class="container">
  <div class="panel panel-warning">
      <div class="panel-heading">
            <?php if ($this->session->flashdata('mensaje')!='') {?>
                <div class="alert-<?php echo $this->session->flashdata('css');?> "><?php
                  echo $this->session->flashdata('mensaje');?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

              <?php }
               if ($this->session->flashdata('estado_nutri')!='') {?>
                <div class="alert-<?php echo $this->session->flashdata('css_estado_nutri');?> "><?php
                  echo $this->session->flashdata('estado_nutri');?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

              <?php }?>
          Datos Generales
      </div>
      <br>
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group row">
              <label for="peso" class="col-sm-2 col-form-label"><strong>Nombre:</strong></label>
                <div class="col-md-8">
                    <label for="peso" class="col-sm-12 col-form-label"><?php echo strtoupper($datos_paciente[0]->nombre)." ".strtoupper($datos_paciente[0]->apellido);?></label>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label"><strong>Email:</strong></label>
                <div class="col-md-3">
                      <label for="talla" class="col-sm-2 col-form-label"><?php echo strtoupper($datos_paciente[0]->correo);?></label>
                </div>
            </div>
          </div>

              <hr>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
              <label for="peso" class="col-sm-2 col-form-label"><strong>Fecha Evaluación:</strong></label>
                <div class="col-md-4">
                    <label for="fecha_control" class="col-sm-12 col-form-label"><?php echo $datos_evaluacion[0]->fecha;?></label>

                </div>
            </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
              <label for="peso" class="col-sm-2 col-form-label"><strong>Edad:</strong></label>
                <div class="col-md-3">
                    <label for="peso" class="col-sm-12 col-form-label"><?php echo calculaEdad($datos_paciente[0]->fecha_nacimiento)." "."años";?></label>
                </div>
            </div>
            </div>
          </div>
      </div>
    </div>
    
    <div class="panel panel-success">
    <div class="panel-heading">P. Generales</div>
      <br>
        <div class="container">
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group row">
              <label for="peso" class="col-sm-2 col-form-label">Peso:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->peso_paciente." "?>Kgs.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Talla:</label>
                <div class="col-md-3">
                  <div class="input-group">
                      <span class="input-group-addon"><?php echo $datos_evaluacion[0]->talla_paciente." "?>Mts.</span>

                  </div>
                </div>
            </div>
          </div>

              <hr>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
              <label for="peso" class="col-sm-2 col-form-label"><strong>IMC:</strong></label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->imc_paciente?></span>
                    </div>
                </div>
            </div>
            </div>
          </div>
      </div>
    </div>

     <div class="panel panel-success">
      <div class="panel-heading"> Perímetros</div>
      <br>
        <div class="container">
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group row">
              <label for="peso" class="col-sm-2 col-form-label">Brazo relajado:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->brazo_relajado_paciente." "?>Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Brazo contraido:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->brazo_contraido_paciente." "?>Cms.</span>
                  </div>
                </div>
            </div>
          </div>


              <hr>
          </div>
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group row">
              <label for="peso" class="col-sm-2 col-form-label">Cintura min:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->cintura_min_paciente." "?>Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Cadera máx:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->cadera_max_paciente." "?>Cms.</span>
                  </div>
                </div>
            </div>
          </div>
          

              <hr>
          </div>
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group row">
              <label for="peso" class="col-sm-2 col-form-label">Muslo medio:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->muslo_medio_paciente." "?>Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Pantorrilla:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->pantorrilla_paciente." "?>Cms.</span>
                  </div>
                </div>
            </div>
          </div>
          

              <hr>
          </div>
      </div>
    </div>
    <div class="panel panel-success">
      <div class="panel-heading"> Pliegues Cutáneos</div>
      <br>
        <div class="container">
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group row">
              <label for="peso" class="col-sm-2 col-form-label">Tricipital:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->tricipital_paciente." "?>Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Subescapular:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->subescapular_paciente." "?>Cms.</span>
                  </div>
                </div>
            </div>
          </div>


              <hr>
          </div>
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group row">
              <label for="peso" class="col-sm-2 col-form-label">Bicipital:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->bicipital_paciente." "?>Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Supracrestídeo:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->supracrestideo_paciente." "?>Cms.</span>
                  </div>
                </div>
            </div>
          </div>
          

              <hr>
          </div>
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group row">
              <label for="peso" class="col-sm-2 col-form-label">Supraespinal:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->supraespinal_paciente." "?>Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Abdominal:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->abdominal_paciente." "?>Cms.</span>
                  </div>
                </div>
            </div>
          </div>
          
          </div>
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group row">
              <label for="peso" class="col-sm-2 col-form-label">Muslo:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->muslo_paciente." "?>Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Pantorrilla:</label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->pantorrilla2_paciente." "?>Cms.</span>
                  </div>
                </div>
            </div>
          </div>
          

              <hr>
          </div>
          <hr>
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group row">
              <label for="peso" class="col-sm-3 col-form-label"><strong>Σ 4 pliegues:</strong></label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->cuatro_pliegues_paciente." "?>Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-3 col-form-label"><strong>grasa Durnin:</strong></label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->grasa_durnin_paciente." "?>%</span>
                  </div>
                </div>
            </div>
          </div>


              <hr>
          </div>
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group row">
              <label for="peso" class="col-sm-3 col-form-label"><strong>Masa Adiposa:</strong></label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->masa_adiposa_paciente." "?>kgs.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-3 col-form-label"><strong>Masa libre grasa:</strong></label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->masa_sin_grasa_paciente." "?>Kgs.</span>
                  </div>
                </div>
            </div>
          </div>
          

              <hr>
          </div>
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group row">
              <label for="peso" class="col-sm-3 col-form-label"><strong>Masa Muscular:</strong></label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->masa_muscular_paciente." "?>Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-3 col-form-label"><strong>Σ 6 pliegues:</strong></label>
                <div class="col-md-3">
                  <div class="input-group">
                        <span class="input-group-addon"><?php echo $datos_evaluacion[0]->seis_pliegues_paciente." "?>Cms.</span>
                  </div>
                </div>
            </div>
          </div>
			</div>
			<hr>
			<div class="row">
        <div class="col-lg-4">
        <button  data-toggle="modal" data-target="#modal_estaod_nutricional" type="button" class="btn-warning btn-lg">Estado nutricional</button>
        </div>
         <div class="col-lg-6">
         </div>
         <div class="col-lg-2">
         </div>
       </div>
				<br>
    </div>
</div>

    <!-- end login -->
    
    
  </div>
    <!-- Modal -->
  <div class="modal fade" id="modal_estaod_nutricional" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Estado Nutricional</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
          <h3>Estado nutricional: <?php echo $datos_evaluacion[0]->estado;?></h3>
          </div>
        </div>
      </div>
    </div>
  </div>
    

  <!-- end page container -->
  
  <!-- ================== BEGIN BASE JS ================== -->
  <script src="<?php echo base_url();?>assets/plugins/jquery/jquery-3.3.1.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/js-cookie/js.cookie.js"></script>
  <script src="<?php echo base_url();?>assets/js/apps.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/demo/ajustes_planilla.js"></script>

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

