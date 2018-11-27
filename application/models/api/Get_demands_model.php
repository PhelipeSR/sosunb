<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_demands_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function ranking($id = 0, $campus = NULL) {
		$report = $this->db->select('report_historic.demands_id')->where('report_historic.users_id', $id)->get('report_historic')->result_array();
		$exclude = array(0);
		foreach ($report as $key => $value) {
			array_push($exclude, $value['demands_id']);
		}
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
				environment.environment,
				type_demand.demands AS type_demand,
				IF(demands.users_id = '.$id.', "true", "false") AS owner_demands,
				IF((SELECT COUNT(*) FROM likes as teste WHERE teste.users_id = '.$id.' AND teste.demands_id = likes.demands_id) > 0, "true", "false") AS gave_like,
			')
			->from('likes')
			->where('demands.excluded', 0)
			->where('status.id !=', 4)
			->where('status.id !=', 5)
			->where_not_in('demands.id',$exclude)
			->group_by("likes.demands_id")
			->join('demands', 'likes.demands_id = demands.id')
			->join('users', 'demands.users_id = users.id')
			->join('local', 'demands.local_id = local.id','left')
			->join('status', 'demands.status_id = status.id')
			->join('campus', 'demands.campus_id = campus.id','left')
			->join('environment', 'demands.environment_id = environment.id')
			->join('type_demand', 'demands.type_demand_id = type_demand.id')
			->order_by('total_likes', 'DESC')
			->group_start()
				->where('demands.counter <', 5)
				->or_where('demands.resolved >', 0)
			->group_end()
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
						CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
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
						CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
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

	public function feed($id = 0, $limit = 0, $status = NULL) {
		$report = $this->db->select('report_historic.demands_id')->where('report_historic.users_id', $id)->get('report_historic')->result_array();
		$exclude = array(0);
		foreach ($report as $key => $value) {
			array_push($exclude, $value['demands_id']);
		}
		$this->db
			->select('
				CONCAT("'.base_url('uploads/demandas/').'",demands.image) AS image_demand,
				CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
				(SELECT COUNT(*) FROM likes as teste WHERE teste.demands_id = demands.id) AS total_likes,
				demands.id AS demand_id,
				demands.title,
				demands.description,
				DATE_FORMAT(`created_date`, "%d/%m/%Y %H:%i") AS created_date,
				users.name,
				local.local,
				status.name AS status,
				campus.campus,
				environment.environment,
				type_demand.demands AS type_demand,
				IF(demands.users_id = '.$id.', "true", "false") AS owner_demands,
				IF((SELECT COUNT(*) FROM likes as teste WHERE teste.users_id = '.$id.' AND teste.demands_id = demands.id) > 0, "true", "false") AS gave_like,
			')
			->from('demands')
			->join('users', 'demands.users_id = users.id')
			->join('local', 'demands.local_id = local.id','left')
			->join('status', 'demands.status_id = status.id')
			->join('campus', 'demands.campus_id = campus.id','left')
			->join('environment', 'demands.environment_id = environment.id')
			->join('type_demand', 'demands.type_demand_id = type_demand.id')
			->where('demands.excluded', 0)
			->where_not_in('demands.id',$exclude)
			->group_start()
				->where('demands.counter <', 5)
				->or_where('demands.resolved >', 0)
			->group_end()
			->order_by('demands.created_date', 'DESC')
			->limit(5,$limit);
		if ($status)
			$this->db->where('demands.status_id', $status);
		if ($this->input->post('search')) {
			$this->db->group_start()
						->like(    'demands.title',       $this->input->post('search') )
						->or_like( 'demands.description', $this->input->post('search') )
						->or_like( 'users.name', $this->input->post('search') )
						->or_like( 'local.local', $this->input->post('search') )
						->or_like( 'environment.environment', $this->input->post('search') )
						->or_like( 'campus.campus', $this->input->post('search') )
					->group_end();
		}

		if ( $result = $this->db->get()->result_array()){
			foreach ($result as $key => $value){
				$comments = $this->db
					->select('
						comments.id AS comment_id,
						comments.comment,
						users.name,
						CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
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
						CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
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

	public function resolved($id = 0, $limit = 0, $status = NULL) {
		$this->db
			->select('
				CONCAT("'.base_url('uploads/demandas/').'",demands.image) AS image_demand,
				demands.id AS demand_id,
				demands.title,
				demands.description,
			')
			->from('demands')
			->where('demands.excluded', 0)
			->where('demands.status_id', 4)
			->group_start()
				->where('demands.counter <', 5)
				->or_where('demands.resolved >', 0)
			->group_end()
			->order_by('demands.title', 'RANDOM')
			->limit(6);

		if ( $result = $this->db->get()->result_array()){
			return $result;
		}
		else{
			return FALSE;
		}
	}

	public function similar($id = 0, $campus = NULL, $environment = NULL, $local = NULL) {
		$report = $this->db->select('report_historic.demands_id')->where('report_historic.users_id', $id)->get('report_historic')->result_array();
		$exclude = array(0);
		foreach ($report as $key => $value) {
			array_push($exclude, $value['demands_id']);
		}
		$this->db
			->select('
				CONCAT("'.base_url('uploads/demandas/').'",demands.image) AS image_demand,
				CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
				(SELECT COUNT(*) FROM likes as teste WHERE teste.demands_id = demands.id) AS total_likes,
				demands.id AS demand_id,
				demands.title,
				demands.description,
				DATE_FORMAT(`created_date`, "%d/%m/%Y %H:%i") AS created_date,
				users.name,
				local.local,
				status.name AS status,
				campus.campus,
				environment.environment,
				type_demand.demands AS type_demand,
				IF(demands.users_id = '.$id.', "true", "false") AS owner_demands,
				IF((SELECT COUNT(*) FROM likes as teste WHERE teste.users_id = '.$id.' AND teste.demands_id = demands.id) > 0, "true", "false") AS gave_like,
			')
			->from('demands')
			->join('users', 'demands.users_id = users.id')
			->join('local', 'demands.local_id = local.id','left')
			->join('status', 'demands.status_id = status.id')
			->join('campus', 'demands.campus_id = campus.id','left')
			->join('environment', 'demands.environment_id = environment.id')
			->join('type_demand', 'demands.type_demand_id = type_demand.id')
			->where('demands.excluded', 0)
			->where('demands.campus_id', $campus)
			->where('demands.environment_id', $environment)
			->where_not_in('demands.id',$exclude)
			->group_start()
				->where('demands.counter <', 5)
				->or_where('demands.resolved >', 0)
			->group_end()
			->order_by('demands.created_date', 'DESC');
		if ($local)
			$this->db->where('demands.local_id', $local);

		if ( $result = $this->db->get()->result_array()){
			foreach ($result as $key => $value){
				$comments = $this->db
					->select('
						comments.id AS comment_id,
						comments.comment,
						users.name,
						CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
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
						CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
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

	public function single($id = 0, $demand_id = 0, $denuncia = TRUE) {
		$report = $this->db->select('report_historic.demands_id')->where('report_historic.users_id', $id)->get('report_historic')->result_array();
		$exclude = array(0);
		foreach ($report as $key => $value) {
			array_push($exclude, $value['demands_id']);
		}
		$this->db
			->select('
				CONCAT("'.base_url('uploads/demandas/').'",demands.image) AS image_demand,
				CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
				(SELECT COUNT(*) FROM likes as teste WHERE teste.demands_id = demands.id) AS total_likes,
				demands.id AS demand_id,
				demands.title,
				demands.description,
				DATE_FORMAT(`created_date`, "%d/%m/%Y %H:%i") AS created_date,
				users.name,
				local.local,
				status.name AS status,
				campus.campus,
				environment.environment,
				type_demand.demands AS type_demand,
				IF(demands.users_id = '.$id.', "true", "false") AS owner_demands,
				IF((SELECT COUNT(*) FROM likes as teste WHERE teste.users_id = '.$id.' AND teste.demands_id = demands.id) > 0, "true", "false") AS gave_like,
			')
			->from('demands')
			->join('users', 'demands.users_id = users.id')
			->join('local', 'demands.local_id = local.id','left')
			->join('status', 'demands.status_id = status.id')
			->join('campus', 'demands.campus_id = campus.id','left')
			->join('environment', 'demands.environment_id = environment.id')
			->join('type_demand', 'demands.type_demand_id = type_demand.id')
			->where('demands.excluded', 0)
			->where_not_in('demands.id',$exclude)
			->where('demands.id', $demand_id);
			if ($denuncia) {
				$this->db
				->group_start()
					->where('demands.counter <', 5)
					->or_where('demands.resolved >', 0)
				->group_end();
			}
		$this->db->order_by('demands.created_date', 'DESC');
		if ($this->input->post('search')) {
			$this->db->group_start()
						->like(    'demands.title',       $this->input->post('search') )
						->or_like( 'demands.description', $this->input->post('search') )
						->or_like( 'users.name', $this->input->post('search') )
						->or_like( 'local.local', $this->input->post('search') )
						->or_like( 'environment.environment', $this->input->post('search') )
						->or_like( 'campus.campus', $this->input->post('search') )
					->group_end();
		}

		if ( $result = $this->db->get()->result_array()){
			foreach ($result as $key => $value){
				$comments = $this->db
					->select('
						comments.id AS comment_id,
						comments.comment,
						users.name,
						CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
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
						CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
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

	public function profile($id = 0) {
		$reclamacao = $this->profile_data($id, 1);
		$sugestao = $this->profile_data($id, 2);
		$comments = $this->profile_interaction_comments($id);
		$likes = $this->profile_interaction_likes($id);

		return array(
			'reclamacao' => $reclamacao,
			'sugestao' => $sugestao,
			'comentarios' => $comments,
			'likes' => $likes,
		);
	}

	public function profile_data($id, $type_demand){
		$report = $this->db->select('report_historic.demands_id')->where('report_historic.users_id', $id)->get('report_historic')->result_array();
		$exclude = array(0);
		foreach ($report as $key => $value) {
			array_push($exclude, $value['demands_id']);
		}
		$this->db
			->select('
				CONCAT("'.base_url('uploads/demandas/').'",demands.image) AS image_demand,
				CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
				(SELECT COUNT(*) FROM likes as teste WHERE teste.demands_id = demands.id) AS total_likes,
				demands.id AS demand_id,
				demands.title,
				demands.description,
				DATE_FORMAT(`created_date`, "%d/%m/%Y %H:%i") AS created_date,
				users.name,
				local.local,
				status.name AS status,
				campus.campus,
				environment.environment,
				type_demand.demands AS type_demand,
				IF(demands.users_id = '.$id.', "true", "false") AS owner_demands,
				IF((SELECT COUNT(*) FROM likes as teste WHERE teste.users_id = '.$id.' AND teste.demands_id = demands.id) > 0, "true", "false") AS gave_like,
			')
			->from('demands')
			->join('users', 'demands.users_id = users.id')
			->join('local', 'demands.local_id = local.id','left')
			->join('status', 'demands.status_id = status.id')
			->join('campus', 'demands.campus_id = campus.id','left')
			->join('environment', 'demands.environment_id = environment.id')
			->join('type_demand', 'demands.type_demand_id = type_demand.id')
			->where('demands.excluded', 0)
			->where_not_in('demands.id',$exclude)
			->where('demands.users_id', $id)
			->where('demands.type_demand_id', $type_demand)
			->group_start()
				->where('demands.counter <', 5)
				->or_where('demands.resolved >', 0)
			->group_end()
			->order_by('demands.created_date', 'DESC');

		$result = $this->db->get()->result_array();

		foreach ($result as $key => $value){
			$comments = $this->db
				->select('
					comments.id AS comment_id,
					comments.comment,
					users.name,
					CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
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
					CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
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

	public function profile_interaction_comments($id){
		$report = $this->db->select('report_historic.demands_id')->where('report_historic.users_id', $id)->get('report_historic')->result_array();
		$exclude = array(0);
		foreach ($report as $key => $value) {
			array_push($exclude, $value['demands_id']);
		}
		$this->db
			->select('
				CONCAT("'.base_url('uploads/demandas/').'",demands.image) AS image_demand,
				CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
				(SELECT COUNT(*) FROM likes as teste WHERE teste.demands_id = demands.id) AS total_likes,
				demands.id AS demand_id,
				demands.title,
				demands.description,
				DATE_FORMAT(`created_date`, "%d/%m/%Y %H:%i") AS created_date,
				users.name,
				local.local,
				status.name AS status,
				campus.campus,
				environment.environment,
				type_demand.demands AS type_demand,
				IF(demands.users_id = '.$id.', "true", "false") AS owner_demands,
				IF((SELECT COUNT(*) FROM likes as teste WHERE teste.users_id = '.$id.' AND teste.demands_id = demands.id) > 0, "true", "false") AS gave_like,
			')
			->from('comments')
			->join('demands', 'comments.demands_id = demands.id')
			->join('users', 'demands.users_id = users.id')
			->join('local', 'demands.local_id = local.id','left')
			->join('status', 'demands.status_id = status.id')
			->join('campus', 'demands.campus_id = campus.id','left')
			->join('environment', 'demands.environment_id = environment.id')
			->join('type_demand', 'demands.type_demand_id = type_demand.id')
			->where('demands.excluded', 0)
			->where_not_in('demands.id',$exclude)
			->where('comments.users_id', $id)
			->group_start()
				->where('demands.counter <', 5)
				->or_where('demands.resolved >', 0)
			->group_end()
			->order_by('demands.created_date', 'DESC')
			->group_by("comments.demands_id");

		$result = $this->db->get()->result_array();

		foreach ($result as $key => $value){
			$comments = $this->db
				->select('
					comments.id AS comment_id,
					comments.comment,
					users.name,
					CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
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
					CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
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

	public function profile_interaction_likes($id){
		$report = $this->db->select('report_historic.demands_id')->where('report_historic.users_id', $id)->get('report_historic')->result_array();
		$exclude = array(0);
		foreach ($report as $key => $value) {
			array_push($exclude, $value['demands_id']);
		}
		$this->db
			->select('
				CONCAT("'.base_url('uploads/demandas/').'",demands.image) AS image_demand,
				CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
				(SELECT COUNT(*) FROM likes as teste WHERE teste.demands_id = demands.id) AS total_likes,
				demands.id AS demand_id,
				demands.title,
				demands.description,
				DATE_FORMAT(`created_date`, "%d/%m/%Y %H:%i") AS created_date,
				users.name,
				local.local,
				status.name AS status,
				campus.campus,
				environment.environment,
				type_demand.demands AS type_demand,
				IF(demands.users_id = '.$id.', "true", "false") AS owner_demands,
				IF((SELECT COUNT(*) FROM likes as teste WHERE teste.users_id = '.$id.' AND teste.demands_id = demands.id) > 0, "true", "false") AS gave_like,
			')
			->from('likes')
			->join('demands', 'likes.demands_id = demands.id')
			->join('users', 'demands.users_id = users.id')
			->join('local', 'demands.local_id = local.id','left')
			->join('status', 'demands.status_id = status.id')
			->join('campus', 'demands.campus_id = campus.id','left')
			->join('environment', 'demands.environment_id = environment.id')
			->join('type_demand', 'demands.type_demand_id = type_demand.id')
			->where('demands.excluded', 0)
			->where_not_in('demands.id',$exclude)
			->where('likes.users_id', $id)
			->group_start()
				->where('demands.counter <', 5)
				->or_where('demands.resolved >', 0)
			->group_end()
			->order_by('demands.created_date', 'DESC')
			->group_by("likes.demands_id");

		$result = $this->db->get()->result_array();

		foreach ($result as $key => $value){
			$comments = $this->db
				->select('
					comments.id AS comment_id,
					comments.comment,
					users.name,
					CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
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
					CONCAT("'.base_url('uploads/perfil/').'",users.image_profile) AS image_profile,
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
}
