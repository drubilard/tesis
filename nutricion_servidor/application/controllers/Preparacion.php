<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    class Preparacion extends CI_Controller 
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function asignar_porcion($id=null,$id_prep=null){
            if($this->session->userdata("id")){
                if(!$id){redirect(base_url()."error404/");}
                $alimento=$this->datos_model->get_alimento_asociado($id);
                if(sizeof($alimento)==0){
                    redirect(base_url()."error404/");
                }
                if($this->input->post("porcion")){
                    $data=array(
                        "porcion"=>$this->input->post("porcion")
                    );
                    $this->datos_model->porcion_alimentos_asociados($id,$data);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','Porción asociada');
                    redirect(base_url()."preparacion/asignar_alimentos/".$id_prep);
                }else{
                    $this->load->view("preparacion/asignar_porcion",compact('alimento'));
                }
                }else{
                redirect(base_url()."administrar/salir");
            }
        
        }
        public function asignar_alimentos($id_prep=null,$id_alm=null){
            if($this->session->userdata("id")){
                if(!$id_prep){redirect(base_url()."error404/");}
                $preparacion=$this->datos_model->get_preparacion_id($id_prep);
                if(sizeof($preparacion)==0){
                    redirect(base_url()."error404/");
                }
                //print_r($preparacion);die;
                    if($id_alm!=null){
                        $alimento=$this->datos_model->get_alimento_id($id_alm);
                        $data=array(
                            "preparacion_idpreparacion"=>$id_prep,
                            "alimento_idalimento"=>$id_alm
                        );
                        $id_alimento_asociado=$this->datos_model->insert_alimentos_asociados($data);
                        $this->session->set_flashdata('css','success');
                        $this->session->set_flashdata('mensaje','Alimentos asociado exitosamente');
                        redirect(base_url()."preparacion/asignar_porcion/".$id_alimento_asociado."/".$id_prep);
                    }
                    $this->load->view("preparacion/asignar_alimentos",compact('preparacion'));
            }else{
            redirect(base_url()."administrar/salir");
            }
        }
        public function quitar_alimentos($id_prep=null,$id_pa=null){
            if($this->session->userdata("id")){
                if(!$id_prep){redirect(base_url()."error404/");}
                $preparacion=$this->datos_model->get_preparacion_id($id_prep);
                if(sizeof($preparacion)==0){
                    redirect(base_url()."error404/");
                }
                //print_r($preparacion);die;
                    if($id_pa!=null){
                        $this->datos_model->delete_alimentos_asociados($id_pa);
                        $this->session->set_flashdata('css','success');
                        $this->session->set_flashdata('mensaje','El alimentos se quitó exitosamente');
                    }
                    $this->load->view("preparacion/quitar_alimentos",compact('preparacion'));
            }else{
            redirect(base_url()."administrar/salir");
            }
        }
        
        public function add_preparacion(){
            if($this->session->userdata("id")){
                if($this->input->post()){
                    if ($this->form_validation->run('add_preparacion')) {
                        $data=array(
                        'nombre'=>$this->input->post('nombre',true),
                        'tipo'=>$this->input->post('tipo',true),
                        'tipo_nutri'=>$this->input->post('tipo_nutri',true)
                        );
                        $this->datos_model->insertar_preparacion($data);
                        $this->session->set_flashdata('css','success');
                        $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                        redirect(base_url()."preparacion/listado_preparaciones");
                    }
                }
                $this->load->view("preparacion/add_preparacion");
            }
            else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function eliminar_preparacion($id=null){
            if(!$id){redirect(base_url()."error404/");}
            $datos=$this->datos_model->get_preparacion_id($id);
            if(sizeof($datos)==0){redirect(base_url()."error404/");}
            $this->datos_model->delete_preparacion_minuta($id);
            $this->datos_model->delete_preparacion_alimento($id);
            $error=$this->datos_model->delete_preparacion($id);
            if($error!=null){
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
                redirect(base_url()."preparacion/listado_preparaciones");
            }else{
                $this->session->set_flashdata('css','danger');
                $this->session->set_flashdata('mensaje','Hubo un error al eliminar el registro');
                redirect(base_url()."preparacion/listado_preparaciones");
            }
        }
        public function editar_preparacion($id=null){
            if(!$id){redirect(base_url()."error404/");}
            $preparacion=$this->datos_model->get_preparacion_id($id);
            //print_r($preparacion);die;
                if(sizeof($preparacion)==0){redirect(base_url()."error404/");}
            if($this->session->userdata("id")&&$this->uri->segment(3)){
                if($this->input->post()){
                    if ($this->form_validation->run('edit_preparacion')) {
                        $data=array(
                            "nombre"=>$this->input->post("nombre_preparacion",true),
                            "tipo"=>$this->input->post('tipo',true),
                            "kcal"=>$this->input->post('kcal',true),
                            "tipo_nutri"=>$this->input->post('tipo_nutri',true)
                        );
                        $this->datos_model->update_preparacion($data,$id);
                        $this->session->set_flashdata('css','success');
                        $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
                        redirect(base_url()."preparacion/listado_preparaciones");
                    }
                 }
                    $this->load->view("preparacion/editar_preparacion",compact('preparacion'));
            }else{
                redirect(base_url().'administrar/salir');
            }
        }
        public function listado_preparaciones(){
            if($this->session->userdata("id")){
                $this->load->view("preparacion/listado_preparaciones");
            }else{
            redirect(base_url()."administrar/salir");
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
        public function mostrar_alimentos_asociar($id){
            $buscar = $this->input->post("buscar");
            $numeropagina = $this->input->post("nropagina");
            $cantidad = $this->input->post("cantidad");
            $inicio = ($numeropagina -1)*$cantidad;
            $data = array(
                "alimento" => $this->datos_model->getTodosPaginacion_alimentos_asociar($buscar,$inicio,$cantidad,"limit",$id),
                "totalregistros" => $this->datos_model->getTodosPaginacion_alimentos_asociar($buscar,$inicio,$cantidad,"cuantos",$id),
                "cantidad" =>$cantidad              
            );
            echo json_encode($data);
        }
        public function mostrar_alimentos_quitar($id){
            $buscar = $this->input->post("buscar");
            $numeropagina = $this->input->post("nropagina");
            $cantidad = $this->input->post("cantidad");
            $inicio = ($numeropagina -1)*$cantidad;
            $data = array(
                "alimento" => $this->datos_model->getTodosPaginacion_alimentos_quitar($buscar,$inicio,$cantidad,"limit",$id),
                "totalregistros" => $this->datos_model->getTodosPaginacion_alimentos_quitar($buscar,$inicio,$cantidad,"cuantos",$id),
                "cantidad" =>$cantidad              
            );
            echo json_encode($data);
        }
    }
?>