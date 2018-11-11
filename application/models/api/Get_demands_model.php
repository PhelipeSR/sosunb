<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_demands_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function ranking($campus = NULL) {

		$this->db->select('
			likes.demands_id AS demand_id,
			count(likes.demands_id) AS likes,
			demands.title,
			demands.image,
			demands.description,
			DATE_FORMAT(`created_date`, "%d/%m/%Y %H:%i") AS created_date,
			users.name,
			users.image_profile,
			local.local,
			status.name AS status,
			campus.campus,
		');
		if ($campus) $this->db->where('campus.id', $campus);
		$this->db->where('demands.excluded !=', 1);
		$this->db->where('status.id !=', 4);
		$this->db->where('status.id !=', 5);
		$this->db->group_by("likes.demands_id");
		$this->db->join('demands', 'likes.demands_id = demands.id');
		$this->db->join('users', 'demands.users_id = users.id');
		$this->db->join('local', 'demands.local_id = local.id');
		$this->db->join('status', 'demands.status_id = status.id');
		$this->db->join('campus', 'local.campus_id = campus.id');
		$this->db->order_by('likes', 'DESC');
		$this->db->limit(10);

		if ( $result = $this->db->get('likes')->result_array()){
			foreach ($result as $key => $value){
				$comments = $this->db
					->select('
						comments.id AS comment_id,
						comments.comment,
						users.name,
						users.image_profile,
						DATE_FORMAT(`data`, "%d/%m/%Y %H:%i") AS created_date,
					')
					->join('users', 'comments.users_id = users.id')
					->where('demands_id', $value['demand_id'])
					->order_by('data', 'ASC')
					->get('comments')
					->result_array();

				$answers = $this->db
					->select('
						answers.id AS comment_id,
						answers.comment,
						users.name,
						users.image_profile,
						DATE_FORMAT(`data`, "%d/%m/%Y %H:%i") AS created_date,
					')
					->join('users', 'answers.users_id = users.id')
					->where('demands_id', $value['demand_id'])
					->order_by('data', 'ASC')
					->get('answers')
					->result_array();

				$result[$key]['comments'] = $comments;
				$result[$key]['answers'] = $answers;
			}
			return $result;
		}
		else{
			return FALSE;
		}
	}
}
