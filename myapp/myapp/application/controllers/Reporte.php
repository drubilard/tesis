<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
class Reporte extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
    public function datos_informe($id=null){
        if(!$id){redirect(base_url()."error404/");}
        $datos=$this->datos_model->get_paciente_por_rut($id);
        if(sizeof($datos)==0){redirect(base_url()."error404/");}
        if ($this->session->userdata("id")||$this->session->userdata("rut")) {
            $datos_informe=$this->datos_model->get_datos_informe($id);
            echo json_encode($datos_informe);
        }else{
            redirect(base_url()."administrar/salir");
        }
    }
    public function informe($id=null){
            $rut=$this->session->userdata('id');
            if(!$id){redirect(base_url()."error404/");}
            $datos_paciente=$this->datos_model->get_paciente_por_rut($id);
            if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
            if ($this->session->userdata("id")) {
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
                    $this->load->view('reporte/informe',compact('datos_paciente'));
                }
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        
    }
?>
