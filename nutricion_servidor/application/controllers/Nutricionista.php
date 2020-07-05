<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    class Nutricionista extends CI_Controller 
    {
        public function __construct()
        {
            parent::__construct();
        }
    

    public function editar_nutricionista($id=null){
        if ($this->session->userdata("id")){
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
                    $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente, vuelva a iniciar sesiиоn por favor');
                    redirect(base_url()."administrar/salir");
                }else{
                    $this->load->view("nutricionista/editar_nutricionista",compact('datos'));
                }
            }else{
                redirect(base_url().'administrar/salir');
            }
        }else{
            redirect(base_url().'administrar/salir');
        }
    }

}
?>