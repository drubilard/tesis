<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/plugins/animate/animate.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/plugins/bootstrap/4.1.3/css/glyphicons.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/logo/logo.png" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <title>NUTRICIÓN</title>
</head>
<body>
<div id="header" class="header navbar-default row justify-content-center justify-content-md-start">
			<!-- begin navbar-header -->
				<div class="navbar-header col-xs-8 col-md-8 col-lg-10">
					<a href="<?php echo base_url();?>administrar/administrar" class="navbar-brand"><img src="<?php echo base_url();?>assets/img/logo/logo.png"  > <b>NUTRICIÓN</b> </a>
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
					<li class="breadcrumb-item" aria-current="page">Reportes gráficos</li>
  				</ol>
			</nav>  			
			
		</div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 ">
                <form method="POST" name="form" id="form1">
                    <input type="hidden" name="base64_1" id="base64_1"/>
                    <br>
                    <button type="submit" class="btn btn-primary" ><span class=" glyphicon glyphicon-download"></span>
                        Descargar Gráficos
                    </button>

                <input type="hidden" id="paciente" value="<?php echo $datos_paciente[0]->rut?>">
                <canvas id="myChart" width="100" height="50"></canvas>
            </div>
            <div class="col-lg-6 ">
                    <input type="hidden" name="base64_2" id="base64_2"/>
                    <br>
                    <br>
                    <br>
                <input type="hidden" id="paciente" value="<?php echo $datos_paciente[0]->rut?>">
                <canvas id="myChart2" width="100" height="50"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 ">
                        <input type="hidden" name="base64_3" id="base64_3"/>
                        <br>
                    <input type="hidden" id="paciente" value="<?php echo $datos_paciente[0]->rut?>">
                    <canvas id="myChart3" width="100" height="50"></canvas>
            </div>
            <div class="col-lg-6 ">
                    <input type="hidden" name="base64_4" id="base64_4"/>
                    <br>
                <input type="hidden" id="paciente" value="<?php echo $datos_paciente[0]->rut?>">
                <canvas id="myChart4" width="100" height="50"></canvas>
            </div>
            </form>
        </div>  
    </div>
<script src="<?php echo base_url();?>assets/js/demo/despliegue_informe.js"></script>
<script>

</script>
</body>
</html>