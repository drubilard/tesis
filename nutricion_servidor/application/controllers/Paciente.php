<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    class Paciente extends CI_Controller 
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function documentos($id=null){
            if($rut=$this->session->userdata('rut') && $this->uri->segment('3')==null){
                $this->load->view('paciente/documentos',compact('rut'));
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function add_paciente(){
            if($this->session->userdata("id")){
                    //$rut_paciente="";
                if($this->input->post()){
                    if ($this->form_validation->run('add_paciente')) {
                        if (valida_rut(trim($this->input->post('rut')))) {
                            $consulta_rut=$this->datos_model->consultar_rut_paciente($this->input->post('rut'));
                            if(sizeof($consulta_rut)==0){
                                $six_digit_random_number = mt_rand(100000, 999999);
                                //print_r($this->input->post('fecha_nacimiento_p'));
                                //print_r(date('Y-m-d'));die;
                                if (valida_fecha($this->input->post('fecha_nacimiento_p'))) {  
                                    $data=array(
                                    'rut'=>trim($this->input->post('rut',true)),
                                    'nombre'=>trim($this->input->post('nombre_paciente',true)),
                                    'apellido'=>trim($this->input->post('apellido_paciente',true)),
                                    'sexo'=>$this->input->post('sexo',true),
                                    'fecha_nacimiento'=>$this->input->post('fecha_nacimiento_p',true),
                                    'correo'=>$this->input->post('correo',true),
                                    'Nutricionista_rut'=>$this->session->userdata("id"),
                                    'clave'=>$six_digit_random_number
                                );
                                $this->datos_model->insertar_paciente($data);
                                $mi_archivo = 'mi_archivo';
                                $config['upload_path'] = "uploads/";
                                $config['file_name'] = $this->input->post('rut');
                                $config['allowed_types'] = "*";
                                $config['max_size'] = "50000";
                                $config['max_width'] = "2000";
                                $config['max_height'] = "2000";

                                $this->load->library('upload', $config);
                                
                                if (!$this->upload->do_upload($mi_archivo)) {
                                    //*** ocurrio un error
                                    $data['uploadError'] = $this->upload->display_errors();
                                    echo $this->upload->display_errors();
                                    die;
                                }
                                $data['uploadSuccess'] = $this->upload->data();
                                $this->session->set_flashdata('css','success');
                                $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                                //$rut_paciente=trim($this->input->post('rut_paciente',true));
                                $this->email->from("noreplay@nutricion.com",'Sistema de Nutrición');
                                $this->email->to($this->input->post('correo',true));
                                $this->email->subject("test email");
                                $this->email->message("Su clave para acceder a sus documentos de nutrición es <strong>".$six_digit_random_number."</strong>");
                                if($this->email->send()){
                                    echo("enviado..");
                                }else{

                                    echo("error");
                                }
                                //$this->load->view("paciente/planilla_evaluacion",compact('ultimo'));
                                redirect(base_url()."paciente/listado_pacientes/");
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
                $this->load->view('paciente/add_paciente');
            }else{
                redirect(base_url()."administrar/salir");
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
                    if ($this->form_validation->run('editar_paciente')) {
                        if(valida_fecha($this->input->post('fecha_nacimiento_p'))){
                            $data=array(
                                "nombre"=>$this->input->post("nombre_paciente",true),
                                "apellido"=>$this->input->post("apellido_paciente",true),
                                "fecha_nacimiento"=>$this->input->post("fecha_nacimiento_p",true),
                                "sexo"=>$this->input->post("sexo",true),
                            );
                            $this->datos_model->update_paciente($data,$id);
                            $this->session->set_flashdata('css','success');
                            $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
                            redirect(base_url()."paciente/listado_pacientes");
                        }else{
                            $this->session->set_flashdata('css','danger');
                            $this->session->set_flashdata('mensaje','Fecha de nacimiento no válida');
                            redirect(base_url()."paciente/editar_paciente/".$datos->rut);
                        }
                    }
                 }
                    $this->load->view("paciente/editar_paciente",compact('datos'));
            }else{
                redirect(base_url().'administrar/salir');
            }
        
        }
        public function eliminar_paciente($id=null){
            if(!$id){redirect(base_url()."error404/");}
                $datos=$this->datos_model->get_paciente_por_rut($id);
                if(sizeof($datos)==0){redirect(base_url()."error404/");}
                $result=$this->datos_model->delete_paciente($id);
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
                redirect(base_url()."paciente/listado_pacientes");
        }
        public function nueva_ficha($id=null){
            if(!$id){redirect(base_url()."error404/");}
            $datos=$this->datos_model->get_paciente_por_rut($id);
            if(sizeof($datos)==0){redirect(base_url()."error404/");}
            if($this->session->userdata("id")){
                if($this->input->post()){
                    if(valida_fecha($this->input->post('fecha',true))){
                        if ($this->form_validation->run('nueva_ficha')) {
                            $data=array(
                                'fecha'=>$this->input->post('fecha',true),
                                'informacion'=>$this->input->post('info',true),
                                'rut'=>$datos->rut
                            );
                            $this->datos_model->insertar_ficha($data);
                            $this->session->set_flashdata('css','success');
                            $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                            redirect(base_url()."paciente/listado_pacientes");
                        }
                    }
                    else{
                        $this->session->set_flashdata('css','danger');
                            $this->session->set_flashdata('mensaje','Fecha no válida');
                            redirect(base_url()."paciente/nueva_ficha/".$datos->rut);
                    }
                }
                $this->load->view("paciente/nueva_ficha",compact('datos'));
            }
            else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function ficha_clinica($id=null){
            if(!$id){redirect(base_url()."error404/");}
            $datos=$this->datos_model->get_paciente_por_rut($id);
            if(sizeof($datos)==0){redirect(base_url()."error404/");}
            if ($this->session->userdata("id")&&($rut_paciente=$this->uri->segment(3))) {
                $this->load->view('paciente/ficha_clinica',compact('rut_paciente'));
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function listado_fichas($id=null){
            if(!$id){redirect(base_url()."error404/");}
            $datos=$this->datos_model->get_paciente_por_rut($id);
            if(sizeof($datos)==0){redirect(base_url()."error404/");}
            if ($this->session->userdata("id")&&($rut_paciente=$this->uri->segment(3))){
                $datos_paciente=$this->datos_model->get_paciente_por_rut($rut_paciente);
                $this->load->view('paciente/listado_fichas',compact('datos_paciente'));
            }else{
                redirect(base_url()."administrar/salir");
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
        public function editar_ficha($id=null){
            if(!$id){redirect(base_url()."error404/");}
            $ficha=$this->datos_model->get_ficha_id($id);
            $datos=$this->datos_model->get_paciente_por_rut($ficha->rut);
            //print_r($datos);die;
            if(sizeof($ficha)==0){redirect(base_url()."error404/");}
            if($this->session->userdata("id")&&$this->uri->segment(3)){
                //print_r($alimento);die;
                if($this->input->post()){
                    if(valida_fecha($this->input->post('fecha',true))){
                        $data=array(
                            'fecha'=>$this->input->post('fecha',true),
                            'informacion'=>$this->input->post('informacion',true)
                        );
                        $this->datos_model->update_ficha($data,$id);
                        $this->session->set_flashdata('css','success');
                        $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
                        redirect(base_url()."paciente/listado_fichas/".$datos->rut);
                    }
                    else{
                        $this->session->set_flashdata('css','danger');
                        $this->session->set_flashdata('mensaje','Fecha no válida');
                        redirect(base_url()."paciente/nueva_ficha/".$datos->rut);
                    }
                }else{
                $this->load->view("paciente/editar_ficha",compact('ficha','datos'));
                }
            }else{
                redirect(base_url().'administrar/salir');
            }
        }
        public function eliminar_ficha($id=null){
            if(!$id){redirect(base_url()."error404/");}
                $datos=$this->datos_model->get_ficha_id($id);
                if(sizeof($datos)==0){redirect(base_url()."error404/");}
                $result=$this->datos_model->delete_ficha($id);
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
                redirect(base_url()."paciente/listado_fichas/".$datos->rut);
        }
        public function listado_pacientes(){
            if($this->session->userdata("id")){
                $this->load->view("paciente/listado_pacientes");
            }else{
            redirect(base_url()."administrar/salir");
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
        public function informe_paciente(){
            if ($this->session->userdata("rut")){
                $datos_paciente=$this->datos_model->get_paciente_por_rut($this->session->userdata("rut"));
            if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
                if($this->input->post("base64_1")){
                    $img = $this->input->post('base64_1');
                    $img = str_replace('data:image/octet-stream;base64,', '', $img);
                    $fileData = base64_decode($img);
                    $fileName = uniqid().'.png';
                    //print_r(dirname(__FILE__));die;
                    $this->load->helper('download');
                    force_download($fileName, $fileData);
                    //$ruta= '/Applications/XAMPP/xamppfiles/htdocs/nutricion/graficos'.'/'.$fileName;
                    //print_r($fileData);die;
                    //file_put_contents($ruta, $fileData);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','Gráfico almacenado correctamente');
                    redirect(base_url()."reporte/listado_pacientes");
                }else
                if($this->input->post("base64_2")){
                    $img = $this->input->post('base64_2');
                    $img = str_replace('data:image/octet-stream;base64,', '', $img);
                    $fileData = base64_decode($img);
                    $fileName = uniqid().'.png';
                    $this->load->helper('download');
                    force_download($fileName, $fileData);
                    //$ruta= '/Applications/XAMPP/xamppfiles/htdocs/nutricion/graficos'.'/'.$fileName;
                    //echo $ruta;die;
                    //file_put_contents($ruta, $fileData);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','Gráfico almacenado correctamente');
                    redirect(base_url()."reporte/listado_pacientes");
                }else
                if($this->input->post("base64_3")){
                    $img = $this->input->post('base64_3');
                    $img = str_replace('data:image/octet-stream;base64,', '', $img);
                    $fileData = base64_decode($img);
                    $fileName = uniqid().'.png';
                    $this->load->helper('download');
                    force_download($fileName, $fileData);
                    //$ruta= '/Applications/XAMPP/xamppfiles/htdocs/nutricion/graficos'.'/'.$fileName;
                    //echo $ruta;die;
                    //file_put_contents($ruta, $fileData);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','Gráfico almacenado correctamente');
                    redirect(base_url()."reporte/listado_pacientes");
                }
                else
                if($this->input->post("base64_4")){
                    $img = $this->input->post('base64_4');
                    $img = str_replace('data:image/octet-stream;base64,', '', $img);
                    $fileData = base64_decode($img);
                    $fileName = uniqid().'.png';
                    $this->load->helper('download');
                    force_download($fileName, $fileData);
                    //$ruta= '/Applications/XAMPP/xamppfiles/htdocs/nutricion/graficos'.'/'.$fileName;
                    //echo $ruta;die;
                    //file_put_contents($ruta, $fileData);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','Gráfico almacenado correctamente');
                    redirect(base_url()."reporte/listado_pacientes");
                }
                else {
                    $this->load->view('reporte/informe_paciente',compact('datos_paciente'));
                }
            }else{
                redirect(base_url()."administrar/salir");
            }
        }

        public function listado_minutas(){
            if ($this->session->userdata("rut")){
                $datos=$this->datos_model->get_paciente_por_rut($this->session->userdata("rut"));
                if(sizeof($datos)==0){redirect(base_url()."error404/");}
                $this->load->view('minuta/listado_minutas',compact('datos'));
            }else{
                redirect(base_url()."administrar/salir");
            }
        }

        public function listado_evaluaciones(){
            if ($this->session->userdata("rut")){
                $datos_paciente=$this->datos_model->get_paciente_por_rut($this->session->userdata("rut"));
                if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
                $this->load->view('evaluacion/listado_evaluaciones',compact('datos_paciente'));
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
    } 

?>