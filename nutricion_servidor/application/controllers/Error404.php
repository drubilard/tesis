<?php
if (!defined('BASEPATH'))
   exit('No direct script access allowed');
class Error404 extends CI_Controller { 
   public function index(){
	   	if ($this->session->userdata("rut")||$this->session->userdata("id")||$this->session->userdata("admin")){
	    	$this->load->view("error404/no_disponible");
	   }else{
	   	redirect(base_url()."administrar/salir");
	   }
	}
}