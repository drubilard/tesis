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
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<!-- end #page-loader -->
	
	<!-- begin login-cover -->

	<!-- end login-cover -->
	
	<!-- begin #page-container -->

    <div id="header" class="header navbar-default row justify-content-center justify-content-md-start">
			<!-- begin navbar-header -->
				<div class="navbar-header col-xs-8 col-md-8 col-lg-10">
					<a href="<?php echo base_url();?>registrar/login" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"  > <b>NUTRICIÓN</b></a>
				</div>
    </div>
    <br>

        <div class="container">
		<!-- begin login -->        </div>
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/js-cookie/js.cookie.js"></script>
	<script src="<?php echo base_url();?>assets/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<div class="container-fluid" class="">
		<!-- begin login -->
<div class=" <?php  if(detectar_SO()){ echo 'login login-v2 movil';} ?>">
			<!-- begin brand -->


			
			<!-- end brand -->
			<!-- begin login-content -->
			
				<div class="  animated wobble">
				<center><img  width="<?php  if(detectar_SO()){ echo '70%';}else{ echo '35%';} ?>" class="navbar-brand" src="<?php echo base_url();?>assets/img/login-bg/imagen_error.png" ></center>

				<div class="container">
					
				</div>
				<!-- end register-content -->
					</div>


			<!-- end login-content -->
		</div>

		<!-- end login -->
		
		
	</div>

	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>
</html>

