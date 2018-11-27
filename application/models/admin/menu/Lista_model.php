<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lista_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	private $table        = 'demands';
	private $colunas      = array(
		'demands.id',
		'demands.image AS image_demand',
		'demands.title',
		'status.name AS status',
		'type_demand.demands',
		'type_problems.type',
		'environment.environment',
		'campus.campus',
		'status.id AS status_id',
		'category.category',
		'demands.campus_id AS campus_id',
		'area.id AS area_id',
		'local.id AS local_id',
		'demands.environment_id',
		'demands.excluded',
		'demands.type_problems_id',

	);
	private $order_column = array('demands.id', NULL,'demands.title','status.name','type_demand.demands','category.category',NULL,'campus.campus',null);

	/*
	* =====================================================================
	* DATATABLES USUÁRIOS ATIVOS
	* =====================================================================
	*/

	public function query_builder(){

		$this->db->select($this->colunas);
		$this->db->from($this->table);
		$this->db
			->join('users', 'demands.users_id = users.id')
			->join('local', 'demands.local_id = local.id','left')
			->join('status', 'demands.status_id = status.id')
			->join('campus', 'demands.campus_id = campus.id','left')
			->join('environment', 'demands.environment_id = environment.id')
			->join('area', 'environment.area_id = area.id')
			->join('type_demand', 'demands.type_demand_id = type_demand.id')
			->join('type_problems', 'demands.type_problems_id = type_problems.id')
			->join('category', 'type_problems.category_id = category.id')
			->group_start()
				->where('demands.counter <', 5)
				->or_where('demands.resolved >', 0)
			->group_end();

		if (isset($_POST['search']['value'])) {
			$this->db
					->group_start()
						->like(    'demands.title',            $this->input->post('search')['value'] )
						->or_like( 'demands.description',      $this->input->post('search')['value'] )
						->or_like( 'users.name',               $this->input->post('search')['value'] )
						->or_like( 'local.local',              $this->input->post('search')['value'] )
						->or_like( 'environment.environment',  $this->input->post('search')['value'] )
						->or_like( 'campus.campus',            $this->input->post('search')['value'] )
					->group_end();
		}

		if ( $this->input->post('order') ) {
			$this->db->order_by( $this->order_column[ $this->input->post('order')['0']['column'] ], $this->input->post('order')['0']['dir'] );
		}else{
			$this->db->order_by( 'demands.id', 'DESC' );
		}
	}

	public function count_filtered_data(){
		$this->query_builder();
		return $this->db->get()->num_rows();
	}

	public function count_all_data(){
		return $this->db
			->from($this->table)
			->group_start()
				->where('demands.counter <', 5)
				->or_where('demands.resolved >', 0)
			->group_end()
			->count_all_results();
	}

	public function data(){
		if ( $this->input->post( 'length') != -1) {
			$this->db->limit( $this->input->post( 'length'), $this->input->post('start'));
		}
		$this->query_builder();
		return $this->db->get()->result();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function create_user($data) {
		if ($this->db->insert('users', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function update_local($data, $user_id) {
		$status_atual = $this->get_status_demands($data['id']);

		$this->db->where('id', $data['id']);
		if ($this->db->update('demands',array(
			'local_id' => $data['local_id'],
			'environment_id' => $data['environment_id'],
			'campus_id' => $data['campus_id'],
			'status_id' => 3,
		))) {
			$this->db->insert('answers',array('comment' => $data['comment'],'previous_status' => $status_atual,'current_status' => 3,'demands_id' => $data['id'], 'users_id' => $user_id));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function update_problema($data, $user_id) {
		$status_atual = $this->get_status_demands($data['id']);

		$this->db->where('id', $data['id']);
		if ($this->db->update('demands',array(
			'type_problems_id' => $data['type_problems_id'],
			'status_id' => 2,
		))) {
			$this->db->insert('answers',array('comment' => $data['comment'],'previous_status' => $status_atual,'current_status' => 2,'demands_id' => $data['id'], 'users_id' => $user_id));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function update_status($data, $user_id) {
		$status_atual = $this->get_status_demands($data['id']);

		$this->db->where('id', $data['id']);
		if ($this->db->update('demands',array(
			'status_id' => $data['status_id'],
		))) {
			$this->db->insert('answers',array('comment' => $data['comment'],'previous_status' => $status_atual,'current_status' => $data['status_id'],'demands_id' => $data['id'], 'users_id' => $user_id));
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete_demand($excluded, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('demands',array('excluded' => $excluded))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function get_tipo_user(){
		$this->db->select('id,type')->where('excluded !=', 1)->order_by('type', 'ASC');
		if ( $result = $this->db->get('profile_type')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}

	public function get_status_demands($id){
		$this->db->select('status_id')->where('id', $id);
		if ( $result = $this->db->get('demands')->row()){
			return $result->status_id;
		}
		else{
			return FALSE;
		}
	}
}