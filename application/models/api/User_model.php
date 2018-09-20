<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function create_user($data) {
		if ($this->db->insert('usuarios', $data)){
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

	public function delete_user($id) {
		if ( $this->db->delete('users', array('id' => $id)) ) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

		/*
	* =====================================================================
	* Outros
	* =====================================================================
	*/

	public function get_permission_groups() {
		if ($result = $this->db->get('permission_groups')->result_array()){
			return $result;
		}else{
			return FALSE;
		}
	}
}