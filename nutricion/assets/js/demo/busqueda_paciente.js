
$(document).ready(function(){
    mostrarDatos("",1,"5");
    $("input[name=busqueda]").keyup(function(){
        textobuscar = $(this).val();
        if(textobuscar==""){
            mostrarDatos(textobuscar,1,"5");
        }else{
            mostrarDatos(textobuscar,1,"10");
        }
	});

	$("body").on("click",".paginacion li a",function(e){
		e.preventDefault();
		valorhref = $(this).attr("href");
		valorBuscar = $("input[name=busqueda]").val();
		mostrarDatos(valorBuscar,valorhref,"5");
    });
    $("#body_pacientes").on("click",".eliminar_paciente",function(e){
        e.preventDefault();
        if(confirm('Realmente desea eliminar este registro?'))
    {
        window.location=$(this).attr("href");
    }
    });

});


function mostrarDatos(valorBuscar,pagina,cantidad){
    path="http://localhost/nutricion/registrar/"
	$.ajax({
		url : "http://192.168.0.12/nutricion/registrar/mostrar_pacientes",
		type: "POST",
		data: {buscar:valorBuscar,nropagina:pagina,cantidad:cantidad},
		dataType:"json",
		success:function(response){
			filas = "";
			$.each(response.paciente,function(key,item){
				//console.log(response.paciente);
				filas+="<tr><td><center>"+item.rut+"</td><td><center>"+item.nombre+" "+item.apellido+"</center></td><td><center><a href='/nutricion/registrar/planilla_evaluacion/"+item.rut+"/"+pagina+"'"+"><span class='glyphicon glyphicon-scale' aria-hidden='true'></span></center></a></td><td><center><a href='/nutricion/registrar/editar_paciente/"+item.rut+"/"+pagina+"'"+"><span class='glyphicon glyphicon-paperclip' aria-hidden='true'></span></center></a></td><td><center><a href='/nutricion/registrar/editar_paciente/"+item.rut+"/"+pagina+"'"+"><span class='glyphicon glyphicon-apple' aria-hidden='true'></span></center></a></td><td><center><a href='/nutricion/registrar/editar_paciente/"+item.rut+"/"+pagina+"'"+"><span class='glyphicon glyphicon-search' aria-hidden='true'></span></a>"+"<a class='eliminar_paciente' href='/nutricion/registrar/eliminar_paciente/"+item.rut+"/"+pagina+"')'"+"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></center></a></td></tr>";
			});

			$("#body_pacientes").html(filas);
			linkseleccionado = Number(pagina);
			//total registros
			totalregistros = response.totalregistros;
			//cantidad de registros por pagina
			cantidadregistros = response.cantidad;

			numerolinks = Math.ceil(totalregistros/cantidadregistros);
			paginador = "<ul class='pagination'>";
			if(linkseleccionado>1)
			{
				paginador+="<li><a href='1'>&laquo;</a></li>";
				paginador+="<li><a href='"+(linkseleccionado-1)+"' '>&lsaquo;</a></li>";

			}
			else
			{
				paginador+="<li class='disabled'><a href='#'>&laquo;</a></li>";
				paginador+="<li class='disabled'><a href='#'>&lsaquo;</a></li>";
			}
			//muestro de los enlaces 
			//cantidad de link hacia atras y adelante
 			cant = 2;
 			//inicio de donde se va a mostrar los links
			pagInicio = (linkseleccionado > cant) ? (linkseleccionado - cant) : 1;
			//condicion en la cual establecemos el fin de los links
			if (numerolinks > cant)
			{
				//conocer los links que hay entre el seleccionado y el final
				pagRestantes = numerolinks - linkseleccionado;
				//defino el fin de los links
				pagFin = (pagRestantes > cant) ? (linkseleccionado + cant) :numerolinks;
			}
			else 
			{
				pagFin = numerolinks;
			}

			for (var i = pagInicio; i <= pagFin; i++) {
				if (i == linkseleccionado)
					paginador +="<li class='active'><a href='javascript:void(0)'>"+i+"</a></li>";
				else
					paginador +="<li><a href='"+i+"'>"+i+"</a></li>";
			}
			//condicion para mostrar el boton sigueinte y ultimo
			if(linkseleccionado<numerolinks)
			{
				paginador+="<li><a href='"+(linkseleccionado+1)+"' >&rsaquo;</a></li>";
				paginador+="<li><a href='"+numerolinks+"'>&raquo;</a></li>";

			}
			else
			{
				paginador+="<li class='disabled'><a href='#'>&rsaquo;</a></li>";
				paginador+="<li class='disabled'><a href='#'>&raquo;</a></li>";
			}
			
			paginador +="</ul>";
			$(".paginacion").html(paginador);

		}
	});
}