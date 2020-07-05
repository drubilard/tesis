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
                            //print_r($existe_rut);die();
                            if (valida_rut(trim($this->input->post('rut'))) && sizeof($existe_rut)==0) {
                                $consultar_usuario=$this->datos_model->consulta_usuario($this->input->post('usuario'));   
                                    if (sizeof($consultar_usuario)==0) {
                                        $data=array(
                                        'rut'=>trim($this->input->post('rut',true)),
                                        'Nombres'=>trim($this->input->post('nombre',true)),
                                        'Apellidos'=>trim($this->input->post('apellido',true)),
                                        'sexo'=>$this->input->post('sexo',true),
                                        'correo'=>$this->input->post('correo',true),
                                        'usuario'=>$this->input->post('usuario',true),
                                        'clave'=>sha1($this->input->post('contrasena',true)),
                                        'estado'=>"0");
                                        //print_r($data);die();
                                        $this->datos_model->insertar_nutricionista($data);
                                        $this->email->from("noreplay@nutricion.com",'Sistema de Nutrición');
                                        $this->email->to($this->input->post('correo',true));
                                        $this->email->subject("Creación Cuenta Nutricionista");
                                        $this->email->message('<!DOCTYPE html>
<html>
  <body style="background-color: #f5f5f5;">
   <table cellspacing="0" cellpadding="0" align="center">
           <tr>
              <td bgcolor="#f59c1a"  style="height: 39px;width: 102px;">
                <img src="'.base_url().'assets/img/logo/logo.png" style="top: 100px;height: 100px;width: 100px;margin: 14px;left: 151px;right: 41px;">
           
              </td>
              <td bgcolor="#f59c1a"  style="height: 70px;left: 0px;width: 523px;">
                <p style="top: 82px;height: 30px;width: 400px;margin: 0;left: 135px;font-family: Arial, Helvetica, Arial, serif;font-weight: 600;font-style: normal;font-size: 25.0px;color: #ffffff;text-align: center;line-height: 35.0px;"> Sistema De Nutrición</p>
           
              </td>
            </tr>
        </table> 
        <table cellspacing="0" cellpadding="0" align="center">
           <tr>
              <td bgcolor="#D07C04"  style="height: 39px;width: 51px;">

           
              </td>
              <td bgcolor="##28a745"  style="height: 70px;left: 0px;width: 548px;">
                <p style="top: 82px;height: auto;width: auto;margin: 0;left: 75px;font-family: Arial, Helvetica, Arial, serif;font-weight: 600;font-style: normal;font-size: 14.0px;color: #ffffff;text-align: center;line-height: 21.0px;"> <img src="'.base_url().'assets/img/logo/check.jpeg" style="top: 69px;height: 23px;width: 24px;margin: -4px;left: 151px;right: 41px;">&nbsp;&nbsp;&nbsp;&nbsp;Su cuenta como nutricionsita para el sistema de nutrición se ha creado exitosamente.</p>
           
              </td>
              <td bgcolor="#D07C04" style="height: 39px;width: 52px;">
                  <p></p>
            
              </td>
            </tr>
        </table>
        <table cellspacing="0" align="center" style="background-color: #ffffff;height: 53px;width: 651px;left: 0px;padding-top: 14px;">
            <tr>  
                <td style="margin: 16px;font-family: Arial, Helvetica, Arial, serif;font-weight: 300;font-style: normal;font-size: 12.0px;color: #444444;text-align: left;line-height: 14.0px;">
                      <span>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estimado(a) <strong>'.$this->input->post('nombre').'</strong> Su cuenta en el sistema de nutrición fue creada exitosamente, sus credenciales son: <br/>
                      </span>    

                </td>
            </tr>
        
            <tr cellspacing="0" align="center" style="background-color: #ffffff;height: 53px;width: 651px;left: 0px;padding-top: 14px;">    
                  <td>
                    <span style="margin: 27px;background-color: #f5f5f5;padding: -33px;line-height: 54px;color: #444444;margin-top: 21px;margin-bottom: 18px;display: inline-block;width: 487px;text-align: center;font-family: Arial, Helvetica, Arial, serif;font-weight: 600;font-style: normal;font-size: 16px;height: 110px; ">Usuario: '.$this->input->post('usuario').'<br> Clave: '.$this->input->post('contrasena').'</span>
                      
                  </td>
            </tr>
            
        </table>
        <br/><br/><br/><br/>
    </body>
    </html>'); 
                                        if($this->email->send()){
                                            $this->session->set_flashdata('css','success');
                                            $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                                        }else{
                                            $this->session->set_flashdata('css','warning');
                                            $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente, sin embargo hubo problemas en el envío del correo electrónico');
                                        }
                                        redirect(base_url()."administrador/desactivar_usuario");
                                    }
                                    else{
                                        $this->session->set_flashdata('css','danger');
                                        $this->session->set_flashdata('mensaje','Ya existe un registro con este nombre de usuario');
                                        redirect(base_url()."administrador/add_nutricionista");
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
                redirect(base_url()."administrar/salir");
            }
    }  
    public function mostrar_usuarios_desactivados(){
        if($this->session->userdata('admin')){
            $buscar = $this->input->post("buscar");
            $numeropagina = $this->input->post("nropagina");
            $cantidad = $this->input->post("cantidad");
            $rut = $this->input->post("rut");
            $inicio = ($numeropagina -1)*$cantidad;
            $data = array(
                "usuarios" => $this->datos_model->getTodosPaginacion_usuarios_des($buscar,$inicio,$cantidad,"limit",$rut),
                "totalregistros" => $this->datos_model->getTodosPaginacion_usuarios_des($buscar,$inicio,$cantidad,"cuantos",$rut),
                "cantidad" =>$cantidad              
            );
            echo json_encode($data);
        }else{
            redirect(base_url()."administrar/salir");
        }
    }
    public function mostrar_usuarios_activados(){
        if($this->session->userdata('admin')){
            $buscar = $this->input->post("buscar");
            $numeropagina = $this->input->post("nropagina");
            $cantidad = $this->input->post("cantidad");
            $rut = $this->input->post("rut");
            $inicio = ($numeropagina -1)*$cantidad;
            $data = array(
                "usuarios" => $this->datos_model->getTodosPaginacion_usuarios_act($buscar,$inicio,$cantidad,"limit",$rut),
                "totalregistros" => $this->datos_model->getTodosPaginacion_usuarios_act($buscar,$inicio,$cantidad,"cuantos",$rut),
                "cantidad" =>$cantidad              
            );
            echo json_encode($data);
        }else{
            redirect(base_url()."administrar/salir");
        }
    }
    public function activar_usuario($rut=null){
        if($this->session->userdata('admin')){
            if($rut){
                $this->datos_model->activar_usuario($rut);
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','el usuario se activó exitosamente');
                redirect(base_url()."administrador/activar_usuario");
            }
            else{
                $this->load->view("administrador/activar_usuario");
            }
        }else{
            redirect(base_url()."administrar/salir");
        }
    }
    public function desactivar_usuario($rut=null){
        if($this->session->userdata('admin')){
            if($rut){
                $this->datos_model->desactivar_usuario($rut);
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','el usuario se desactivó exitosamente');
                redirect(base_url()."administrador/desactivar_usuario");
            }
            else{
                $this->load->view("administrador/desactivar_usuario");
            }
        }else{
            redirect(base_url()."administrar/salir");
        }
    }
    
    }?>