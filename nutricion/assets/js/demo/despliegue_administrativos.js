
$(document).ready(function(){
	$("#fecha_admin_div").hide();
	var encabezado;
	var texto="Día asignado para "
    $("#administrativo").change(function(){
    	$( "h5" ).remove();
    	var seccion=document.querySelector("#dias_seleccionados");
    	var texto_2 = document.createTextNode($('#administrativo option:selected').html());
    	encabezado=document.createElement("h5");
    	encabezado.append(texto,texto_2,": ");
		seccion.append(encabezado);
        $("#fecha_admin_div").show();
    });
    $("#fecha_admin").change(function(){
    	$("strong").remove();
    	var negrita= document.createElement("strong");
    	var texto_3 = document.createTextNode($('input[id=fecha_admin]').val());
    	negrita.append(texto_3);
    	encabezado.append(negrita);
    });
});