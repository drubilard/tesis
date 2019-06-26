$(document).ready(function(){
	var suma_4pliegues=0;
	var masa_adip=0;
	var masa_sin_grasa=0;
	var masa_muscular=0;
	var suma_6pliegues=0;
	var imc=$("#talla_id").val()*$("#talla_id").val();
		if((!isFinite(parseFloat($("#peso_id").val())/imc))||(isNaN(parseFloat($("#peso_id").val())/imc))){
			$("#imc_id").val(0);
		}else{
			imc=parseFloat($("#peso_id").val()/imc);
			imc=imc.toFixed(2);
			$("#imc_id").val(imc);
		}

	$( "#peso_id" ).change(function() {
		imc=$("#talla_id").val()*$("#talla_id").val();
		if((!isFinite(parseFloat($("#peso_id").val())/imc))||(isNaN(parseFloat($("#peso_id").val())/imc))){
			$("#imc_id").val(0);
		}else{
			imc=parseFloat($("#peso_id").val()/imc);
			imc=imc.toFixed(2);
			$("#imc_id").val(imc);
		}
	});
	$( "#talla_id" ).change(function() {
		imc=$("#talla_id").val()*$("#talla_id").val();
		if((!isFinite(parseFloat($("#peso_id").val())/imc))||(isNaN(parseFloat($("#peso_id").val())/imc))){
			$("#imc_id").val(0);
		}else{
			imc=parseFloat($("#peso_id").val()/imc);
			imc=imc.toFixed(2);
			$("#imc_id").val(imc);
		}
	});
	$( "#tricipital_id" ).change(function() {
		suma_4pliegues=parseFloat($("#tricipital_id").val())+parseFloat($("#subescapular_id").val())+parseFloat($("#bicipital_id").val())+parseFloat($("#supracrestideo_id").val());
  		suma_6pliegues=parseFloat($("#tricipital_id").val())+parseFloat($("#subescapular_id").val())+parseFloat($("#supraespinal_id").val())+parseFloat($("#abdomial_id").val())+parseFloat($("#muslo_id").val())+parseFloat($("#pantorrilla_pliegue_id").val());
  		$("#4pliegues_id").val(suma_4pliegues);
  		$("#6pliegues_id").val(suma_6pliegues);
  	});
  	$( "#subescapular_id" ).change(function() {
		 suma_6pliegues=parseFloat($("#tricipital_id").val())+parseFloat($("#subescapular_id").val())+parseFloat($("#supraespinal_id").val())+parseFloat($("#abdomial_id").val())+parseFloat($("#muslo_id").val())+parseFloat($("#pantorrilla_pliegue_id").val());
		 suma_4pliegues=parseFloat($("#tricipital_id").val())+parseFloat($("#subescapular_id").val())+parseFloat($("#bicipital_id").val())+parseFloat($("#supracrestideo_id").val());
  		$("#4pliegues_id").val(suma_4pliegues);
  		$("#6pliegues_id").val(suma_6pliegues);
  	});
  	$( "#bicipital_id" ).change(function() {
		suma_6pliegues=parseFloat($("#tricipital_id").val())+parseFloat($("#subescapular_id").val())+parseFloat($("#supraespinal_id").val())+parseFloat($("#abdomial_id").val())+parseFloat($("#muslo_id").val())+parseFloat($("#pantorrilla_pliegue_id").val());
		suma_4pliegues=parseFloat($("#tricipital_id").val())+parseFloat($("#subescapular_id").val())+parseFloat($("#bicipital_id").val())+parseFloat($("#supracrestideo_id").val());
  		$("#4pliegues_id").val(suma_4pliegues);
  		$("#6pliegues_id").val(suma_6pliegues);
  	});
  	$( "#supracrestideo_id" ).change(function() {
		suma_6pliegues=parseFloat($("#tricipital_id").val())+parseFloat($("#subescapular_id").val())+parseFloat($("#supraespinal_id").val())+parseFloat($("#abdomial_id").val())+parseFloat($("#muslo_id").val())+parseFloat($("#pantorrilla_pliegue_id").val());
		suma_4pliegues=parseFloat($("#tricipital_id").val())+parseFloat($("#subescapular_id").val())+parseFloat($("#bicipital_id").val())+parseFloat($("#supracrestideo_id").val());
  		$("#4pliegues_id").val(suma_4pliegues);
  		$("#6pliegues_id").val(suma_6pliegues);
  	});
  	$( "#supraespinal_id" ).change(function() {
		suma_6pliegues=parseFloat($("#tricipital_id").val())+parseFloat($("#subescapular_id").val())+parseFloat($("#supraespinal_id").val())+parseFloat($("#abdomial_id").val())+parseFloat($("#muslo_id").val())+parseFloat($("#pantorrilla_pliegue_id").val());
  		$("#6pliegues_id").val(suma_6pliegues);
  	});
  	$( "#abdomial_id" ).change(function() {
  		suma_6pliegues=parseFloat($("#tricipital_id").val())+parseFloat($("#subescapular_id").val())+parseFloat($("#supraespinal_id").val())+parseFloat($("#abdomial_id").val())+parseFloat($("#muslo_id").val())+parseFloat($("#pantorrilla_pliegue_id").val());
  		$("#6pliegues_id").val(suma_6pliegues);
  	});
  	$( "#muslo_id" ).change(function() {
  		suma_6pliegues=parseFloat($("#tricipital_id").val())+parseFloat($("#subescapular_id").val())+parseFloat($("#supraespinal_id").val())+parseFloat($("#abdomial_id").val())+parseFloat($("#muslo_id").val())+parseFloat($("#pantorrilla_pliegue_id").val());
  		$("#6pliegues_id").val(suma_6pliegues);
  	});
  	$( "#pantorrilla_pliegue_id" ).change(function() {
  		suma_6pliegues=parseFloat($("#tricipital_id").val())+parseFloat($("#subescapular_id").val())+parseFloat($("#supraespinal_id").val())+parseFloat($("#abdomial_id").val())+parseFloat($("#muslo_id").val())+parseFloat($("#pantorrilla_pliegue_id").val());
  		$("#6pliegues_id").val(suma_6pliegues);
  	});

	$( "#peso_id" ).change(function() {
		masa_adip=$("#peso_id").val()*($("#grasa_durnin_id").val()/100); 
		masa_adip=masa_adip.toFixed(2);
  		$("#masa_adiposa_id").val(masa_adip);
  		masa_sin_grasa=parseFloat($("#peso_id").val())-parseFloat($("#masa_adiposa_id").val());
		masa_sin_grasa=masa_sin_grasa.toFixed(2);
  		$("#masa_sin_grasa_id").val(masa_sin_grasa);
  		masa_muscular=parseFloat($("#masa_sin_grasa_id").val())*0.4;
		masa_muscular=masa_muscular.toFixed(2);
  		$("#masa_muscular_id").val(masa_muscular);
	});
	$( "#grasa_durnin_id" ).change(function() {
		masa_adip=$("#peso_id").val()*($("#grasa_durnin_id").val()/100);
		masa_adip=masa_adip.toFixed(2);
  		$("#masa_adiposa_id").val(masa_adip);
  		masa_sin_grasa=parseFloat($("#peso_id").val())-parseFloat($("#masa_adiposa_id").val());
		masa_sin_grasa=masa_sin_grasa.toFixed(2);
  		$("#masa_sin_grasa_id").val(masa_sin_grasa);
  		masa_muscular=parseFloat($("#masa_sin_grasa_id").val())*0.4;
		masa_muscular=masa_muscular.toFixed(2);
  		$("#masa_muscular_id").val(masa_muscular);
	});




});