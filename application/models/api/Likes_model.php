<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Likes_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function create_like($data) {
		if ($this->db->insert('likes', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function delete_like($demandsid, $userid) {
		$this->db->where('demands_id', $demandsid);
		$this->db->where('users_id', $userid);
		if ($this->db->delete('likes')) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

}
