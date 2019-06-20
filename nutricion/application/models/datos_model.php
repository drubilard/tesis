<?php
class datos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
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
	public function get_user($user,$clave){
		$clave=sha1($clave);
		$query=$this->db
				->select("*")
				->from("nutricionista")
				->where(array("usuario"=>$user,"clave"=>$clave))
				->get();
				//echo $this->db->last_query();die;
		return $query->row();
	}
	public function consulta_usuario($usuario){
		$usuario_sha1=sha1($usuaio);
		$query=$this->db->select('*')
			->from("nutricionista")
			->where("usuario",$usuario_sha1)
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
	public function delete_pat_hab($id){
		$this->db->where('id',$id);
        $this->db->delete('patologias_habitos');
	}
	public function delete_alimento($id){
		$this->db->where('idAlimento',$id);
        $this->db->delete('alimento');
	}
	public function delete_preparacion($id){
		$this->db->where('idpreparacion',$id);
        $this->db->delete('preparacion');
	}
	public function get_pat_hab_id($id){
		$query=$this->db
                ->select("*")
                ->from("patologias_habitos")
                ->where(array("id"=>$id))
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->row();
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
	public function get_preparacion_id($id){
		$query=$this->db
                ->select("*")
                ->from("preparacion")
                ->where(array("idpreparacion"=>$id))
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->row();
	}
	public function update_pat_hab($data=array(),$id){
		$this->db->where('id',$id)
				->update('patologias_habitos',$data);
	}
	public function update_alimento($data=array(),$id){
		$this->db->where('idAlimento',$id)
				->update('alimento',$data);
	}
	public function update_preparacion($data=array(),$id){
		$this->db->where('idpreparacion',$id)
				->update('preparacion',$data);
	}
	public function get_last_paciente(){
		$query=$this->db->select("*")
				->from('pacientes')
				->limit(1)
				->order_by("fecha","desc")
				->get();
		return $query->row();
	}
	public function asociat_pat_hab_paciente($data=array()){
		$this->db->insert('paciente_pat_hab',$data);
	}
	public function asociar_paciente_alimentos($data=array()){
		$this->db->insert('paciente_alimentos',$data);
	}
	public function asociar_paciente_preparaciones($data=array()){
		$this->db->insert('paciente_preparaciones',$data);
	}
	public function add_evaluacion($data=array()){
		$this->db->insert('evaluacion_paciente',$data);
	}
	public function get_evaluacion(){
		$query=$this->db->select('*')
			->from('evaluacion_paciente')
			->get();
			return $query->result();
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
						->like('nombre',$buscar,'after')
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
	public function update_paciente($data=array(),$id){
		$this->db->where('rut',$id)
				->update('paciente',$data);
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
                        ->order_by("nombre","asc")
						->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
                        ->select("*")
						->from("paciente")
						->like('nombre',$buscar,'after')
                        ->count_all_results();
                return $query;
            break;
        }
    }

	public function getTodosPaginacion_alimentos($buscar="",$pagina,$porpagina,$quehago){
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("*")
                        ->from("alimento")
						->limit($porpagina,$pagina)
						->like('nombre',$buscar,'after')
                        ->order_by("nombre","asc")
                        ->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
                        ->select("*")
						->from("alimento")
						->like('nombre',$buscar,'after')
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
                        ->order_by("nombre","asc")
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
    			->from('alimentos')
    			->order_by("opcion","desc")
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
    public function get_preparaciones_pot_rut($id){
    	$query=$this->db->select('pre.nombre as nombre, pa.opcion as tipo')
    		->from('paciente_preparaciones as pa, preparaciones as pre')
    		->where("pa.rut_paciente='$id' and pa.id_preparacion=pre.id")
    		->get();
    	return $query->result();
    }
    public function get_alimentos_por_rut($id){
    	$query=$this->db->select('al.alimento_info as nombre, pa.preferir as pref, pa.prevenir as prev, pa.evitar as evi')
    		->from('paciente_alimentos as pa, alimentos as al')
    		->where("pa.rut_paciente='$id' and pa.id_preparacion=al.id")
    		->get();
    	return $query->result();
    }
}

