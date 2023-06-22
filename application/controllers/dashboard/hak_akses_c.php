<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hak_akses_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('hak_akses_m','model');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
		$msg = "";
		$nama_pegawai_cari = "";
		$id_peg = "";

		$pegawai = $this->model->get_all_pegawai();
		$menu_lev1 = $this->model->get_menu_lev1();
		$pegawai_filter = "";

		if($this->input->post('filter')){

			$id_peg = $this->input->post('id_peg');
			$pegawai_filter = $this->model->get_pegawai_by_id($id_peg);
		
		} else if($this->input->post('simpan')){

			$msg = 1;
			$id_peg2 = $this->input->post('id_peg2');
			$menu    = $this->input->post('menu');
			$menu2   = $this->input->post('menu2');

			$this->model->delete_hak_akses($id_peg2);

			if($menu != "" || $menu != ""){
				foreach ($menu as $key => $val) {
					$this->model->simpan_hak_akses($id_peg2, $val);
				}
			}

			if($menu2 != "" || $menu2 != ""){
				foreach ($menu2 as $key2 => $val2) {
					$this->model->simpan_hak_akses2($id_peg2, $val2);
				}
			}

			$id_peg = $id_peg2;
			$pegawai_filter = $this->model->get_pegawai_by_id($id_peg);
		}

		$data = array(
		  'page' => "dashboard/hak_akses_v",
		  'induk_menu' => "user_manage",
		  'menu' => "hak_akses",
		  'title' => "HAK AKSES PENGGUNA",		
		  'departemen'	=> $this->dep_div->departemen(),  
		  'post_url' => "dashboard/hak_akses_c",  
		  'msg'  => $msg,
		  'nama_pegawai_cari' => $nama_pegawai_cari,
		  'id_peg' => $id_peg,
		  'pegawai' => $pegawai,
		  'menu_lev1' => $menu_lev1,
		  'pegawai_filter' => $pegawai_filter,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}
}