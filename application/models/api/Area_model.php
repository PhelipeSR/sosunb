<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function get_area() {
		$this->db
			->select('id, area')
			->order_by('area', 'ASC')
			->where('excluded', 0);
		if ( $result = $this->db->get('area')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}
}
