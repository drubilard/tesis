<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
class Registrar extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
    public function inicio(){
        $this->load->view('registrar/inicio');
    }
    public function add_nutricionista(){
        $rut_paciente="";
        if($this->input->post()){
            if ($this->form_validation->run('add_nutricionista')) {
                if ($this->input->post('contrasena')==$this->input->post('contrasena_2')) {
                    if (valida_rut(trim($this->input->post('rut_paciente')))) {
                        $consultar_usuario=$this->datos_model->consulta_usuario($this->input->post('usuario'));   
                            if (sizeof($consultar_usuario)==0) {
                                $data=array(
                                'rut'=>trim($this->input->post('rut_paciente',true)),
                                'Nombres'=>trim($this->input->post('nombre',true)),
                                'Apellidos'=>trim($this->input->post('apellido',true)),
                                'sexo'=>$this->input->post('sexo',true),
                                'usuario'=>$this->input->post('usuario',true),
                                'clave'=>sha1($this->input->post('contrasena',true)),
                                );
                                $this->datos_model->insertar_nutricionista($data);
                                $this->session->set_flashdata('css','success');
                                $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                                $rut_paciente=trim($this->input->post('rut_paciente',true));
                                redirect(base_url()."registrar/inicio/$rut_paciente");
                            }
                            else{
                                $this->session->set_flashdata('css','danger');
                                $this->session->set_flashdata('mensaje','Ya existe un registro con este nombre de usuario');
                                redirect(base_url()."registrar/add_nutricionista");
                            }
                    }else{
                        $this->session->set_flashdata('css','danger');
                        $this->session->set_flashdata('mensaje','Rut no válido');
                    }
                    }else{
                        $this->session->set_flashdata('css','danger');
                        $this->session->set_flashdata('mensaje','las contraseñas no coinciden');
                    }

                }  
            }
            $this->load->view('registrar/add_nutricionista');
        }
        

    
	public function add(){
    if($this->session->userdata("id")){
            $rut_paciente="";
        if($this->input->post()){
            if ($this->form_validation->run('add_formulario')) {
                if (valida_rut(trim($this->input->post('rut_paciente')))) {
                    $consulta_rut=$this->datos_model->consultar_rut_paciente($this->input->post('rut_paciente'));
                    if(sizeof($consulta_rut)==0){
                        if (valida_fecha($this->input->post('fecha_nacimiento_p'))) {  
                            $data=array(
                            'rut'=>trim($this->input->post('rut_paciente',true)),
                            'nombre'=>trim($this->input->post('nombre_paciente',true)),
                            'apellido'=>trim($this->input->post('apellido_paciente',true)),
                            'sexo'=>$this->input->post('sexo',true),
                            'fecha_nacimiento'=>$this->input->post('fecha_nacimiento_p',true),
                            'Nutricionista_rut'=>$this->session->userdata("id")
                        );
                        $this->datos_model->insertar_paciente($data);
                        $this->session->set_flashdata('css','success');
                        $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                        $rut_paciente=trim($this->input->post('rut_paciente',true));
                        //$this->load->view("registrar/planilla_evaluacion",compact('ultimo'));
                        redirect(base_url()."registrar/asignar_pat_hab/$rut_paciente");
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
        $this->load->view('registrar/add');
    }else{
        redirect(base_url()."registrar/salir");
    }
        
}   
public function editar_paciente($id){
    if($this->session->userdata("id")&&$this->uri->segment(3)){
        $datos=$this->datos_model->get_paciente_por_rut($id);
        if($this->input->post()){
        if(!$id){show_404();}
        if(sizeof($datos)==0){show_404();}
        $data=array(
            "nombre"=>$this->input->post("nombre_paciente",true),
            "apellido"=>$this->input->post("apellido_paciente",true),
            "fecha_nacimiento"=>$this->input->post("fecha_nacimiento_p",true),
            "sexo"=>$this->input->post("sexo",true),
        );
        $this->datos_model->update_paciente($data,$id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
        redirect(base_url()."registrar/listado_pacientes");
         }else{
            $this->load->view("registrar/editar_paciente",compact('datos'));
        }
    }else{
        redirect(base_url().'registrar/salir');
    }

}
public function eliminar_paciente($id=null){
    if(!$id){show_404();}
        $datos=$this->datos_model->get_paciente_por_rut($id);
        if(sizeof($datos)==0){show_404();}
        $result=$this->datos_model->delete_paciente($id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
        redirect(base_url()."registrar/listado_pacientes");
}
public function login(){

        if($this->input->post()){
            if ($this->form_validation->run('login_formulario')) {
                $data=$this->datos_model->get_user($this->input->post('user',true),$this->input->post('clave',true)); 
                //print_r($data); die("bandera");
                if (sizeof($data)==0) {
                    $this->session->set_flashdata('css','danger');
                    $this->session->set_flashdata('mensaje_login','los datos no coinciden');
                    redirect(base_url()."registrar/login");                   
                }else{   
                    $this->session->set_userdata("datos_usuario");
                    $this->session->set_userdata("id",$data->rut);
                    $this->session->set_userdata("nombre",$data->Nombres);
                    $this->session->set_userdata("usuario",$data->usuario); 
                    redirect(base_url()."registrar/administrar");
                } 
        }
    }
    $this->load->view('registrar/login');
    }

    public function add_pat_hab(){
        if($this->session->userdata("id")){
            if($this->input->post()){
                if ($this->form_validation->run('add_pat_hab')) {
                    $data=array(
                    'nombre'=>$this->input->post('nombre_pat_hab',true),
                    'tipo'=>$this->input->post('tipo',true)
                    );
                    $this->datos_model->insertar_pat_hab($data);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                    redirect(base_url()."registrar/listado_pat_hab");
                }
            }
            $this->load->view("registrar/add_pat_hab");
        }
        else{
            redirect(base_url()."registrar/salir");
        }
    }
     public function add_alimento(){
        if($this->session->userdata("id")){
            if($this->input->post()){
                if ($this->form_validation->run('add_alimento')) {
                    $data=array(
                    'nombre'=>$this->input->post('nombre_alimento',true),
                    'tipo'=>$this->input->post('tipo',true),
                    'aporte'=>$this->input->post('aporte',true),
                    'propiedades'=>$this->input->post('propiedades',true)
                    );
                    $this->datos_model->insertar_alimento($data);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                    redirect(base_url()."registrar/listado_alimentos");
                }
            }
            $this->load->view("registrar/add_alimento");
        }
        else{
            redirect(base_url()."registrar/salir");
        }
    }
     public function add_preparacion(){
        if($this->session->userdata("id")){
            if($this->input->post()){
                if ($this->form_validation->run('add_preparacion')) {
                    $data=array(
                    'nombre'=>$this->input->post('nombre',true)
                    );
                    $this->datos_model->insertar_preparacion($data);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','el registro se ha ingresado exitosamente');
                    redirect(base_url()."registrar/listado_preparaciones");
                }
            }
            $this->load->view("registrar/add_preparacion");
        }
        else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function salir(){
        $this->session->sess_destroy("datos_usuario");
        redirect(base_url()."registrar/login");
    }

    public function administrar(){
        if ($this->session->userdata("id")) {
            $nutri=$this->session->userdata("nombre");
            $this->load->view('registrar/administrar',compact('nutri'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function eliminar_pat_hab($id=null)
    {
        if(!$id){show_404();}
        $datos=$this->datos_model->get_pat_hab_id($id);
        if(sizeof($datos)==0){show_404();}
        $result=$this->datos_model->delete_pat_hab($id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
        redirect(base_url()."registrar/listado_pat_hab");
    }
    public function eliminar_alimento($id=null)
    {
        if(!$id){show_404();}
        $datos=$this->datos_model->get_alimento_id($id);
        if(sizeof($datos)==0){show_404();}
        $error=$this->datos_model->delete_alimento($id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
        redirect(base_url()."registrar/listado_alimentos");
    }
    public function eliminar_preparacion($id=null)
    {
        if(!$id){show_404();}
        $datos=$this->datos_model->get_preparacion_id($id);
        if(sizeof($datos)==0){show_404();}
        $this->datos_model->delete_preparacion($id);
        $this->session->set_flashdata('css','success');
        $this->session->set_flashdata('mensaje','El registro se ha eliminado exitosamente');
        redirect(base_url()."registrar/listado_preparaciones");
    }
    public function editar_pat_hab($id){
        if($this->session->userdata("id")&&$this->uri->segment(3)){
            $datos=$this->datos_model->get_pat_hab_id($id);
            if($this->input->post()){
            if(!$id){show_404();}
            if(sizeof($datos)==0){show_404();}
            $data=array(
                "nombre"=>$this->input->post("nombre_pat_hab",true),
                "tipo"=>$this->input->post("tipo",true)
            );
            $this->datos_model->update_pat_hab($data,$id);
            $this->session->set_flashdata('css','success');
            $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
            redirect(base_url()."registrar/listado_pat_hab");
             }else{
                $this->load->view("registrar/editar_pat_hab",compact('datos'));
            }
        }else{
            redirect(base_url().'registrar/salir');
        }
    }
    public function editar_alimento($id){
        if($this->session->userdata("id")&&$this->uri->segment(3)){
            $alimento=$this->datos_model->get_alimento_id($id);
            //print_r($alimento);die;
            if($this->input->post()){
            if(!$id){show_404();}
            if(sizeof($alimento)==0){show_404();}
            $data=array(
                "nombre"=>$this->input->post("nombre_alimento",true),
                "tipo"=>$this->input->post("tipo",true),
                "propiedades"=>$this->input->post("propiedades",true),
                "aporte"=>$this->input->post("aporte",true)
            );
            $this->datos_model->update_alimento($data,$id);
            $this->session->set_flashdata('css','success');
            $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
            redirect(base_url()."registrar/listado_alimentos");
             }else{
                $this->load->view("registrar/editar_alimento",compact('alimento'));
            }
        }else{
            redirect(base_url().'registrar/salir');
        }
    }
    public function editar_preparacion($id){
        if($this->session->userdata("id")&&$this->uri->segment(3)){
            $preparacion=$this->datos_model->get_preparacion_id($id);
            if($this->input->post()){
            if(!$id){show_404();}
            if(sizeof($preparacion)==0){show_404();}
            $data=array(
                "nombre"=>$this->input->post("nombre_preparacion",true),
            );
            $this->datos_model->update_preparacion($data,$id);
            $this->session->set_flashdata('css','success');
            $this->session->set_flashdata('mensaje','El registro ha sido modificado exitosamente');
            redirect(base_url()."registrar/listado_preparaciones");
             }else{
                $this->load->view("registrar/editar_preparacion",compact('preparacion'));
            }
        }else{
            redirect(base_url().'registrar/salir');
        }
    }
    public function asignar_pat_hab(){
        if($this->session->userdata("id")){
            if($rut_paciente=$this->uri->segment(3)){
                $this->load->view("registrar/asignar_pat_hab",compact('lista_habitos','lista_patologias'));
            }else{
                redirect(base_url()."registrar/salir");
            }
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function planilla_evaluacion(){
        if(($this->session->userdata("id")) && ($rut_paciente=$this->uri->segment(3))){
            $datos_paciente=$this->datos_model->get_paciente_por_rut($this->uri->segment(3));
            //print_r($datos_paciente);exit;
            if($this->input->post()){
                if ($this->form_validation->run('add_evaluacion')){
                    if (($this->input->post('num_control'))&&($this->input->post('rut_pacientr'))) {
                    $ultimo=$this->input->post('rut_pacientr');
                    $num_control=$this->input->post('num_control');
                    $datos_paciente=$this->datos_model->get_paciente_por_rut($ultimo);                            
                    }else{
                        $num_control=1;
                    }
                    //echo $this->input->post('imc');exit;
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
                        "4pliegues_paciente"=>$this->input->post('4pliegues'),
                        "grasa_durnin_paciente"=>$this->input->post('grasa_durnin'),
                        "masa_adiposa_paciente"=>$this->input->post('masa_adiposa'),
"masa_sin_grasa_paciente"=>$this->input->post('masa_sin_grasa'),
                        "masa_muscular_paciente"=>$this->input->post('masa_muscular'),
                        "6pliegues_paciente"=>$this->input->post('6pliegues'),
                        "control"=>$num_control,
                        "rut_paciente_fk"=>$datos_paciente->rut_paciente);
                    $this->session->set_flashdata('css','success');
                    $this->session->set_flashdata('mensaje','se ingresó exitosamente su evaluación');
                    $this->datos_model->add_evaluacion($data);
                    redirect(base_url()."registrar/revision_examenes/$rut_paciente");
                }       
            }
            $this->load->view("registrar/planilla_evaluacion",compact('datos_paciente'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function revision_examenes(){
        if(($this->session->userdata("id")) && ($rut_paciente=$this->uri->segment(3))) {
            $alimentos=$this->datos_model->get_all_alimentos();
            if($this->input->post()){
                if($this->input->post('nombre_alimento_preferir')){
                    foreach($this->input->post('nombre_alimento_preferir') as $alm){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$alm,
                                'preferir'=>1,
                                'prevenir'=>0,
                                'evitar'=>0
                                );
                            $this->datos_model->asociar_paciente_alimentos($data);
                    }
                }
                if($this->input->post('nombre_alimento_prevenir')){
                    foreach($this->input->post('nombre_alimento_prevenir') as $alm){
                        $data=array('rut_paciente'=>$rut_paciente,
                            'id_preparacion'=>$alm,
                            'preferir'=>0,
                            'prevenir'=>1,
                            'evitar'=>0
                            );
                        $this->datos_model->asociar_paciente_alimentos($data);
                    }
                }
                if($this->input->post('nombre_alimento_evitar')){
                    foreach($this->input->post('nombre_alimento_evitar') as $alm){
                        $data=array('rut_paciente'=>$rut_paciente,
                            'id_preparacion'=>$alm,
                            'preferir'=>0,
                            'prevenir'=>0,
                            'evitar'=>1
                            );
                        $this->datos_model->asociar_paciente_alimentos($data);
                    }
                }

                redirect(base_url()."registrar/minuta/$rut_paciente");
            }
        $this->load->view("registrar/revision_examenes",compact('alimentos'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function listado_pacientes(){
        if($this->session->userdata("id")){
            $this->load->view("registrar/listado_pacientes");
        }else{
        redirect(base_url()."registrar/salir");
        }
    }
    public function listado_alimentos(){
        if($this->session->userdata("id")){
            $this->load->view("registrar/listado_alimentos");
        }else{
        redirect(base_url()."registrar/salir");
        }
    }
    public function listado_preparaciones(){
        if($this->session->userdata("id")){
            $this->load->view("registrar/listado_preparaciones",compact('preparaciones','cuantos','pagina'));
        }else{
        redirect(base_url()."registrar/salir");
        }
    }
    public function mostrar_pacientes(){
        $buscar = $this->input->post("buscar");
		$numeropagina = $this->input->post("nropagina");
        $cantidad = $this->input->post("cantidad");
        $inicio = ($numeropagina -1)*$cantidad;
        $data = array(
            "paciente" => $this->datos_model->getTodosPaginacion_pacientes($buscar,$inicio,$cantidad,"limit",$this->session->userdata("id")),
            "totalregistros" => $this->datos_model->getTodosPaginacion_pacientes($buscar,$inicio,$cantidad,"cuantos",$this->session->userdata("id")),
            "cantidad" =>$cantidad              
        );
		echo json_encode($data);
    }
    public function mostrar_patologias(){
        $buscar = $this->input->post("buscar");
		$numeropagina = $this->input->post("nropagina");
        $cantidad = $this->input->post("cantidad");
        $inicio = ($numeropagina -1)*$cantidad;
        $data = array(
            "paciente" => $this->datos_model->getTodosPaginacion_patologias($buscar,$inicio,$cantidad,"limit"),
            "totalregistros" => $this->datos_model->getTodosPaginacion_patologias($buscar,$inicio,$cantidad,"cuantos"),
            "cantidad" =>$cantidad              
        );
		echo json_encode($data);
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
    public function gestion(){
        if($this->session->userdata("id")){
            $this->load->view("registrar/gestion");
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function minuta(){
        if(($this->session->userdata("id"))&& ($rut_paciente=$this->uri->segment(3))){
            $preparaciones=$this->datos_model->get_all_preparaciones();
            if($this->input->post()){
                    foreach($this->input->post('nombre_preparacion_d') as $prep){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$prep,
                                'opcion'=>'desayuno'
                                );
                            $this->datos_model->asociar_paciente_preparaciones($data);
                    }
                    foreach($this->input->post('nombre_preparacion_co') as $prep){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$prep,
                                'opcion'=>'colacion'
                                );
                            $this->datos_model->asociar_paciente_preparaciones($data);
                    }
                    foreach($this->input->post('nombre_preparacion_e') as $prep){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$prep,
                                'opcion'=>'entrada'
                                );
                            $this->datos_model->asociar_paciente_preparaciones($data);
                    }
                    foreach($this->input->post('nombre_preparacion_a') as $prep){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$prep,
                                'opcion'=>'almuerzo'
                                );
                            $this->datos_model->asociar_paciente_preparaciones($data);
                    }
                    foreach($this->input->post('nombre_preparacion_cmd') as $prep){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$prep,
                                'opcion'=>'colacion media tarde'
                                );
                            $this->datos_model->asociar_paciente_preparaciones($data);
                    }
                    foreach($this->input->post('nombre_preparacion_o') as $prep){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$prep,
                                'opcion'=>'once'
                                );
                            $this->datos_model->asociar_paciente_preparaciones($data);
                    }
                    foreach($this->input->post('nombre_preparacion_ce') as $prep){
                            $data=array('rut_paciente'=>$rut_paciente,
                                'id_preparacion'=>$prep,
                                'opcion'=>'cena'
                                );
                            $this->datos_model->asociar_paciente_preparaciones($data);
                    }
                 redirect(base_url()."registrar/pdf/$rut_paciente");
            }
        $this->load->view("registrar/minuta",compact('preparaciones'));
        }else{
            redirect(base_url()."registrar/salir");
        }
    }
    public function pdf(){
        if(($this->session->userdata("id"))&& ($rut_paciente=$this->uri->segment(3))){
            $paciente=$this->datos_model->get_paciente_por_rut($rut_paciente);
            $preparaciones=$this->datos_model->get_preparaciones_pot_rut($rut_paciente);
            $alimentos=$this->datos_model->get_alimentos_por_rut($rut_paciente);
            $hoy = date("dmyhis");
            $pdfFilePath = $rut_paciente."_".$hoy.".pdf";
            $html='<div style="position: absolute; top: 5mm; left: 175mm; width: 100mm;">

<img style="vertical-align: top" src="assets/img/logo/logo.png" width="80"/>

</div>';
            $html.='<h1>Minuta Nutricional</h1>
<p><h5><label>Paciente: </label>'.$paciente->nombres.' '.$paciente->apellidos.'</h5></p>
<h5><label>Rut: </label>'.$paciente->rut_paciente.'</h5></p>
<table class="bpmTopnTail"><thead>
<tr class="headerrow"><th>Tiempos   </th>
<td class="pmhTopCenter">Preparación</td>
</tr>
</thead><tbody>
<tr class="evenrow"><th>
<p>Desayuno</p>
</th>

<td>
<ul>';
foreach ($preparaciones as $key => $preparacion) {
    if($preparacion->tipo=="desayuno"){
    $html.='
<li>'.$preparacion->nombre.'</li>';}}
$html.='
</ul>
</td>
</tr>
<tr class="evenrow"><th>Colación</th>
<td>
<ul>';
foreach ($preparaciones as $key => $preparacion) {
    if($preparacion->tipo=="colacion"){
    $html.='
<li>'.$preparacion->nombre.'</li>';}}
$html.='
</ul>
</td>
</tr>
<tr class="evenrow"><th>
<p>Entrada</p>
</th>
<td>
<ul>';
foreach ($preparaciones as $key => $preparacion) {
    if($preparacion->tipo=="entrada"){
    $html.='
<li>'.$preparacion->nombre.'</li>';}}
$html.='
</ul>
</td>
</tr>
<tr class="evenrow"><th>
<p>Almuerzo</p>
</th>
<td>
<ul>';
foreach ($preparaciones as $key => $preparacion) {
    if($preparacion->tipo=="almuerzo"){
    $html.='
<li>'.$preparacion->nombre.'</li>';}}
$html.='
</ul>
</td>
</tr>
<tr class="evenrow"><th>
<p>Colación media tarde</p>
</th>
<td>
<ul>';
foreach ($preparaciones as $key => $preparacion) {
    if($preparacion->tipo=="colacion media tarde"){
    $html.='
<li>'.$preparacion->nombre.'</li>';}}
$html.='
</ul>
</td>
</tr>
<tr class="evenrow"><th>
<p>Once</p>
</th>
<td>
<ul>';
foreach ($preparaciones as $key => $preparacion) {
    if($preparacion->tipo=="once"){
    $html.='
<li>'.$preparacion->nombre.'</li>';}}
$html.='
</ul>
</td>
</tr>
<tr class="evenrow"><th>
<p>Cena</p>
</th>
<td>
<ul>';
foreach ($preparaciones as $key => $preparacion) {
    if($preparacion->tipo=="cena"){
    $html.='
<li>'.$preparacion->nombre.'</li>';}}
$html.='
</ul>
</td>
</tr>
</tbody></table>
<p>&nbsp;</p>';
$html.='<h4>Restriciones de Alimentos</h4>
<table class="bpmTopnTail"><tbody>
<tr>
<td>Preferir</td>
<td>
<ul>';
foreach ($alimentos as $key => $alimento) {
    if($alimento->pref==1){
    $html.='
<li>'.$alimento->nombre.'</li>';}}
$html.='
</ul>
</td>
</tr>
<tr>
<td>Prevenir</td>
<td>
<ul>';
foreach ($alimentos as $key => $alimento) {
    if($alimento->prev==1){
    $html.='
<li>'.$alimento->nombre.'</li>';}}
$html.='
</ul>
</td>
</tr>
<tr>
<td>Evitar</td>
<td>
<ul>';
foreach ($alimentos as $key => $alimento) {
    if($alimento->evi==1){
    $html.='
<li>'.$alimento->nombre.'</li>';}}
$html.='
</ul>
</td>
</tr>
</tbody></table>';
    
            $estilos=file_get_contents(base_url()."assets/css/mpdfstyletables.css");
            $this->load->library('M_pdf');
            $mpdf = new mPDF('c');
            $mpdf->setDisplayMode('fullpage');
            $mpdf->WriteHTML($estilos,1);
            $mpdf->WriteHTML($html,2);
            $mpdf->SetProtection(array(), 'kakito', 'kakito');
            $mpdf->Output($pdfFilePath, 'I');
            exit();
    }else{
            redirect(base_url()."registrar/salir");
        }
    }
}       
