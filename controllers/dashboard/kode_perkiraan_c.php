<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kode_perkiraan_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('kode_perkiraan_m','model');
	}

	function index(){
		
	}

	function get_kode_perkiraan(){
		$keyword = $this->input->get('keyword');
		$data = $this->model->get_koper_all($keyword);
		echo json_encode($data);
	}

	function get_koper_id(){
		$id_koper = $this->input->post('id_koper');
		$data = $this->model->get_koper_id($id_koper);
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */