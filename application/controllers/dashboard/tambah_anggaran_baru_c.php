<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tambah_anggaran_baru_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('realisasi_anggaran_m','model');
		$this->load->model('departemen_divisi_m','dep_div');
	}

	function index(){
		$data = array(
		  'page' 		=> "dashboard/tambah_anggaran_baru_v",
		  'induk_menu' 	=> "",
		  'menu' 		=> "",
		  'title' 		=> "TAMBAH ANGGARAN BARU",
		  'url'			=> "",
		  'departemen'	=> $this->dep_div->departemen(),
		);
		$this->load->view('dashboard/beranda_v', $data);
	}
	

}