<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demands_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function create_demands($data) {
		if ($this->db->insert('demands', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}



	public function delete_demands($data, $user=FALSE) {
		if($user){
			$this->db->where('users_id', $data['users_id']);
		}
		$this->db->where('id', $data['demands_id']);
		if ($this->db->update('demands',array('excluded' => 1))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}



}
