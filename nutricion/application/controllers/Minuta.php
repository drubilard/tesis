<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    class Minuta extends CI_Controller 
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function alimentos_minuta($id){
            $alimentos=$this->datos_model->get_alimentos_minuta($id);
            print_r($alimentos);die;
        }
        public function eliminar_minuta($id=null){
            if(!$id){redirect(base_url()."error404/");}
                $datos=$this->datos_model->get_minuta($id);
                if(sizeof($datos)==0){redirect(base_url()."error404/");}
                $result=$this->datos_model->delete_preparaciones_minuta($id);
                $result=$this->datos_model->delete_minuta($id);
                $this->session->set_flashdata('css','success');
                $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
                redirect(base_url()."minuta/listado_minutas/".$datos[0]->Paciente_rut);
        }
        public function listado_minutas($id=null){
            if(!$id){redirect(base_url()."error404/");}
            $datos=$this->datos_model->get_paciente_por_rut($id);
            if(sizeof($datos)==0){redirect(base_url()."error404/");}
            if ($this->session->userdata("id")||$this->session->userdata("rut")){
                $this->load->view('minuta/listado_minutas',compact('datos'));
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function mostrar_minutas(){
            if($this->input->post()){
                $buscar = $this->input->post("buscar");
                $numeropagina = $this->input->post("nropagina");
                $cantidad = $this->input->post("cantidad");
                $rut_paciente = $this->input->post("rut");
                $inicio = ($numeropagina -1)*$cantidad; 
                $data = array(
                    "minutas" => $this->datos_model->getTodosPaginacion_minutas($buscar,$inicio,$cantidad,"limit",$rut_paciente),
                    "totalregistros" => $this->datos_model->getTodosPaginacion_minutas($buscar,$inicio,$cantidad,"cuantos",$rut_paciente),
                    "cantidad" =>$cantidad              
                );
                echo json_encode($data);
            }
        }
        public function crear_minuta($id=null){
            if(!$id){redirect(base_url()."error404/");}
            $datos_paciente=$this->datos_model->get_paciente_por_rut($id);
            if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
            if($this->session->userdata("id")){
                $preparaciones=$this->datos_model->get_all_preparaciones();
                if($this->input->post()){
                        if($this->input->post('preparaciones_minuta_des')&&$this->input->post('preparaciones_minuta_col')&&$this->input->post('preparaciones_minuta_ent')&&$this->input->post('preparaciones_minuta_alm')&&$this->input->post('preparaciones_minuta_col_2')&&$this->input->post('preparaciones_minuta_on')&&$this->input->post('preparaciones_minuta_cen')){
                            $data=array('Paciente_rut'=>$datos_paciente[0]->rut,
                            'fecha'=>date('Y-m-j')
                                    );
                            $id_minuta=$this->datos_model->crear_minuta($data);
                                foreach($this->input->post('preparaciones_minuta_des') as $prep){
                                    $data=array('preparacion_idpreparacion'=>$prep,
                                    'minuta_idminuta'=>$id_minuta
                                    );
                                        $this->datos_model->asociar_minuta_preparaciones($data);
                                }
                                foreach($this->input->post('preparaciones_minuta_col') as $prep){
                                    $data=array('preparacion_idpreparacion'=>$prep,
                                    'minuta_idminuta'=>$id_minuta
                                    );
                                        $this->datos_model->asociar_minuta_preparaciones($data);
                                }
                                foreach($this->input->post('preparaciones_minuta_ent') as $prep){
                                    $data=array('preparacion_idpreparacion'=>$prep,
                                    'minuta_idminuta'=>$id_minuta
                                    );
                                        $this->datos_model->asociar_minuta_preparaciones($data);
                                }
                                foreach($this->input->post('preparaciones_minuta_alm') as $prep){
                                    $data=array('preparacion_idpreparacion'=>$prep,
                                    'minuta_idminuta'=>$id_minuta
                                    );
                                        $this->datos_model->asociar_minuta_preparaciones($data);
                                }
                                foreach($this->input->post('preparaciones_minuta_col_2') as $prep){
                                    $data=array('preparacion_idpreparacion'=>$prep,
                                    'minuta_idminuta'=>$id_minuta
                                    );
                                        $this->datos_model->asociar_minuta_preparaciones($data);
                                }
                                foreach($this->input->post('preparaciones_minuta_on') as $prep){
                                    $data=array('preparacion_idpreparacion'=>$prep,
                                    'minuta_idminuta'=>$id_minuta
                                    );
                                        $this->datos_model->asociar_minuta_preparaciones($data);
                                }
                                foreach($this->input->post('preparaciones_minuta_cen') as $prep){
                                    $data=array('preparacion_idpreparacion'=>$prep,
                                    'minuta_idminuta'=>$id_minuta
                                    );
                                        $this->datos_model->asociar_minuta_preparaciones($data);
                                }
                            redirect(base_url()."minuta/pdf/".$id."/".$id_minuta);
                        }else{
                            $this->session->set_flashdata('css','danger');
                            $this->session->set_flashdata('mensaje_minuta','Asegurese de que existe al menos una preparación en cada tiempo de comida');
                        }
                }
                
            $this->load->view("minuta/crear_minuta",compact('preparaciones','id'));
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function recomendar_minuta($rut){
            if(!$rut){redirect(base_url()."error404/");}
            $datos_paciente=$this->datos_model->get_paciente_por_rut($rut);
            if(sizeof($datos_paciente)==0){redirect(base_url()."error404/");}
            if(sizeof($this->datos_model->get_patologia_rut($rut))==0 || $this->datos_model->get_last_evaluacion($rut)==0){
                $this->session->set_flashdata('css','warning');
                $this->session->set_flashdata('mensaje','No se cuenta con la información necesaria');
                redirect(base_url()."minuta/gestion_minuta/".$rut);
            }
            if($this->session->userdata("id")){
                $preparaciones=$this->datos_model->get_all_preparaciones();
                $patologias=$this->datos_model->get_patologia_rut($rut);
                $patologias_id=array();
                $i=0;
                foreach ($patologias as $pat) {
                    $patologias_id[$i]=$pat->idPatologia;
                    $patologias_id[$i+1]=",";
                    $i+=2;
                }
                $estado_nutri=$this->datos_model->get_last_evaluacion($rut);
                array_splice($patologias_id, sizeof($patologias_id)-1, 1);
                //print_r($estado_nutri);die;
                $preparaciones_permitidas=$this->datos_model->preparaciones_por_patologia_permitidas($patologias_id,$estado_nutri->estado);
                $preparaciones_restringidas=$this->datos_model->preparaciones_por_patologia_restringidas($patologias_id,$estado_nutri->estado);
                $preparaciones_descartadas=$this->datos_model->preparaciones_por_gustos_restringidas($rut);
                //echo "test";
                //print_r($preparaciones_permitidas);die;
                $i=0;
                foreach($preparaciones_permitidas as $prep){
                    foreach($preparaciones_restringidas as $prep2){
                        if ($prep2->id == $prep->id) {
                            array_splice($preparaciones_permitidas, $i, 1);
                            $i-=1;
                        }
                    }
                    $i+=1;
                }
                //print_r($preparaciones_permitidas);die;
                $i=0;
                foreach($preparaciones_permitidas as $prep){
                    foreach($preparaciones_descartadas as $prep2){
                        if ($prep2->id == $prep->id) {
                            array_splice($preparaciones_permitidas, $i, 1);
                            $i-=1;
                        }
                    }
                    $i+=1;
                }
                //print_r($preparaciones_permitidas);die;
                if($this->input->post()){
                    if($this->input->post('preparaciones_minuta_des')&&$this->input->post('preparaciones_minuta_col')&&$this->input->post('preparaciones_minuta_ent')&&$this->input->post('preparaciones_minuta_alm')&&$this->input->post('preparaciones_minuta_col_2')&&$this->input->post('preparaciones_minuta_on')&&$this->input->post('preparaciones_minuta_cen')){
                        $data=array('Paciente_rut'=>$datos_paciente[0]->rut,
                        'fecha'=>date('Y-m-j')
                                );
                        $id_minuta=$this->datos_model->crear_minuta($data); 
                            foreach($this->input->post('preparaciones_minuta_des') as $prep){
                                $data=array('preparacion_idpreparacion'=>$prep,
                                'minuta_idminuta'=>$id_minuta
                                );
                                    $this->datos_model->asociar_minuta_preparaciones($data);
                            }
                            foreach($this->input->post('preparaciones_minuta_col') as $prep){
                                $data=array('preparacion_idpreparacion'=>$prep,
                                'minuta_idminuta'=>$id_minuta
                                );
                                    $this->datos_model->asociar_minuta_preparaciones($data);
                            }
                            foreach($this->input->post('preparaciones_minuta_ent') as $prep){
                                $data=array('preparacion_idpreparacion'=>$prep,
                                'minuta_idminuta'=>$id_minuta
                                );
                                    $this->datos_model->asociar_minuta_preparaciones($data);
                            }
                            foreach($this->input->post('preparaciones_minuta_alm') as $prep){
                                $data=array('preparacion_idpreparacion'=>$prep,
                                'minuta_idminuta'=>$id_minuta
                                );
                                    $this->datos_model->asociar_minuta_preparaciones($data);
                            }
                            foreach($this->input->post('preparaciones_minuta_col_2') as $prep){
                                $data=array('preparacion_idpreparacion'=>$prep,
                                'minuta_idminuta'=>$id_minuta
                                );
                                    $this->datos_model->asociar_minuta_preparaciones($data);
                            }
                            foreach($this->input->post('preparaciones_minuta_on') as $prep){
                                $data=array('preparacion_idpreparacion'=>$prep,
                                'minuta_idminuta'=>$id_minuta
                                );
                                    $this->datos_model->asociar_minuta_preparaciones($data);
                            }
                            foreach($this->input->post('preparaciones_minuta_cen') as $prep){
                                $data=array('preparacion_idpreparacion'=>$prep,
                                'minuta_idminuta'=>$id_minuta
                                );
                                    $this->datos_model->asociar_minuta_preparaciones($data);
                            }
                        redirect(base_url()."minuta/pdf/".$rut."/".$id_minuta);
                        }else{
                            $this->session->set_flashdata('css','danger');
                            $this->session->set_flashdata('mensaje_minuta','Asegurese de que existe al menos una preparación en cada tiempo de comida');
                        }
                    }  
                    //die();      
                $this->load->view("minuta/recomendar_minuta",compact('preparaciones','rut','preparaciones_permitidas'));
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function editar_minuta($id_minuta=null,$rut){
            if(!$id_minuta){redirect(base_url()."error404/");}
            $minuta_preparaciones=$this->datos_model->get_preparaciones_minuta($id_minuta);
            $minuta=$this->datos_model->get_minuta($id_minuta);
            $fecha=$minuta->fecha;
            if(sizeof($minuta_preparaciones)==0){redirect(base_url()."error404/");}
            if(($this->session->userdata("id"))){
                $preparaciones=$this->datos_model->get_all_preparaciones();
                if($this->input->post()){
                    $this->datos_model->delete_preparaciones_minuta($id_minuta);
                    $this->datos_model->delete_minuta($id_minuta);
                    $minuta=$this->datos_model->get_minuta($id_minuta);
                    if(sizeof($minuta)==0){
                        $data=array('Paciente_rut'=>$rut,
                        'fecha'=>$fecha
                                );
                        $id_minuta=$this->datos_model->crear_minuta($data);
                            foreach($this->input->post('preparaciones_minuta_des') as $prep){
                                $data=array('preparacion_idpreparacion'=>$prep,
                                'minuta_idminuta'=>$id_minuta
                                );
                                    $this->datos_model->asociar_minuta_preparaciones($data);
                            }
                            foreach($this->input->post('preparaciones_minuta_col') as $prep){
                                $data=array('preparacion_idpreparacion'=>$prep,
                                'minuta_idminuta'=>$id_minuta
                                );
                                    $this->datos_model->asociar_minuta_preparaciones($data);
                            }
                            foreach($this->input->post('preparaciones_minuta_ent') as $prep){
                                $data=array('preparacion_idpreparacion'=>$prep,
                                'minuta_idminuta'=>$id_minuta
                                );
                                    $this->datos_model->asociar_minuta_preparaciones($data);
                            }
                            foreach($this->input->post('preparaciones_minuta_alm') as $prep){
                                $data=array('preparacion_idpreparacion'=>$prep,
                                'minuta_idminuta'=>$id_minuta
                                );
                                    $this->datos_model->asociar_minuta_preparaciones($data);
                            }
                            foreach($this->input->post('preparaciones_minuta_col_2') as $prep){
                                $data=array('preparacion_idpreparacion'=>$prep,
                                'minuta_idminuta'=>$id_minuta
                                );
                                    $this->datos_model->asociar_minuta_preparaciones($data);
                            }
                            foreach($this->input->post('preparaciones_minuta_on') as $prep){
                                $data=array('preparacion_idpreparacion'=>$prep,
                                'minuta_idminuta'=>$id_minuta
                                );
                                    $this->datos_model->asociar_minuta_preparaciones($data);
                            }
                            foreach($this->input->post('preparaciones_minuta_cen') as $prep){
                                $data=array('preparacion_idpreparacion'=>$prep,
                                'minuta_idminuta'=>$id_minuta
                                );
                                    $this->datos_model->asociar_minuta_preparaciones($data);
                            }
                        redirect(base_url()."minuta/pdf/".$rut."/".$id_minuta);
                        redirect(base_url()."minuta/pdf/".$rut."/".$id_minuta);
                        }
                }
            $this->load->view("minuta/editar_minuta",compact('preparaciones','minuta_preparaciones','rut'));
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function gestion_minuta($id=null){
            if ($this->session->userdata("id")) {
                $paciente=$this->datos_model->get_paciente_por_rut($id);
                if(sizeof($paciente)==0){redirect(base_url()."error404/");}
                $this->load->view("minuta/gestion_minuta",compact('id'));
            }else{
                redirect(base_url()."administrar/salir");
            }
        }
        public function pdf($rut=null,$id=null){
            if(!$id || !$rut){redirect(base_url()."error404/");}
            $paciente=$this->datos_model->get_paciente_por_rut_minuta($rut);
            if(sizeof($paciente)==0){redirect(base_url()."error404/");}
            if($this->session->userdata("id") || $this->session->userdata("rut")){
                $estado_nutri=$this->datos_model->get_last_evaluacion($rut);
                $agua_beber=(($estado_nutri->peso_paciente)*30)/1000;
                $preparaciones=$this->datos_model->get_prepraciones_minuta($id);
                $patologias=$this->datos_model->get_patologia_rut($rut);
                $alimentos=$this->datos_model->get_alimentos_minuta($id);
                $alimentos_prop_apor=$this->datos_model->get_alimentos_minuta_prop_apor($id);
                $patologias_id=array();
                $i=0;
                foreach ($patologias as $pat) {
                    $patologias_id[$i]=$pat->idPatologia;
                    $patologias_id[$i+1]=",";
                    $i+=2;
                }
                $tipo_alimento_restringidas=$this->datos_model->tipo_alimento_por_patologia_restringidas($patologias_id);
                //print_r($tipo_alimento_restringidas);die;
                date_default_timezone_set("America/Santiago");
                $hoy = date("Y-m-j_h:i:s");
                $pdfFilePath = $rut."_".$hoy.".pdf";
                $html='<div style="position: absolute; top: 5mm; left: 175mm; width: 100mm;">
    
    <img style="vertical-align: top" src="assets/img/logo/logo.png" width="80"/>
    
    </div>';
                $html.=' <h1>Minuta Nutricional</h1><h2> Nutricionista: '.$paciente[0]->nombre_nutri.' '.$paciente[0]->apellido_nutri.'</h2>
    <p><h5><label>Fecha:</label> '.date('d-m-Y').'</h5></p>
    <p><h5><label>Paciente: </label>'.$paciente[0]->nombre_paciente.' '.$paciente[0]->apellido_paciente.'</h5>
    <h5><label>Rut: </label>'.$paciente[0]->rut.'</h5></p>
    <h5><label>Hidratación recomendada: </label>'.$agua_beber.'litros</h5></p>
    <h4>Minuta nutricional</h4>
    <table class="bpmTopnTail"><thead>
    <tr class="headerrow"><th>Tiempos</th>
    <td class="headerrow">Preparacion</td>
    <td class="headerrow">Alimentos</td>
    <td class="headerrow">Aporte calorico</td>
    </tr>
    </thead><tbody>
    <tr class="evenrow">
        <th>Desayuno</th>
            <td>
                <ul>';
                $id_preparaciones_des=array();
                $i=0;
                foreach ($preparaciones as $preparacion) {
                    if($preparacion->tipo=="desayuno"){
                    $html.='
                <li>'.$preparacion->nombre.'</li>'; 
                foreach ($alimentos as $alimento) {
                    if($alimento->id==$preparacion->idpreparacion){
                    $html.='<br>';
                    }
                }
                $html.='<hr>';
                $id_preparaciones_des[$i]=$preparacion->idpreparacion;
                $i++;    
                    }
                }
                $html.='
            </ul>
            </td>
            <td>
                <ul>';
                foreach($id_preparaciones_des as $i){
                    foreach ($alimentos as $alimento) {
                        if($alimento->id==$i){
                        $html.='
                    <li>'.$alimento->nombre.'('.$alimento->porcion.')'.'</li>';}
                    }
                $html.='<br>    <hr>';
                }
                $html.='
                </ul>
            </td>
            <td>
                <ul>';
                foreach ($preparaciones as $preparacion) {
                    if(in_array($preparacion->idpreparacion,$id_preparaciones_des)){
                    $html.=$preparacion->kcal;
                    foreach ($alimentos as $alimento) {
                        if($alimento->id==$preparacion->idpreparacion){
                            $html.='<br>';
                        }
                    }
                    $html.='<br><hr>';
                    }
                }
                $html.='
            </ul>
            </td>
            
    </tr>
    <tr class="evenrow">
        <th>Colación</th>
            <td>
                <ul>';
                $id_preparaciones_col1=array();
                $i=0;
                foreach ($preparaciones as $preparacion) {
                    if($preparacion->tipo=="colacion_1"){
                    $html.='
                <li>'.$preparacion->nombre.'</li>'; 
                foreach ($alimentos as $alimento) {
                    if($alimento->id==$preparacion->idpreparacion){
                    $html.='<br>';
                    }
                }
                $html.='<hr>';
                $id_preparaciones_col1[$i]=$preparacion->idpreparacion;
                $i++;    
                    }
                }
                $html.='
            </ul>
            </td>
            <td>
                <ul>';
                foreach($id_preparaciones_col1 as $i){
                    foreach ($alimentos as $alimento) {
                        if($alimento->id==$i){
                        $html.='
                    <li>'.$alimento->nombre.'('.$alimento->porcion.')'.'</li>';}
                    }
                $html.='<br><hr>';
                }
                $html.='
                </ul>
            </td>
            <td>
            <ul>';
            foreach ($preparaciones as $preparacion) {
                if(in_array($preparacion->idpreparacion,$id_preparaciones_col1)){
                    $html.=$preparacion->kcal;
                    foreach ($alimentos as $alimento) {
                        if($alimento->id==$preparacion->idpreparacion){
                            $html.='<br>';
                        }
                    }
                    $html.='<br><hr>';
    
                }
            }
            $html.='
        </ul>
        </td>
    </tr>
    <tr class="evenrow">
        <th>
            <p>Entrada</p>
        </th>
        <td>
            <ul>';
                $id_preparaciones_ent=array();
                $i=0;
                foreach ($preparaciones as $preparacion) {
                    if($preparacion->tipo=="entrada"){
                    $html.='
                <li>'.$preparacion->nombre.'</li>'; 
                foreach ($alimentos as $alimento) {
                    if($alimento->id==$preparacion->idpreparacion){
                    $html.='<br>';
                    }
                }
                $html.='<hr>';
                $id_preparaciones_ent[$i]=$preparacion->idpreparacion;
                $i++;    
                    }
                }
                $html.='
                </ul>
                </td>
                <td>
                    <ul>';
                    foreach($id_preparaciones_ent as $i){
                        foreach ($alimentos as $alimento) {
                            if($alimento->id==$i){
                            $html.='
                            <li>'.$alimento->nombre.'('.$alimento->porcion.')'.'</li>';}
                        }
                    $html.='<br><hr>';
                    }
                    $html.='</ul>
                </td>
                <td>
                <ul>';
                foreach ($preparaciones as $preparacion) {
                    if(in_array($preparacion->idpreparacion,$id_preparaciones_ent)){
                    $html.=$preparacion->kcal;
                    foreach ($alimentos as $alimento) {
                        if($alimento->id==$preparacion->idpreparacion){
                            $html.='<br>';
                        }
                    }
                    $html.='<br><hr>';
                    }
                }
                $html.='
            </ul>
            </td>
            </tr>
            <tr class="evenrow">
                <th>
                    <p>Almuerzo</p>
                </th>
                <td>
                    <ul>';
                    $id_preparaciones_alm=array();
                    $i=0;
                    foreach ($preparaciones as $preparacion) {
                        if($preparacion->tipo=="almuerzo"){
                        $html.='
                    <li>'.$preparacion->nombre.'</li>'; 
                    foreach ($alimentos as $alimento) {
                        if($alimento->id==$preparacion->idpreparacion){
                        $html.='<br>';
                        }
                    }
                    $html.='<hr>';
                    $id_preparaciones_alm[$i]=$preparacion->idpreparacion;
                    $i++;    
                        }
                    }
                    $html.='
                </ul>
                </td>
                <td>
                    <ul>';
                    foreach($id_preparaciones_alm as $i){
                        foreach ($alimentos as $alimento) {
                            if($alimento->id==$i){
                            $html.='
                            <li>'.$alimento->nombre.'('.$alimento->porcion.')'.'</li>';}
                        }
                    $html.='<br><hr>';
                    }
                    $html.='</ul>
                </td>
                <td>
                <ul>';
                foreach ($preparaciones as $preparacion) {
                    if(in_array($preparacion->idpreparacion,$id_preparaciones_alm)){
                        $html.=$preparacion->kcal;
                        foreach ($alimentos as $alimento) {
                            if($alimento->id==$preparacion->idpreparacion){
                                $html.='<br>';
                            }
                        }
                        $html.='<br><hr>';
                    }
                }
                $html.='
            </ul>
            </td>
            </tr>
            <tr class="evenrow">
                <th>
                    <p>Colación media tarde</p>
                </th>
                <td>
                    <ul>';
                    $id_preparaciones_col2=array();
                    $i=0;
                    foreach ($preparaciones as $preparacion) {
                        if($preparacion->tipo=="colacion_2"){
                        $html.='
                    <li>'.$preparacion->nombre.'</li>'; 
                    foreach ($alimentos as $alimento) {
                        if($alimento->id==$preparacion->idpreparacion){
                        $html.='<br>';
                        }
                    }
                    $html.='<hr>';
                    $id_preparaciones_col2[$i]=$preparacion->idpreparacion;
                    $i++;    
                        }
                    }
                    $html.='
                </ul>
                </td>
                <td>
                    <ul>';
                    foreach($id_preparaciones_col2 as $i){
                        foreach ($alimentos as $alimento) {
                            if($alimento->id==$i){
                            $html.='
                            <li>'.$alimento->nombre.'('.$alimento->porcion.')'.'</li>';}
                        }
                    $html.='<br><hr>';
                    }
                    $html.='</ul>
                </td>
                <td>
                <ul>';
                foreach ($preparaciones as $preparacion) {
                    if(in_array($preparacion->idpreparacion,$id_preparaciones_col2)){
                        $html.=$preparacion->kcal;
                        foreach ($alimentos as $alimento) {
                            if($alimento->id==$preparacion->idpreparacion){
                                $html.='<br>';
                            }
                        }
                        $html.='<br><hr>';
                    }
                }
                $html.='
            </ul>
            </td>
            </tr>
            <tr class="evenrow">
                <th>
                    <p>Once</p>
                </th>
                <td>
                    <ul>';
                    $id_preparaciones_once=array();
                    $i=0;
                    foreach ($preparaciones as $preparacion) {
                        if($preparacion->tipo=="once"){
                        $html.='
                    <li>'.$preparacion->nombre.'</li>'; 
                    foreach ($alimentos as $alimento) {
                        if($alimento->id==$preparacion->idpreparacion){
                        $html.='<br>';
                        }
                    }
                    $html.='<hr>';
                    $id_preparaciones_once[$i]=$preparacion->idpreparacion;
                    $i++;    
                        }
                    }
                    $html.='
                </ul>
                </td>
                <td>
                    <ul>';
                    foreach($id_preparaciones_once as $i){
                        foreach ($alimentos as $alimento) {
                            if($alimento->id==$i){
                            $html.='
                            <li>'.$alimento->nombre.'('.$alimento->porcion.')'.'</li>';}
                        }
                    $html.='<br><hr>';
                    }
                    $html.='</ul>
                </td>
                <td>
                <ul>';
                foreach ($preparaciones as $preparacion) {
                    if(in_array($preparacion->idpreparacion,$id_preparaciones_once)){
                        $html.=$preparacion->kcal;
                        foreach ($alimentos as $alimento) {
                            if($alimento->id==$preparacion->idpreparacion){
                                $html.='<br>';
                            }
                        }
                        $html.='<br><hr>';
                    }
                }
                $html.='
            </ul>
            </td>
            </tr>
            <tr class="evenrow">
                <th>
                    <p>Cena</p>
                </th>
                <td>
                    <ul>';
                    $id_preparaciones_cena=array();
                    $i=0;
    
                    foreach ($preparaciones as $preparacion) {
                        if($preparacion->tipo=="cena"){
                        $html.='
                    <li>'.$preparacion->nombre.'</li>'; 
                    foreach ($alimentos as $alimento) {
                        if($alimento->id==$preparacion->idpreparacion){
                        $html.='<br>';
                        }
                    }
                    $html.='<hr>';
                    $id_preparaciones_cena[$i]=$preparacion->idpreparacion;
                    $i++;    
                        }
                    }
                    $html.='
                </ul>
                </td>
                <td>
                <ul>';
                foreach($id_preparaciones_cena as $i){
                    foreach ($alimentos as $alimento) {
                        if($alimento->id==$i){
                        $html.='
                        <li>'.$alimento->nombre.'('.$alimento->porcion.')'.'</li>';}
                    }
                $html.='<br><hr>';
                }
                $html.='</ul>
                </td>
                <td>
                <ul>';
                foreach ($preparaciones as $preparacion) {
                    if(in_array($preparacion->idpreparacion,$id_preparaciones_cena)){
                        $html.=$preparacion->kcal;
                        foreach ($alimentos as $alimento) {
                            if($alimento->id==$preparacion->idpreparacion){
                                $html.='<br>';
                            }
                        }
                        $html.='<br><hr>';
                    }
                }
                $html.='
            </ul>
            </td>
            </tr>
            </tbody>
        </table>
            <p>&nbsp;</p>';
            $html.='<h4>Tipos de alimentos a evitar</h4>
            <table class="bpmTopnTail">
            <tbody><tr>
                <td>';foreach ($tipo_alimento_restringidas as $tipo) {
                    $html.='-'.$tipo->nombre.'. ';
                }
                $html.='</tr>      
                </tbody>
            </table>';
    
            
            $html.='<h4>Consideraciones para patologias asociadas al paciente</h4>
            <table class="bpmTopnTail"><tbody>';
                    foreach ($patologias as $pat) {
                    $html.='<tr>
                    <td>'.$pat->nombre.'</td>
                    <td>
                    <ul>
                    <li>'.$pat->consideraciones.'</li>
                    </ul>
                    </td>
                    </tr>';}
                    
                $html.='</tbody>
            </table>';
            $html.='<h4>Aporte y propiedades de alimentos considerados en la minuta</h4>
            <table class="bpmTopnTail">
                <tbody>
                    <tr class="headerrow">
    
                        <th>
                        Alimento
                        </th>
                        <th>
                        Aporte
                        </th>
                        <th>
                        Propiedades
                        </th>
                    </tr>';
                        foreach ($alimentos_prop_apor as $alimento) {
                            $html.='<tr><td>'.$alimento->nombre.'.</td> ';
                            $html.='<td>'.$alimento->aporte.'.</td>';
                            $html.='<td>'.$alimento->propiedades.'.</td></tr> ';
                        }
                        $html.='</tbody></table>';
                        ob_start();
                error_reporting(E_ALL & ~E_NOTICE);
                ini_set('display_errors', 0);
                ini_set('log_errors', 1);
                $estilos=file_get_contents("assets/css/mpdfstyletables.css");
                $mpdf = new mPDF('c');
                $mpdf->setFooter('{PAGENO}');
                $mpdf->setDisplayMode('fullpage');
                $mpdf->WriteHTML($estilos,1);
                $mpdf->WriteHTML($html,2);
                ob_end_clean();
                $mpdf->Output($pdfFilePath, 'D');
                exit();
        }else{
                redirect(base_url()."administrar/salir");
            }
        }
    }
?>