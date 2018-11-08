<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coments_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function create_coments($data) {
		if ($this->db->insert('coments', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function get_coments($demands_id) {
		$this->db
			->select('coments.id,coments.comment,coments.data, users.name,profile_type.type')
			->join('users', 'users.id = coments.users_id')
			->join('profile_type', 'profile_type.id = users.profile_type_id')
			->where('coments.excluded !=', 1)
			->where('coments.demands_id', $demands_id)
			->order_by('coments.data', 'ASC');
		if ( $result = $this->db->get('coments')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}

	// public function update_coments($comment, $commentid, $userid, ) {
	// 	$this->db->where('id', $demandid);
	// 	$this->db->where('users_id', $userid);
	// 	if ($this->db->update('coments',$data)) {
	// 		return TRUE;
	// 	}else{
	// 		return FALSE;
	// 	}
	// }

	public function delete_coments($data) {
		$this->db->where('id', $data['coment_id'])->where('users_id', $data['users_id']);
		if ($this->db->update('coments',array('excluded' => 1))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
