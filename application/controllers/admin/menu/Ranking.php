<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ranking extends CI_Controller {

	public function render() {
		$this->load->view('admin/menu/ranking');
	}

	public function get_area() {
		$this->load->model('admin/menu/Ranking_model');
		$output = array(
			"draw" => isset ( $_POST['draw'] ) ? intval( $_POST['draw'] ) : 0,
			"recordsTotal"    => $this->Area_model->count_all_data(),
			"recordsFiltered" => $this->Area_model->count_filtered_data(),
			"data"            => $this->Area_model->data(),
		);
		echo json_encode($output);
	}
}
