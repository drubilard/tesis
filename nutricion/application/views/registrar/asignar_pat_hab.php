
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
  <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/logo/logo.png"/>
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
        <a href="<?php echo base_url();?>registrar/administrar" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"> <b>NUTRICIÓN</b> evaluación</a>
      </div>
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
      <div class="panel-heading"><?php if ($this->session->flashdata('mensaje')!='') {?>
                <div class="alert-<?php echo $this->session->flashdata('css');?> "><?php
                  echo $this->session->flashdata('mensaje');?></div>

              <?php }?> Agregar Patologías</div>
      <br>
        <?php echo form_open(null,array("name"=>"form_dias_admin","class"=>"margin-bottom-0"));?>
          <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <?php foreach($lista_patologias as $patologia){?>
                  <label>
                   <input name="nombre_patologia[]"  type="checkbox" value="<?php echo $patologia->id?>">
                    <?php echo $patologia->nombre;?>
                  </label>
                  <br>
                  <?php }?>
              </div>
            </div>
          </div>
          <hr>
            <div class="panel panel-success">
            <div class="panel-heading">Agregar Hábitos</div> 
            <div class="container">
                <div class="row">
                  <div  class="col-md-12">
                  <br>
                      <?php foreach($lista_habitos as $habitos){?>
                      <label>
                      <input name="nombre_habito[]" type="checkbox" value="<?php echo $habitos->id;?>">
                      <?php echo $habitos->nombre;?>
                    </label>
                    <br>
                    <?php }?>
                  </div>
                </div>
            </div>
                  <div class="modal-footer">
                  <button data-toggle="modal" type="button" data-target="#modal_ficha_clinica" class=" btn btn-info ">Ficha Clínica</button>

                </div>
            
        </div>
    </div>
</div>


  </div>  
      <!-- end login-content -->

    <!-- end login -->
    
    
    <!-- Modal -->
<div class="modal fade" id="modal_ficha_clinica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ficha Clínica</h4>
      </div>
      <div class="modal-body">
        <textarea name="ficha_clinica" id="textarea_fichaclinica" placeholder="Ingresa tu mensaje"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <?php echo form_close();?>
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

