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
        $rut_paciente="";
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
public function editar_paciente($id=null){
    if(!$id){redirect(base_url()."error404/");}
    $datos=$this->datos_model->get_paciente_por_rut($this->uri->segment(3));
    if(sizeof($datos)==0){
        redirect(base_url()."error404/");
    }
    if($this->session->userdata("id")&&$this->uri->segment(3)){
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
    if($this->session->userdata("id")&&$this->uri->segment(3)){
        $datos=$this->datos_model->get_nutricionista_por_rut($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        if($this->input->post()){
        if(!$id){redirect(base_url()."error404/");}
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
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
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','se edito exitosamente su evaluación');
                    $this->session->set_flashdata('css_estado_nutri','warning');
                    $this->session->set_flashdata('estado_nutri','Respecto a la reciente modificación en la evaluación, el paciente se encuentra...');
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
            if($this->input->post()){
                if ($this->form_validation->run('add_alimento')) {
                    $data=array(
                    'nombre'=>$this->input->post('nombre_alimento',true),
                    'tipo'=>$this->input->post('tipo',true),
                    'aporte'=>$this->input->post('aporte',true),
                    'propiedades'=>$this->input->post('propiedades',true)
                    );
                    $this->datos_model->insertar_alimento($data);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                    redirect(base_url()."registrar/listado_alimentos");
                }
            }
            $this->load->view("registrar/add_alimento");
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
                    'nombre'=>$this->input->post('nombre',true)
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
            else{
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
        if(sizeof($alimento)==0){redirect(base_url()."error404/");}
        if($this->session->userdata("id")&&$this->uri->segment(3)){
            //print_r($alimento);die;
            if($this->input->post()){
            $data=array(
                "nombre"=>$this->input->post("nombre_alimento",true),
                "tipo"=>$this->input->post("tipo",true),
                "propiedades"=>$this->input->post("propiedades",true),
                "aporte"=>$this->input->post("aporte",true)
            );
            $this->datos_model->update_alimento($data,$id);
            $this->session->set_flashdata('css','success');
            $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
            redirect(base_url()."registrar/listado_alimentos");
             }else{
                $this->load->view("registrar/editar_alimento",compact('alimento'));
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
                "nombre"=>$this->input->post("nombre_patologia",true),
                "Grupo_patologico"=>$this->input->post("grupo",true),
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
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','se ingresó exitosamente su evaluación');
                    $this->session->set_flashdata('css_estado_nutri','warning');
                    $this->session->set_flashdata('estado_nutri','Respecto a la reciente evaluación, el paciente se encuentra...');
                    $this->datos_model->add_evaluacion($data);
                    redirect(base_url()."registrar/listado_evaluaciones/".$datos_paciente->rut);
                }       
            }
            $this->load->view("registrar/planilla_evaluacion",compact('datos_paciente'));
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
        //print_r(sizeof($patologias_asociadas));die;
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
    public function gestion(){
        if($this->session->userdata("id")){
            $this->load->view("registrar/gestion");
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function minuta($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos_paciente=$this->datos_model->get_paciente_por_rut($this->uri->segment(3));
        if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
        if(($this->session->userdata("id"))&& ($rut_paciente=$this->uri->segment(3))){
            $preparaciones=$this->datos_model->get_all_preparaciones();
            if($this->input->post()){
                    foreach($this->input->post('nombre_preparacion_d') as $prep){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$prep,
                                'opcion'=>'desayuno'
                                );
                            $this->datos_model->asociar_paciente_preparaciones($data);
                    }
                    foreach($this->input->post('nombre_preparacion_co') as $prep){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$prep,
                                'opcion'=>'colacion'
                                );
                            $this->datos_model->asociar_paciente_preparaciones($data);
                    }
                    foreach($this->input->post('nombre_preparacion_e') as $prep){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$prep,
                                'opcion'=>'entrada'
                                );
                            $this->datos_model->asociar_paciente_preparaciones($data);
                    }
                    foreach($this->input->post('nombre_preparacion_a') as $prep){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$prep,
                                'opcion'=>'almuerzo'
                                );
                            $this->datos_model->asociar_paciente_preparaciones($data);
                    }
                    foreach($this->input->post('nombre_preparacion_cmd') as $prep){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$prep,
                                'opcion'=>'colacion media tarde'
                                );
                            $this->datos_model->asociar_paciente_preparaciones($data);
                    }
                    foreach($this->input->post('nombre_preparacion_o') as $prep){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$prep,
                                'opcion'=>'once'
                                );
                            $this->datos_model->asociar_paciente_preparaciones($data);
                    }
                    foreach($this->input->post('nombre_preparacion_ce') as $prep){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$prep,
                                'opcion'=>'cena'
                                );
                            $this->datos_model->asociar_paciente_preparaciones($data);
                    }
                 redirect(base_url()."registrar/pdf/$rut_paciente");
            }
        $this->load->view("registrar/minuta",compact('preparaciones'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function pdf($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos_paciente=$this->datos_model->get_paciente_por_rut($this->uri->segment(3));
        if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
        if(($this->session->userdata("id"))&& ($rut_paciente=$this->uri->segment(3))){
            $paciente=$this->datos_model->get_paciente_por_rut($rut_paciente);
            date_default_timezone_set("America/Santiago");
            $hoy = date("Y-m-j_h:i:s");
            $pdfFilePath = $rut_paciente."_".$hoy.".pdf";
            $html='<div style="position: absolute; top: 5mm; left: 175mm; width: 100mm;">

<img style="vertical-align: top" src="assets/img/logo/logo.png" width="80"/>

</div>';
            $html.='<h1>Minuta Nutricional</h1>
<h5><label>Fecha: </label>'.date('d-m-Y').'</h5></p>
<p><h5><label>Paciente: </label>'.$paciente->nombre.' '.$paciente->apellido.'</h5></p>
<h5><label>Rut: </label>'.$paciente->rut.'</h5></p>
<table class="bpmTopnTail"><thead>
<tr class="headerrow"><th>Tiempos   </th>
<td class="pmhTopCenter">Preparación</td>
</tr>
</thead><tbody>
<tr class="evenrow"><th>
<p>Desayuno</p>
</th>

<td>
<ul>';
                    /*foreach ($preparaciones as $key => $preparacion) {
                        if($preparacion->tipo=="desayuno"){
                        $html.='
                    <li>'.$preparacion->nombre.'</li>';}}
                    $html.='
                </ul>
            </td>
        </tr>
        <tr class="evenrow">
            <th>Colación</th>
            <td>
            <ul>';
                foreach ($preparaciones as $key => $preparacion) {
                    if($preparacion->tipo=="colacion"){
                    $html.='
                <li>'.$preparacion->nombre.'</li>';}}
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
                    foreach ($preparaciones as $key => $preparacion) {
                        if($preparacion->tipo=="entrada"){
                        $html.='
                    <li>'.$preparacion->nombre.'</li>';}}
                    $html.='
                </ul>
            </td>
        </tr>
        <tr class="evenrow">
            <th>
                <p>Almuerzo</p>
            </th>
            <td>
                <ul>';
                    foreach ($preparaciones as $key => $preparacion) {
                        if($preparacion->tipo=="almuerzo"){
                        $html.='
                    <li>'.$preparacion->nombre.'</li>';}}
                    $html.='
                </ul>
            </td>
        </tr>
        <tr class="evenrow">
            <th>
                <p>Colación media tarde</p>
            </th>
            <td>
                <ul>';
                    foreach ($preparaciones as $key => $preparacion) {
                        if($preparacion->tipo=="colacion media tarde"){
                        $html.='
                    <li>'.$preparacion->nombre.'</li>';}}
                    $html.='
                </ul>
            </td>
        </tr>
        <tr class="evenrow">
            <th>
                <p>Once</p>
            </th>
            <td>
                <ul>';
                    foreach ($preparaciones as $key => $preparacion) {
                        if($preparacion->tipo=="once"){
                        $html.='
                    <li>'.$preparacion->nombre.'</li>';}}
                    $html.='
                </ul>
            </td>
        </tr>
        <tr class="evenrow">
            <th>
                <p>Cena</p>
            </th>
            <td>
                <ul>';
                    foreach ($preparaciones as $key => $preparacion) {
                        if($preparacion->tipo=="cena"){
                        $html.='
                    <li>'.$preparacion->nombre.'</li>';}}
                    $html.='
                </ul>
            </td>
        </tr>
        </tbody>
    </table>
        <p>&nbsp;</p>';
        $html.='<h4>Restriciones de Alimentos</h4>
        <table class="bpmTopnTail"><tbody>
        <tr>
        <td>Preferir</td>
        <td>
        <ul>';
        foreach ($alimentos as $key => $alimento) {
            if($alimento->pref==1){
            $html.='
        <li>'.$alimento->nombre.'</li>';}}
        $html.='
        </ul>
        </td>
        </tr>
        <tr>
        <td>Prevenir</td>
        <td>
        <ul>';
        foreach ($alimentos as $key => $alimento) {
            if($alimento->prev==1){
            $html.='
        <li>'.$alimento->nombre.'</li>';}}
        $html.='
        </ul>
        </td>
        </tr>
        <tr>
        <td>Evitar</td>
        <td>
        <ul>';
        foreach ($alimentos as $key => $alimento) {
            if($alimento->evi==1){
            $html.='
        <li>'.$alimento->nombre.'</li>';}}
        $html.=*/
        $html.='</ul>
        </td>
        </tr>
    </tbody>
</table>';
    
            $estilos=file_get_contents(base_url()."assets/css/mpdfstyletables.css");
            $mpdf = new mPDF('c');
            $mpdf->setDisplayMode('fullpage');
            $mpdf->WriteHTML($estilos,1);
            $mpdf->WriteHTML($html,2);
            $mpdf->SetProtection(array(), 'nutricion', 'nutricion');
            $mpdf->Output();
            exit();
    }else{
            redirect(base_url()."registrar/salir");
        }
    }
}       