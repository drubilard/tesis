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
                                        $this->email->message('<html>
                                        <body style="background-color: #f5f5f5;">
                                        <table cellspacing="0" cellpadding="0" align="center">
                                                <tr>
                                                      <td bgcolor="#FF0000" colspan="4" style="height: 68px;width: 650px;">
                                                          
                                                      </td>
                                                </tr>
                                      
                                                <tr>
                                                      <td bgcolor="#941a0f" style="height: 39px;width: 651px;top: 69px;">
                                                          <p style="font-family: Arial, Helvetica, Arial, serif;font-weight: 600;font-style: normal;font-size: 18.0px;color:#ffffff;text-align: center;line-height: 3px;">Comprobante de solicitud de Seguro VIDA + DEVOLUCIÓN </p>
                                                      </td>
                                                </tr>
                                              </table> 
                                              <table cellspacing="0" cellpadding="0" align="center">
                                                 <tr>
                                                    <td bgcolor="#941a0f"  style="height: 39px;width: 51px;">
                                                      
                                                 
                                                    </td>
                                                    <td bgcolor="#b2c157"  style="height: 39px;left: 0px;width: 548px;">
                                                      <p style="top: 82px;height: auto;width: auto;margin: 0;left: 75px;font-family: Arial, Helvetica, Arial, serif;font-weight: 600;font-style: normal;font-size: 14.0px;color: #ffffff;text-align: center;line-height: 21.0px;"> <img src="data:image/jpeg;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABGdBTUEAALGPC/xhBQAAApBJREFUSA29lk9rE1EUxTNmEAnNn9qVirpLQTdKBXHnpgvRtnEjCCIIIvhF+gmKuCuia7FdWLGNeze6rssoupMkI07FOuPvTO7TzDR9TaHthZP77n33npOZ997MBKU9LE3TJiUtMAvOgdNA9hV0wDp4FQTBJ/z+DYEZ0AbjmmpnxlaiOARLIAGy72AZtEATTBg0vg2WgWpk6lFv6BWkYBK8A7IYLIK6t4lJ1VitemTimBzZx4SuxIl8YXxlZKEnqR6gXpm4dl4ZSV2yTIVnPHzeKfUaBy5dyhWT0MInQJe+7yvJkRGIw7jE+X+DELjdtVhsGjeO4/h8v9/XUcgMTq2vrO0S04M42zl7Lrzx5Fyv17sLtkHixODUBnG7sXmMjgXrWuHQ9XIMYwSQ36PsOaRl/HYYhrHajGtFY6wlIZ14mUsOojF+EblP2TOJQPwb3KlUKp+HWldtPKuF2wSyf/d3qHDXIbfoAUJ/ut1uiv9FPFcsFmfGjIaEIgsmXCHxCQheQvACv+PgQfqQucREthjfdL3DHh49RWTRSCGIronE8AGik46A3KOCyA03V/QIVDOZNO1rjfQUlrmncqlarb7nfr8dpEuXKW4jPoXIY/JPiXHBFn6+Xq+vWd0od8qS3yTUseCCq4QkqdVqC/g3lruUJMlHxk8kgtfBnms0Gu7PuNaiv2iJjoT0PpG5bZ4F+seItfCvs0SpdNb8z3K5fAuRDYt9bt4m17VG3gPL/HHWZNXW60cURdd9zG6OvtyBzfIkvY8g5gPErg5vCke4m6cn/whSIcmjeaia2OG/JkzoaF58Jnb4r3IJyVgvXZluo15asoP/OBlIDX4RONDPLZ1yryE4TYEOs+8DUu+yTR/RX2Hmd3Z3A28TAAAAAElFTkSuQmCC" style="top: 69px;height: 23px;width: 24px;margin: -4px;left: 151px;right: 41px;">&nbsp;&nbsp;&nbsp;&nbsp;Tu solicitud de seguro se ha enviado exitosamente.</p>
                                                 
                                                    </td>
                                                    <td bgcolor="#941a0f" style="height: 39px;width: 52px;">
                                                        <p></p>
                                                  
                                                    </td>
                                                  </tr>
                                              </table>
                                              <table cellspacing="0" align="center" style="background-color: #ffffff;height: 53px;width: 547px;left: 0px;padding-top: 14px;">
                                                  <tr>  
                                                      <td style="margin: 16px;font-family: Arial, Helvetica, Arial, serif;font-weight: 300;font-style: normal;font-size: 12.0px;color: #444444;text-align: left;line-height: 14.0px;">
                                                            <span>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estimado (a) #NOMCONTRATANTE# #APEPATCONTRATANTE#: Te enviamos el comprobante de solicitud del Seguro <b>N&deg; #NROSOLICITUD#</b> realizada con fecha #FECHAHOY#<br/>
                                                            </span>    
                                                            <!--span style="margin: 16px;font-family: Arial, Helvetica, Arial, serif;font-weight: 300;font-style: normal;font-size: 12.0px;color: #444444;text-align: left;line-height: 14.0px;">
                                                              <b>N&deg; #NUMEROSOLICITUD#</b>  realizada con fecha #FECHAHOY#
                                                            </span-->  
                                                      </td>
                                                  </tr>
                                              
                                                  <tr>    
                                                        <td>
                                                          <span style="margin: 27px;background-color: #f5f5f5;padding: -33px;line-height: 54px;color: #444444;margin-top: 21px;margin-bottom: 18px;display: inline-block;width: 487px;text-align: center;font-family: Arial, Helvetica, Arial, serif;font-weight: 600;font-style: normal;font-size: 16px;height: 48px;">Valor prima mensual: UF #PRIMACALCULADA#</span>
                                                            
                                                        </td>
                                                  </tr>
                                                  
                                                  <tr>    
                                                      <td>
                                                        <span style="margin: 16px;font-family: Arial, Helvetica, Arial, serif;font-weight: 600;font-style: normal;font-size: 16.0px;text-align: left;padding-top: 2px;line-height: 26px;">DATOS DEL ASEGURADO
                                                        </span>
                                                        <hr style="width: 97%;height: 1px;margin-left: auto;margin-right: auto;background-color: #DDDDDD;color: #DDDDDD;border: 0 none;margin-top: 10px;margin-bottom: 6px;">
                                                      </td>
                                                  </tr>
                                              </table>
                                              <table cellspacing="0" align="center" style="background-color: #ffffff;height: 66px;width: 548px;left: 1px;top: 36px;padding-top: 21px;">
                                                
                                                  <tr>
                                                      
                                                    <td>
                                                      <span style="background-color: #ffffff;margin: 16px;left: 75px;-ms-transform: rotate(0deg);font-family: Arial, Helvetica, Arial, serif;font-weight: 600;font-style:normal;font-size: 14.0px;color: #444444;text-align: left;line-height: 16.0px;">Nombres:</span> 
                                                    </td>
                                      
                                                    <td>
                                                      <span style="background-color: #ffffff;margin: 16px;left: 75px;-ms-transform: rotate(0deg);font-family: Arial, Helvetica, Arial, serif;font-weight: 600;font-style:normal;font-size: 14.0px;color: #444444;text-align: left;line-height: 16.0px;">Apellidos:</span>
                                                    </td>
                                                  </tr>
                                      
                                                  <tr>
                                                    <td>  
                                                      <span style="background-color: #ffffff;margin: 16px;-ms-transform: rotate(0deg);transform: rotate(0deg);font-family: Arial, Helvetica, Arial, serif;font-weight: 400;font-style: normal;font-size: 14.0px;color: #a0a0a0;text-align: left;line-height: 43px;">#NOMASEGURADO#</span>
                                                    </td>
                                      
                                                    <td>  
                                                        <span style="background-color: #ffffff;margin: 16px;-ms-transform: rotate(0deg);transform: rotate(0deg);font-family: Arial, Helvetica, Arial, serif;font-weight: 400;font-style: normal;font-size: 14.0px;color: #a0a0a0;text-align: left;line-height: 43px;">#APEPATASEGURADO# #APEMATASEGURADO#</span>
                                                    </td>
                                                  </tr>
                                      
                                                  <tr>
                                                      
                                                    <td>
                                                      <span style="background-color: #ffffff;margin: 16px;left: 75px;-ms-transform: rotate(0deg);font-family: Arial, Helvetica, Arial, serif;font-weight: 600;font-style:normal;font-size: 14.0px;color: #444444;text-align: left;line-height: 16.0px;"> RUT:</span> 
                                                    </td>
                                      
                                                    <td>
                                                      <span style="background-color: #ffffff;margin: 16px;left: 75px;-ms-transform: rotate(0deg);font-family: Arial, Helvetica, Arial, serif;font-weight: 600;font-style:normal;font-size: 14.0px;color: #444444;text-align: left;line-height: 16.0px;">Fecha de nacimiento:</span>
                                                    </td>
                                                  </tr>
                                      
                                                  <tr>
                                                    <td>  
                                                      <span style="background-color: #ffffff;margin: 16px;-ms-transform: rotate(0deg);transform: rotate(0deg);font-family: Arial, Helvetica, Arial, serif;font-weight: 400;font-style: normal;font-size: 14.0px;color: #a0a0a0;text-align: left;line-height: 43px;">#RUTCLIENTE#</span>
                                                    </td>
                                      
                                                    <td>  
                                                        <span style="background-color: #ffffff;margin: 16px;-ms-transform: rotate(0deg);transform: rotate(0deg);font-family: Arial, Helvetica, Arial, serif;font-weight: 400;font-style: normal;font-size: 14.0px;color: #a0a0a0;text-align: left;line-height: 43px;">#FECHANACASEGURADO#</span>
                                                    </td>
                                                  </tr>
                                      
                                                  <tr>  
                                          
                                                  <tr>
                                                    <td align="center" colspan="2" style="height: 80px">  
                                                        <span align="center" style="font-family: Arial, Helvetica, Arial, serif;background-color: #ffffff;top: 25px;height: auto;margin: 0;left: 87px;font-weight: 400;font-style: normal;font-size: 14.0px;color: #898989;border-style: solid;border-width: 1px;border-color: #969696;padding-top: 13px;padding-right: 20px;padding-left: 20px;padding-bottom: 10px;">
                                       
                                                           
                                                              Si tienes cualquier duda, solo llama al <b>(600) 320 3000</b> </span>
                                                    </td> 
                                                  </tr>
                                      
                                                  <tr>
                                                    <td align="center" bgcolor="#f5f5f5" colspan="2" style="height: 80px">  
                                                        <p style="font-family: Arial, Helvetica, Arial, serif;font-weight: 400;font-style: normal;font-size: 10.0px;color: #444444;text-align: left;line-height: 11.0px;margin-left: 10px;">
                                                   <b>Nota:</b> Este mail es generado de manera autom&aacute;tica, por favor no respondas a este mensaje. Asimismo, se ha omitido acentos para evitar problemas de compatibilidad.
                                                   <br/> <br/> 
                                                   El valor definitivo de tu prima mensual puede variar de acuerdo a la evaluaci&oacute;n de tu solicitud, por lo tanto este documento no significa la cobertura inmediata.
                                                </p>
                                                    </td> 
                                                  </tr>  
                                             </table>
                                                 
                                            
                                         
                                             
                                              <br/><br/><br/><br/>
                                          </body>
                                      </html>
                                      '); 
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
                $this->redirect(base_url().'salir');
            }
    }  
    public function mostrar_usuarios_desactivados(){
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
    }
    public function mostrar_usuarios_activados(){
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