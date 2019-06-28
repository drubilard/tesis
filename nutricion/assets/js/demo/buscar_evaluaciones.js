
$(document).ready(function(){
    rut=$("input[name=rut]").val();
    mostrarDatos(rut,"",1,"5");
    $("input[name=busqueda]").keyup(function(){
        textobuscar = $(this).val();
        if(textobuscar==""){
            mostrarDatos(rut,textobuscar,1,"5");
        }else{
            mostrarDatos(rut,textobuscar,1,"10");
        }
	});

	$("body").on("click",".paginacion li a",function(e){
		e.preventDefault();
		valorhref = $(this).attr("href");
		valorBuscar = $("input[name=busqueda]").val();
		mostrarDatos(rut,valorBuscar,valorhref,"5");
    });
    $("#body_evaluacion").on("click",".eliminar_evaluacion",function(e){
        e.preventDefault();
        if(confirm('Realmente desea eliminar este registro?'))
    {
        window.location=$(this).attr("href");
    }
    });

});


function mostrarDatos(rut_paciente,valorBuscar,pagina,cantidad){
	path="http://192.168.0.12/nutricion/registrar/";
	//path="http://10.145.249.105/nutricion/registrar/";
		$.ajax({
		url : path+"mostrar_evaluaciones",
		type: 'POST',
		data: {rut:rut_paciente,buscar:valorBuscar,nropagina:pagina,cantidad:cantidad},
		dataType:"json",
		success:function(response){
			filas = "";
			$.each(response.evaluaciones,function(key,item){
				//console.log(response.paciente);
				filas+="<tr><td><center>"+item.fecha+"</td><ter></td><td><center><a class='btn btn-primary tabla btn-xs' href='/nutricion/registrar/editar_evaluacion/"+item.idevaluacion_nutricional+"'"+"><span class='glyphicon glyphicon-search' aria-hidden='true'></span></a>    "+"    <a class='eliminar_evaluacion btn btn-danger tabla btn-xs' href='/nutricion/registrar/eliminar_evaluacion/"+item.idevaluacion_nutricional+"')'"+"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></center></a></td></tr>";
			});

			$("#body_evaluacion").html(filas);
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
