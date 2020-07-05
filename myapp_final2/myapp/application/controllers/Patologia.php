<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    class Patologia extends CI_Controller 
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function mostrar_patologias(){
            if ($this->session->userdata("id")){
                $buscar = $this->input->post("buscar");
                $numeropagina = $this->input->post("nropagina");
                $cantidad = $this->input->post("cantidad");
                $inicio = ($numeropagina -1)*$cantidad;
                $data = array(
                    "patologia" => $this->datos_model->getTodosPaginacion_patologias($buscar,$inicio,$cantidad,"limit",$this->session->userdata("id")),
                    "totalregistros" => $this->datos_model->getTodosPaginacion_patologias($buscar,$inicio,$cantidad,"cuantos",$this->session->userdata("id")),
                    "cantidad" =>$cantidad              
                );
                echo json_encode($data);
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function listado_patologias(){
            if ($this->session->userdata("id")){
                if($this->session->userdata("id")){
                    $this->load->view("patologia/listado_patologias");
                }else{
                redirect(base_url()."administrar/salir");
                }
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function editar_patologia($id=null){
            if ($this->session->userdata("id")){
                if(!$id){redirect(base_url()."error404/");}
                $patologia=$this->datos_model->get_patologia_id($id);
                if(sizeof($patologia)==0){redirect(base_url()."error404/");}
                if($this->session->userdata("id")&&$this->uri->segment(3)){
                    //print_r($alimento);die;
                    if($this->input->post()){
                    $data=array(
                        "consideraciones"=>$this->input->post("consideraciones",true)
                    );
                    $this->datos_model->update_patologia($data,$id);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
                    redirect(base_url()."patologia/listado_patologias");
                    }else{
                        $this->load->view("patologia/editar_patologia",compact('patologia'));
                    }
                }else{
                    redirect(base_url().'administrar/salir');
                }
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function asociar_patologia($id=null){
            if ($this->session->userdata("id")){
                if(!$id){redirect(base_url()."error404/");}
                $datos_paciente=$this->datos_model->get_paciente_por_rut($this->uri->segment(3));
                if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
                $patologias=$this->datos_model->all_patologias();
                $patologias_asociadas=$this->datos_model->patologias_asociadas($id);
                if($this->session->userdata("id")){
                    if($this->input->post()){
                        $asociar=$this->input->post('patologias_asociadas');
                        if(sizeof($patologias_asociadas)!=0){
                            $this->datos_model->delete_asignacion_patologia($id);
                        }
                        //print_r($asociar);die;
                        foreach($asociar as $pat){
                            $data=array('Patologia_idPatologia'=>$pat,
                                    'Paciente_rut'=>$datos_paciente[0]->rut
                                    );
                                $this->datos_model->agregar_asociar_patologia($data,$id);
                        }
                        $this->session->set_flashdata('css','success');
                        $this->session->set_flashdata('mensaje','Asignaciones de patologías exitosa');
                        redirect(base_url()."paciente/listado_pacientes");
                    }
                    else{

                        $this->load->view("patologia/asociar_patologia",compact("datos_paciente","patologias","patologias_asociadas"));
                    }
                }else{
                redirect(base_url()."administrar/salir");
                }
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
    }
?>     