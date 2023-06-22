<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departemen_divisi_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
	}

	function index(){
		$data = array(
		  'page' => "",
		  'induk_menu' => "",
		  'menu' => "",
		  'title' => "",
		  'departemen'	=> $this->dep_div->departemen(),	  
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function divisi(){
		$sessi = $this->session->userdata('masuk_bos');
		$id_dep = $sessi['id_departemen'];
		$id_div = $sessi['id_divisi'];
		$id_departemen = $this->input->post('id_departemen');
		$data = $this->dep_div->divisi($id_departemen);
		echo json_encode($data);
	}

	function get_dep_div(){
		$id_divisi = $this->input->post('id_divisi');
		$data = $this->dep_div->get_divisi_id($id_divisi);
		echo json_encode($data);
	}

	function get_bagian_id(){
		$id_bagian = $this->input->post('id_bagian');
		$data = $this->dep_div->get_bagian_id($id_bagian);
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */