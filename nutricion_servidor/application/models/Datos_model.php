<?php
class datos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
	}
	public function insert_sesion($data){
		$this->db->insert('sesiones',$data);
		return $this->db->insert_id();
	}
	public function get_sesiones_activas($rut){
		$query=$this->db->select("id")
				->from('sesiones')
				->where(array("rut"=>$rut,"estado"=>"1"))
				->get();
		return $query->row();
	}
	public function update_sesion($id_sesion){
		$this->db->set('estado','0');
		$this->db->where('id',$id_sesion);
		$this->db->update('sesiones');
	}
	public function get_datos_informe($rut){
		$query=$this->db
			->select("fecha,peso_paciente,cintura_min_paciente,grasa_durnin_paciente,imc_paciente")
			->from("evaluacion_nutricional")
			->where("Paciente_rut",$rut)
			->order_by("fecha","asc")
			->get();
			return $query->result(); 
	}
    public function getTodosPaginacion_pat_hab($pagina,$porpagina,$quehago){
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("*")
                        ->from("patologias_habitos")
                        ->limit($porpagina,$pagina)
                        ->order_by("tipo","desc")
                        ->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
                        ->select("*")
                        ->from("patologias_habitos")
                        ->count_all_results();
                return $query;
            break;
        }
    }
    public function insertar_pat_hab($data=array()){
    	$this->db->insert('patologias_habitos',$data);
    }
    public function insertar_alimento($data=array()){
		$this->db->insert('alimento',$data);
		return $this->db->insert_id();
	}
	public function asociar_tipo_alimento($data){
		$this->db->insert('tipo_alimento',$data);
	}
	public function insertar_ficha($data=array()){
    	$this->db->insert('ficha_clinica',$data);
    }
    public function insertar_preparacion($data=array()){
    	$this->db->insert('preparacion',$data);
    }
    public function insertar_paciente($data=array()){
    	$this->db->insert('paciente',$data);
    	return $this->db->insert_id();
    
	}
	public function insertar_nutricionista($data=array()){
    	$this->db->insert('nutricionista',$data);
    	return $this->db->insert_id();
    
	}
	public function consultar_rut($rut){
		$query=$this->db
		-> select('rut')
		->from('nutricionista')
		->where("rut",$rut)
		->get();
		return $query->row();
	}
	public function get_user_nutri($user,$clave){
		$clave=sha1($clave);
		$query=$this->db
				->select("*")
				->from("nutricionista")
				->where(array("usuario"=>$user,"clave"=>$clave))
				->get();
				//echo $this->db->last_query();die;
		return $query->row();
	}
	public function get_user_admin($user,$clave){
		$query=$this->db
				->select("*")
				->from("administrador")
				->where(array("rut"=>$user,"clave"=>$clave))
				->get();
				//echo $this->db->last_query();die;
		return $query->row();
	}
	public function get_user_paciente($user,$clave){
		//$clave=sha1($clave);
		$query=$this->db
				->select("*")
				->from("paciente")
				->where(array("rut"=>$user,"clave"=>$clave))
				->get();
				//echo $this->db->last_query();die;
		return $query->row();
	}
	public function consulta_usuario($usuario){
		$query=$this->db->select('*')
			->from("nutricionista")
			->where("usuario",$usuario)
			->get();
		return $query->result();
	}
	public function consultar_rut_paciente($rut){
		$query=$this->db->select('*')
			->from("paciente")
			->where("rut",$rut)
			->get();
		return $query->result();
	}

	public function update_usuario($id,$data){
		$this->db->set('fecha_nacimiento',$data);
		$this->db->where('id',$id);
		$this->db->update('usuarios');
		return $this->db->last_query();
	}

	public function delete_paciente($id){
		$this->db->where('rut',$id);
        $this->db->delete('paciente');
	}
	public function delete_minuta($id){
		$this->db->where('idMinutas',$id);
        $this->db->delete('minutas');
	}
	public function delete_preparaciones_minuta($id){
		$this->db->where('minuta_idminuta',$id);
        $this->db->delete('preparacion_minuta');
	}
	public function delete_asignacion_patologia($rut){
		$this->db->where('Paciente_rut',$rut);
		$this->db->delete('paciente_patologia');
	}
	public function delete_evaluacion($id){
		$this->db->where('idevaluacion_nutricional',$id);
        $this->db->delete('evaluacion_nutricional');
	}
	public function delete_pat_hab($id){
		$this->db->where('id',$id);
        $this->db->delete('patologias_habitos');
	}
	public function delete_alimento($id){
		$this->db->where('idAlimento',$id);
        return $this->db->delete('alimento');
	}
	public function delete_alimento_preparacion($id){
		$this->db->where('alimento_idalimento',$id);
        return $this->db->delete('preparacion_alimento');
	}
	public function delete_ficha($id){
		$this->db->where('id',$id);
        $this->db->delete('ficha_clinica');
	}
	public function delete_preparacion($id){
		$this->db->where('idpreparacion',$id);
        return $this->db->delete('preparacion');
	}
	public function delete_preparacion_alimento($id){
		$this->db->where('preparacion_idpreparacion',$id);
        return $this->db->delete('preparacion_alimento');
	}
	public function delete_preparacion_minuta($id){
		$this->db->where('preparacion_idpreparacion',$id);
        return $this->db->delete('preparacion_minuta');
	}
	public function get_alimento_id($id){
		$query=$this->db
                ->select("*")
                ->from("alimento")
                ->where(array("idAlimento"=>$id))
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->row();
	}
	public function get_ficha_id($id){
		$query=$this->db
                ->select("*")
                ->from("ficha_clinica")
                ->where(array("id"=>$id))
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->row();
	}
	public function get_preparacion_id($id){
		$query=$this->db
                ->select("*")
                ->from("preparacion")
                ->where(array("idpreparacion"=>$id))
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->row();
	}
	public function preparaciones_por_patologia_permitidas($id=array(),$estado){
		$id=implode($id);
		//print_r($id);die;
		$query=$this->db
                ->select("DISTINCT(preparacion.nombre),preparacion.idpreparacion as id, preparacion.tipo as tipo")
                ->from("alimento, tipo, preparacion_alimento, hechos_bc_permitido, preparacion")
                ->where("hechos_bc_permitido.id_patologia in($id) and hechos_bc_permitido.id_tipo_alimento=tipo.idtipo and tipo.idtipo=alimento.tipo_alimento and alimento.idAlimento=preparacion_alimento.alimento_idalimento and preparacion_alimento.preparacion_idpreparacion=preparacion.idpreparacion and preparacion.tipo_nutri='".$estado."'")
				->order_by("preparacion.nombre","desc")
				->get();      
        return $query->result();
	}
	public function preparaciones_por_patologia_restringidas($id=array(),$estado){
		$id=implode($id);
		//print_r($id);die;
		$query=$this->db
                ->select("DISTINCT(preparacion.nombre),preparacion.idpreparacion as id, preparacion.tipo as tipo")
                ->from("alimento, tipo, preparacion_alimento, hechos_bc_restringido, preparacion")
                ->where("hechos_bc_restringido.id_patologia in($id) and hechos_bc_restringido.id_tipo_alimento=tipo.idtipo and tipo.idtipo=alimento.tipo_alimento and alimento.idAlimento=preparacion_alimento.alimento_idalimento and preparacion_alimento.preparacion_idpreparacion=preparacion.idpreparacion and preparacion.tipo_nutri='".$estado."'")
				->order_by("preparacion.nombre","desc")
				->get();      
        return $query->result();
	}
	public function preparaciones_por_gustos_restringidas($rut){
		//print_r($id);die;
		$query=$this->db
                ->select("DISTINCT(preparacion.nombre),preparacion.idpreparacion as id, preparacion.tipo as tipo")
                ->from("alimento, preparacion_alimento,alimento_paciente, preparacion, paciente")
                ->where("paciente.rut= '".$rut."' and paciente.rut=alimento_paciente.paciente_rut and alimento_paciente.alimento_idalimento=alimento.idAlimento and alimento.idAlimento=preparacion_alimento.alimento_idalimento and preparacion_alimento.preparacion_idpreparacion=preparacion.idpreparacion")
				->order_by("preparacion.nombre","desc")
				->get();      
        return $query->result();
	}
	public function tipo_alimento_por_patologia_restringidas($id=array()){
		$id=implode($id);
		//print_r($id);die;
		$query=$this->db
                ->select("tipo.nombre as nombre")
                ->from("tipo,hechos_bc_restringido")
                ->where("hechos_bc_restringido.id_patologia in('".$id."') and hechos_bc_restringido.id_tipo_alimento=tipo.idtipo ")
				->order_by("nombre","asc")
				->get();
				return $query->result();
	}
	public function update_patologia($data=array(),$id){
		$this->db->where('idPatologia',$id)
				->update('patologia',$data);
	}
	public function update_alimento($data=array(),$id){
		$this->db->where('idAlimento',$id)
				->update('alimento',$data);
	}
	public function update_ficha($data=array(),$id){
		$this->db->where('id',$id)
				->update('ficha_clinica',$data);
	}
	public function update_preparacion($data=array(),$id){
		$this->db->where('idpreparacion',$id)
				->update('preparacion',$data);
	}

	public function agregar_asociar_patologia($data=array(),$rut){
		$this->db->insert('paciente_patologia',$data);
	}
	public function insert_alimentos_asociados($data=array()){
		$this->db->insert('preparacion_alimento',$data);
		return $this->db->insert_id();
	}
	public function insert_alimentos_restringir($data=array()){
		$this->db->insert('alimento_paciente',$data);
		return $this->db->insert_id();
	}
	public function porcion_alimentos_asociados($id,$data=array()){
		$this->db->where('idpreparacion_alimento',$id)
				->update('preparacion_alimento',$data);
	}
	public function get_alimento_asociado($id){
		$query=$this->db
			->select("alimento.tipo_alimento as tipo, alimento.nombre as nombre, idpreparacion_alimento as id ")
			->from('preparacion_alimento, alimento')
			->where("idpreparacion_alimento="."'$id'"." and preparacion_alimento.alimento_idalimento=alimento.idAlimento")
			->get();
		return $query->row();
	}
	public function delete_alimentos_asociados($id){
		$this->db->where("idpreparacion_alimento",$id);
		return $this->db->delete('preparacion_alimento');
	}
	public function asociar_paciente_alimentos($data=array()){
		$this->db->insert('paciente_alimentos',$data);
	}
	public function asociar_minuta_preparaciones($data=array()){
		$this->db->insert('preparacion_minuta',$data);
	}
	public function add_evaluacion($data=array()){
		$this->db->insert('Evaluacion_nutricional',$data);
	}
	public function get_evaluacion($id){
		$query=$this->db->select('*')
			->from('evaluacion_nutricional')
			->where('idevaluacion_nutricional',$id)
			->get();
			return $query->row();
	}
	public function get_last_evaluacion($id){
		$query=$this->db->select('estado, peso_paciente')
			->from('evaluacion_nutricional')
			->where("idevaluacion_nutricional = (select max(idevaluacion_nutricional) from evaluacion_nutricional where Paciente_rut='".$id."')")
			->get();
			return $query->row();
	}
	public function get_preparaciones_minuta($id){
		$query=$this->db->select('preparacion_idpreparacion')
			->from('preparacion_minuta')
			->where('minuta_idminuta',$id)
			->get();
			return $query->result();
	}
	public function get_minuta($id){
		$query=$this->db->select('fecha,Paciente_rut')
			->from('minutas')
			->where('idMinutas',$id)
			->get();
			return $query->row();
	}
	public function add_ficha_clinica($data=array()){
		$this->db->insert('ficha_clinica',$data);
	}

	public function getTodosPaginacion_pacientes($buscar="",$pagina,$porpagina,$quehago,$rut){
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("*")
						->from("paciente")
						->where('Nutricionista_rut',$rut)
						->limit($porpagina,$pagina)
						->like('nombre',$buscar,'after')
                        ->order_by("nombre","asc")
						->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
                        ->select("*")
						->from("paciente")
						->where('Nutricionista_rut',$rut)
						->like('nombre',$buscar,'after')
                        ->count_all_results();
                return $query;
            break;
        }
	}
	public function getTodosPaginacion_evaluaciones($buscar="",$pagina,$porpagina,$quehago,$rut){
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("*")
						->from("evaluacion_nutricional")
						->where('Paciente_rut',$rut)
						->limit($porpagina,$pagina)
						->like('fecha',$buscar,'after')
						->order_by('idevaluacion_nutricional','desc')
						->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
                        ->select("*")
						->from("evaluacion_nutricional")
						->where('Paciente_rut',$rut)
						->like('fecha',$buscar,'after')
                        ->count_all_results();
                return $query;
            break;
        }
	}
	public function getTodosPaginacion_minutas($buscar="",$pagina,$porpagina,$quehago,$rut){
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("*")
						->from("minutas")
						->where('Paciente_rut',$rut)
						->limit($porpagina,$pagina)
						->like('fecha',$buscar,'after')
						->order_by('fecha','desc')
						->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
                        ->select("*")
						->from("minutas")
						->where('Paciente_rut',$rut)
						->like('fecha',$buscar,'after')
                        ->count_all_results();
                return $query;
            break;
        }
	}
	public function getTodosPaginacion_fichas($buscar="",$pagina,$porpagina,$quehago,$rut){
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("*")
						->from("ficha_clinica")
						->where('rut',$rut)
						->limit($porpagina,$pagina)
						->like('fecha',$buscar,'after')
						->order_by('fecha','desc')
						->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
                        ->select("*")
						->from("ficha_clinica")
						->where('rut',$rut)
						->like('fecha',$buscar,'after')
                        ->count_all_results();
                return $query;
            break;
        }
	}
	public function get_paciente_por_rut($rut){
		$query=$this->db->select("*")
				->from('paciente')
				->where('rut',$rut)
				->get();
		return $query->row();
	}
	public function get_paciente_por_rut_minuta($rut){
		$query=$this->db->select("paciente.rut as rut, paciente.nombre as nombre_paciente, paciente.apellido as apellido_paciente, nutricionista.Nombres as nombre_nutri, nutricionista.Apellidos as apellido_nutri")
				->from('paciente,nutricionista')
				->where("paciente.rut= '".$rut."' and paciente.Nutricionista_rut=nutricionista.rut")
				->get();
		return $query->row();
	}
	public function get_nutricionista_por_rut($rut){
		$query=$this->db->select("*")
				->from('nutricionista')
				->where('rut',$rut)
				->get();
		return $query->row();
	}
	public function update_paciente($data=array(),$id){
		$this->db->where('rut',$id)
				->update('paciente',$data);
	}	
	public function update_nutricionista($data=array(),$id){
		$this->db->where('rut',$id)
				->update('nutricionista',$data);
	}
	public function update_evaluacion($data=array(),$id){
		$this->db->where('idevaluacion_nutricional',$id)
				->update('evaluacion_nutricional',$data);
	}	
	public function getTodosPaginacion_patologias($buscar="",$pagina,$porpagina,$quehago){
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("*")
						->from("patologia")
						->limit($porpagina,$pagina)
						->like('nombre',$buscar,'after')
                        ->order_by("Grupo_patologico","asc")
						->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
                        ->select("*")
						->from("patologia")
						->like('nombre',$buscar,'after')
                        ->count_all_results();
                return $query;
            break;
        }
    }
	public function all_patologias(){
        $query=$this->db
                ->select("*")
				->from("patologia")
                ->order_by("Grupo_patologico","asc")
				->get();
                return $query->result();        

	}
	public function patologias_asociadas($rut){
        $query=$this->db
                ->select("Patologia_idPatologia")
				->from("paciente_patologia")
				->where('Paciente_rut',$rut)
                ->order_by("Patologia_idPatologia","asc")
				->get();
                return $query->result();        

    }
	public function getTodosPaginacion_alimentos($buscar="",$pagina,$porpagina,$quehago){
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("alimento.idAlimento as idAlimento, alimento.nombre as nombre, alimento.aporte as aporte, alimento.propiedades as propiedades, alimento.tipo_alimento as tipo_alimento, tipo.idtipo as idtipo, tipo.nombre as nombre_tipo")
						->from("alimento, tipo")
						->where("alimento.tipo_alimento=tipo.idtipo")
						->limit($porpagina,$pagina)
						->like('alimento.nombre',$buscar,'after')
                        ->order_by("tipo.nombre","asc")
                        ->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
                        ->select("*")
						->from("alimento, tipo")
						->where("alimento.tipo_alimento=tipo.idtipo")
						->like('alimento.nombre',$buscar,'after')
                        ->count_all_results();
                return $query;
            break;
        }
	}
	public function getTodosPaginacion_alimentos_restringir($buscar="",$pagina,$porpagina,$quehago,$id){
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("alimento.idAlimento as idAlimento, alimento.nombre as nombre, tipo.nombre as tipo")
						->from("alimento, tipo")
						->join("alimento_paciente","alimento_paciente.alimento_idalimento=alimento.idAlimento and alimento_paciente.paciente_rut='".$id."'","left")
						->where("alimento_paciente.idalimento_paciente is null and tipo.idtipo=alimento.tipo_alimento")
						->like('alimento.nombre',$buscar,'after')
						->limit($porpagina,$pagina)
                        ->order_by("alimento.nombre","asc")
                        ->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
				->select("*")
				->from("alimento")
				->join("alimento_paciente","alimento_paciente.alimento_idalimento=alimento.idAlimento and alimento_paciente.paciente_rut='".$id."'","left")
				->where("alimento_paciente.idalimento_paciente is null")
				->like('alimento.nombre',$buscar,'after')
                ->count_all_results();
                return $query;
            break;
        }
	}
	public function getTodosPaginacion_alimentos_asociar($buscar="",$pagina,$porpagina,$quehago,$id){
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("alimento.idAlimento as idAlimento, alimento.nombre as nombre, tipo.nombre as tipo")
						->from("alimento, tipo")
						->join("preparacion_alimento","preparacion_alimento.alimento_idalimento=alimento.idAlimento and preparacion_alimento.preparacion_idpreparacion='".$id."'","left")
						->where("preparacion_alimento.idpreparacion_alimento is null and tipo.idtipo=alimento.tipo_alimento")
						->like('alimento.nombre',$buscar,'after')
						->limit($porpagina,$pagina)
                        ->order_by("alimento.nombre","asc")
                        ->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
				->select("*")
				->from("alimento")
				->join("preparacion_alimento","preparacion_alimento.alimento_idalimento=alimento.idAlimento and preparacion_alimento.preparacion_idpreparacion='".$id."'","left")
				->where("preparacion_alimento.idpreparacion_alimento is null")
				->like('alimento.nombre',$buscar,'after')
                ->count_all_results();
                return $query;
            break;
        }
	}
	public function getTodosPaginacion_alimentos_quitar($buscar="",$pagina,$porpagina,$quehago,$id){
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("a.nombre as nombre, a.idAlimento as id, t.nombre as tipo, pa.idpreparacion_alimento as idpa")
						->from("alimento as a,preparacion_alimento as pa,preparacion as p, tipo as t")
						->where("alimento_idalimento =idAlimento and a.tipo_alimento=t.idtipo and idpreparacion=preparacion_idpreparacion and idpreparacion=".$id)
						->like('a.nombre',$buscar,'after')
						->limit($porpagina,$pagina)
                        ->order_by("a.nombre","asc")
                        ->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
						->select("a.nombre as nombre, a.idAlimento as id, a.tipo_alimento as tipo")
						->from("alimento as a,preparacion_alimento as pa,preparacion as p")
						->where("alimento_idalimento =idAlimento and idpreparacion=preparacion_idpreparacion and idpreparacion=".$id)
						->like('a.nombre',$buscar,'after')
                		->count_all_results();
                return $query;
            break;
        }
	}

    public function getTodosPaginacion_preparaciones($buscar="",$pagina,$porpagina,$quehago){
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("*")
                        ->from("preparacion")
						->limit($porpagina,$pagina)
						->like('nombre',$buscar,'after')
                        ->order_by("tipo","asc")
                        ->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
                        ->select("*")
						->from("preparacion")
						->like('nombre',$buscar,'after')
                        ->count_all_results();
                return $query;
            break;
        }
	}
    public function get_all_alimentos(){
    	$query=$this->db->select('*')
    			->from('alimento')
    			->order_by("nombre","desc")
    			->get();
    		return $query->result();
	}
	public function get_all_tipo_alimentos(){
    	$query=$this->db->select('*')
    			->from('tipo')
    			->order_by("nombre","asc")
    			->get();
    		return $query->result();
    }
     public function get_all_preparaciones(){
     	$query=$this->db->select('*')
     		->from('preparacion')
     		->order_by("tipo","desc")
     		->get();
     		return $query->result();
	}
	
	public function crear_minuta($data){
		$this->db->insert('minutas',$data);
		return $this->db->insert_id();
	}
	public function get_prepraciones_minuta($id){
		$query=$this->db->select('nombre,tipo, idpreparacion, kcal')
     		->from('preparacion, preparacion_minuta')
			 ->where("minuta_idminuta=".$id." and preparacion_idpreparacion=idpreparacion")
			 ->order_by('preparacion.idpreparacion','asc')
     		->get();
     		return $query->result();
	}
	public function get_alimentos_minuta($id){
		$query=$this->db->select('preparacion.idpreparacion as id,alimento.nombre as nombre, preparacion_alimento.porcion as porcion')
     		->from("preparacion, preparacion_minuta, minutas, preparacion_alimento, alimento")
     		->where("minutas.idMinutas='".$id."' and minutas.idMinutas=preparacion_minuta.minuta_idminuta and preparacion_minuta.preparacion_idpreparacion = preparacion.idpreparacion and preparacion.idpreparacion=preparacion_alimento.preparacion_idpreparacion and preparacion_alimento.alimento_idalimento=alimento.idAlimento")
			->order_by('preparacion.idpreparacion', "asc") 
			 ->get();
     		return $query->result();
	}
	public function get_alimentos_minuta_prop_apor($id){
		$query=$this->db->select('distinct(alimento.nombre) as nombre, alimento.aporte as aporte, alimento.propiedades as propiedades')
     		->from("preparacion, preparacion_minuta, minutas, preparacion_alimento, alimento")
     		->where("minutas.idMinutas='".$id."' and minutas.idMinutas=preparacion_minuta.minuta_idminuta and preparacion_minuta.preparacion_idpreparacion = preparacion.idpreparacion and preparacion.idpreparacion=preparacion_alimento.preparacion_idpreparacion and preparacion_alimento.alimento_idalimento=alimento.idAlimento")
			->order_by('nombre', "asc") 
			 ->get();
     		return $query->result();
	}
	public function get_patologia_rut($rut){
		$query=$this->db
                ->select("idPatologia,nombre,consideraciones")
                ->from("paciente_patologia,patologia")
                ->where("Paciente_rut='".$rut."' and Patologia_idPatologia=idPatologia")
				->get();      
        return $query->result();
	}
	public function get_patologia_id($id){
		$query=$this->db
                ->select("nombre,consideraciones")
                ->from("patologia")
                ->where("idPatologia=",$id)
				->get();      
        return $query->row();
	}

	public function get_porc_grasa($sexo){
		$query=$this->db
			->select ("*")
			->from ("porcen_grasa")
			->where("sexo",$sexo)
			->get();
		return $query->result();
	}
}

