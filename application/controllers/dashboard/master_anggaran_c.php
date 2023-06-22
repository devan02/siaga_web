<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_anggaran_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model_m','model');
	}

	function index(){
		
	}

	function get_bagian(){
		$keyword = $this->input->get('keyword');
		$data = $this->model->get_bagian_all($keyword);
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */