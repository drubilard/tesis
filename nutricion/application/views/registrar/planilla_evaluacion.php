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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
  <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
  <!-- begin #page-loader -->
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
        <a href="<?php echo base_url();?>registrar/administrar" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"> <b>NUTRICIÓN</b> Evaluación</a>
      </div>
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>registrar/administrar"><strong>Administración</strong></a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>registrar/listado_pacientes"><strong>Pacientes</strong></a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>registrar/evaluaciones/<?php echo $datos_paciente->rut?>"><strong>Evaluaciones</strong></a></li>
            <li class="breadcrumb-item" aria-current="page">Planilla Evaluación</li>
          </ol>
      </nav>
    </div>
  <br>
  <!<div id="page-container" class="">
    <!-- begin login -->
    <div class="" data-pageload-addclass="animated fadeIn">
      <!-- begin brand -->
  <div class="container evaluacion">
  <?php echo form_open(null,array("name"=>"form_palnilla_evaluacion","class"=>"margin-bottom-0"));?>
  <div class="panel panel-warning">
      <div class="panel-heading">
        <?php if ($this->session->flashdata('mensaje')!='') {?>
                <div class="alert alert-<?php echo $this->session->flashdata('css');?> "><?php
                  echo $this->session->flashdata('mensaje');?>
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
                    <label for="peso" class="col-sm-12 col-form-label"><?php echo strtoupper($datos_paciente->nombre)." ".strtoupper($datos_paciente->apellido);?></label>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label"><strong>Email:</strong></label>
                <div class="col-md-3">
                      <label for="talla" class="col-sm-2 col-form-label"></label>
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
                    <input type="date" name="fecha_control" class="col-sm-12 col-form-label" value="<?php echo date('Y-m-d');?>">
                </div>
            </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
              <label for="peso" class="col-sm-2 col-form-label"><strong>Edad:</strong></label>
                <div class="col-md-3">
                    <label for="peso" class="col-sm-12 col-form-label"><?php echo calculaEdad($datos_paciente->fecha_nacimiento)." "."años";?></label>
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
                      <input type="text" name="peso" class="form-control" id="peso_id" placeholder="" value="0">
                        <span class="input-group-addon">Kgs.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Talla:</label>
                <div class="col-md-3">
                  <div class="input-group">
                      <input type="text" name="talla" class="form-control" id="talla_id" placeholder="" value="0">
                        <span class="input-group-addon">Mts.</span>
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
                      <input type="text" name="imc" class="form-control" readonly value="0" id="imc_id" placeholder="" value="0">
                        <span class="input-group-addon">-</span>
                    </div>
                </div>
            </div>
            </div>
          </div>
      </div>
    </div>
    <div class="panel panel-success">
      <div class="panel-heading"> Diámetros Óseos</div>
      <br>
        <div class="container">
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group row">
              <label for="peso" class="col-sm-2 col-form-label">Húmero:</label>
                <div class="col-md-3">
                  <div class="input-group">
                      <input type="text" name="humero" class="form-control" id="humero_id" placeholder="" value="0">
                        <span class="input-group-addon">Mts.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Fémur:</label>
                <div class="col-md-3">
                  <div class="input-group">
                      <input type="text" name="femur" class="form-control" id="femur_id" placeholder="" value="0">
                        <span class="input-group-addon">Mts.</span>
                  </div>
                </div>
            </div>
          </div>

              <hr>
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
                      <input type="text" name="b_relajado" class="form-control" id="b_relajado_id" placeholder="" value="0">
                        <span class="input-group-addon">Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Brazo contraido:</label>
                <div class="col-md-3">
                  <div class="input-group">
                      <input type="text" name="b_contraido" class="form-control" id="b_contraido_id" placeholder="" value="0">
                        <span class="input-group-addon">Cms.</span>
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
                      <input type="text" name="c_min" class="form-control" id="c_min_id" placeholder="" value="0">
                        <span class="input-group-addon">Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Cadera máx:</label>
                <div class="col-md-3">
                  <div class="input-group">
                      <input type="text" name="c_max" class="form-control" id="c_max_id" placeholder="" value="0">
                        <span class="input-group-addon">Cms.</span>
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
                      <input type="text" name="m_medio" class="form-control" id="m_medio_id" placeholder="" value="0"> 
                        <span class="input-group-addon">Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Pantorrilla:</label>
                <div class="col-md-3">
                  <div class="input-group">
                      <input type="text" name="pantorrilla_perimetro" class="form-control" id="pantorrilla_perimetro_id" placeholder="" value="0">
                        <span class="input-group-addon">Cms.</span>
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
                      <input type="text" name="tricipital" class="form-control" id="tricipital_id" placeholder="" value="0">
                        <span class="input-group-addon">Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Subescapular:</label>
                <div class="col-md-3">
                  <div class="input-group">
                      <input type="text" name="subescapular" class="form-control" id="subescapular_id" placeholder="" value="0">
                        <span class="input-group-addon">Cms.</span>
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
                      <input type="text" name="bicipital" class="form-control" id="bicipital_id" placeholder="" value="0">
                        <span class="input-group-addon">Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Supracrestídeo:</label>
                <div class="col-md-3">
                  <div class="input-group">
                      <input type="text" name="supracrestideo" class="form-control" id="supracrestideo_id" placeholder="" value="0">
                        <span class="input-group-addon">Cms.</span>
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
                      <input type="text" name="supraespinal" class="form-control" id="supraespinal_id" placeholder="" value="0">
                        <span class="input-group-addon">Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Abdominal:</label>
                <div class="col-md-3">
                  <div class="input-group">
                      <input type="text" name="abdomial" class="form-control" id="abdomial_id" placeholder="" value="0">
                        <span class="input-group-addon">Cms.</span>
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
                      <input type="text" name="muslo" class="form-control" id="muslo_id" placeholder="" value="0">
                        <span class="input-group-addon">Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-2 col-form-label">Pantorrilla:</label>
                <div class="col-md-3">
                  <div class="input-group">
                      <input type="text" name="pantorrilla_pliegue" class="form-control" id="pantorrilla_pliegue_id" placeholder="" value="0">
                        <span class="input-group-addon">Cms.</span>
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
                      <input type="text" name="4pliegues" class="form-control" id="4pliegues_id" placeholder="" readonly value="0">
                        <span class="input-group-addon">Cms.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-3 col-form-label"><strong>grasa Durnin:</strong></label>
                <div class="col-md-3">
                  <div class="input-group">
                      <input type="text" name="grasa_durnin" class="form-control" id="grasa_durnin_id" placeholder="" value="0">
                        <span class="input-group-addon">%</span>
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
                      <input type="text" name="masa_adiposa" class="form-control" id="masa_adiposa_id" placeholder="" readonly value="0">
                        <span class="input-group-addon">kgs.</span>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="talla" class="col-sm-3 col-form-label"><strong>Masa libre grasa:</strong></label>
                <div class="col-md-3">
                  <div class="input-group">
                      <input type="text" name="masa_sin_grasa" class="form-control" id="masa_sin_grasa_id" placeholder="" readonly value="0">
                        <span class="input-group-addon">Kgs.</span>
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
                        <input type="text" name="masa_muscular" class="form-control" id="masa_muscular_id" placeholder="" readonly value="0">
                          <span class="input-group-addon">Cms.</span>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label for="talla" class="col-sm-3 col-form-label"><strong>Σ 6 pliegues:</strong></label>
                  <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" name="6pliegues" class="form-control" id="6pliegues_id" placeholder="" readonly value="0">
                          <span class="input-group-addon">Cms.</span>
                    </div>
                  </div>
              </div>
            </div>
        </div>
          <div class="row">
            <div class="col-lg-4 col-sm- col-md-4 col-xs-4">
              <button type="submit" id="enviar" class=" btn-success btn-lg">Enviar</button>
            </div>
            <div class="col-lg-6 col-sm-3 col-md-5 col-xs-3">

            </div>
            <div class="col-lg-2 col-sm-2 col-md-3 col-xs-4">
              <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Open modal</button>
           </div>
           <hr>
           </div>
      </div>
           <hr>

    </div>
    <?php echo form_close();?>
    <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Modal body..
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

