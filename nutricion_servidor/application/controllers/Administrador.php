<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    class Administrador extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
        }
        public function crear_usuario(){
            if($this->session->userdata('admin')){
                $this->load->view("administrador/crear_usuario");
            }else{
                redirect(base_url()."administrar/salir");
            }
            
        }
        public function add_nutricionista(){
            if($this->session->userdata('admin')){
                if($this->input->post()){
                    if ($this->form_validation->run('add_nutricionista')) {
                        if ($this->input->post('contrasena')==$this->input->post('contrasena_2')) {
                            $existe_rut=$this->datos_model->consultar_rut($this->input->post('rut'));
                            if (valida_rut(trim($this->input->post('rut'))) || sizeof($existe_rut->rut)==0) {
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
                                        $rut_paciente=trim($this->input->post('rut',true));
                                        redirect(base_url()."administrar/administrar");
                                    }
                                    else{
                                        $this->session->set_flashdata('css','danger');
                                        $this->session->set_flashdata('mensaje','Ya existe un registro con este nombre de usuario');
                                        redirect(base_url()."nutricionista/add_nutricionista");
                                    }
                            }else{
                                $this->session->set_flashdata('css','danger');
                                $this->session->set_flashdata('mensaje','El rut no es válido o ya se encuentra registrado.');
                            }
                        }else{
                            $this->session->set_flashdata('css','danger');
                            $this->session->set_flashdata('mensaje','las contraseñas no coinciden');
                        }
                    }  
                }
                $this->load->view('administrador/add_nutricionista');
            }else{
                $this->redirect(base_url().'salir');
            }
    }  
    
    }?>