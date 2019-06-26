    $(document).ready(function(){
    var fechas_evaluaciones=[];
    var peso=[];
    var porc_grasa=[];
    var cintura=[];
    var rut_paciente=$("#paciente").val();
    var ctx="";
    var ctx2="";
    var ctx3="";

    var path="http://192.168.0.12/nutricion/registrar/datos_informe/"+rut_paciente;
    //path="http://10.145.243.133/nutricion/registrar/datos_informe/"+rut_paciente;
        $.post(path,
            function(data){
                var obj= JSON.parse(data);
                fechas_evaluaciones=[];
                peso=[];
                $.each(obj,function(i,item){
                    peso.push(item.peso_paciente);
                    fechas_evaluaciones.push(item.fecha);
                    porc_grasa.push(item.grasa_durnin_paciente);
                    cintura.push(item.cintura_min_paciente);
                });
                 ctx = $("#myChart");
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: fechas_evaluaciones,
                        datasets: [{
                        data:peso,
                        label: 'Progreso de estado nutricional en base peso',
                        backgroundColor: 
                            'rgba(0, 175, 238, 0.4)',
        
                        borderColor: 
                            'rgba(0, 175, 238, 1)',
        
                        borderWidth: 2
                    }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                }); 
                ctx2 = $("#myChart2");
                var myChart = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: fechas_evaluaciones,
                        datasets: [{
                        data:porc_grasa,
                        label: 'Progreso de estado nutricional en base % de grasa',
                        backgroundColor: 
                            'rgba(255, 99, 132, 0.4)',
        
                        borderColor: 
                            'rgba(255, 99, 132, 1)',
        
                        borderWidth: 2
                    }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                ctx3 = $("#myChart3");
                var myChart = new Chart(ctx3, {
                    type: 'line',
                    data: {
                        labels: fechas_evaluaciones,
                        datasets: [{
                        data:cintura,
                        label: 'Progreso de estado nutricional en base pliegue de cintura',
                        backgroundColor: 
                            'rgba( 245, 155, 26, 0.4)',
        
                        borderColor: 
                            'rgba(245, 155, 26, 1)',
        
                        borderWidth: 2
                    }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                 
        });
        document.getElementById('form1').addEventListener("submit",function(){
            var image = ctx[0].toDataURL("image/png").replace("image/png", "image/octet-stream");
            //var image = dataURL; // data:image/png....
            //image = image.replace("image/png","image/octet-stream");
            document.getElementById('base64_1').value = image;
         },false);
         document.getElementById('form2').addEventListener("submit",function(){
            var image = ctx2[0].toDataURL("image/png").replace("image/png", "image/octet-stream");
            //var image = dataURL; // data:image/png....
            //image = image.replace("image/png","image/octet-stream");
            document.getElementById('base64_2').value = image;
         },false);
         document.getElementById('form3').addEventListener("submit",function(){
            var image = ctx3[0].toDataURL("image/png").replace("image/png", "image/octet-stream");
            //var image = dataURL; // data:image/png....
            //image = image.replace("image/png","image/octet-stream");
            document.getElementById('base64_3').value = image;
         },false);

});