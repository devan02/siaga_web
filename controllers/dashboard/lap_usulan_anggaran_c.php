<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_usulan_anggaran_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('lap_usulan_anggaran_m','model');
		$this->load->model('kode_perkiraan_m','koper2');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index(){
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

		if($this->input->post('excel')){
			$this->cetak_excel();
		} else if($this->input->post('pdf')){
			$this->cetak_pdf();
		} 

		$key = "";
		$data = array(
		  'page' => "dashboard/lap_usulan_anggaran_v",
		  'induk_menu' => "rencana_anggaran",
		  'menu' => "lap_usulan_anggaran",
		  'title' => "LAPORAN USULAN ANGGARAN",		
		  'departemen'	=> $this->dep_div->departemen(),    
		  'post_url' => "dashboard/lap_usulan_anggaran_c",
		  'disable'		=> $disable,
		  'disable2'	=> $disable2,
		  'koper'		=> $this->koper2->get_koper_all($key),
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cetak_pdf(){

		$ttd = $this->master_model_m->get_ttd('lap_usulan_anggaran');

		$tahun = $this->input->post('tahun');
		$kriteria = $this->input->post('kriteria');

		$departemen = "";
		$divisi = "";
		$sessi = $this->session->userdata('masuk_bos');
		$id_pegawai = $sessi['id'];

		$sql_pegawai = "SELECT LEVEL FROM stp_pegawai WHERE ID = $id_pegawai";
		$q_pegawai = $this->db->query($sql_pegawai)->row();
		$level = $q_pegawai->LEVEL;
		if($level == "KABAG"){
			$sql_bag = "
				SELECT 
					PEGAWAI.*,
					BAGIAN.ID AS ID_BAGIAN,
					SUB_BAGIAN.ID AS ID_SUB_BAGIAN 
				FROM stp_pegawai PEGAWAI
				LEFT JOIN stp_departemen BAGIAN ON BAGIAN.ID = PEGAWAI.ID_DEPARTEMEN
				LEFT JOIN stp_divisi SUB_BAGIAN ON SUB_BAGIAN.ID_DEPARTEMEN = BAGIAN.ID
				WHERE PEGAWAI.ID = '$id_pegawai'
			";
			$q_bag = $this->db->query($sql_bag)->row();
			$departemen = $q_bag->ID_BAGIAN;
			$divisi = $this->input->post('divisi');
		}else if($level == "ADMIN"){
			$departemen = $this->input->post('departemen');
			$divisi = $this->input->post('divisi');
		}else if($level == null){
			$sql_bag = "
				SELECT 
					PEGAWAI.*,
					BAGIAN.ID AS ID_BAGIAN,
					SUB_BAGIAN.ID AS ID_SUB_BAGIAN 
				FROM stp_pegawai PEGAWAI
				LEFT JOIN stp_departemen BAGIAN ON BAGIAN.ID = PEGAWAI.ID_DEPARTEMEN
				LEFT JOIN stp_divisi SUB_BAGIAN ON SUB_BAGIAN.ID_DEPARTEMEN = BAGIAN.ID
				WHERE PEGAWAI.ID = '$id_pegawai'
			";
			$q_bag = $this->db->query($sql_bag)->row();
			$departemen = $q_bag->ID_BAGIAN;
			$divisi = $q_bag->ID_SUB_BAGIAN;
		}

		$koper = $this->input->post('koper');
		$ket = "";
		$nama_dep = "";
		$nama_div = "";

		if($kriteria == ""){
			$departemen = "";
			$divisi = "";
			$ket = "USULAN ANGGARAN SEMUA BAGIAN";
		} else if($kriteria == "dep"){
			$nama_dep = strtoupper($this->model->get_nama_dep($departemen)->NAMA);
			$divisi = "";
			$ket = "USULAN ANGGARAN BAGIAN $nama_dep";
		} else if($kriteria == "div"){
			$nama_div = strtoupper($this->model->get_nama_div($divisi)->NAMA);
			$ket = "USULAN ANGGARAN SUB BAGIAN $nama_div";
		}

		$dt    = $this->model->get_report_condition($tahun, $departemen, $divisi, $koper);
		$data = array(
		  'dt'    => $dt,
		  'thn'   => $tahun,
		  'ket'   => $ket,
		  'ttd'   => $ttd,
		);	
		$this->load->view('dashboard/pdf/report_usulan_anggaran_pdf', $data);



	}

	function cetak_excel(){
		$tahun = $this->input->post('tahun');
		$kriteria = $this->input->post('kriteria');
		
		$departemen = "";
		$divisi = "";
		$sessi = $this->session->userdata('masuk_bos');
		$id_pegawai = $sessi['id'];

		$sql_pegawai = "SELECT LEVEL FROM stp_pegawai WHERE ID = $id_pegawai";
		$q_pegawai = $this->db->query($sql_pegawai)->row();
		$level = $q_pegawai->LEVEL;
		if($level == "KABAG"){
			$sql_bag = "
				SELECT 
					PEGAWAI.*,
					BAGIAN.ID AS ID_BAGIAN,
					SUB_BAGIAN.ID AS ID_SUB_BAGIAN 
				FROM stp_pegawai PEGAWAI
				LEFT JOIN stp_departemen BAGIAN ON BAGIAN.ID = PEGAWAI.ID_DEPARTEMEN
				LEFT JOIN stp_divisi SUB_BAGIAN ON SUB_BAGIAN.ID_DEPARTEMEN = BAGIAN.ID
				WHERE PEGAWAI.ID = '$id_pegawai'
			";
			$q_bag = $this->db->query($sql_bag)->row();
			$departemen = $q_bag->ID_BAGIAN;
			$divisi = $this->input->post('divisi');
		}else if($level == "ADMIN"){
			$departemen = $this->input->post('departemen');
			$divisi = $this->input->post('divisi');
		}else if($level == null){
			$sql_bag = "
				SELECT 
					PEGAWAI.*,
					BAGIAN.ID AS ID_BAGIAN,
					SUB_BAGIAN.ID AS ID_SUB_BAGIAN 
				FROM stp_pegawai PEGAWAI
				LEFT JOIN stp_departemen BAGIAN ON BAGIAN.ID = PEGAWAI.ID_DEPARTEMEN
				LEFT JOIN stp_divisi SUB_BAGIAN ON SUB_BAGIAN.ID_DEPARTEMEN = BAGIAN.ID
				WHERE PEGAWAI.ID = '$id_pegawai'
			";
			$q_bag = $this->db->query($sql_bag)->row();
			$departemen = $q_bag->ID_BAGIAN;
			$divisi = $q_bag->ID_SUB_BAGIAN;
		}
		
		$koper = $this->input->post('koper');
		$ket = "";
		$nama_dep = "";
		$nama_div = "";

		if($kriteria == ""){
			$departemen = "";
			$divisi = "";
			$ket = "USULAN ANGGARAN SEMUA BAGIAN";
		} else if($kriteria == "dep"){
			$nama_dep = strtoupper($this->model->get_nama_dep($departemen)->NAMA);
			$divisi = "";
			$ket = "USULAN ANGGARAN BAGIAN $nama_dep";
		} else if($kriteria == "div"){
			$nama_div = strtoupper($this->model->get_nama_div($divisi)->NAMA);
			$ket = "USULAN ANGGARAN SUB BAGIAN $nama_div";
		}

		$dt    = $this->model->get_report_condition($tahun, $departemen, $divisi, $koper);
		$data = array(
		  'dt'    => $dt,
		  'thn'   => $tahun,
		  'ket'   => $ket,
		);	
		$this->load->view('dashboard/excel/report_usulan_anggaran_xls', $data);



	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */