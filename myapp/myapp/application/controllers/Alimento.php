<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    class Alimento extends CI_Controller 
    {
        public function __construct()
        {
            parent::__construct();
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
                            redirect(base_url()."alimento/listado_alimentos");
                        }
                    }
                }
                $this->load->view("alimento/add_alimento",compact('tipo_alimentos'));
            }
            else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function eliminar_alimento($id=null)
        {
            if(!$id){redirect(base_url()."error404/");}
            $datos=$this->datos_model->get_alimento_id($id);
            if(sizeof($datos)==0){redirect(base_url()."error404/");}
            $error=$this->datos_model->delete_alimento_preparacion($id);
            $error=$this->datos_model->delete_alimento($id);
            if($error!=null){
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
                redirect(base_url()."alimento/listado_alimentos");
            }else{
                $this->session->set_flashdata('css','danger');
                $this->session->set_flashdata('mensaje','Hubo un error al eliminar el registro');
                redirect(base_url()."alimento/listado_alimentos");
            }
        }
        public function editar_alimento($id=null){
            if(!$id){redirect(base_url()."error404/");}
            $alimento=$this->datos_model->get_alimento_id($id);
            $tipo_alimentos=$this->datos_model->get_all_tipo_alimentos($id);
            if(sizeof($alimento)==0){redirect(base_url()."error404/");}
            if($this->session->userdata("id")&&$this->uri->segment(3)){
                //print_r($alimento);die;
                if($this->input->post()){
                    if ($this->form_validation->run('add_alimento')) {
                $data=array(
                    "nombre"=>$this->input->post("nombre_alimento",true),
                    "tipo_alimento"=>$this->input->post("tipo",true),
                    "propiedades"=>$this->input->post("propiedades",true),
                    "aporte"=>$this->input->post("aporte",true)
                );
                $this->datos_model->update_alimento($data,$id);
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
                redirect(base_url()."alimento/listado_alimentos");
                    }
                 }
                    $this->load->view("alimento/editar_alimento",compact('alimento','tipo_alimentos'));
            }else{
                redirect(base_url().'administrar/salir');
            }
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
        public function listado_alimentos(){
            if($this->session->userdata("id")){
                $this->load->view("alimento/listado_alimentos");
            }else{
            redirect(base_url()."administrar/salir");
            }
        }
        public function mostrar_alimentos_restringir($id){
            $buscar = $this->input->post("buscar");
            $numeropagina = $this->input->post("nropagina");
            $cantidad = $this->input->post("cantidad");
            $inicio = ($numeropagina -1)*$cantidad;
            $data = array(
                "alimento" => $this->datos_model->getTodosPaginacion_alimentos_restringir($buscar,$inicio,$cantidad,"limit",$id),
                "totalregistros" => $this->datos_model->getTodosPaginacion_alimentos_restringir($buscar,$inicio,$cantidad,"cuantos",$id),
                "cantidad" =>$cantidad              
            );
            echo json_encode($data);
        }
        public function restringir_alimentos($id,$id_alm=null){
            if($this->session->userdata("id")){
                if(!$id){redirect(base_url()."error404/");}
                $datos=$this->datos_model->get_paciente_por_rut($id);
                if(sizeof($datos)==0){
                    redirect(base_url()."error404/");
                }
                //print_r($preparacion);die;
                    if($id_alm!=null){
                        $data=array(
                            "alimento_idalimento"=>$id_alm,
                            "paciente_rut"=>$id
                        );
                        $id_alimento_asociado=$this->datos_model->insert_alimentos_restringir($data);
                        $this->session->set_flashdata('css','success');
                        $this->session->set_flashdata('mensaje','Alimentos descartado exitosamente');
                    }
                    $this->load->view("alimento/restringir_alimentos",compact("datos"));
            }else{
            redirect(base_url()."administrar/salir");
            }
        }
        public function eliminar_evaluacion($id=null){
            if(!$id){redirect(base_url()."error404/");}
                $datos=$this->datos_model->get_evaluacion($id);
                if(sizeof($datos)==0){redirect(base_url()."error404/");}
                $result=$this->datos_model->delete_evaluacion($id);
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
                redirect(base_url()."registrar/listado_evaluaciones/".$datos[0]->Paciente_rut);
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
    }
?>