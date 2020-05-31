<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    class Evaluacion extends CI_Controller 
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function editar_evaluacion($id=null){
            if(!$id){redirect(base_url()."error404/");}
            if($this->session->userdata("id")&&$this->uri->segment(3)){
                $datos_evaluacion=$this->datos_model->get_evaluacion($id);
                $datos_paciente=$this->datos_model->get_paciente_por_rut($datos_evaluacion[0]->Paciente_rut);
                $porc_grasa=$this->datos_model->get_porc_grasa($datos_paciente[0]->sexo);
                //print_r($datos_evaluacion);die;
                if(sizeof($datos_paciente)==0 || sizeof($datos_evaluacion)==0){redirect(base_url()."error404/");}
                if($this->input->post()){
                $edad=(int)calculaEdad($datos_paciente[0]->fecha_nacimiento);
                $porc_grasa=(int)$this->input->post('grasa_durnin');
                $sexo=$datos_paciente[0]->sexo;
                switch ($sexo) {
                    case '1':
                    if($porc_grasa<10){
                        $estado_nutri_paciente_bd="enflaquecido";
                        $estado_nutri_paciente="hace referencia a un estado enflaquecido";
                    }else if($edad<18){
                        $estado_nutri_paciente_bd="promedio";
                        $estado_nutri_paciente="corrresponde a evaluaciones infantiles";
                    }else if(18<= $edad && $edad<=25){
                        if($porc_grasa<15){
                            $estado_nutri_paciente_bd="adecuado";
                            $estado_nutri_paciente="hace referencia a un estado adecuado";
                        }else if(15<= $porc_grasa && $porc_grasa<=20){
                            $estado_nutri_paciente_bd="promedio";
                            $estado_nutri_paciente="hace referencia a un estado promedio";
                        }else if(20< $porc_grasa && $porc_grasa<=25){
                            $estado_nutri_paciente_bd="sobrepeso";
                            $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                        }else if(25< $porc_grasa){
                            $estado_nutri_paciente_bd="obeso";
                            $estado_nutri_paciente="hace referencia a un estado de obesidad";
                        }
                    }else if(25< $edad && $edad<=30){
                        if($porc_grasa<=17){
                            $estado_nutri_paciente_bd="adecuado";
                            $estado_nutri_paciente="hace referencia a un estado adecuado";
                        }else if(17< $porc_grasa && $porc_grasa<=22){
                            $estado_nutri_paciente_bd="promedio";
                            $estado_nutri_paciente="hace referencia a un estado promedio";
                        }else if(22< $porc_grasa && $porc_grasa<=27){
                            $estado_nutri_paciente_bd="spbrepeso";
                            $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                        }else if(27< $porc_grasa){
                            $estado_nutri_paciente_bd="obeso";
                            $estado_nutri_paciente="hace referencia a un estado de obesidad";
                        }
                    }else if(30< $edad && $edad<=35){
                        if($porc_grasa<=19){
                            $estado_nutri_paciente_bd="adecuado";
                            $estado_nutri_paciente="hace referencia a un estado adecuado";
                        }else if(19< $porc_grasa && $porc_grasa<=24){
                            $estado_nutri_paciente_bd="promedio";
                            $estado_nutri_paciente="hace referencia a un estado promedio";
                        }else if(24< $porc_grasa && $porc_grasa<=29){
                            $estado_nutri_paciente_bd="sobrepeso";
                            $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                        }else if(29< $porc_grasa){
                            $estado_nutri_paciente_bd="obeso";
                            $estado_nutri_paciente="hace referencia a un estado de obesidad";
                        }
                    }else if(35< $edad && $edad<=40){
                        if($porc_grasa<=21){
                            $estado_nutri_paciente_bd="adecuado";
                            $estado_nutri_paciente="hace referencia a un estado adecuado";
                        }else if(21< $porc_grasa && $porc_grasa<=26){
                            $estado_nutri_paciente_bd="promedio";
                            $estado_nutri_paciente="hace referencia a un estado promedio";
                        }else if(26< $porc_grasa && $porc_grasa<=31){
                            $estado_nutri_paciente_bd="sobrepeso";
                            $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                        }else if(31< $porc_grasa){
                            $estado_nutri_paciente_bd="obeso";
                            $estado_nutri_paciente="hace referencia a un estado de obesidad";
                        }
                    }else if(40< $edad && $edad<=45){
                        if($porc_grasa<=23){
                            $estado_nutri_paciente_bd="adecuado";
                            $estado_nutri_paciente="hace referencia a un estado adecuado";
                        }else if(23< $porc_grasa && $porc_grasa<=28){
                            $estado_nutri_paciente_bd="promedio";
                            $estado_nutri_paciente="hace referencia a un estado promedio";
                        }else if(28< $porc_grasa && $porc_grasa<=33){
                            $estado_nutri_paciente_bd="sobrepeso";
                            $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                        }else if(33< $porc_grasa){
                            $estado_nutri_paciente_bd="obeso";
                            $estado_nutri_paciente="hace referencia a un estado de obesidad";
                        }
                    }else if(45< $edad && $edad<=60){
                        if($porc_grasa<=25){
                            $estado_nutri_paciente_bd="adecuado";
                            $estado_nutri_paciente="hace referencia a un estado adecuado";
                        }else if(25< $porc_grasa && $porc_grasa<=30){
                            $estado_nutri_paciente_bd="promedio";
                            $estado_nutri_paciente="hace referencia a un estado promedio";
                        }else if(30< $porc_grasa && $porc_grasa<=35){
                            $estado_nutri_paciente_bd="sobrepeso";
                            $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                        }else if(35< $porc_grasa){
                            $estado_nutri_paciente_bd="obeso";
                            $estado_nutri_paciente="hace referencia a un estado de obesidad";
                        }
                    }else if(60 < $edad ){
                        if(30< $porc_grasa && $porc_grasa<=35){
                            $estado_nutri_paciente_bd="promedio";
                            $estado_nutri_paciente="hace referecnia a un estado promedio";
                        }
                    }
                        break;
                    
                    case '2':
                    if($porc_grasa<10){
                        $estado_nutri_paciente_bd="enflaquecido";
                        $estado_nutri_paciente="hace referencia a un estado enflaquecido";
                    }else if($edad<18){
                        $estado_nutri_paciente="corrresponde a evaluaciones infantiles";
                    }else if(18<= $edad && $edad<=25){
                        if($porc_grasa<17){
                            $estado_nutri_paciente_bd="adecuado";
                            $estado_nutri_paciente="hace referencia a un estado adecuado";
                        }else if(17<= $porc_grasa && $porc_grasa<=20){
                            $estado_nutri_paciente_bd="promedio";
                            $estado_nutri_paciente="hace referencia a un estado promedio";
                        }else if(20< $porc_grasa && $porc_grasa<=25){
                            $estado_nutri_paciente_bd="sobrepeso";
                            $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                        }else if(25< $porc_grasa){
                            $estado_nutri_paciente_bd="obeso";
                            $estado_nutri_paciente="hace referencia a un estado de obesidad";
                        }
                    }else if(25< $edad && $edad<=30){
                        if($porc_grasa<=19){
                            $estado_nutri_paciente_bd="adecuado";
                            $estado_nutri_paciente="hace referencia a un estado adecuado";
                        }else if(19< $porc_grasa && $porc_grasa<=22){
                            $estado_nutri_paciente_bd="promedio";
                            $estado_nutri_paciente="hace referencia a un estado promedio";
                        }else if(22< $porc_grasa && $porc_grasa<=27){
                            $estado_nutri_paciente_bd="sobrepeso";
                            $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                        }else if(27< $porc_grasa){
                            $estado_nutri_paciente_bd="obeso";
                            $estado_nutri_paciente="hace referencia a un estado de obesidad";
                        }
                    }else if(30< $edad && $edad<=35){
                        if($porc_grasa<=21){
                            $estado_nutri_paciente_bd="adecuado";
                            $estado_nutri_paciente="hace referencia a un estado adecuado";
                        }else if(21< $porc_grasa && $porc_grasa<=24){
                            $estado_nutri_paciente_bd="promedio";
                            $estado_nutri_paciente="hace referencia a un estado promedio";
                        }else if(24< $porc_grasa && $porc_grasa<=29){
                            $estado_nutri_paciente_bd="sobrepeso";
                            $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                        }else if(29< $porc_grasa){
                            $estado_nutri_paciente_bd="obeso";
                            $estado_nutri_paciente="hace referencia a un estado de obesidad";
                        }
                    }else if(35< $edad && $edad<=40){
                        if($porc_grasa<=23){
                            $estado_nutri_paciente_bd="adecuado";
                            $estado_nutri_paciente="hace referencia a un estado adecuado";
                        }else if(23< $porc_grasa && $porc_grasa<=26){
                            $estado_nutri_paciente_bd="promedio";
                            $estado_nutri_paciente="hace referencia a un estado promedio";
                        }else if(26< $porc_grasa && $porc_grasa<=31){
                            $estado_nutri_paciente_bd="sobrepeso";
                            $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                        }else if(31< $porc_grasa){
                            $estado_nutri_paciente_bd="obeso";
                            $estado_nutri_paciente="hace referencia a un estado de obesidad";
                        }
                    }else if(40< $edad && $edad<=45){
                        if($porc_grasa<=25){
                            $estado_nutri_paciente_bd="adecuado";
                            $estado_nutri_paciente="hace referencia a un estado adecuado";
                        }else if(25< $porc_grasa && $porc_grasa<=28){
                            $estado_nutri_paciente_bd="promedio";
                            $estado_nutri_paciente="hace referencia a un estado promedio";
                        }else if(28< $porc_grasa && $porc_grasa<=33){
                            $estado_nutri_paciente_bd="sobrepeso";
                            $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                        }else if(33< $porc_grasa){
                            $estado_nutri_paciente_bd="obeso";
                            $estado_nutri_paciente="hace referencia a un estado de obesidad";
                        }
                    }else if(45 < $edad ){
                        if($porc_grasa < 15){
                            $estado_nutri_paciente_bd="enflaquecido";
                            $estado_nutri_paciente="hace referencia a un estado enflaquecido";
                        }else
                        if(15< $porc_grasa && $porc_grasa<=35){
                            $estado_nutri_paciente_bd="promedio";
                            $estado_nutri_paciente="hace referencia a un estado promedio";
                        }
                        else if(35< $porc_grasa &&  $porc_grasa <45){
                            $estado_nutri_paciente_bd="sobrepeso";
                            $estado_nutri_paciente="hace referencia a un estado sobrepeso";
                        }
                        else if(45< $porc_grasa){
                            $estado_nutri_paciente_bd="obeso";
                            $estado_nutri_paciente="hace referencia a un estado de obesidad";
                        }
                    }
                    break;
                }
                                //print_r($estado_nutri_paciente_bd);die;
                                $data=array("peso_paciente"=>$this->input->post('peso'),
                                "talla_paciente"=>$this->input->post('talla'),
                                "imc_paciente"=>$this->input->post('imc'),
                                "humero_paciente"=>$this->input->post('humero'),
                                "femur_paciente"=>$this->input->post('femur'),
                                "brazo_relajado_paciente"=>$this->input->post('b_relajado'),
                                "brazo_contraido_paciente"=>$this->input->post('b_contraido'),
                                "cintura_min_paciente"=>$this->input->post('c_min'),
                                "cadera_max_paciente"=>$this->input->post('c_max'),
                                "muslo_medio_paciente"=>$this->input->post('m_medio'),
                                "pantorrilla_paciente"=>$this->input->post('pantorrilla_perimetro'),
                                "tricipital_paciente"=>$this->input->post('tricipital'),
                                "subescapular_paciente"=>$this->input->post('subescapular'),
                                "bicipital_paciente"=>$this->input->post('bicipital'),
                                "supracrestideo_paciente"=>$this->input->post('supracrestideo'),
                                "supraespinal_paciente"=>$this->input->post('supraespinal'),
                                "abdominal_paciente"=>$this->input->post('abdomial'),
                                "muslo_paciente"=>$this->input->post('muslo'),
                                "pantorrilla2_paciente"=>$this->input->post('pantorrilla_pliegue'),
                                "cuatro_pliegues_paciente"=>$this->input->post('4pliegues'),
                                "grasa_durnin_paciente"=>$this->input->post('grasa_durnin'),
                                "masa_adiposa_paciente"=>$this->input->post('masa_adiposa'),
                                "masa_sin_grasa_paciente"=>$this->input->post('masa_sin_grasa'),
                                "masa_muscular_paciente"=>$this->input->post('masa_muscular'),
                                "seis_pliegues_paciente"=>$this->input->post('6pliegues'),
                                "fecha"=>$this->input->post('fecha_control'),
                                "estado"=>$estado_nutri_paciente_bd,
                                "Paciente_rut"=>$datos_paciente[0]->rut);
                            $this->session->set_flashdata('css','success');
                            $this->session->set_flashdata('mensaje','se edito exitosamente su evaluación');
                            $this->session->set_flashdata('css_estado_nutri','warning');
                            $this->session->set_flashdata('estado_nutri','Respecto a la reciente modificación en la evaluación, el estado nutricional del paciente '. $estado_nutri_paciente);
                            $this->datos_model->update_evaluacion($data,$id);
                            redirect(base_url()."evaluacion/listado_evaluaciones/".$datos_paciente[0]->rut);
                 }else{
                    $this->load->view("evaluacion/editar_evaluacion",compact('datos_paciente','datos_evaluacion','porc_grasa'));
                }
            }else{
                redirect(base_url().'administrar/salir');
            }
        
        }
        public function ver_evaluacion($id=null){
            if(!$id){redirect(base_url()."error404/");}
            if($this->session->userdata("rut")){
                $datos_evaluacion=$this->datos_model->get_evaluacion($id);
                $datos_paciente=$this->datos_model->get_paciente_por_rut($this->session->userdata("rut"));
                //print_r($datos_paciente);die;
                if(sizeof($datos_paciente)==0 || sizeof($datos_evaluacion)==0){redirect(base_url()."error404/");}
                $this->load->view("evaluacion/ver_evaluacion",compact('datos_paciente','datos_evaluacion'));
            }else{
                redirect(base_url().'administrar/salir');
            }
        
        }
        public function evaluaciones($id=null){
            if(!$id){redirect(base_url()."error404/");}
            $datos=$this->datos_model->get_paciente_por_rut($id);
            if(sizeof($datos)==0){redirect(base_url()."error404/");}
            if ($this->session->userdata("id")&&($rut_paciente=$this->uri->segment(3))) {
                $this->load->view('evaluacion/evaluaciones',compact('rut_paciente'));
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function planilla_evaluacion($id=null){
            if(!$id){redirect(base_url()."error404/");}
            $datos_paciente=$this->datos_model->get_paciente_por_rut($id);
            if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
            if(($this->session->userdata("id")) && ($rut_paciente=$this->uri->segment(3))){
                //print_r($datos_paciente[0]->sexo);exit;
                $porc_grasa=$this->datos_model->get_porc_grasa($datos_paciente[0]->sexo);

                //print_r($datos_paciente[0]->sexo);die();
                if($this->input->post()){
                    if ($this->form_validation->run('add_evaluacion')){
                        //echo $this->input->post('imc');exit;
                            $edad=(int)calculaEdad($datos_paciente[0]->fecha_nacimiento);
                            $porc_grasa=(int)$this->input->post('grasa_durnin');
                            $sexo=$datos_paciente[0]->sexo;
                            switch ($sexo) {
                                case '1':
                                if($porc_grasa<10){
                                    $estado_nutri_paciente_bd="enflaquecido";
                                    $estado_nutri_paciente="hace referencia a un estado enflaquecido";
                                }else if($edad<18){
                                    $estado_nutri_paciente_bd="promedio";
                                    $estado_nutri_paciente="corrresponde a evaluaciones infantiles";
                                }else if(18<= $edad && $edad<=25){
                                    if($porc_grasa<15){
                                        $estado_nutri_paciente_bd="adecuado";
                                        $estado_nutri_paciente="hace referencia a un estado adecuado";
                                    }else if(15<= $porc_grasa && $porc_grasa<=20){
                                        $estado_nutri_paciente_bd="promedio";
                                        $estado_nutri_paciente="hace referencia a un estado promedio";
                                    }else if(20< $porc_grasa && $porc_grasa<=25){
                                        $estado_nutri_paciente_bd="sobrepeso";
                                        $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                                    }else if(25< $porc_grasa){
                                        $estado_nutri_paciente_bd="obeso";
                                        $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                    }
                                }else if(25< $edad && $edad<=30){
                                    if($porc_grasa<=17){
                                        $estado_nutri_paciente_bd="adecuado";
                                        $estado_nutri_paciente="hace referencia a un estado adecuado";
                                    }else if(17< $porc_grasa && $porc_grasa<=22){
                                        $estado_nutri_paciente_bd="promedio";
                                        $estado_nutri_paciente="hace referencia a un estado promedio";
                                    }else if(22< $porc_grasa && $porc_grasa<=27){
                                        $estado_nutri_paciente_bd="spbrepeso";
                                        $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                                    }else if(27< $porc_grasa){
                                        $estado_nutri_paciente_bd="obeso";
                                        $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                    }
                                }else if(30< $edad && $edad<=35){
                                    if($porc_grasa<=19){
                                        $estado_nutri_paciente_bd="adecuado";
                                        $estado_nutri_paciente="hace referencia a un estado adecuado";
                                    }else if(19< $porc_grasa && $porc_grasa<=24){
                                        $estado_nutri_paciente_bd="promedio";
                                        $estado_nutri_paciente="hace referencia a un estado promedio";
                                    }else if(24< $porc_grasa && $porc_grasa<=29){
                                        $estado_nutri_paciente_bd="sobrepeso";
                                        $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                                    }else if(29< $porc_grasa){
                                        $estado_nutri_paciente_bd="obeso";
                                        $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                    }
                                }else if(35< $edad && $edad<=40){
                                    if($porc_grasa<=21){
                                        $estado_nutri_paciente_bd="adecuado";
                                        $estado_nutri_paciente="hace referencia a un estado adecuado";
                                    }else if(21< $porc_grasa && $porc_grasa<=26){
                                        $estado_nutri_paciente_bd="promedio";
                                        $estado_nutri_paciente="hace referencia a un estado promedio";
                                    }else if(26< $porc_grasa && $porc_grasa<=31){
                                        $estado_nutri_paciente_bd="sobrepeso";
                                        $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                                    }else if(31< $porc_grasa){
                                        $estado_nutri_paciente_bd="obeso";
                                        $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                    }
                                }else if(40< $edad && $edad<=45){
                                    if($porc_grasa<=23){
                                        $estado_nutri_paciente_bd="adecuado";
                                        $estado_nutri_paciente="hace referencia a un estado adecuado";
                                    }else if(23< $porc_grasa && $porc_grasa<=28){
                                        $estado_nutri_paciente_bd="promedio";
                                        $estado_nutri_paciente="hace referencia a un estado promedio";
                                    }else if(28< $porc_grasa && $porc_grasa<=33){
                                        $estado_nutri_paciente_bd="sobrepeso";
                                        $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                                    }else if(33< $porc_grasa){
                                        $estado_nutri_paciente_bd="obeso";
                                        $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                    }
                                }else if(45< $edad && $edad<=60){
                                    if($porc_grasa<=25){
                                        $estado_nutri_paciente_bd="adecuado";
                                        $estado_nutri_paciente="hace referencia a un estado adecuado";
                                    }else if(25< $porc_grasa && $porc_grasa<=30){
                                        $estado_nutri_paciente_bd="promedio";
                                        $estado_nutri_paciente="hace referencia a un estado promedio";
                                    }else if(30< $porc_grasa && $porc_grasa<=35){
                                        $estado_nutri_paciente_bd="sobrepeso";
                                        $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                                    }else if(35< $porc_grasa){
                                        $estado_nutri_paciente_bd="obeso";
                                        $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                    }
                                }else if(60 < $edad ){
                                    if(30< $porc_grasa && $porc_grasa<=35){
                                        $estado_nutri_paciente_bd="promedio";
                                        $estado_nutri_paciente="hace referecnia a un estado promedio";
                                    }
                                }
                                    break;
                                
                                case '2':
                                if($porc_grasa<10){
                                    $estado_nutri_paciente_bd="enflaquecido";
                                    $estado_nutri_paciente="hace referencia a un estado enflaquecido";
                                }else if($edad<18){
                                    $estado_nutri_paciente="corrresponde a evaluaciones infantiles";
                                }else if(18<= $edad && $edad<=25){
                                    if($porc_grasa<17){
                                        $estado_nutri_paciente_bd="adecuado";
                                        $estado_nutri_paciente="hace referencia a un estado adecuado";
                                    }else if(17<= $porc_grasa && $porc_grasa<=20){
                                        $estado_nutri_paciente_bd="promedio";
                                        $estado_nutri_paciente="hace referencia a un estado promedio";
                                    }else if(20< $porc_grasa && $porc_grasa<=25){
                                        $estado_nutri_paciente_bd="sobrepeso";
                                        $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                                    }else if(25< $porc_grasa){
                                        $estado_nutri_paciente_bd="obeso";
                                        $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                    }
                                }else if(25< $edad && $edad<=30){
                                    if($porc_grasa<=19){
                                        $estado_nutri_paciente_bd="adecuado";
                                        $estado_nutri_paciente="hace referencia a un estado adecuado";
                                    }else if(19< $porc_grasa && $porc_grasa<=22){
                                        $estado_nutri_paciente_bd="promedio";
                                        $estado_nutri_paciente="hace referencia a un estado promedio";
                                    }else if(22< $porc_grasa && $porc_grasa<=27){
                                        $estado_nutri_paciente_bd="sobrepeso";
                                        $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                                    }else if(27< $porc_grasa){
                                        $estado_nutri_paciente_bd="obeso";
                                        $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                    }
                                }else if(30< $edad && $edad<=35){
                                    if($porc_grasa<=21){
                                        $estado_nutri_paciente_bd="adecuado";
                                        $estado_nutri_paciente="hace referencia a un estado adecuado";
                                    }else if(21< $porc_grasa && $porc_grasa<=24){
                                        $estado_nutri_paciente_bd="promedio";
                                        $estado_nutri_paciente="hace referencia a un estado promedio";
                                    }else if(24< $porc_grasa && $porc_grasa<=29){
                                        $estado_nutri_paciente_bd="sobrepeso";
                                        $estado_nutri_paciente="hace referencia a un estado de sobrepeso";
                                    }else if(29< $porc_grasa){
                                        $estado_nutri_paciente_bd="obeso";
                                        $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                    }
                                }else if(35< $edad && $edad<=40){
                                    if($porc_grasa<=23){
                                        $estado_nutri_paciente_bd="adecuado";
                                        $estado_nutri_paciente="hace referencia a un estado adecuado";
                                    }else if(23< $porc_grasa && $porc_grasa<=26){
                                        $estado_nutri_paciente_bd="promedio";
                                        $estado_nutri_paciente="hace referencia a un estado promedio";
                                    }else if(26< $porc_grasa && $porc_grasa<=31){
                                        $estado_nutri_paciente_bd="sobrepeso";
                                        $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                    }else if(31< $porc_grasa){
                                        $estado_nutri_paciente_bd="obeso";
                                        $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                    }
                                }else if(40< $edad && $edad<=45){
                                    if($porc_grasa<=25){
                                        $estado_nutri_paciente_bd="adecuado";
                                        $estado_nutri_paciente="hace referencia a un estado adecuado";
                                    }else if(25< $porc_grasa && $porc_grasa<=28){
                                        $estado_nutri_paciente_bd="promedio";
                                        $estado_nutri_paciente="hace referencia a un estado promedio";
                                    }else if(28< $porc_grasa && $porc_grasa<=33){
                                        $estado_nutri_paciente_bd="sobrepeso";
                                        $estado_nutri_paciente="hace referecnia a un estado de sobrepeso";
                                    }else if(33< $porc_grasa){
                                        $estado_nutri_paciente_bd="obeso";
                                        $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                    }
                                }else if(45 < $edad ){
                                    if($porc_grasa < 15){
                                        $estado_nutri_paciente_bd="enflaquecido";
                                        $estado_nutri_paciente="hace referencia a un estado enflaquecido";
                                    }else
                                    if(15< $porc_grasa && $porc_grasa<=35){
                                        $estado_nutri_paciente_bd="promedio";
                                        $estado_nutri_paciente="hace referencia a un estado promedio";
                                    }
                                    else if(35< $porc_grasa &&  $porc_grasa <45){
                                        $estado_nutri_paciente_bd="sobrepeso";
                                        $estado_nutri_paciente="hace referencia a un estado sobrepeso";
                                    }
                                    else if(45< $porc_grasa){
                                        $estado_nutri_paciente_bd="obeso";
                                        $estado_nutri_paciente="hace referencia a un estado de obesidad";
                                    }
                                }
                                break;
                            }
                            $data=array("peso_paciente"=>$this->input->post('peso'),
                            "talla_paciente"=>$this->input->post('talla'),
                            "imc_paciente"=>$this->input->post('imc'),
                            "humero_paciente"=>$this->input->post('humero'),
                            "femur_paciente"=>$this->input->post('femur'),
                            "brazo_relajado_paciente"=>$this->input->post('b_relajado'),
                            "brazo_contraido_paciente"=>$this->input->post('b_contraido'),
                            "cintura_min_paciente"=>$this->input->post('c_min'),
                            "cadera_max_paciente"=>$this->input->post('c_max'),
                            "muslo_medio_paciente"=>$this->input->post('m_medio'),
                            "pantorrilla_paciente"=>$this->input->post('pantorrilla_perimetro'),
                            "tricipital_paciente"=>$this->input->post('tricipital'),
                            "subescapular_paciente"=>$this->input->post('subescapular'),
                            "bicipital_paciente"=>$this->input->post('bicipital'),
                            "supracrestideo_paciente"=>$this->input->post('supracrestideo'),
                            "supraespinal_paciente"=>$this->input->post('supraespinal'),
                            "abdominal_paciente"=>$this->input->post('abdomial'),
                            "muslo_paciente"=>$this->input->post('muslo'),
                            "pantorrilla2_paciente"=>$this->input->post('pantorrilla_pliegue'),
                            "cuatro_pliegues_paciente"=>$this->input->post('4pliegues'),
                            "grasa_durnin_paciente"=>$this->input->post('grasa_durnin'),
                            "masa_adiposa_paciente"=>$this->input->post('masa_adiposa'),
                            "masa_sin_grasa_paciente"=>$this->input->post('masa_sin_grasa'),
                            "masa_muscular_paciente"=>$this->input->post('masa_muscular'),
                            "seis_pliegues_paciente"=>$this->input->post('6pliegues'),
                            "fecha"=>$this->input->post('fecha_control'),
                            "estado"=>$estado_nutri_paciente_bd,
                            "Paciente_rut"=>$datos_paciente[0]->rut);
                        $this->session->set_flashdata('css','success');
                        $this->session->set_flashdata('mensaje','se ingresó exitosamente su evaluación');
                        $this->session->set_flashdata('css_estado_nutri','warning');
                        $this->session->set_flashdata('estado_nutri','Respecto a la reciente evaluación, el estado nutricional del paciente '.$estado_nutri_paciente);
                        $this->datos_model->add_evaluacion($data);
                        redirect(base_url()."evaluacion/listado_evaluaciones/".$datos_paciente[0]->rut);
                    }      
                }
                $this->load->view("evaluacion/planilla_evaluacion",compact('datos_paciente','porc_grasa'));
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function listado_evaluaciones($id=null){
            if(!$id){redirect(base_url()."error404/");}
            $datos=$this->datos_model->get_paciente_por_rut($id);
            if(sizeof($datos)==0){redirect(base_url()."error404/");}
            if (($this->session->userdata("id")||$this->session->userdata("rut")) &&($rut_paciente=$this->uri->segment(3))){
                $datos_paciente=$this->datos_model->get_paciente_por_rut($rut_paciente);
                $this->load->view('evaluacion/listado_evaluaciones',compact('datos_paciente'));
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function mostrar_evaluaciones(){
                $buscar = $this->input->post("buscar");
                $numeropagina = $this->input->post("nropagina");
                $cantidad = $this->input->post("cantidad");
                $rut_paciente = $this->input->post("rut");
                $inicio = ($numeropagina -1)*$cantidad; 
                $data = array(
                    "evaluaciones" => $this->datos_model->getTodosPaginacion_evaluaciones($buscar,$inicio,$cantidad,"limit",$rut_paciente),
                    "totalregistros" => $this->datos_model->getTodosPaginacion_evaluaciones($buscar,$inicio,$cantidad,"cuantos",$rut_paciente),
                    "cantidad" =>$cantidad              
                );
                echo json_encode($data);
        }
        public function eliminar_evaluacion($id=null){
            if(!$id){redirect(base_url()."error404/");}
                $datos=$this->datos_model->get_evaluacion($id);
                if(sizeof($datos)==0){redirect(base_url()."error404/");}
                $result=$this->datos_model->delete_evaluacion($id);
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
                redirect(base_url()."evaluacion/listado_evaluaciones/".$datos[0]->Paciente_rut);
        }
    }
?>