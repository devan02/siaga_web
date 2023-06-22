<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyeksi_arus_kas_revisi_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('proyeksi_arus_kas_revisi_m','model');
	}

	function index(){
		$data = array(
		  'page' 		=> "dashboard/proyeksi_arus_kas_revisi_v",
		  'induk_menu' 	=> "proyeksi_anggaran",
		  'menu' 		=> "proyeksi_arus_kas_revisi",
		  'title'		=> "PROYEKSI ARUS KAS",
		  'url'			=> '',
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

}