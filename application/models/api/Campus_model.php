<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campus_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function get_campus() {
		$this->db
			->select('id, campus')
			->order_by('campus', 'ASC')
			->where('excluded', 0);
		if ( $result = $this->db->get('campus')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}
}
