<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head><meta charset="gb18030">
    
    <title>NUTRICIÓN</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/css/glyphicons.css" rel="stylesheet" />
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
    <div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header col-xs-12 col-sm-12  col-md-8 col-lg-8 col-xl-9">
					<a href="" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"  > <b>NUTRICIÓN</b></a>
				</div>
				<div class="navbar-header col-xs-12 col-sm-12 col-md-2 col-lg-4 col-xl-3">
					<a href="<?php echo base_url();?>administrar/salir" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logout.png" >  Cerrar Sesión</a>
				</div>
		</div>
    <!-- end login-cover -->
    
    <!-- begin #page-container -->
    

    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-v2 " data-pageload-addclass="animated fadeIn ">
            <!-- begin brand -->
            <div class="login-header row animated bounceInLeft">
                <div class="brand ">
                    <img src="<?php echo base_url();?>assets/img/logo/logo.png" style="height: 70px;"> <b>NUTRICIÓN</b> Administrador
                </div>

            </div>
            <br>
            <!-- begin login-content -->
            
                    <div class="login-buttons row animated bounceIn"> 
                        <a href="<?php echo base_url();?>administrador/add_nutricionista" class="btn btn-success btn-block btn-lg"><span class="glyphicon glyphicon-plus " aria-hidden="true"></span><span class="glyphicon glyphicon-user " aria-hidden="true"></span>  Registrar Usuario</a>
                        <a href="<?php echo base_url();?>administrador/activar_usuario" class="btn btn-primary btn-block btn-lg"><span class="glyphicon glyphicon-ok " aria-hidden="true"></span><span class="glyphicon glyphicon-user " aria-hidden="true"></span>  Activar cuenta</a>
                        <a href="<?php echo base_url();?>administrador/desactivar_usuario" class="btn btn-danger btn-block btn-lg"><span class="glyphicon glyphicon-remove " aria-hidden="true"></span><span class="glyphicon glyphicon-user " aria-hidden="true"></span>  Desactivar cuenta</a>
                    </div>


            <!-- end login-content -->
        </div>

        <!-- end login -->
        
        
    </div>
        <!-- Modal -->

    <!--<div class="modal fade" id="tipo_login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title" id="myModalLabel">Tipo de login</h4>
                </div>
                <div class="modal-body">
                    <div class="login-buttons row animated bounceIn">
                            <div class="col-md-9 col-xs-8">
                                <a href="<?php echo base_url();?>nutricionista/login" class="btn btn-success  btn-lg"><span class="glyphicon  " aria-hidden="true"></span><span class="glyphicon " aria-hidden="true"></span> Nutricionista</a>
                            </div>
                            <div class="col-md-3 col-xs-4">
                                <a href="<?php echo base_url();?>paciente/login" class="btn btn-success  btn-lg"><span class="glyphicon  " aria-hidden="true"></span><span class="glyphicon " aria-hidden="true"></span> Paciente</a>
                            </div>
                    </div>
                    <hr>
      			</div>
      		</div>

    	</div>
  	</div>-->
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