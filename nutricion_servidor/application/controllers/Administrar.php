<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    class Administrar extends CI_Controller 
    {
        public function __construct()
        {
            parent::__construct();
        }
        /*public function inicio(){
            $this->load->view('administrar/inicio');
        } */
    
        public function login(){

            if($this->input->post()){
                if ($this->form_validation->run('login_formulario')) {
                    $data_user=$this->datos_model->get_user_nutri($this->input->post('user',true),$this->input->post('clave',true)); 
                    $data_user_paciente=$this->datos_model->get_user_paciente($this->input->post('user',true),$this->input->post('clave',true)); 
                    $data_admin=$this->datos_model->get_user_admin($this->input->post('user',true),$this->input->post('clave',true)); 
                    if ((sizeof($data_user)==0) && (sizeof($data_user_paciente)==0)&&(sizeof($data_admin)==0)){                  
                            $this->session->set_flashdata('css','danger');
                            $this->session->set_flashdata('mensaje_login','los datos no coinciden');
                            redirect(base_url()."administrar/login");                
                    }else{
                        if(sizeof($data_user_paciente)>0){
                            $this->session->set_userdata("datos_usuario");
                            $this->session->set_userdata("rut",$data_user_paciente->rut);
                            $this->session->set_userdata("nombre",$data_user_paciente->nombre);
                            $this->session->set_userdata("sexo",$data_user_paciente->sexo); 
                        redirect(base_url()."paciente/documentos/");
                        }
                        else if (sizeof($data_user)>0){
                        $data=$this->datos_model->get_sesiones_activas($data_user->rut);
                        $data_insert=array(
                            'rut'=>$data_user->rut,
                            'estado'=>'1'
                        );
                        $id_sesion=$this->datos_model->insert_sesion($data_insert);
                        $this->session->set_userdata($id_sesion);
                        $this->session->set_userdata("id",$data_user->rut);
                        $this->session->set_userdata("nombre",$data_user->Nombres);
                        $this->session->set_userdata("sexo",$data_user->sexo);
                        $this->session->set_userdata("tipo",$data_user->tipo);  
                        redirect(base_url()."administrar/administrar/");
                        } 
                        else{
                            $this->session->set_userdata("admin",$data_admin->rut);
                            redirect(base_url()."administrador/crear_usuario/");
                        }
                    }
                }
            }
            $this->load->view('nutricionista/login');
        }
        public function salir(){
            $this->session->sess_destroy("datos_usuario");
            redirect(base_url()."administrar/login");
        }

        public function administrar(){
            if ($this->session->userdata("id")) {
                $nutri_nombre=$this->session->userdata("nombre");
                $nutri_sexo=$this->session->userdata("sexo");
                $this->load->view('administrar/administrar',compact('nutri_nombre','nutri_sexo'));
            }else{
                redirect(base_url()."administrar/salir");
            }
        }

        public function gestion(){
            if($this->session->userdata("id")){
                $this->load->view("administrar/gestion");
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function email(){
            $this->email->from("nutricion@ejemplo.com",'dagoberto rubilar');
            $this->email->to("drubilard@gmail.com");
            $this->email->subject("test email");
            $this->email->message("prueba de correo sistema de nutriciónosss");
            if($this->email->send()){
                echo "enviado..";
            }
            else{
                echo "no se envio";
            }
        }
        
        
    }      
?> 