<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preview_revisi_c extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('preview_revisi_m','model');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
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

		$data = array(
		  'page' => "dashboard/preview_revisi_v",
		  'induk_menu' => "revisi_anggaran",
		  'menu' => "preview_revisi",
		  'title' => "PREVIEW REVISI RKAP",		
		  'departemen'	=> $this->dep_div->departemen(),
		  'disable'		=> $disable,
		  'disable2'	=> $disable2,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function grid_seleksi_cari(){ 
		$id_departemen = $this->input->post('id_departemen');
		$id_divisi = $this->input->post('id_divisi');
		$tahun = $this->input->post('tahun');
		$jenis = $this->input->post('jenis');
		$sumber = $this->input->post('sumber');

		$data = $this->model->get_rkap_by_seleksi($id_departemen, $id_divisi, $tahun, $jenis, $sumber);

		echo json_encode($data);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */