<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Registrar extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
    
	public function add()
	{
    if($this->session->userdata("id")){
            $rut_paciente="";
        if($this->input->post()){
            if ($this->form_validation->run('add_formulario')) {
                if ($this->input->post('email')==$this->input->post('email2')) {
                    if (valida_rut(trim($this->input->post('rut_paciente')))) {
                    if (valida_fecha($this->input->post('fecha_nacimiento_pac'))) {
                    $consultar_correo=$this->datos_model->consulta_correo($this->input->post('email'));   
                    if (sizeof($consultar_correo)==0) {
                        $usuario=strtolower(substr(trim($this->input->post('nombre',true)), 0, 1).trim($this->input->post('apellido',true)));
                        $consultar_usuario=$this->datos_model->consulta_usuario($usuario);
                        if (sizeof($consultar_usuario)!=0) {
                               $usuario=$usuario."_";
                        }   
                        $data=array(
                        'rut_paciente'=>trim($this->input->post('rut_paciente',true)),
                        'nombres'=>trim($this->input->post('nombre',true)),
                        'apellidos'=>trim($this->input->post('apellido',true)),
                        'email'=>$this->input->post('email',true),
                        'sexo'=>$this->input->post('sexo',true),
                        'usuario'=>$usuario,
                        'fecha_nacimiento'=>$this->input->post('fecha_nacimiento_pac',true)
                    );
                    $this->datos_model->insertar_paciente($data);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                    $rut_paciente=trim($this->input->post('rut_paciente'));
                    $rut_paciente=trim($this->input->post('rut_paciente',true));
                    //$this->load->view("registrar/planilla_evaluacion",compact('ultimo'));
                    redirect(base_url()."registrar/asignar_pat_hab/$rut_paciente");
                    }
                    else{
                        $this->session->set_flashdata('css','danger');
                        $this->session->set_flashdata('mensaje','Ya existe un registro con esta dirección de correo');
                        redirect(base_url()."registrar/add");
                    }
                }else{
                    $this->session->set_flashdata('css','danger');
                    $this->session->set_flashdata('mensaje','fecha no válida');
                }
                
                }else{
                    $this->session->set_flashdata('css','danger');
                    $this->session->set_flashdata('mensaje','Rut no válido');
                }
                }else{
                    $this->session->set_flashdata('css','danger');
                    $this->session->set_flashdata('mensaje','los correos ingresados no coinsiden');
                }

            }
        }
        $this->load->view('registrar/add');
    }else{
        redirect(base_url()."registrar/salir");
    }
        
}   
    public function listado_pat_hab()
    {
        if($this->session->userdata("id")){
        //zona de configuración inicial
        if($this->uri->segment(3))
        {
            $pagina=$this->uri->segment(3);
        }else
        {
            $pagina=0;
        }
        $porpagina=4;
        //zona de carga de los datos
        $datos=$this->datos_model->getTodosPaginacion_pat_hab($pagina,$porpagina,"limit");
        $cuantos=$this->datos_model->getTodosPaginacion_pat_hab($pagina,$porpagina,"cuantos");           //zona de configuración de la librería pagination
        $config['base_url']=base_url()."registrar/listado_pat_hab";
        $config['total_rows']=$cuantos;
        $config['per_page']=$porpagina;
        $config['uri_segment']='3';
        $config['num_links']='4';
        $config['first_link']='Primero';
        $config['next_link']='Siguiente';
        $config['prev_link']='Anterior';
        $config['last_link']='Última';
        
        $config['full_tag_open']='<ul class="pagination">';
        
       
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';    
        $config['full_tag_close']='</ul>';
        $this->pagination->initialize($config);
        $this->load->view("registrar/listado_pat_hab",compact('datos','cuantos','pagina'));
    }else{
    redirect(base_url()."registrar/salir");
    }
    }
    public function login(){

        if($this->input->post()){
            if ($this->form_validation->run('login_formulario')) {
                $data=$this->datos_model->get_user($this->input->post('user',true),$this->input->post('clave',true)); 
                //print_r($data); die("bandmera");
                if (sizeof($data)==0) {
                    $this->session->set_flashdata('css','danger');
                    $this->session->set_flashdata('mensaje_login','los datos no coinsiden');
                    redirect(base_url()."registrar/login");                   
                }else{   
                    $this->session->set_userdata("datos_usuario");
                    $this->session->set_userdata("id",$data->id);
                    $this->session->set_userdata("nombre",$data->nombre);
                    $this->session->set_userdata("apellido",$data->apellido);
                    $this->session->set_userdata("correo",$data->email);
                    $this->session->set_userdata("admin",$data->admin); 
                    redirect(base_url()."registrar/administrar");
                } 
        }
    }
    $this->load->view('registrar/login');
    }

    public function add_pat_hab(){
        if($this->session->userdata("id")){
            if($this->input->post()){
                if ($this->form_validation->run('add_pat_hab')) {
                    $data=array(
                    'nombre'=>$this->input->post('nombre_pat_hab',true),
                    'tipo'=>$this->input->post('tipo',true)
                    );
                    $this->datos_model->insertar_pat_hab($data);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                    redirect(base_url()."registrar/listado_pat_hab");
                }
            }
            $this->load->view("registrar/add_pat_hab");
        }
        else{
            redirect(base_url()."registrar/salir");
        }
    }
     public function add_alimento(){
        if($this->session->userdata("id")){
            if($this->input->post()){
                if ($this->form_validation->run('add_alimento')) {
                    $data=array(
                    'alimento_info'=>$this->input->post('alimento_info',true),
                    'opcion'=>$this->input->post('opcion',true)
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
        if ($this->session->userdata('admin')==1) {
                $pacientes=$this->datos_model->get_all_pacientes();
                $this->load->view('registrar/administrar',compact("pacientes"));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function eliminar_pat_hab($id=null)
    {
        if(!$id){show_404();}
        $datos=$this->datos_model->get_pat_hab_id($id);
        if(sizeof($datos)==0){show_404();}
        $result=$this->datos_model->delete_pat_hab($id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
        redirect(base_url()."registrar/listado_pat_hab");
    }
    public function eliminar_alimento($id=null)
    {
        if(!$id){show_404();}
        $datos=$this->datos_model->get_alimento_id($id);
        if(sizeof($datos)==0){show_404();}
        $error=$this->datos_model->delete_alimento($id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
        redirect(base_url()."registrar/listado_alimentos");
    }
    public function eliminar_preparacion($id=null)
    {
        if(!$id){show_404();}
        $datos=$this->datos_model->get_preparacion_id($id);
        if(sizeof($datos)==0){show_404();}
        $this->datos_model->delete_preparacion($id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
        redirect(base_url()."registrar/listado_preparaciones");
    }
    public function editar_pat_hab($id){
        if($this->session->userdata("id")&&$this->uri->segment(3)){
            $datos=$this->datos_model->get_pat_hab_id($id);
            if($this->input->post()){
            if(!$id){show_404();}
            if(sizeof($datos)==0){show_404();}
            $data=array(
                "nombre"=>$this->input->post("nombre_pat_hab",true),
                "tipo"=>$this->input->post("tipo",true)
            );
            $this->datos_model->update_pat_hab($data,$id);
            $this->session->set_flashdata('css','success');
            $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
            redirect(base_url()."registrar/listado_pat_hab");
             }else{
                $this->load->view("registrar/editar_pat_hab",compact('datos'));
            }
        }else{
            redirect(base_url().'registrar/salir');
        }
    }
    public function editar_alimento($id){
        if($this->session->userdata("id")&&$this->uri->segment(3)){
            $alimento=$this->datos_model->get_alimento_id($id);
            if($this->input->post()){
            if(!$id){show_404();}
            if(sizeof($alimento)==0){show_404();}
            $data=array(
                "alimento_info"=>$this->input->post("nombre_alimento",true),
                "opcion"=>$this->input->post("opcion",true)
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
    public function editar_preparacion($id){
        if($this->session->userdata("id")&&$this->uri->segment(3)){
            $preparacion=$this->datos_model->get_preparacion_id($id);
            if($this->input->post()){
            if(!$id){show_404();}
            if(sizeof($preparacion)==0){show_404();}
            $data=array(
                "nombre"=>$this->input->post("nombre_preparacion",true),
                "tipo"=>$this->input->post("tipo",true)
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
    public function asignar_pat_hab(){
        if($this->session->userdata("id")){
            if($rut_paciente=$this->uri->segment(3)){
                $lista_patologias=$this->datos_model->get_patologias();
                $lista_habitos=$this->datos_model->get_habitos();
                if($this->input->post('nombre_habito') || $this->input->post('nombre_patologia') || $this->input->post('ficha_clinica')){
                    if($this->input->post('nombre_habito')){
                        foreach($this->input->post('nombre_habito') as $hab){
                            $data=array('id_paciente'=>$rut_paciente,
                                'id_pat_hab'=>$hab);
                            $this->datos_model->asociat_pat_hab_paciente($data);
                        }
                    }
                    if($this->input->post('nombre_patologia')){
                        foreach($this->input->post('nombre_patologia') as $pat){
                            $data=array('id_paciente'=>$rut_paciente,
                                'id_pat_hab'=>$pat);
                            $this->datos_model->asociat_pat_hab_paciente($data);
                        }
                    }
                    if($this->input->post('ficha_clinica')){
                        $data_ficha=array('ficha'=>$this->input->post('ficha_clinica',true),
                            'rut_paciente'=>$rut_paciente);
                        $this->datos_model->add_ficha_clinica($data_ficha);
                    }
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','Asignación exitosa, proceda a realizar evaluación');
                    redirect(base_url()."registrar/planilla_evaluacion/$rut_paciente");
                }else{
                    $this->load->view("registrar/asignar_pat_hab",compact('lista_habitos','lista_patologias'));
                }
            }else{
                redirect(base_url()."registrar/salir");
            }
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function planilla_evaluacion(){
        if(($this->session->userdata("id")) && ($rut_paciente=$this->uri->segment(3))){
            $datos_paciente=$this->datos_model->get_paciente_por_rut($this->uri->segment(3));
            //print_r($datos_paciente);exit;
            if($this->input->post()){
                if ($this->form_validation->run('add_evaluacion')){
                    if (($this->input->post('num_control'))&&($this->input->post('rut_pacientr'))) {
                    $ultimo=$this->input->post('rut_pacientr');
                    $num_control=$this->input->post('num_control');
                    $datos_paciente=$this->datos_model->get_paciente_por_rut($ultimo);                            
                    }else{
                        $num_control=1;
                    }
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
                        "4pliegues_paciente"=>$this->input->post('4pliegues'),
                        "grasa_durnin_paciente"=>$this->input->post('grasa_durnin'),
                        "masa_adiposa_paciente"=>$this->input->post('masa_adiposa'),
"masa_sin_grasa_paciente"=>$this->input->post('masa_sin_grasa'),
                        "masa_muscular_paciente"=>$this->input->post('masa_muscular'),
                        "6pliegues_paciente"=>$this->input->post('6pliegues'),
                        "control"=>$num_control,
                        "rut_paciente_fk"=>$datos_paciente->rut_paciente);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','se ingresó exitosamente su evaluación');
                    $this->datos_model->add_evaluacion($data);
                    redirect(base_url()."registrar/revision_examenes/$rut_paciente");
                }       
            }
            $this->load->view("registrar/planilla_evaluacion",compact('datos_paciente'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function revision_examenes(){
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
    public function listado_alimentos(){
        if($this->session->userdata("id")){
        //zona de configuración inicial
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
                $pagina=0;
            }
            $porpagina=4;
            //zona de carga de los datos
            $alimentos=$this->datos_model->getTodosPaginacion_alimentos($pagina,$porpagina,"limit");
            $cuantos=$this->datos_model->getTodosPaginacion_alimentos($pagina,$porpagina,"cuantos");           //zona de configuración de la librería pagination
            $config['base_url']=base_url()."registrar/listado_alimentos";
            $config['total_rows']=$cuantos;
            $config['per_page']=$porpagina;
            $config['uri_segment']='3';
            $config['num_links']='4';
            $config['first_link']='Primero';
            $config['next_link']='Siguiente';
            $config['prev_link']='Anterior';
            $config['last_link']='Última';
        
            $config['full_tag_open']='<ul class="pagination">';
        
       
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';    
            $config['full_tag_close']='</ul>';
            $this->pagination->initialize($config);
            $this->load->view("registrar/listado_alimentos",compact('alimentos','cuantos','pagina'));
        }else{
        redirect(base_url()."registrar/salir");
        }
    }
    public function listado_preparaciones(){
        if($this->session->userdata("id")){
        //zona de configuración inicial
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
                $pagina=0;
            }
            $porpagina=4;
            //zona de carga de los datos
            $preparaciones=$this->datos_model->getTodosPaginacion_preparaciones($pagina,$porpagina,"limit");
            $cuantos=$this->datos_model->getTodosPaginacion_preparaciones($pagina,$porpagina,"cuantos");           //zona de configuración de la librería pagination
            $config['base_url']=base_url()."registrar/listado_preparaciones";
            $config['total_rows']=$cuantos;
            $config['per_page']=$porpagina;
            $config['uri_segment']='3';
            $config['num_links']='4';
            $config['first_link']='Primero';
            $config['next_link']='Siguiente';
            $config['prev_link']='Anterior';
            $config['last_link']='Última';
        
            $config['full_tag_open']='<ul class="pagination">';
        
       
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';    
            $config['full_tag_close']='</ul>';
            $this->pagination->initialize($config);
            $this->load->view("registrar/listado_preparaciones",compact('preparaciones','cuantos','pagina'));
        }else{
        redirect(base_url()."registrar/salir");
        }
    }
    public function gestion(){
        if($this->session->userdata("id")){
            $this->load->view("registrar/gestion");
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function minuta(){
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
    public function pdf(){
        if(($this->session->userdata("id"))&& ($rut_paciente=$this->uri->segment(3))){
            $paciente=$this->datos_model->get_paciente_por_rut($rut_paciente);
            $preparaciones=$this->datos_model->get_preparaciones_pot_rut($rut_paciente);
            $alimentos=$this->datos_model->get_alimentos_por_rut($rut_paciente);
            $hoy = date("dmyhis");
            $pdfFilePath = $rut_paciente."_".$hoy.".pdf";
            $html='<div style="position: absolute; top: 5mm; left: 175mm; width: 100mm;">

<img style="vertical-align: top" src="assets/img/logo/logo.png" width="80"/>

</div>';
            $html.='<h1>Minuta Nutricional</h1>
<p><h5><label>Paciente: </label>'.$paciente->nombres.' '.$paciente->apellidos.'</h5></p>
<h5><label>Rut: </label>'.$paciente->rut_paciente.'</h5></p>
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
foreach ($preparaciones as $key => $preparacion) {
    if($preparacion->tipo=="desayuno"){
    $html.='
<li>'.$preparacion->nombre.'</li>';}}
$html.='
</ul>
</td>
</tr>
<tr class="evenrow"><th>Colación</th>
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
<tr class="evenrow"><th>
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
<tr class="evenrow"><th>
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
<tr class="evenrow"><th>
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
<tr class="evenrow"><th>
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
<tr class="evenrow"><th>
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
</tbody></table>
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
$html.='
</ul>
</td>
</tr>
</tbody></table>';
    
            $estilos=file_get_contents(base_url()."assets/css/mpdfstyletables.css");
            $this->load->library('M_pdf');
            $mpdf = new mPDF('c');
            $mpdf->setDisplayMode('fullpage');
            $mpdf->WriteHTML($estilos,1);
            $mpdf->WriteHTML($html,2);
            $mpdf->SetProtection(array(), 'kakito', 'kakito');
            $mpdf->Output($pdfFilePath, 'I');
            exit();
    }else{
            redirect(base_url()."registrar/salir");
        }
    }
}       
