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
                                $mi_archivo = 'mi_archivo';
                                $config['upload_path'] = "uploads/";
                                $config['file_name'] = $this->input->post('rut');
                                $config['allowed_types'] = "*";
                                $config['max_size'] = "50000";
                                $config['max_width'] = "2000";
                                $config['max_height'] = "2000";
                                $this->load->library('upload', $config);  
                                $avatar=trim($this->input->post('rut',true));                            
                                if (!$this->upload->do_upload($mi_archivo)) {
                                    //*** ocurrio un error
                                    //$data['uploadError'] = $this->upload->display_errors();
                                    //echo $this->upload->display_errors();
                                    $avatar="default";
                                }
                                $data['uploadSuccess'] = $this->upload->data();
                                $data_usr=array(
                                    'rut'=>trim($this->input->post('rut',true)),
                                    'nombre'=>trim($this->input->post('nombre_paciente',true)),
                                    'apellido'=>trim($this->input->post('apellido_paciente',true)),
                                    'sexo'=>$this->input->post('sexo',true),
                                    'fecha_nacimiento'=>$this->input->post('fecha_nacimiento_p',true),
                                    'correo'=>$this->input->post('correo',true),
                                    'Nutricionista_rut'=>$this->session->userdata("id"),
                                    'clave'=>sha1($six_digit_random_number),
                                    "avatar"=>$avatar
                                );
                                $this->datos_model->insertar_paciente($data_usr);
                                //$rut_paciente=trim($this->input->post('rut_paciente',true));
                                $this->email->from("noreplay@nutricion.com",'Sistema de Nutrición');
                                $this->email->to($this->input->post('correo',true));
                                $this->email->subject("Clave paciente para Sistema De Nutrición");
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
                <p style="top: 82px;height: auto;width: auto;margin: 0;left: 75px;font-family: Arial, Helvetica, Arial, serif;font-weight: 600;font-style: normal;font-size: 14.0px;color: #ffffff;text-align: center;line-height: 21.0px;"> <img src="'.base_url().'assets/img/logo/check.jpeg" style="top: 69px;height: 23px;width: 24px;margin: -4px;left: 151px;right: 41px;">&nbsp;&nbsp;&nbsp;&nbsp;Su cuenta como paciente para el sistema de nutrición se ha creado exitosamente.</p>
           
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
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estimado(a) <strong>'.$this->input->post('nombre_paciente').'</strong> Su cuenta en el sistema de nutrición fue creada exitosamente, sus credenciales son: <br/>
                      </span>    

                </td>
            </tr>
        
            <tr cellspacing="0" align="center" style="background-color: #ffffff;height: 53px;width: 651px;left: 0px;padding-top: 14px;">    
                  <td>
                    <span style="margin: 27px;background-color: #f5f5f5;padding: -33px;line-height: 54px;color: #444444;margin-top: 21px;margin-bottom: 18px;display: inline-block;width: 487px;text-align: center;font-family: Arial, Helvetica, Arial, serif;font-weight: 600;font-style: normal;font-size: 16px;height: 110px; ">Usuario: '.$this->input->post('rut').'<br> Clave: '.$six_digit_random_number.'</span>
                      
                  </td>
            </tr>s
            
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
            if($this->session->userdata("id")){
                if(!$id){redirect(base_url()."error404/");}
                $datos=$this->datos_model->get_paciente_por_rut($id);
                if(sizeof($datos)==0){
                redirect(base_url()."error404/");
                }
                if($this->input->post()){
                    if ($this->form_validation->run('editar_paciente')) {
                        if(valida_fecha($this->input->post('fecha_nacimiento_p'))){
                            $data=array(
                                "nombre"=>$this->input->post("nombre_paciente",true),
                                "apellido"=>$this->input->post("apellido_paciente",true),
                                "fecha_nacimiento"=>$this->input->post("fecha_nacimiento_p",true),
                                "sexo"=>$this->input->post("sexo",true),
                                "correo"=>$this->input->post("correo",true),
                            );
                            $this->datos_model->update_paciente($data,$id);
                            $this->session->set_flashdata('css','success');
                            $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
                            redirect(base_url()."paciente/listado_pacientes");
                        }else{
                            $this->session->set_flashdata('css','danger');
                            $this->session->set_flashdata('mensaje','Fecha de nacimiento no válida');
                            
                        }
                    }
                 }
                    $this->load->view("paciente/editar_paciente",compact('datos'));
            }else{
                redirect(base_url().'administrar/salir');
            }
        
        }
        public function eliminar_paciente($id=null){
            if($this->session->userdata("id")){
                if(!$id){redirect(base_url()."error404/");}
                    $datos=$this->datos_model->get_paciente_por_rut($id);
                    if(sizeof($datos)==0){redirect(base_url()."error404/");}
                    $ids=$this->datos_model->get_minuta_paciente_delete($id);
                    foreach ($ids as $i){
                     $result=$this->datos_model->delete_preparaciones_minuta_paciente($i->idMinutas);
                    }
                    foreach ($ids as $i){
                        $result=$this->datos_model->delete_minuta_paciente($i->idMinutas);
                       }
                    $result=$this->datos_model->delete_evaluacion_paciente($id);
                    $result=$this->datos_model->delete_ficha_paciente($id);
                    $result=$this->datos_model->delete_asignacion_patologia($id);
                    $result=$this->datos_model->delete_alimentos_excluidos($id);
                    $result=$this->datos_model->delete_paciente($id);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
                    redirect(base_url()."paciente/listado_pacientes");
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function nueva_ficha($id=null){
            if($this->session->userdata("id")){
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
                                    'rut'=>$datos[0]->rut
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
                                redirect(base_url()."paciente/nueva_ficha/".$datos[0]->rut);
                        }
                    }
                    $this->load->view("paciente/nueva_ficha",compact('datos'));
                }
                else{
                    redirect(base_url()."administrar/salir");
                }
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function ficha_clinica($rut_paciente=null){
            if($this->session->userdata("id")){
                if(!$rut_paciente){redirect(base_url()."error404/");}
                $datos=$this->datos_model->get_paciente_por_rut($rut_paciente);
                if(sizeof($datos)==0){redirect(base_url()."error404/");}
                $this->load->view('paciente/ficha_clinica',compact('rut_paciente'));
            }else{
            redirect(base_url()."administrar/salir");
            }
        }
        public function listado_fichas($id=null){
            if($this->session->userdata("id")){
                if(!$id){redirect(base_url()."error404/");}
                $datos_paciente=$this->datos_model->get_paciente_por_rut($id);
                if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
                $this->load->view('paciente/listado_fichas',compact('datos_paciente'));
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function mostrar_fichas(){
            if($this->session->userdata("id")){
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
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function editar_ficha($id=null){
             if($this->session->userdata("id")){
                if(!$id){redirect(base_url()."error404/");}
                $ficha=$this->datos_model->get_ficha_id($id);
                $datos=$this->datos_model->get_paciente_por_rut($ficha[0]->rut);
                //print_r($datos);die;
                if(sizeof($ficha)==0){redirect(base_url()."error404/");}
                    if($this->input->post()){
                        if(valida_fecha($this->input->post('fecha',true))){
                            $data=array(
                                'fecha'=>$this->input->post('fecha',true),
                                'informacion'=>$this->input->post('textarea_fichaclinica',true)
                            );
                            $this->datos_model->update_ficha($data,$id);
                            $this->session->set_flashdata('css','success');
                            $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
                            redirect(base_url()."paciente/listado_fichas/".$datos[0]->rut);
                        }
                        else{
                            $this->session->set_flashdata('css','danger');
                            $this->session->set_flashdata('mensaje','Fecha no válida');
                            redirect(base_url()."paciente/editar_ficha/".$ficha[0]->id);
                        }
                    }else{
                        //print_r($datos);die;
                    $this->load->view("paciente/editar_ficha",compact('ficha','datos'));
                    }
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function eliminar_ficha($id=null){
            if($this->session->userdata("id")){
                if(!$id){redirect(base_url()."error404/");}
                    $datos=$this->datos_model->get_ficha_id($id);
                    if(sizeof($datos)==0){redirect(base_url()."error404/");}
                    $result=$this->datos_model->delete_ficha($id);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
                    redirect(base_url()."paciente/listado_fichas/".$datos[0]->rut);
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function listado_pacientes(){
            if($this->session->userdata("id")){
                $this->load->view("paciente/listado_pacientes");
            }else{
            redirect(base_url()."administrar/salir");
            }
        }
        public function mostrar_pacientes(){
            if($this->session->userdata("id")){
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
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function informe_paciente(){
            if ($id=$this->session->userdata("rut")) {
                $datos_paciente=$this->datos_model->get_paciente_por_rut($id);
                if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
                    if($this->input->post("base64_1")){
                        $this->load->library('zip');
                        $this->load->helper('download');
                        for ($i=1; $i<=4 ; $i++) {
                            $base64="base64_".$i;
                            $img = $this->input->post($base64);
                            $img = str_replace('data:image/octet-stream;base64,', '', $img);
                            $fileData = base64_decode($img);
                            $fileName = uniqid().'.png';
                            $this->zip->add_data($fileName, $fileData);
                        }
                        $this->zip->download('Graficos_'.$datos_paciente[0]->rut);
                        //$ruta= '/Applications/XAMPP/xamppfiles/htdocs/nutricion/graficos'.'/'.$fileName;
                        //print_r($fileData);die;
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