$(document).ready(function(){
    mostrarDatos("",1,"7",$("input[name=rut]").val());
    $("input[name=busqueda]").keyup(function(){
        textobuscar = $(this).val();
        if(textobuscar==""){
            mostrarDatos(textobuscar,1,"7",$("input[name=rut]").val());
        }else{
            mostrarDatos(textobuscar,1,"10",$("input[name=rut]").val());
        }
  });

  $("body").on("click",".paginacion li a",function(e){
    e.preventDefault();
    valorhref = $(this).attr("href");
    valorBuscar = $("input[name=busqueda]").val();
    mostrarDatos(valorBuscar,valorhref,"7",$("input[name=rut]").val());
    });
    $("#body_pacientes").on("click",".eliminar_paciente",function(e){
        e.preventDefault();
        if(confirm('Realmente desea eliminar este registro?'))
    {
        window.location=$(this).attr("href");
    }
    });

});



function mostrarDatos(valorBuscar,pagina,cantidad,rut){
  path="http://localhost:8000/paciente/";
  //path="http://mard.cl/nutricion/registrar/";
  //path="http://192.168.0.12/nutricion/registrar/";
  //path="http://10.145.149.41/nutricion/registrar/";
    $.ajax({
    url : path+"mostrar_pacientes",
    type: "POST",
    data: {buscar:valorBuscar,nropagina:pagina,cantidad:cantidad,rut:rut},
    dataType:"json",
    success:function(response){
      filas = "";
      $.each(response.paciente,function(key,item){
        //console.log(response.paciente);
        filas+="<tr><td><center><img src='http://localhost:8000/uploads/"+item.rut+".png' alt='Avatar' class='avatar'></td><td><center>"+item.nombre+" "+item.apellido+"</td><td><center><a class='btn btn-warning btn-xs' href='/paciente/ficha_clinica/"+item.rut+"'><span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span></a></center></td><td><center><a class='btn btn-danger btn-xs' href='/patologia/asociar_patologia/"+item.rut+"'><span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span></a> "+" <a class='btn btn-danger btn-xs' href='/alimento/restringir_alimentos/"+item.rut+"'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></center></td><td><center><a href='/evaluacion/evaluaciones/"+item.rut+"' class='btn btn-info tabla btn-xs'> <span class='glyphicon glyphicon-scale' aria-hidden='true'></span> Evaluación </a></center></a></td><td><center><a class='btn btn-warning  btn-xs' href='/reporte/informe/"+item.rut+"/'"+"><span class='glyphicon glyphicon-paperclip' aria-hidden='true'></span></a></center></td><td><center><a class='btn btn-success btn-xs' href='/minuta/gestion_minuta/"+item.rut+"/'"+"><span class='glyphicon glyphicon-apple' aria-hidden='true'></span></center></td><td><center><a class='btn btn-primary tabla btn-xs' href='/paciente/editar_paciente/"+item.rut+"/'"+"><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>  "+"   <a class='eliminar_paciente btn btn-danger tabla btn-xs' href='/paciente/eliminar_paciente/"+item.rut+"/')'"+"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a></center></td></tr>";
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