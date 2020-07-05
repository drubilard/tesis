$(document).ready(function(){
    var rut_forma="";
    $("input[name=rut]").change(function(){
        if(($(this).val().charAt($(this).val().length-2)!="-")){
            rut= $(this).val();   
            rut_forma=rut.substr(0,rut.length-1)
            dv=rut.charAt(rut.length-1)
            $(this).val(rut_forma+"-"+dv);
        }
        
    });
});