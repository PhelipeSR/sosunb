<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function create_user($data) {
		if ($this->db->insert('users', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function update_user($data, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('users',$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function get_info_user($id) {
		$this->db
			->select('
				id,
				name,
				registry,
				identity,
				DATE_FORMAT(`date_birth`, "%d/%m/%Y") AS date_birth,
				email,
				CONCAT("'.base_url('uploads/perfil/').'",image_profile) AS image_profile
			')
			->where('id',$id);
		if ( $result = $this->db->get('users')->row() ) {
			return $result;
		}else{
			return FALSE;
		}
	}

	public function delete_user($id) {
		$this->db->where('id', $id);
		if ($this->db->update('users',array('excluded' => 1))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}