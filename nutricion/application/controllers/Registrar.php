<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
class Registrar extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
    public function inicio(){
        $this->load->view('registrar/inicio');
    }
    public function add_nutricionista(){
        if($this->session->userdata("id")){
            if($this->input->post()){
                if ($this->form_validation->run('add_nutricionista')) {
                    if ($this->input->post('contrasena')==$this->input->post('contrasena_2')) {
                        if (valida_rut(trim($this->input->post('rut_paciente')))) {
                            $consultar_usuario=$this->datos_model->consulta_usuario($this->input->post('usuario'));   
                                if (sizeof($consultar_usuario)==0) {
                                    $data=array(
                                    'rut'=>trim($this->input->post('rut',true)),
                                    'Nombres'=>trim($this->input->post('nombre',true)),
                                    'Apellidos'=>trim($this->input->post('apellido',true)),
                                    'sexo'=>$this->input->post('sexo',true),
                                    'usuario'=>$this->input->post('usuario',true),
                                    'clave'=>sha1($this->input->post('contrasena',true)),
                                    );
                                    $this->datos_model->insertar_nutricionista($data);
                                    $this->session->set_flashdata('css','success');
                                    $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                                    $rut_paciente=trim($this->input->post('rut_paciente',true));
                                    redirect(base_url()."registrar/inicio/$rut_paciente");
                                }
                                else{
                                    $this->session->set_flashdata('css','danger');
                                    $this->session->set_flashdata('mensaje','Ya existe un registro con este nombre de usuario');
                                    redirect(base_url()."registrar/add_nutricionista");
                                }
                        }else{
                            $this->session->set_flashdata('css','danger');
                            $this->session->set_flashdata('mensaje','Rut no válido');
                        }
                    }else{
                        $this->session->set_flashdata('css','danger');
                        $this->session->set_flashdata('mensaje','las contraseñas no coinciden');
                    }
                }  
            }
            $this->load->view('registrar/add_nutricionista');
        }else{
            redirect(base_url()."registrar/salir");
        }
    }  
    public function add_paciente(){
    if($this->session->userdata("id")){
            $rut_paciente="";
        if($this->input->post()){
            if ($this->form_validation->run('add_paciente')) {
                if (valida_rut(trim($this->input->post('rut')))) {
                    $consulta_rut=$this->datos_model->consultar_rut_paciente($this->input->post('rut_paciente'));
                    if(sizeof($consulta_rut)==0){
                        if (valida_fecha($this->input->post('fecha_nacimiento_p'))) {  
                            $data=array(
                            'rut'=>trim($this->input->post('rut',true)),
                            'nombre'=>trim($this->input->post('nombre_paciente',true)),
                            'apellido'=>trim($this->input->post('apellido_paciente',true)),
                            'sexo'=>$this->input->post('sexo',true),
                            'fecha_nacimiento'=>$this->input->post('fecha_nacimiento_p',true),
                            'Nutricionista_rut'=>$this->session->userdata("id")
                        );
                        $this->datos_model->insertar_paciente($data);
                        $this->session->set_flashdata('css','success');
                        $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                        $rut_paciente=trim($this->input->post('rut_paciente',true));
                        //$this->load->view("registrar/planilla_evaluacion",compact('ultimo'));
                        redirect(base_url()."registrar/listado_pacientes/");
                        }else{
                            $this->session->set_flashdata('css','danger');
                            $this->session->set_flashdata('mensaje','fecha no válida');
                        }
                    
                    }else{
                        $this->session->set_flashdata('css','danger');
                        $this->session->set_flashdata('mensaje','Rut ya registrado');
                    }
                }else{
                    $this->session->set_flashdata('css','danger');
                    $this->session->set_flashdata('mensaje','Rut no válido');
                }
            }
        }
        $this->load->view('registrar/add_paciente');
    }else{
        redirect(base_url()."registrar/salir");
    }
        
}   
public function asignar_alimentos($id_prep=null,$id_alm=null){
    if($this->session->userdata("id")){
        if(!$id_prep){redirect(base_url()."error404/");}
        $preparacion=$this->datos_model->get_preparacion_id($id_prep);
        if(sizeof($preparacion)==0){
            redirect(base_url()."error404/");
        }
        //print_r($preparacion);die;
            if($id_alm!=null){
                $alimento=$this->datos_model->get_alimento_id($id_alm);
                $data=array(
                    "preparacion_idpreparacion"=>$id_prep,
                    "alimento_idalimento"=>$id_alm
                );
                $id_alimento_asociado=$this->datos_model->insert_alimentos_asociados($data);
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','Alimentos asociado exitosamente');
                if ($alimento->tipo=="bebestible") {
                    redirect(base_url()."registrar/asignar_alimentos/".$id_prep);
                }else{
                redirect(base_url()."registrar/asignar_porcion/".$id_alimento_asociado."/".$id_prep);
                }
            }
            $this->load->view("registrar/asignar_alimentos",compact('preparacion'));
    }else{
    redirect(base_url()."registrar/salir");
    }
}
public function alimentos_minuta($id){
    $alimentos=$this->datos_model->get_alimentos_minuta($id);
    print_r($alimentos);die;
}


public function asignar_porcion($id=null,$id_prep=null){
    if($this->session->userdata("id")){
        if(!$id){redirect(base_url()."error404/");}
        $alimento=$this->datos_model->get_alimento_asociado($id);
        if(sizeof($alimento)==0){
            redirect(base_url()."error404/");
        }
        if($this->input->post("porcion")){
            $data=array(
                "porcion"=>$this->input->post("porcion")
            );
            $this->datos_model->porcion_alimentos_asociados($id,$data);
            $this->session->set_flashdata('css','success');
            $this->session->set_flashdata('mensaje','Porción asociada');
            redirect(base_url()."registrar/asignar_alimentos/".$id_prep);
        }else{
            $this->load->view("registrar/asignar_porcion",compact('alimento'));
        }
        }else{
        redirect(base_url()."registrar/salir");
    }

}
public function quitar_alimentos($id_prep=null,$id_pa=null){
    if($this->session->userdata("id")){
        if(!$id_prep){redirect(base_url()."error404/");}
        $preparacion=$this->datos_model->get_preparacion_id($id_prep);
        if(sizeof($preparacion)==0){
            redirect(base_url()."error404/");
        }
        //print_r($preparacion);die;
            if($id_pa!=null){
                $this->datos_model->delete_alimentos_asociados($id_pa);
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','El alimentos se quitó exitosamente');
            }
            $this->load->view("registrar/quitar_alimentos",compact('preparacion'));
    }else{
    redirect(base_url()."registrar/salir");
    }
}
public function editar_paciente($id=null){
    if(!$id){redirect(base_url()."error404/");}
    $datos=$this->datos_model->get_paciente_por_rut($id);
    if(sizeof($datos)==0){
        redirect(base_url()."error404/");
    }
    if($this->session->userdata("id")){
        if($this->input->post()){
        $data=array(
            "nombre"=>$this->input->post("nombre_paciente",true),
            "apellido"=>$this->input->post("apellido_paciente",true),
            "fecha_nacimiento"=>$this->input->post("fecha_nacimiento_p",true),
            "sexo"=>$this->input->post("sexo",true),
        );
        $this->datos_model->update_paciente($data,$id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
        redirect(base_url()."registrar/listado_pacientes");
         }else{
            $this->load->view("registrar/editar_paciente",compact('datos'));
        }
    }else{
        redirect(base_url().'registrar/salir');
    }

}
public function editar_nutricionista($id=null){
    if(!$id){redirect(base_url()."error404/");}
    if($this->session->userdata("id")){
        $datos=$this->datos_model->get_nutricionista_por_rut($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        if($this->input->post()){
            if(!$id){redirect(base_url()."error404/");}
            $data=array(
                "Nombres"=>$this->input->post("nombre_nutricionista",true),
                "Apellidos"=>$this->input->post("apellido_nutricionista",true),
                "sexo"=>$this->input->post("sexo",true)
            );
            $this->datos_model->update_nutricionista($data,$id);
            $this->session->set_flashdata('css','success');
            $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente, vuelva a iniciar sesión por favor');
            redirect(base_url()."registrar/login");
         }else{
            $this->load->view("registrar/editar_nutricionista",compact('datos'));
        }
    }else{
        redirect(base_url().'registrar/salir');
    }

}
public function editar_evaluacion($id){
    if(!$id){redirect(base_url()."error404/");}
    if($this->session->userdata("id")&&$this->uri->segment(3)){
        $datos_evaluacion=$this->datos_model->get_evaluacion($id);
        $datos_paciente=$this->datos_model->get_paciente_por_rut($datos_evaluacion->Paciente_rut);
        //print_r($datos_evaluacion);die;
        if($this->input->post()){
        if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
        $data=array("peso_paciente"=>$this->input->post('peso'),
                        "talla_paciente"=>$this->input->post('talla'),
                        "imc_paciente"=>$this->input->post('imc'),
                        "humero_paciente"=>$this->input->post('humero'),
                        "femur_paciente"=>$this->input->post('femur'),
                        "brazo_relajado_paciente"=>$this->input->post('b_relajado'),
                        "brazo_contraido_paciente"=>$this->input->post('b_contraido'),
                        "cintura_min_paciente"=>$this->input->post('c_min'),
                        "cadera_max_paciente"=>$this->input->post('c_max'),
                        "muslo_medio_paciente"=>$this->input->post('m_medio'),
                        "pantorrilla_paciente"=>$this->input->post('pantorrilla_perimetro'),
                        "tricipital_paciente"=>$this->input->post('tricipital'),
                        "subescapular_paciente"=>$this->input->post('subescapular'),
                        "bicipital_paciente"=>$this->input->post('bicipital'),
                        "supracrestideo_paciente"=>$this->input->post('supracrestideo'),
                        "supraespinal_paciente"=>$this->input->post('supraespinal'),
                        "abdominal_paciente"=>$this->input->post('abdomial'),
                        "muslo_paciente"=>$this->input->post('muslo'),
                        "pantorrilla2_paciente"=>$this->input->post('pantorrilla_pliegue'),
                        "cuatro_pliegues_paciente"=>$this->input->post('4pliegues'),
                        "grasa_durnin_paciente"=>$this->input->post('grasa_durnin'),
                        "masa_adiposa_paciente"=>$this->input->post('masa_adiposa'),
                        "masa_sin_grasa_paciente"=>$this->input->post('masa_sin_grasa'),
                        "masa_muscular_paciente"=>$this->input->post('masa_muscular'),
                        "seis_pliegues_paciente"=>$this->input->post('6pliegues'),
                        "fecha"=>$this->input->post('fecha_control'),
                        "Paciente_rut"=>$datos_paciente->rut);
                        $edad=(int)calculaEdad($datos_paciente->fecha_nacimiento);
                        $porc_grasa=(int)$this->input->post('grasa_durnin');
                        $sexo=$datos_paciente->sexo;
                        switch ($sexo) {
                            case '1':
                            if(18<= $edad && $edad<=25){
                                if($porc_grasa<15){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(15<= $porc_grasa && $porc_grasa<=20){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(20< $porc_grasa && $porc_grasa<=25){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(25< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(25< $edad && $edad<=30){
                                if($porc_grasa<17){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(17<= $porc_grasa && $porc_grasa<=22){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(22< $porc_grasa && $porc_grasa<=27){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(27< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(30< $edad && $edad<=35){
                                if($porc_grasa<19){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(19<= $porc_grasa && $porc_grasa<=24){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(24< $porc_grasa && $porc_grasa<=29){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(29< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(35< $edad && $edad<=40){
                                if($porc_grasa<21){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(21<= $porc_grasa && $porc_grasa<=26){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(26< $porc_grasa && $porc_grasa<=31){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(31< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(40< $edad && $edad<=45){
                                if($porc_grasa<23){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(23<= $porc_grasa && $porc_grasa<=28){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(28< $porc_grasa && $porc_grasa<=33){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(33< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(45< $edad && $edad<=50){
                                if($porc_grasa<25){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(25<= $porc_grasa && $porc_grasa<=30){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(30< $porc_grasa && $porc_grasa<=35){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(35< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(50 < $edad ){
                                $estado_nutri_paciente="SIN DEFINIR";
                            }
                                break;
                            
                            case '2':
                            if(18<= $edad && $edad<=25){
                                if($porc_grasa<17){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(17<= $porc_grasa && $porc_grasa<=20){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(20< $porc_grasa && $porc_grasa<=25){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(25< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(25< $edad && $edad<=30){
                                if($porc_grasa<19){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(19<= $porc_grasa && $porc_grasa<=22){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(22< $porc_grasa && $porc_grasa<=27){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(27< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(30< $edad && $edad<=35){
                                if($porc_grasa<21){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(21<= $porc_grasa && $porc_grasa<=24){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(24< $porc_grasa && $porc_grasa<=29){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(29< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(35< $edad && $edad<=40){
                                if($porc_grasa<23){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(23<= $porc_grasa && $porc_grasa<=26){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(26< $porc_grasa && $porc_grasa<=31){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(31< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(40< $edad && $edad<=45){
                                if($porc_grasa<25){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(25<= $porc_grasa && $porc_grasa<=28){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(28< $porc_grasa && $porc_grasa<=33){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(33< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(45< $edad && $edad<=50){
                                if($porc_grasa<27){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(27<= $porc_grasa && $porc_grasa<=30){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(30< $porc_grasa && $porc_grasa<=35){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(35< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(50 < $edad ){
                                $estado_nutri_paciente="SIN DEFINIR";
                            }
                            break;
                        }
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','se edito exitosamente su evaluación');
                    $this->session->set_flashdata('css_estado_nutri','warning');
                    $this->session->set_flashdata('estado_nutri','Respecto a la reciente modificación en la evaluación, el estado nutricional del paciente '. $estado_nutri_paciente);
                    $this->datos_model->update_evaluacion($data,$id);
                    redirect(base_url()."registrar/listado_evaluaciones/".$datos_paciente->rut);
         }else{
            $this->load->view("registrar/editar_evaluacion",compact('datos_paciente','datos_evaluacion'));
        }
    }else{
        redirect(base_url().'registrar/salir');
    }

}
public function eliminar_paciente($id=null){
    if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_paciente_por_rut($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        $result=$this->datos_model->delete_paciente($id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
        redirect(base_url()."registrar/listado_pacientes");
}
public function eliminar_evaluacion($id=null){
    if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_evaluacion($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        $result=$this->datos_model->delete_evaluacion($id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
        redirect(base_url()."registrar/listado_evaluaciones/".$datos->Paciente_rut);
}
public function eliminar_minuta($id=null){
    if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_minuta($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        $result=$this->datos_model->delete_preparaciones_minuta($id);
        $result=$this->datos_model->delete_minuta($id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
        redirect(base_url()."registrar/listado_minutas/".$datos->Paciente_rut);
}
public function eliminar_ficha($id=null){
    if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_ficha_id($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        $result=$this->datos_model->delete_ficha($id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
        redirect(base_url()."registrar/listado_fichas/".$datos->rut);
}
public function login(){

        if($this->input->post()){
            if ($this->form_validation->run('login_formulario')) {
                $data=$this->datos_model->get_user($this->input->post('user',true),$this->input->post('clave',true)); 
                //print_r($data); die("bandera");
                if (sizeof($data)==0) {
                    $this->session->set_flashdata('css','danger');
                    $this->session->set_flashdata('mensaje_login','los datos no coinciden');
                    redirect(base_url()."registrar/login");                   
                }else{   
                    $this->session->set_userdata("datos_usuario");
                    $this->session->set_userdata("id",$data->rut);
                    $this->session->set_userdata("nombre",$data->Nombres);
                    $this->session->set_userdata("sexo",$data->sexo); 
                    redirect(base_url()."registrar/administrar");
                } 
        }
    }
    $this->load->view('registrar/login');
    }
     public function add_alimento(){
        if($this->session->userdata("id")){
            $tipo_alimentos=$this->datos_model->get_all_tipo_alimentos();
            if($this->input->post()){
                if ($this->form_validation->run('add_alimento')) {
                    $data=array(
                    'nombre'=>$this->input->post('nombre_alimento',true),
                    'aporte'=>$this->input->post('aporte',true),
                    'propiedades'=>$this->input->post('propiedades',true),
                    'tipo_alimento'=>$this->input->post('tipo',true)
                    );
                    $id_alimento=$this->datos_model->insertar_alimento($data);
                    if($id_alimento!=null){
                        $this->session->set_flashdata('css','success');
                        $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                        redirect(base_url()."registrar/listado_alimentos");
                    }
                }
            }
            $this->load->view("registrar/add_alimento",compact('tipo_alimentos'));
        }
        else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function nueva_ficha($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_paciente_por_rut($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        if($this->session->userdata("id")){
            if($this->input->post()){
                if ($this->form_validation->run('nueva_ficha')) {
                    $data=array(
                        'fecha'=>$this->input->post('fecha',true),
                        'informacion'=>$this->input->post('info',true),
                        'rut'=>$datos->rut
                    );
                    $this->datos_model->insertar_ficha($data);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                    redirect(base_url()."registrar/listado_pacientes");
                }
            }
            $this->load->view("registrar/nueva_ficha",compact('datos'));
        }
        else{
            redirect(base_url()."registrar/salir");
        }
    }
     public function add_preparacion(){
        if($this->session->userdata("id")){
            if($this->input->post()){
                if ($this->form_validation->run('add_preparacion')) {
                    $data=array(
                    'nombre'=>$this->input->post('nombre',true),
                    'tipo'=>$this->input->post('tipo',true)
                    );
                    $this->datos_model->insertar_preparacion($data);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                    redirect(base_url()."registrar/listado_preparaciones");
                }
            }
            $this->load->view("registrar/add_preparacion");
        }
        else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function salir(){
        $this->session->sess_destroy("datos_usuario");
        redirect(base_url()."registrar/login");
    }

    public function administrar(){
        if ($this->session->userdata("id")) {
            $nutri_nombre=$this->session->userdata("nombre");
            $nutri_sexo=$this->session->userdata("sexo");
            $this->load->view('registrar/administrar',compact('nutri_nombre','nutri_sexo'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function evaluaciones($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_paciente_por_rut($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        if ($this->session->userdata("id")&&($rut_paciente=$this->uri->segment(3))) {
            $this->load->view('registrar/evaluaciones',compact('rut_paciente'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function ficha_clinica($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_paciente_por_rut($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        if ($this->session->userdata("id")&&($rut_paciente=$this->uri->segment(3))) {
            $this->load->view('registrar/ficha_clinica',compact('rut_paciente'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function listado_evaluaciones($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_paciente_por_rut($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        if ($this->session->userdata("id")&&($rut_paciente=$this->uri->segment(3))){
            $datos_paciente=$this->datos_model->get_paciente_por_rut($rut_paciente);
            $this->load->view('registrar/listado_evaluaciones',compact('datos_paciente'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function listado_minutas($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_paciente_por_rut($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        if ($this->session->userdata("id")){
            $this->load->view('registrar/listado_minutas',compact('datos'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function listado_fichas($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_paciente_por_rut($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        if ($this->session->userdata("id")&&($rut_paciente=$this->uri->segment(3))){
            $datos_paciente=$this->datos_model->get_paciente_por_rut($rut_paciente);
            $this->load->view('registrar/listado_fichas',compact('datos_paciente'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function informe($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_paciente_por_rut($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        if ($this->session->userdata("id")&&($rut_paciente=$this->uri->segment(3))) {
            if($this->input->post("base64_1")){
                $img = $this->input->post('base64_1');
                $img = str_replace('data:image/octet-stream;base64,', '', $img);
                $fileData = base64_decode($img);
                $fileName = uniqid().'.png';
                //print_r(dirname(__FILE__));die;
                //$this->load->helper('download');
                //force_download($fileName, $fileData);
                $ruta= '/Applications/XAMPP/xamppfiles/htdocs/nutricion/graficos'.'/'.$fileName;
                //print_r($fileData);die;
                file_put_contents($ruta, $fileData);
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','Gráfico almacenado correctamente');
                redirect(base_url()."registrar/listado_pacientes");
            }else
            if($this->input->post("base64_2")){
                $img = $this->input->post('base64_2');
                $img = str_replace('data:image/octet-stream;base64,', '', $img);
                $fileData = base64_decode($img);
                $fileName = uniqid().'.png';
                //$this->load->helper('download');
                //force_download($fileName, $fileData);
                $ruta= '/Applications/XAMPP/xamppfiles/htdocs/nutricion/graficos'.'/'.$fileName;
                //echo $ruta;die;
                file_put_contents($ruta, $fileData);
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','Gráfico almacenado correctamente');
                redirect(base_url()."registrar/listado_pacientes");
            }else
            if($this->input->post("base64_3")){
                $img = $this->input->post('base64_3');
                $img = str_replace('data:image/octet-stream;base64,', '', $img);
                $fileData = base64_decode($img);
                $fileName = uniqid().'.png';
                //$this->load->helper('download');
                //force_download($fileName, $fileData);
                $ruta= '/Applications/XAMPP/xamppfiles/htdocs/nutricion/graficos'.'/'.$fileName;
                //echo $ruta;die;
                file_put_contents($ruta, $fileData);
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','Gráfico almacenado correctamente');
                redirect(base_url()."registrar/listado_pacientes");
            }
            else
            if($this->input->post("base64_4")){
                $img = $this->input->post('base64_4');
                $img = str_replace('data:image/octet-stream;base64,', '', $img);
                $fileData = base64_decode($img);
                $fileName = uniqid().'.png';
                //$this->load->helper('download');
                //force_download($fileName, $fileData);
                $ruta= '/Applications/XAMPP/xamppfiles/htdocs/nutricion/graficos'.'/'.$fileName;
                //echo $ruta;die;
                file_put_contents($ruta, $fileData);
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','Gráfico almacenado correctamente');
                redirect(base_url()."registrar/listado_pacientes");
            }
            else {
                $datos_paciente=$this->datos_model->get_paciente_por_rut($rut_paciente);
                $this->load->view('registrar/informe',compact('datos_paciente'));
            }
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function datos_informe($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_paciente_por_rut($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        if ($this->session->userdata("id")&&($this->uri->segment(3))) {
            $datos_informe=$this->datos_model->get_datos_informe($id);
            echo json_encode($datos_informe);
        }else{
            redirect(base_url()."registrar/salir");
        }
    }

    public function eliminar_alimento($id=null)
    {
        if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_alimento_id($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        $error=$this->datos_model->delete_alimento($id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
        redirect(base_url()."registrar/listado_alimentos");
    }
    public function eliminar_preparacion($id=null)
    {
        if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_preparacion_id($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        $this->datos_model->delete_preparacion($id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
        redirect(base_url()."registrar/listado_preparaciones");
    }
    public function editar_alimento($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $alimento=$this->datos_model->get_alimento_id($id);
        $tipo_alimentos=$this->datos_model->get_all_tipo_alimentos($id);
        if(sizeof($alimento)==0){redirect(base_url()."error404/");}
        if($this->session->userdata("id")&&$this->uri->segment(3)){
            //print_r($alimento);die;
            if($this->input->post()){
            $data=array(
                "nombre"=>$this->input->post("nombre_alimento",true),
                "tipo_alimento"=>$this->input->post("tipo",true),
                "propiedades"=>$this->input->post("propiedades",true),
                "aporte"=>$this->input->post("aporte",true)
            );
            $this->datos_model->update_alimento($data,$id);
            $this->session->set_flashdata('css','success');
            $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
            redirect(base_url()."registrar/listado_alimentos");
             }else{
                $this->load->view("registrar/editar_alimento",compact('alimento','tipo_alimentos'));
            }
        }else{
            redirect(base_url().'registrar/salir');
        }
    }
    public function editar_ficha($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $ficha=$this->datos_model->get_ficha_id($id);
        $datos=$this->datos_model->get_paciente_por_rut($ficha->rut);
        //print_r($datos);die;
        if(sizeof($ficha)==0){redirect(base_url()."error404/");}
        if($this->session->userdata("id")&&$this->uri->segment(3)){
            //print_r($alimento);die;
            if($this->input->post()){
                $data=array(
                    'fecha'=>$this->input->post('fecha',true),
                    'informacion'=>$this->input->post('info',true)
                );
            $this->datos_model->update_ficha($data,$id);
            $this->session->set_flashdata('css','success');
            $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
            redirect(base_url()."registrar/listado_fichas/".$datos->rut);
             }else{
                $this->load->view("registrar/editar_ficha",compact('ficha','datos'));
            }
        }else{
            redirect(base_url().'registrar/salir');
        }
    }
    public function editar_patologia($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $patologia=$this->datos_model->get_patologia_id($id);
        if(sizeof($patologia)==0){redirect(base_url()."error404/");}
        if($this->session->userdata("id")&&$this->uri->segment(3)){
            //print_r($alimento);die;
            if($this->input->post()){
            $data=array(
                "consideraciones"=>$this->input->post("consideraciones",true)
            );
            $this->datos_model->update_patologia($data,$id);
            $this->session->set_flashdata('css','success');
            $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
            redirect(base_url()."registrar/listado_patologias");
             }else{
                $this->load->view("registrar/editar_patologia",compact('patologia'));
            }
        }else{
            redirect(base_url().'registrar/salir');
        }
    }
    public function editar_preparacion($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $preparacion=$this->datos_model->get_preparacion_id($id);
            if(sizeof($preparacion)==0){redirect(base_url()."error404/");}
        if($this->session->userdata("id")&&$this->uri->segment(3)){
            if($this->input->post()){
            $data=array(
                "nombre"=>$this->input->post("nombre_preparacion",true),
                "tipo"=>$this->input->post('tipo',true)
            );
            $this->datos_model->update_preparacion($data,$id);
            $this->session->set_flashdata('css','success');
            $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
            redirect(base_url()."registrar/listado_preparaciones");
             }else{
                $this->load->view("registrar/editar_preparacion",compact('preparacion'));
            }
        }else{
            redirect(base_url().'registrar/salir');
        }
    }
    public function planilla_evaluacion($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos_paciente=$this->datos_model->get_paciente_por_rut($this->uri->segment(3));
        if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
        if(($this->session->userdata("id")) && ($rut_paciente=$this->uri->segment(3))){
            //print_r($datos_paciente);exit;
            if($this->input->post()){
                if ($this->form_validation->run('add_evaluacion')){
                    //echo $this->input->post('imc');exit;
                    $data=array("peso_paciente"=>$this->input->post('peso'),
                        "talla_paciente"=>$this->input->post('talla'),
                        "imc_paciente"=>$this->input->post('imc'),
                        "humero_paciente"=>$this->input->post('humero'),
                        "femur_paciente"=>$this->input->post('femur'),
                        "brazo_relajado_paciente"=>$this->input->post('b_relajado'),
                        "brazo_contraido_paciente"=>$this->input->post('b_contraido'),
                        "cintura_min_paciente"=>$this->input->post('c_min'),
                        "cadera_max_paciente"=>$this->input->post('c_max'),
                        "muslo_medio_paciente"=>$this->input->post('m_medio'),
                        "pantorrilla_paciente"=>$this->input->post('pantorrilla_perimetro'),
                        "tricipital_paciente"=>$this->input->post('tricipital'),
                        "subescapular_paciente"=>$this->input->post('subescapular'),
                        "bicipital_paciente"=>$this->input->post('bicipital'),
                        "supracrestideo_paciente"=>$this->input->post('supracrestideo'),
                        "supraespinal_paciente"=>$this->input->post('supraespinal'),
                        "abdominal_paciente"=>$this->input->post('abdomial'),
                        "muslo_paciente"=>$this->input->post('muslo'),
                        "pantorrilla2_paciente"=>$this->input->post('pantorrilla_pliegue'),
                        "cuatro_pliegues_paciente"=>$this->input->post('4pliegues'),
                        "grasa_durnin_paciente"=>$this->input->post('grasa_durnin'),
                        "masa_adiposa_paciente"=>$this->input->post('masa_adiposa'),
                        "masa_sin_grasa_paciente"=>$this->input->post('masa_sin_grasa'),
                        "masa_muscular_paciente"=>$this->input->post('masa_muscular'),
                        "seis_pliegues_paciente"=>$this->input->post('6pliegues'),
                        "fecha"=>$this->input->post('fecha_control'),
                        "Paciente_rut"=>$datos_paciente->rut);
                        $edad=(int)calculaEdad($datos_paciente->fecha_nacimiento);
                        $porc_grasa=(int)$this->input->post('grasa_durnin');
                        $sexo=$datos_paciente->sexo;
                        switch ($sexo) {
                            case '1':
                            if($edad<18){
                                $estado_nutri_paciente="corrresponde a evaluaciones infantiles";
                            }else if(18<= $edad && $edad<=25){
                                if($porc_grasa<15){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(15<= $porc_grasa && $porc_grasa<=20){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(20< $porc_grasa && $porc_grasa<=25){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(25< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(25< $edad && $edad<=30){
                                if($porc_grasa<=17){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(17< $porc_grasa && $porc_grasa<=22){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(22< $porc_grasa && $porc_grasa<=27){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(27< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(30< $edad && $edad<=35){
                                if($porc_grasa<=19){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(19< $porc_grasa && $porc_grasa<=24){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(24< $porc_grasa && $porc_grasa<=29){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(29< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(35< $edad && $edad<=40){
                                if($porc_grasa<=21){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(21< $porc_grasa && $porc_grasa<=26){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(26< $porc_grasa && $porc_grasa<=31){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(31< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(40< $edad && $edad<=45){
                                if($porc_grasa<=23){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(23< $porc_grasa && $porc_grasa<=28){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(28< $porc_grasa && $porc_grasa<=33){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(33< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(45< $edad && $edad<=60){
                                if($porc_grasa<=25){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(25< $porc_grasa && $porc_grasa<=30){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(30< $porc_grasa && $porc_grasa<=35){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(35< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(60 < $edad ){
                                if(30< $porc_grasa && $porc_grasa<=35){
                                    $estado_nutri_paciente="hace referecnia a un estado promedio";
                                }
                            }
                                break;
                            
                            case '2':
                            if($edad<18){
                                $estado_nutri_paciente="corrresponde a evaluaciones infantiles";
                            }else if(18<= $edad && $edad<=25){
                                if($porc_grasa<17){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(17<= $porc_grasa && $porc_grasa<=20){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(20< $porc_grasa && $porc_grasa<=25){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(25< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(25< $edad && $edad<=30){
                                if($porc_grasa<=19){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(19< $porc_grasa && $porc_grasa<=22){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(22< $porc_grasa && $porc_grasa<=27){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(27< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(30< $edad && $edad<=35){
                                if($porc_grasa<=21){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(21< $porc_grasa && $porc_grasa<=24){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(24< $porc_grasa && $porc_grasa<=29){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(29< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(35< $edad && $edad<=40){
                                if($porc_grasa<=23){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(23< $porc_grasa && $porc_grasa<=26){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(26< $porc_grasa && $porc_grasa<=31){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(31< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(40< $edad && $edad<=45){
                                if($porc_grasa<=25){
                                    $estado_nutri_paciente="hace referencia a un estado adecuado";
                                }else if(25< $porc_grasa && $porc_grasa<=28){
                                    $estado_nutri_paciente="hace referencia a un estado promedio";
                                }else if(28< $porc_grasa && $porc_grasa<=33){
                                    $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                }else if(33< $porc_grasa){
                                    $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                }
                            }else if(45 < $edad ){
                                if(30< $porc_grasa && $porc_grasa<=35){
                                    $estado_nutri_paciente="hace referecnia a un estado promedio";
                                }
                            }
                            break;
                        }
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','se ingresó exitosamente su evaluación');
                    $this->session->set_flashdata('css_estado_nutri','warning');
                    $this->session->set_flashdata('estado_nutri','Respecto a la reciente evaluación, el estado nutricional del paciente '.$estado_nutri_paciente);
                    $this->datos_model->add_evaluacion($data);
                    redirect(base_url()."registrar/listado_evaluaciones/".$datos_paciente->rut);
                }       
            }            $this->load->view("registrar/planilla_evaluacion",compact('datos_paciente'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function revision_examenes($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos_paciente=$this->datos_model->get_paciente_por_rut($this->uri->segment(3));
        if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
        if(($this->session->userdata("id")) && ($rut_paciente=$this->uri->segment(3))) {
            $alimentos=$this->datos_model->get_all_alimentos();
            if($this->input->post()){
                if($this->input->post('nombre_alimento_preferir')){
                    foreach($this->input->post('nombre_alimento_preferir') as $alm){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$alm,
                                'preferir'=>1,
                                'prevenir'=>0,
                                'evitar'=>0
                                );
                            $this->datos_model->asociar_paciente_alimentos($data);
                    }
                }
                if($this->input->post('nombre_alimento_prevenir')){
                    foreach($this->input->post('nombre_alimento_prevenir') as $alm){
                        $data=array('rut_paciente'=>$rut_paciente,
                            'id_preparacion'=>$alm,
                            'preferir'=>0,
                            'prevenir'=>1,
                            'evitar'=>0
                            );
                        $this->datos_model->asociar_paciente_alimentos($data);
                    }
                }
                if($this->input->post('nombre_alimento_evitar')){
                    foreach($this->input->post('nombre_alimento_evitar') as $alm){
                        $data=array('rut_paciente'=>$rut_paciente,
                            'id_preparacion'=>$alm,
                            'preferir'=>0,
                            'prevenir'=>0,
                            'evitar'=>1
                            );
                        $this->datos_model->asociar_paciente_alimentos($data);
                    }
                }

                redirect(base_url()."registrar/minuta/$rut_paciente");
            }
        $this->load->view("registrar/revision_examenes",compact('alimentos'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function listado_pacientes(){
        if($this->session->userdata("id")){
            $this->load->view("registrar/listado_pacientes");
        }else{
        redirect(base_url()."registrar/salir");
        }
    }
    public function listado_patologias(){
        if($this->session->userdata("id")){
            $this->load->view("registrar/listado_patologias");
        }else{
        redirect(base_url()."registrar/salir");
        }
    }
    public function asociar_patologia($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos_paciente=$this->datos_model->get_paciente_por_rut($this->uri->segment(3));
        if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
        $patologias=$this->datos_model->all_patologias();
        $patologias_asociadas=$this->datos_model->patologias_asociadas($id);
        if($this->session->userdata("id")){
            if($this->input->post()){
                $asociar=$this->input->post('patologias_asociadas');
                if(sizeof($patologias_asociadas)!=0){
                    $this->datos_model->delete_asignacion_patologia($id);
                }
                //print_r($asociar);die;
                foreach($asociar as $pat){
                    $data=array('Patologia_idPatologia'=>$pat,
                            'Paciente_rut'=>$datos_paciente->rut
                            );
                        $this->datos_model->agregar_asociar_patologia($data,$id);
                }
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','Asignaciones de patologías exitosa');
                redirect(base_url()."registrar/listado_pacientes");
            }
            else{
                $this->load->view("registrar/asociar_patologia",compact("datos_paciente","patologias","patologias_asociadas"));
            }
        }else{
        redirect(base_url()."registrar/salir");
        }
    }
    public function listado_alimentos(){
        if($this->session->userdata("id")){
            $this->load->view("registrar/listado_alimentos");
        }else{
        redirect(base_url()."registrar/salir");
        }
    }
    public function listado_preparaciones(){
        if($this->session->userdata("id")){
            $this->load->view("registrar/listado_preparaciones",compact('preparaciones','cuantos','pagina'));
        }else{
        redirect(base_url()."registrar/salir");
        }
    }
    public function mostrar_pacientes(){
        $buscar = $this->input->post("buscar");
        $numeropagina = $this->input->post("nropagina");
        $cantidad = $this->input->post("cantidad");
        $rut = $this->input->post("rut");
        $inicio = ($numeropagina -1)*$cantidad;
        $data = array(
            "paciente" => $this->datos_model->getTodosPaginacion_pacientes($buscar,$inicio,$cantidad,"limit",$rut),
            "totalregistros" => $this->datos_model->getTodosPaginacion_pacientes($buscar,$inicio,$cantidad,"cuantos",$rut),
            "cantidad" =>$cantidad              
        );
        echo json_encode($data);
    }
    public function mostrar_patologias(){
        $buscar = $this->input->post("buscar");
        $numeropagina = $this->input->post("nropagina");
        $cantidad = $this->input->post("cantidad");
        $inicio = ($numeropagina -1)*$cantidad;
        $data = array(
            "patologia" => $this->datos_model->getTodosPaginacion_patologias($buscar,$inicio,$cantidad,"limit",$this->session->userdata("id")),
            "totalregistros" => $this->datos_model->getTodosPaginacion_patologias($buscar,$inicio,$cantidad,"cuantos",$this->session->userdata("id")),
            "cantidad" =>$cantidad              
        );
        echo json_encode($data);
    }
    public function mostrar_evaluaciones(){
        if($this->input->post()){
            $buscar = $this->input->post("buscar");
            $numeropagina = $this->input->post("nropagina");
            $cantidad = $this->input->post("cantidad");
            $rut_paciente = $this->input->post("rut");
            $inicio = ($numeropagina -1)*$cantidad; 
            $data = array(
                "evaluaciones" => $this->datos_model->getTodosPaginacion_evaluaciones($buscar,$inicio,$cantidad,"limit",$rut_paciente),
                "totalregistros" => $this->datos_model->getTodosPaginacion_evaluaciones($buscar,$inicio,$cantidad,"cuantos",$rut_paciente),
                "cantidad" =>$cantidad              
            );
            echo json_encode($data);
        }
    }
    public function mostrar_minutas(){
        if($this->input->post()){
            $buscar = $this->input->post("buscar");
            $numeropagina = $this->input->post("nropagina");
            $cantidad = $this->input->post("cantidad");
            $rut_paciente = $this->input->post("rut");
            $inicio = ($numeropagina -1)*$cantidad; 
            $data = array(
                "minutas" => $this->datos_model->getTodosPaginacion_minutas($buscar,$inicio,$cantidad,"limit",$rut_paciente),
                "totalregistros" => $this->datos_model->getTodosPaginacion_minutas($buscar,$inicio,$cantidad,"cuantos",$rut_paciente),
                "cantidad" =>$cantidad              
            );
            echo json_encode($data);
        }
    }
    public function mostrar_fichas(){
        if($this->input->post()){
            $buscar = $this->input->post("buscar");
            $numeropagina = $this->input->post("nropagina");
            $cantidad = $this->input->post("cantidad");
            $rut_paciente = $this->input->post("rut");
            $inicio = ($numeropagina -1)*$cantidad; 
            $data = array(
                "fichas" => $this->datos_model->getTodosPaginacion_fichas($buscar,$inicio,$cantidad,"limit",$rut_paciente),
                "totalregistros" => $this->datos_model->getTodosPaginacion_fichas($buscar,$inicio,$cantidad,"cuantos",$rut_paciente),
                "cantidad" =>$cantidad              
            );
            echo json_encode($data);
        }
    }
    public function mostrar_preparaciones(){
        $buscar = $this->input->post("buscar");
        $numeropagina = $this->input->post("nropagina");
        $cantidad = $this->input->post("cantidad");
        $inicio = ($numeropagina -1)*$cantidad;
        $data = array(
            "preparacion" => $this->datos_model->getTodosPaginacion_preparaciones($buscar,$inicio,$cantidad,"limit"),
            "totalregistros" => $this->datos_model->getTodosPaginacion_preparaciones($buscar,$inicio,$cantidad,"cuantos"),
            "cantidad" =>$cantidad              
        );
        echo json_encode($data);
    }
    public function mostrar_alimentos(){
        $buscar = $this->input->post("buscar");
        $numeropagina = $this->input->post("nropagina");
        $cantidad = $this->input->post("cantidad");
        $inicio = ($numeropagina -1)*$cantidad;
        $data = array(
            "alimento" => $this->datos_model->getTodosPaginacion_alimentos($buscar,$inicio,$cantidad,"limit"),
            "totalregistros" => $this->datos_model->getTodosPaginacion_alimentos($buscar,$inicio,$cantidad,"cuantos"),
            "cantidad" =>$cantidad              
        );
        echo json_encode($data);
    }
    public function mostrar_alimentos_asociar($id){
        $buscar = $this->input->post("buscar");
        $numeropagina = $this->input->post("nropagina");
        $cantidad = $this->input->post("cantidad");
        $inicio = ($numeropagina -1)*$cantidad;
        $data = array(
            "alimento" => $this->datos_model->getTodosPaginacion_alimentos_asociar($buscar,$inicio,$cantidad,"limit",$id),
            "totalregistros" => $this->datos_model->getTodosPaginacion_alimentos_asociar($buscar,$inicio,$cantidad,"cuantos",$id),
            "cantidad" =>$cantidad              
        );
        echo json_encode($data);
    }
    public function mostrar_alimentos_quitar($id){
        $buscar = $this->input->post("buscar");
        $numeropagina = $this->input->post("nropagina");
        $cantidad = $this->input->post("cantidad");
        $inicio = ($numeropagina -1)*$cantidad;
        $data = array(
            "alimento" => $this->datos_model->getTodosPaginacion_alimentos_quitar($buscar,$inicio,$cantidad,"limit",$id),
            "totalregistros" => $this->datos_model->getTodosPaginacion_alimentos_quitar($buscar,$inicio,$cantidad,"cuantos",$id),
            "cantidad" =>$cantidad              
        );
        echo json_encode($data);
    }
    public function gestion(){
        if($this->session->userdata("id")){
            $this->load->view("registrar/gestion");
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function crear_minuta($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos_paciente=$this->datos_model->get_paciente_por_rut($id);
        if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
        if($this->session->userdata("id")){
            $preparaciones=$this->datos_model->get_all_preparaciones();
            if($this->input->post()){
                $data=array('Paciente_rut'=>$datos_paciente->rut,
                'fecha'=>date('Y-m-j')
                        );
                $id_minuta=$this->datos_model->crear_minuta($data);
                foreach($this->input->post('preparaciones_minuta_beb') as $prep){
                    $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta,
                        );
                    $this->datos_model->asociar_minuta_preparaciones($data);
                    }   
                    foreach($this->input->post('preparaciones_minuta_des') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta
                        );
                            $this->datos_model->asociar_minuta_preparaciones($data);
                    }
                    foreach($this->input->post('preparaciones_minuta_col') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta
                        );
                            $this->datos_model->asociar_minuta_preparaciones($data);
                    }
                    foreach($this->input->post('preparaciones_minuta_ent') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta
                        );
                            $this->datos_model->asociar_minuta_preparaciones($data);
                    }
                    foreach($this->input->post('preparaciones_minuta_alm') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta
                        );
                            $this->datos_model->asociar_minuta_preparaciones($data);
                    }
                    foreach($this->input->post('preparaciones_minuta_col_2') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta
                        );
                            $this->datos_model->asociar_minuta_preparaciones($data);
                    }
                    foreach($this->input->post('preparaciones_minuta_on') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta
                        );
                            $this->datos_model->asociar_minuta_preparaciones($data);
                    }
                    foreach($this->input->post('preparaciones_minuta_cen') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta
                        );
                            $this->datos_model->asociar_minuta_preparaciones($data);
                    }
                 redirect(base_url()."registrar/pdf/".$id."/".$id_minuta);
            }
        $this->load->view("registrar/crear_minuta",compact('preparaciones','id'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function recomendar_minuta($rut){
        if(!$rut){redirect(base_url()."error404/");}
        $datos_paciente=$this->datos_model->get_paciente_por_rut($rut);
        if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
        if($this->session->userdata("id")){
            $preparaciones=$this->datos_model->get_all_preparaciones();
            $patologias=$this->datos_model->get_patologia_rut($rut);
            $patologias_id=array();
            $i=0;
            foreach ($patologias as $pat) {
                $patologias_id[$i]=$pat->idPatologia;
                $patologias_id[$i+1]=",";
                $i+=2;
            }
            $preparaciones_permitidas=$this->datos_model->preparaciones_por_patologia_permitidas($patologias_id);
            //print_r($preparaciones_permitidas);
            $preparaciones_restringidas=$this->datos_model->preparaciones_por_patologia_restringidas($patologias_id);
            $i=0;
            foreach($preparaciones_permitidas as $prep){
                foreach($preparaciones_restringidas as $prep2){
                    if ($prep2->id == $prep->id) {
                        array_splice($preparaciones_permitidas, $i, 1);
                        $i-=1;
                    }
                }
                $i+=1;
            }
            if($this->input->post()){
                $data=array('Paciente_rut'=>$datos_paciente->rut,
                'fecha'=>date('Y-m-j')
                        );
                $id_minuta=$this->datos_model->crear_minuta($data);
                foreach($this->input->post('preparaciones_minuta_beb') as $prep){
                    $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta,
                        );
                    $this->datos_model->asociar_minuta_preparaciones($data);
                    }   
                    foreach($this->input->post('preparaciones_minuta_des') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta
                        );
                            $this->datos_model->asociar_minuta_preparaciones($data);
                    }
                    foreach($this->input->post('preparaciones_minuta_col') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta
                        );
                            $this->datos_model->asociar_minuta_preparaciones($data);
                    }
                    foreach($this->input->post('preparaciones_minuta_ent') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta
                        );
                            $this->datos_model->asociar_minuta_preparaciones($data);
                    }
                    foreach($this->input->post('preparaciones_minuta_alm') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta
                        );
                            $this->datos_model->asociar_minuta_preparaciones($data);
                    }
                    foreach($this->input->post('preparaciones_minuta_col_2') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta
                        );
                            $this->datos_model->asociar_minuta_preparaciones($data);
                    }
                    foreach($this->input->post('preparaciones_minuta_on') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta
                        );
                            $this->datos_model->asociar_minuta_preparaciones($data);
                    }
                    foreach($this->input->post('preparaciones_minuta_cen') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                        'minuta_idminuta'=>$id_minuta
                        );
                            $this->datos_model->asociar_minuta_preparaciones($data);
                    }
                redirect(base_url()."registrar/pdf/".$rut."/".$id_minuta);
                }        
            $this->load->view("registrar/recomendar_minuta",compact('preparaciones','rut','preparaciones_permitidas'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function editar_minuta($id_minuta=null,$rut){
        if(!$id_minuta){redirect(base_url()."error404/");}
        $minuta_preparaciones=$this->datos_model->get_preparaciones_minuta($id_minuta);
        $minuta=$this->datos_model->get_minuta($id_minuta);
        $fecha=$minuta->fecha;
        if(sizeof($minuta_preparaciones)==0){redirect(base_url()."error404/");}
        if(($this->session->userdata("id"))){
            $preparaciones=$this->datos_model->get_all_preparaciones();
            if($this->input->post()){
                $this->datos_model->delete_preparaciones_minuta($id_minuta);
                $this->datos_model->delete_minuta($id_minuta);
                $minuta=$this->datos_model->get_minuta($id_minuta);
                if(sizeof($minuta)==0){
                    $data=array('Paciente_rut'=>$rut,
                    'fecha'=>$fecha
                            );
                    $id_minuta=$this->datos_model->crear_minuta($data);
                    foreach($this->input->post('preparaciones_minuta_beb') as $prep){
                        $data=array('preparacion_idpreparacion'=>$prep,
                            'minuta_idminuta'=>$id_minuta,
                            );
                        $this->datos_model->asociar_minuta_preparaciones($data);
                        }   
                        foreach($this->input->post('preparaciones_minuta_des') as $prep){
                            $data=array('preparacion_idpreparacion'=>$prep,
                            'minuta_idminuta'=>$id_minuta
                            );
                                $this->datos_model->asociar_minuta_preparaciones($data);
                        }
                        foreach($this->input->post('preparaciones_minuta_col') as $prep){
                            $data=array('preparacion_idpreparacion'=>$prep,
                            'minuta_idminuta'=>$id_minuta
                            );
                                $this->datos_model->asociar_minuta_preparaciones($data);
                        }
                        foreach($this->input->post('preparaciones_minuta_ent') as $prep){
                            $data=array('preparacion_idpreparacion'=>$prep,
                            'minuta_idminuta'=>$id_minuta
                            );
                                $this->datos_model->asociar_minuta_preparaciones($data);
                        }
                        foreach($this->input->post('preparaciones_minuta_alm') as $prep){
                            $data=array('preparacion_idpreparacion'=>$prep,
                            'minuta_idminuta'=>$id_minuta
                            );
                                $this->datos_model->asociar_minuta_preparaciones($data);
                        }
                        foreach($this->input->post('preparaciones_minuta_col_2') as $prep){
                            $data=array('preparacion_idpreparacion'=>$prep,
                            'minuta_idminuta'=>$id_minuta
                            );
                                $this->datos_model->asociar_minuta_preparaciones($data);
                        }
                        foreach($this->input->post('preparaciones_minuta_on') as $prep){
                            $data=array('preparacion_idpreparacion'=>$prep,
                            'minuta_idminuta'=>$id_minuta
                            );
                                $this->datos_model->asociar_minuta_preparaciones($data);
                        }
                        foreach($this->input->post('preparaciones_minuta_cen') as $prep){
                            $data=array('preparacion_idpreparacion'=>$prep,
                            'minuta_idminuta'=>$id_minuta
                            );
                                $this->datos_model->asociar_minuta_preparaciones($data);
                        }
                    redirect(base_url()."registrar/pdf/".$rut."/".$id_minuta);
                    redirect(base_url()."registrar/pdf/".$rut."/".$id_minuta);
                    }
            }
        $this->load->view("registrar/editar_minuta",compact('preparaciones','minuta_preparaciones'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function gestion_minuta($id=null){
        if ($this->session->userdata("id")) {
            $paciente=$this->datos_model->get_paciente_por_rut($id);
            if(sizeof($paciente)==0){redirect(base_url()."error404/");}
            $this->load->view("registrar/gestion_minuta",compact('id'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function pdf($rut=null,$id=null){
        if(!$id || !$rut){redirect(base_url()."error404/");}
        $paciente=$this->datos_model->get_paciente_por_rut_minuta($rut);
        if(sizeof($paciente)==0){redirect(base_url()."error404/");}
        if($this->session->userdata("id")){
            $preparaciones=$this->datos_model->get_prepraciones_minuta($id);
            $patologias=$this->datos_model->get_patologia_rut($rut);
            $alimentos=$this->datos_model->get_alimentos_minuta($id);
            $patologias_id=array();
            $i=0;
            foreach ($patologias as $pat) {
                $patologias_id[$i]=$pat->idPatologia;
                $patologias_id[$i+1]=",";
                $i+=2;
            }
            $tipo_alimento_restringidas=$this->datos_model->tipo_alimento_por_patologia_restringidas($patologias_id);
            //print_r($tipo_alimento_restringidas);die;
            date_default_timezone_set("America/Santiago");
            $hoy = date("Y-m-j_h:i:s");
            $pdfFilePath = $rut."_".$hoy.".pdf";
            $html='<div style="position: absolute; top: 5mm; left: 175mm; width: 100mm;">

<img style="vertical-align: top" src="assets/img/logo/logo.png" width="80"/>

</div>';
            $html.=' <h1>Minuta Nutricional</h1><h4> Nutricionista: '.$paciente->nombre_nutri.' '.$paciente->apellido_nutri.'</h4>
<p><h5><label>Fecha:</label> '.date('d-m-Y').'</h5></p>
<p><h5><label>Paciente: </label>'.$paciente->nombre_paciente.' '.$paciente->apellido_paciente.'</h5>
<h5><label>Rut: </label>'.$paciente->rut.'</h5></p>
<table class="bpmTopnTail"><thead>
<tr class="headerrow"><th>Tiempos</th>
<td class="headerrow">Preparación</td>
<td class="headerrow">Alimentos</td>
</tr>
</thead><tbody>
<tr class="evenrow"><th>
<p>Desayuno</p>
</th>

<td>
<ul>';
$id_preparaciones_des=array();
$i=0;

foreach ($preparaciones as $preparacion) {
    if($preparacion->tipo=="desayuno"){
    $html.='
<li>'.$preparacion->nombre.'</li>'; 
foreach ($alimentos as $alimento) {
    if($alimento->id==$preparacion->idpreparacion){
    $html.='<br>';
    }
}
$html.='<hr>';
$id_preparaciones_des[$i]=$preparacion->idpreparacion;
$i++;    
    }
}
$html.='
</ul>
</td>
<td>
<ul>';
foreach($id_preparaciones_des as $i){
    foreach ($alimentos as $alimento) {
        if($alimento->id==$i){
        $html.='
        <li>'.$alimento->nombre.'('.$alimento->porcion.')'.'</li>';}
    }
$html.='<br><hr>';
}
$html.='
</ul>
</td>
</tr>
<tr class="evenrow">
    <th>Colación</th>
        <td>
            <ul>';
            $id_preparaciones_col1=array();
            $i=0;
            foreach ($preparaciones as $preparacion) {
                if($preparacion->tipo=="colacion_1"){
                $html.='
            <li>'.$preparacion->nombre.'</li>'; 
            foreach ($alimentos as $alimento) {
                if($alimento->id==$preparacion->idpreparacion){
                $html.='<br>';
                }
            }
            $html.='<hr>';
            $id_preparaciones_col1[$i]=$preparacion->idpreparacion;
            $i++;    
                }
            }
            $html.='
        </ul>
        </td>
        <td>
            <ul>';
            foreach($id_preparaciones_col1 as $i){
                foreach ($alimentos as $alimento) {
                    if($alimento->id==$i){
                    $html.='
                <li>'.$alimento->nombre.'('.$alimento->porcion.')'.'</li>';}
                }
            $html.='<br><hr>';
            }
            $html.='
            </ul>
        </td>
</tr>
<tr class="evenrow">
    <th>
        <p>Entrada</p>
    </th>
    <td>
        <ul>';
            $id_preparaciones_ent=array();
            $i=0;
            foreach ($preparaciones as $preparacion) {
                if($preparacion->tipo=="entrada"){
                $html.='
            <li>'.$preparacion->nombre.'</li>'; 
            foreach ($alimentos as $alimento) {
                if($alimento->id==$preparacion->idpreparacion){
                $html.='<br>';
                }
            }
            $html.='<hr>';
            $id_preparaciones_ent[$i]=$preparacion->idpreparacion;
            $i++;    
                }
            }
            $html.='
            </ul>
            </td>
            <td>
                <ul>';
                foreach($id_preparaciones_ent as $i){
                    foreach ($alimentos as $alimento) {
                        if($alimento->id==$i){
                        $html.='
                        <li>'.$alimento->nombre.'('.$alimento->porcion.')'.'</li>';}
                    }
                $html.='<br><hr>';
                }
                $html.='</ul>
            </td>
        </tr>
        <tr class="evenrow">
            <th>
                <p>Almuerzo</p>
            </th>
            <td>
                <ul>';
                $id_preparaciones_alm=array();
                $i=0;
                foreach ($preparaciones as $preparacion) {
                    if($preparacion->tipo=="almuerzo"){
                    $html.='
                <li>'.$preparacion->nombre.'</li>'; 
                foreach ($alimentos as $alimento) {
                    if($alimento->id==$preparacion->idpreparacion){
                    $html.='<br>';
                    }
                }
                $html.='<hr>';
                $id_preparaciones_alm[$i]=$preparacion->idpreparacion;
                $i++;    
                    }
                }
                $html.='
            </ul>
            </td>
            <td>
                <ul>';
                foreach($id_preparaciones_alm as $i){
                    foreach ($alimentos as $alimento) {
                        if($alimento->id==$i){
                        $html.='
                        <li>'.$alimento->nombre.'('.$alimento->porcion.')'.'</li>';}
                    }
                $html.='<br><hr>';
                }
                $html.='</ul>
            </td>
        </tr>
        <tr class="evenrow">
            <th>
                <p>Colación media tarde</p>
            </th>
            <td>
                <ul>';
                $id_preparaciones_col2=array();
                $i=0;
                foreach ($preparaciones as $preparacion) {
                    if($preparacion->tipo=="colacion_2"){
                    $html.='
                <li>'.$preparacion->nombre.'</li>'; 
                foreach ($alimentos as $alimento) {
                    if($alimento->id==$preparacion->idpreparacion){
                    $html.='<br>';
                    }
                }
                $html.='<hr>';
                $id_preparaciones_col2[$i]=$preparacion->idpreparacion;
                $i++;    
                    }
                }
                $html.='
            </ul>
            </td>
            <td>
                <ul>';
                foreach($id_preparaciones_col2 as $i){
                    foreach ($alimentos as $alimento) {
                        if($alimento->id==$i){
                        $html.='
                        <li>'.$alimento->nombre.'('.$alimento->porcion.')'.'</li>';}
                    }
                $html.='<br><hr>';
                }
                $html.='</ul>
            </td>
        </tr>
        <tr class="evenrow">
            <th>
                <p>Once</p>
            </th>
            <td>
                <ul>';
                $id_preparaciones_once=array();
                $i=0;
                foreach ($preparaciones as $preparacion) {
                    if($preparacion->tipo=="once"){
                    $html.='
                <li>'.$preparacion->nombre.'</li>'; 
                foreach ($alimentos as $alimento) {
                    if($alimento->id==$preparacion->idpreparacion){
                    $html.='<br>';
                    }
                }
                $html.='<hr>';
                $id_preparaciones_once[$i]=$preparacion->idpreparacion;
                $i++;    
                    }
                }
                $html.='
            </ul>
            </td>
            <td>
                <ul>';
                foreach($id_preparaciones_once as $i){
                    foreach ($alimentos as $alimento) {
                        if($alimento->id==$i){
                        $html.='
                        <li>'.$alimento->nombre.'('.$alimento->porcion.')'.'</li>';}
                    }
                $html.='<br><hr>';
                }
                $html.='</ul>
            </td>
        </tr>
        <tr class="evenrow">
            <th>
                <p>Cena</p>
            </th>
            <td>
                <ul>';
                $id_preparaciones_cena=array();
                $i=0;
                foreach ($preparaciones as $preparacion) {
                    if($preparacion->tipo=="cena"){
                    $html.='
                <li>'.$preparacion->nombre.'</li>'; 
                foreach ($alimentos as $alimento) {
                    if($alimento->id==$preparacion->idpreparacion){
                    $html.='<br>';
                    }
                }
                $html.='<hr>';
                $id_preparaciones_cena[$i]=$preparacion->idpreparacion;
                $i++;    
                    }
                }
                $html.='
            </ul>
            </td>
            <td>
            <ul>';
            foreach($id_preparaciones_cena as $i){
                foreach ($alimentos as $alimento) {
                    if($alimento->id==$i){
                    $html.='
                    <li>'.$alimento->nombre.'('.$alimento->porcion.')'.'</li>';}
                }
            $html.='<br><hr>';
            }
            $html.='</ul>
            </td>
        </tr>
        </tbody>
    </table>
        <p>&nbsp;</p>';
        $html.='<h4>Tipo de alimentos a evitar</h4>
        <table class="bpmTopnTail">
        <tbody><tr>
            <td>';foreach ($tipo_alimento_restringidas as $tipo) {
                $html.='-'.$tipo->nombre.'. ';
            }
            $html.='</tr>      
            </tbody>
        </table>';

        
        $html.='<h4>Consideraciones para patologias asociadas al paciente</h4>
        <table class="bpmTopnTail"><tbody>';
                foreach ($patologias as $pat) {
                $html.='<tr>
                <td>'.$pat->nombre.'</td>
                <td>
                <ul>
                <li>'.$pat->consideraciones.'</li>
                </ul>
                </td>
                </tr>';}
                
            $html.='</tbody>
        </table>';
    
            $estilos=file_get_contents("assets/css/mpdfstyletables.css");
            $mpdf = new mPDF('c');
            $mpdf->setDisplayMode('fullpage');
            $mpdf->WriteHTML($estilos,1);
            $mpdf->WriteHTML($html,2);
            $mpdf->Output($pdfFilePath, 'I');
            exit();
    }else{
            redirect(base_url()."registrar/salir");
        }
    }
}       