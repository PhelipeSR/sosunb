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
		if ($this->db->insert('comments', $data)){
			return $this->db->insert_id();
		}
		else{
			return FALSE;
		}
	}

	public function get_coments($demands_id) {
		$this->db
			->select('comments.id,comments.comment,comments.data, users.name,profile_type.type')
			->join('users', 'users.id = comments.users_id')
			->join('profile_type', 'profile_type.id = users.profile_type_id')
			// ->where('comments.excluded !=', 1)
			->where('comments.demands_id', $demands_id)
			->order_by('comments.data', 'ASC');
		if ( $result = $this->db->get('comments')->result()){
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
		$this->db->where('id', $data['comment_id'])->where('users_id', $data['users_id']);
		$this->db->delete('comments');
		// if ($this->db->delete('comments') {
		// 	 return TRUE;
		// }else{
		// 	return FALSE;
		// }
		return TRUE;
	}
}
