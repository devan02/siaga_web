<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengelompokan_kode_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('pengelompokan_kode_m','model');
		$this->load->model('departemen_divisi_m','dep_div');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
		$msg = "";
		$disable = "";
		$disable2 = "";
		$sessi = $this->session->userdata('masuk_bos');
		$id_pegawai = $sessi['id'];
		$sql_peg = "SELECT * FROM stp_pegawai WHERE ID = '$id_pegawai'";
		$q_peg = $this->db->query($sql_peg)->row();
		$level = $q_peg->LEVEL;
		if($level == "KABAG"){
			$disable = "disabled='disabled'";
		}else if($level == "ADMIN"){
			$disable = "";
		}else if($level == null){
			$disable = "disabled='disabled'";
			$disable2 = "disabled='disabled'";
		}


		if($this->input->post('simpan')){

			$msg = 1;
			$kode_anggaran = $this->input->post('kode_ag_baru');
			$kode_perkiraan = $this->input->post('kode_perkiraan');

			foreach ($kode_anggaran as $key => $val) {
				$this->model->save_koper_baru($val, $kode_perkiraan);
			}
		}

		$data = array(
		  'page' => "dashboard/pengelompokan_kode_v",
		  'induk_menu' => "fitur_tambahan",
		  'menu' => "kelompok",
		  'title' => "PENGELOMPOKAN KODE PERKIRAAN",
		  'post_url' => "dashboard/pengelompokan_kode_c",  
		  'msg'  => $msg,
		  'departemen'	=> $this->dep_div->departemen(),  
		  'disable'		=> $disable,
		  'disable2'	=> $disable2,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function get_koper_lama(){
		$id_divisi = $this->input->post('id_divisi');
		$tahun     = $this->input->post('tahun');

		$get_koper = $this->model->get_koper_lama($id_divisi, $tahun);

		echo json_encode($get_koper);
	}

	function get_anggaran_by_koper_lama(){
		$id_divisi   = $this->input->post('id_divisi');
		$tahun       = $this->input->post('tahun');
		$koper_lama  = $this->input->post('koper_lama');

		$get_data_anggaran = $this->model->get_data_anggaran_by_koper_lama($id_divisi, $tahun, $koper_lama);

		echo json_encode($get_data_anggaran);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */