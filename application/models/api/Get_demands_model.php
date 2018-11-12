<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_demands_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function ranking($campus = NULL, $id = 0) {

		$this->db
			->select('
				CONCAT("'.base_url('uploads/demandas/').'",demands.image) AS image_demand,
				CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
				count(likes.demands_id) AS total_likes,
				likes.demands_id AS demand_id,
				demands.title,
				demands.description,
				DATE_FORMAT(`created_date`, "%d/%m/%Y %H:%i") AS created_date,
				users.name,
				local.local,
				status.name AS status,
				campus.campus,
				IF(demands.users_id = '.$id.', "true", "false") AS owner_demands,
				IF((SELECT COUNT(*) FROM likes as teste WHERE teste.users_id = '.$id.' AND teste.demands_id = likes.demands_id) > 0, "true", "false") AS gave_like,
			')
			->from('likes')
			->where('demands.excluded !=', 1)
			->where('status.id !=', 4)
			->where('status.id !=', 5)
			->group_by("likes.demands_id")
			->join('demands', 'likes.demands_id = demands.id')
			->join('users', 'demands.users_id = users.id')
			->join('local', 'demands.local_id = local.id')
			->join('status', 'demands.status_id = status.id')
			->join('campus', 'local.campus_id = campus.id')
			->order_by('total_likes', 'DESC')
			->limit(10);
		if ($campus)
			$this->db->where('campus.id', $campus);

		if ( $result = $this->db->get()->result_array()){
			foreach ($result as $key => $value){
				$comments = $this->db
					->select('
						comments.id AS comment_id,
						comments.comment,
						users.name,
						users.image_profile,
						DATE_FORMAT(`data`, "%d/%m/%Y %H:%i") AS created_date,
						IF(comments.users_id='.$id.', "true", "false") AS owner_comment
					')
					->join('users', 'comments.users_id = users.id')
					->where('demands_id', $value['demand_id'])
					->order_by('data', 'ASC')
					->get('comments')
					->result_array();

				$answers = $this->db
					->select('
						answers.id AS answer_id,
						answers.comment,
						previous_status.name AS previous_status,
						current_status.name AS current_status,
						users.name,
						users.image_profile,
						DATE_FORMAT(`data`, "%d/%m/%Y %H:%i") AS created_date,
						IF(answers.users_id='.$id.', "true", "false") AS owner_answer
					')
					->join('users', 'answers.users_id = users.id')
					->join('status AS previous_status', 'answers.previous_status = previous_status.id')
					->join('status AS current_status', 'answers.current_status = current_status.id')
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
