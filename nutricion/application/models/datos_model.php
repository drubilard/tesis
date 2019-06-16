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
    	$this->db->insert('alimentos',$data);
    }
    public function insertar_preparacion($data=array()){
    	$this->db->insert('preparaciones',$data);
    }
    public function insertar_paciente($data=array()){
    	$this->db->insert('pacientes',$data);
    	return $this->db->insert_id();
    
	}
	public function get_user($user,$clave){
		$clave=sha1($clave);
		$query=$this->db
				->select("*")
				->from("usuarios")
				->where(array("usuario"=>$user,"clave"=>$clave))
				->get();

		return $query->row();
	}
	public function consulta_correo($correo){
		$query=$this->db->select('*')
			->from("pacientes")
			->where("email",$correo)
			->get();
		return $query->result();
	}
	public function consulta_usuario($usuario){
		$query=$this->db->select('*')
			->from("usuarios")
			->where("usuario",$usuario)
			->get();
		return $query->result();
	}
	public function get_all_pacientes(){
		$query=$this->db
				->select("*")
				->from("pacientes")
				->get();
		return $query->result();
	}

	public function update_usuario($id,$data){
		$this->db->set('fecha_nacimiento',$data);
		$this->db->where('id',$id);
		$this->db->update('usuarios');
		return $this->db->last_query();
	}

	public function get_administrativos($mes){
		$query=$this->db->select("u.nombre, u.apellido, a.fecha_admin")
			->from("usuarios as u, administrativos as a")
			->where("date_format(a.fecha_admin,'%m')=$mes and u.id=a.id_usuario")
			->get();
		return $query->result();
	}

	public function get_cont_administrativos($mes){
		$query=$this->db->select('count(*) as contador')
			->from('administrativos as a, usuarios as u')
			->where("date_format(a.fecha_admin,'%m')=$mes and u.id=a.id_usuario")
			->get();
		return $query->row();
	}
	public function delete_pat_hab($id){
		$this->db->where('id',$id);
        $this->db->delete('patologias_habitos');
	}
	public function delete_alimento($id){
		$this->db->where('id',$id);
        $this->db->delete('alimentos');
	}
	public function delete_preparacion($id){
		$this->db->where('id',$id);
        $this->db->delete('preparaciones');
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
                ->from("alimentos")
                ->where(array("id"=>$id))
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->row();
	}
	public function get_preparacion_id($id){
		$query=$this->db
                ->select("*")
                ->from("preparaciones")
                ->where(array("id"=>$id))
                ->get();
        //echo $this->db->last_query();exit;        
        return $query->row();
	}
	public function update_pat_hab($data=array(),$id){
		$this->db->where('id',$id)
				->update('patologias_habitos',$data);
	}
	public function update_alimento($data=array(),$id){
		$this->db->where('id',$id)
				->update('alimentos',$data);
	}
	public function update_preparacion($data=array(),$id){
		$this->db->where('id',$id)
				->update('preparaciones',$data);
	}
	public function get_patologias(){
		$query=$this->db->select('*')
				->from('patologias_habitos')
				->where('tipo',1)
				->get();
			return $query->result();
	}
	public function get_habitos(){
		$query=$this->db->select('*')
				->from('patologias_habitos')
				->where('tipo',2)
				->get();
			return $query->result();
	}
	public function get_paciente_por_rut($rut){
		$query=$this->db->select("*")
				->from('pacientes')
				->where('rut_paciente',$rut)
				->get();
		return $query->row();
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

	public function getTodosPaginacion_alimentos($pagina,$porpagina,$quehago){
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("*")
                        ->from("alimentos")
                        ->limit($porpagina,$pagina)
                        ->order_by("opcion","desc")
                        ->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
                        ->select("*")
                        ->from("alimentos")
                        ->count_all_results();
                return $query;
            break;
        }
    }
    public function getTodosPaginacion_preparaciones($pagina,$porpagina,$quehago){
        switch($quehago)
        {
            case 'limit':
                $query=$this->db
                        ->select("*")
                        ->from("preparaciones")
                        ->limit($porpagina,$pagina)
                        ->order_by("tipo","asc")
                        ->get();
                return $query->result();        
            break;
            case 'cuantos':
                $query=$this->db
                        ->select("*")
                        ->from("preparaciones")
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
     		->from('preparaciones')
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

