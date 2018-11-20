<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function verify_login($data){

		$this->db->select( '*' );
		$this->db->where('email', $data['email']);
		$this->db->where('excluded', 0);
		$this->db->where('profile_type_id !=', 1);
		$result = $this->db->get('users');

		if ($result->num_rows() == 1) {
			$row = $result->row();
			if (password_verify( $data['password'], $row->password)) {
				return $row;
			}else{
				return FALSE;
			}
		}
	}
}