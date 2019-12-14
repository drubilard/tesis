$(document).ready(function(){
	$("#tipo_consulta").hide();
    $("#paciente_id").change(function(){
        $("#tipo_consulta").show();
    });
});