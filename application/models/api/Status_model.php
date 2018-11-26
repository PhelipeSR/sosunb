<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function get_status() {
		$this->db
			->select('id, name AS status')
			->where('excluded !=', 1);
		if ( $result = $this->db->get('status')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}
}
