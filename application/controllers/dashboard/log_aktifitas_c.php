<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_aktifitas_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('log_aktifitas_m','model');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
		$data = array(
		  'page' => "dashboard/log_aktifitas_v",
		  'induk_menu' => "",
		  'menu' => "log_user",
		  'title' => "LOG AKTIFITAS PENGGUNA",		
		  'departemen'	=> $this->dep_div->departemen(),  
		);
		$this->load->view('dashboard/beranda_v', $data);
	}
}