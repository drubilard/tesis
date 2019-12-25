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

});



function mostrarDatos(valorBuscar,pagina,cantidad,rut){
  path="http://localhost:8000/administrador/";
  //path="http://mard.cl/nutricion/registrar/";
  //path="http://192.168.0.12/nutricion/registrar/";
  //path="http://10.145.149.41/nutricion/registrar/";
    $.ajax({
    url : path+"mostrar_usuarios_desactivados",
    type: "POST",
    data: {buscar:valorBuscar,nropagina:pagina,cantidad:cantidad,rut:rut},
    dataType:"json",
    success:function(response){
      filas = "";
      $.each(response.usuarios,function(key,item){
        //console.log(response.paciente);
        filas+="<tr><td><center>"+item.rut+"</td><td><center>"+item.Nombres+" "+item.Apellidos+"</td><td><center><a class='btn btn-primary tabla btn-xs' href='/administrador/activar_usuario/"+item.rut+"/')'"+"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></a></center></td></tr>";
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