$(document).ready(function(){
	var suma_4pliegues=0;
	var imc=0;
	var masa_adip=0;
	var masa_sin_grasa=0;
	var masa_muscular=0;
	var suma_6pliegues=0;
	$( "#peso_id" ).change(function() {
		imc=$("#talla_id").val()*$("#talla_id").val();
		imc=parseInt($("#peso_id").val())/imc;
		imc=imc.toFixed(2);
  		$("#imc_id").val(imc);
	});
	$( "#talla_id" ).change(function() {
		imc=$("#talla_id").val()*$("#talla_id").val();
		imc=parseInt($("#peso_id").val())/imc;
		imc=imc.toFixed(2);
  		$("#imc_id").val(imc);
	});
	$( "#tricipital_id" ).change(function() {
		 suma_4pliegues=parseInt($("#tricipital_id").val())+parseInt($("#subescapular_id").val())+parseInt($("#bicipital_id").val())+parseInt($("#supracrestideo_id").val());
  		suma_6pliegues=parseInt($("#tricipital_id").val())+parseInt($("#subescapular_id").val())+parseInt($("#bicipital_id").val())+parseInt($("#supracrestideo_id").val())+parseInt($("#supraespinal_id").val())+parseInt($("#abdomial_id").val())+parseInt($("#muslo_id").val())+parseInt($("#pantorrilla_pliegue_id").val());
  		$("#4pliegues_id").val(suma_4pliegues);
  		$("#6pliegues_id").val(suma_6pliegues);
  	});
  	$( "#subescapular_id" ).change(function() {
		 suma_6pliegues=parseInt($("#tricipital_id").val())+parseInt($("#subescapular_id").val())+parseInt($("#bicipital_id").val())+parseInt($("#supracrestideo_id").val())+parseInt($("#supraespinal_id").val())+parseInt($("#abdomial_id").val())+parseInt($("#muslo_id").val())+parseInt($("#pantorrilla_pliegue_id").val());
		 suma_4pliegues=parseInt($("#tricipital_id").val())+parseInt($("#subescapular_id").val())+parseInt($("#bicipital_id").val())+parseInt($("#supracrestideo_id").val());
  		$("#4pliegues_id").val(suma_4pliegues);
  		$("#6pliegues_id").val(suma_6pliegues);
  	});
  	$( "#bicipital_id" ).change(function() {
		suma_6pliegues=parseInt($("#tricipital_id").val())+parseInt($("#subescapular_id").val())+parseInt($("#bicipital_id").val())+parseInt($("#supracrestideo_id").val())+parseInt($("#supraespinal_id").val())+parseInt($("#abdomial_id").val())+parseInt($("#muslo_id").val())+parseInt($("#pantorrilla_pliegue_id").val());
		suma_4pliegues=parseInt($("#tricipital_id").val())+parseInt($("#subescapular_id").val())+parseInt($("#bicipital_id").val())+parseInt($("#supracrestideo_id").val());
  		$("#4pliegues_id").val(suma_4pliegues);
  		$("#6pliegues_id").val(suma_6pliegues);
  	});
  	$( "#supracrestideo_id" ).change(function() {
		suma_6pliegues=parseInt($("#tricipital_id").val())+parseInt($("#subescapular_id").val())+parseInt($("#bicipital_id").val())+parseInt($("#supracrestideo_id").val())+parseInt($("#supraespinal_id").val())+parseInt($("#abdomial_id").val())+parseInt($("#muslo_id").val())+parseInt($("#pantorrilla_pliegue_id").val());
		suma_4pliegues=parseInt($("#tricipital_id").val())+parseInt($("#subescapular_id").val())+parseInt($("#bicipital_id").val())+parseInt($("#supracrestideo_id").val());
  		$("#4pliegues_id").val(suma_4pliegues);
  		$("#6pliegues_id").val(suma_6pliegues);
  	});
  	$( "#supraespinal_id" ).change(function() {
		suma_6pliegues=parseInt($("#tricipital_id").val())+parseInt($("#subescapular_id").val())+parseInt($("#bicipital_id").val())+parseInt($("#supracrestideo_id").val())+parseInt($("#supraespinal_id").val())+parseInt($("#abdomial_id").val())+parseInt($("#muslo_id").val())+parseInt($("#pantorrilla_pliegue_id").val());
  		$("#6pliegues_id").val(suma_6pliegues);
  	});
  	$( "#abdomial_id" ).change(function() {
  		suma_6pliegues=parseInt($("#tricipital_id").val())+parseInt($("#subescapular_id").val())+parseInt($("#bicipital_id").val())+parseInt($("#supracrestideo_id").val())+parseInt($("#supraespinal_id").val())+parseInt($("#abdomial_id").val())+parseInt($("#muslo_id").val())+parseInt($("#pantorrilla_pliegue_id").val());
  		$("#6pliegues_id").val(suma_6pliegues);
  	});
  	$( "#muslo_id" ).change(function() {
  		suma_6pliegues=parseInt($("#tricipital_id").val())+parseInt($("#subescapular_id").val())+parseInt($("#bicipital_id").val())+parseInt($("#supracrestideo_id").val())+parseInt($("#supraespinal_id").val())+parseInt($("#abdomial_id").val())+parseInt($("#muslo_id").val())+parseInt($("#pantorrilla_pliegue_id").val());
  		$("#6pliegues_id").val(suma_6pliegues);
  	});
  	$( "#pantorrilla_pliegue_id" ).change(function() {
  		suma_6pliegues=parseInt($("#tricipital_id").val())+parseInt($("#subescapular_id").val())+parseInt($("#bicipital_id").val())+parseInt($("#supracrestideo_id").val())+parseInt($("#supraespinal_id").val())+parseInt($("#abdomial_id").val())+parseInt($("#muslo_id").val())+parseInt($("#pantorrilla_pliegue_id").val());
  		$("#6pliegues_id").val(suma_6pliegues);
  	});

	$( "#peso_id" ).change(function() {
		masa_adip=$("#peso_id").val()*($("#grasa_durnin_id").val()/100); 
		masa_adip=masa_adip.toFixed(1);
  		$("#masa_adiposa_id").val(masa_adip);
  		masa_sin_grasa=parseInt($("#peso_id").val())-parseInt($("#masa_adiposa_id").val());
		masa_sin_grasa=masa_sin_grasa.toFixed(1);
  		$("#masa_sin_grasa_id").val(masa_sin_grasa);
  		masa_muscular=parseInt($("#masa_sin_grasa_id").val())*0.4;
		masa_muscular=masa_muscular.toFixed(1);
  		$("#masa_muscular_id").val(masa_muscular);
	});
	$( "#grasa_durnin_id" ).change(function() {
		masa_adip=$("#peso_id").val()*($("#grasa_durnin_id").val()/100);
		masa_adip=masa_adip.toFixed(1);
  		$("#masa_adiposa_id").val(masa_adip);
  		masa_sin_grasa=parseInt($("#peso_id").val())-parseInt($("#masa_adiposa_id").val());
		masa_sin_grasa=masa_sin_grasa.toFixed(1);
  		$("#masa_sin_grasa_id").val(masa_sin_grasa);
  		masa_muscular=parseInt($("#masa_sin_grasa_id").val())*0.4;
		masa_muscular=masa_muscular.toFixed(1);
  		$("#masa_muscular_id").val(masa_muscular);
	});




});