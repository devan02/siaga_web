<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_realisasi_revisi_rkap_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('realisasi_revisi_anggaran_m','model');
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('kode_perkiraan_m','koper');

		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    } 
	} 

	function index(){
		$sessi = $this->session->userdata('masuk_bos');
		$id_pegawai = $sessi['id'];

		$sql_pegawai = "SELECT LEVEL FROM stp_pegawai WHERE ID = $id_pegawai";
		$q_pegawai = $this->db->query($sql_pegawai)->row();
		$level = $q_pegawai->LEVEL;
		$disable = "";
		$disable2 = "";
		if($level == "KABAG"){
			$disable = "disabled='disabled'";
		}else if($level == "ADMIN"){
			$disable = "";
		}else if($level == null){
			$disable = "disabled='disabled'";
			$disable2 = "disabled='disabled'";
		}

		$key = "";
		$data = array(
		  'page' 		=> "dashboard/laporan_realisasi_revisi_rkap_v",
		  'induk_menu' 	=> "realisasi_revisi_anggaran",
		  'menu' 		=> "laporan_realisasi_revisi_rkap",
		  'title' 		=> "LAPORAN REALISASI REVISI RKAP",
		  'url'			=> base_url().'dashboard/laporan_realisasi_revisi_rkap_c/cetak',
		  'departemen'	=> $this->dep_div->departemen(),
		  'koper'		=> $this->koper->get_koper_all($key),
		  'disable'		=> $disable,
		  'disable2'	=> $disable2,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cetak(){
		$kode_perkiraan = $this->input->post('kode_perkiraan');
		if($this->input->post('pdf')){
			if($kode_perkiraan != ""){
				$this->cetak_per_kode_perkiraan_pdf();
			}else{
				$this->cetak_pdf();
			}
		}else{
			if($kode_perkiraan != ""){
				$this->cetak_per_kode_perkiraan_excel();
			}else{
				$this->cetak_excel();
			}
		}
	}

	function cetak_pdf(){
		$bagian = "";
		$sub_bagian = "";
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
			$bagian = $q_bag->ID_BAGIAN;
			$sub_bagian = $this->input->post('divisi');
		}else if($level == "ADMIN"){
			$bagian = $this->input->post('departemen');
			$sub_bagian = $this->input->post('divisi');
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
			$bagian = $q_bag->ID_BAGIAN;
			$sub_bagian = $q_bag->ID_SUB_BAGIAN;
		}

		$tahun = $this->input->post('tahun');
		$kriteria = $this->input->post('kriteria');
		$kode_perkiraan = $this->input->post('kode_perkiraan');

		$ket = "";
		$nama_bag = $this->db->query("SELECT * FROM stp_departemen WHERE ID = '$bagian'")->row()->NAMA;
		$nama_sub_bag = $this->db->query("SELECT * FROM stp_divisi WHERE ID = '$sub_bagian'")->row()->NAMA;

		if($kriteria == "semua_bagian"){
			$ket = "SEMUA BAGIAN";
		}else if($kriteria == "bagian"){
			$ket = "BAGIAN ".strtoupper($nama_bag);
		}else{
			$ket = "BAGIAN ".strtoupper($nama_bag)." SUB BAGIAN ".strtoupper($nama_sub_bag);
		}

		$data = array(
		  'title' => "LAPORAN REALISASI REVISI ANGGARAN",
		  'thn'   => $tahun,
		  'kriteria' => $kriteria,
		  'bagian' => $bagian,
		  'sub_bagian' => $sub_bagian,
		  'kd_perkiraan' => $this->model->get_kode_perkiraan_new($tahun,$kriteria,$bagian,$sub_bagian,$kode_perkiraan),
		  'bag_subbag' => $ket,
		);

		$this->load->view('dashboard/pdf/report_lap_realisasi_revisi_anggaran', $data);
	}

	function cetak_per_kode_perkiraan_pdf(){
		$bagian = "";
		$sub_bagian = "";
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
			$bagian = $q_bag->ID_BAGIAN;
			$sub_bagian = $this->input->post('divisi');
		}else if($level == "ADMIN"){
			$bagian = $this->input->post('departemen');
			$sub_bagian = $this->input->post('divisi');
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
			$bagian = $q_bag->ID_BAGIAN;
			$sub_bagian = $q_bag->ID_SUB_BAGIAN;
		}

		$tahun = $this->input->post('tahun');
		$kriteria = $this->input->post('kriteria');
		$kode_perkiraan = $this->input->post('kode_perkiraan');

		$ket = "";
		$nama_bag = $this->db->query("SELECT * FROM stp_departemen WHERE ID = '$bagian'")->row()->NAMA;
		$nama_sub_bag = $this->db->query("SELECT * FROM stp_divisi WHERE ID = '$sub_bagian'")->row()->NAMA;

		if($kriteria == "semua_bagian"){
			$ket = "SEMUA BAGIAN";
		}else if($kriteria == "bagian"){
			$ket = "BAGIAN ".strtoupper($nama_bag);
		}else{
			$ket = "BAGIAN ".strtoupper($nama_bag)." SUB BAGIAN ".strtoupper($nama_sub_bag);
		}

		$data = array(
		  'title' => "LAPORAN REALISASI REVISI ANGGARAN",
		  'thn'   => $tahun,
		  'kriteria' => $kriteria,
		  'bagian' => $bagian,
		  'sub_bagian' => $sub_bagian,
		  'kd_perkiraan' => $this->model->get_kode_perkiraan_new($tahun,$kriteria,$bagian,$sub_bagian,$kode_perkiraan),
		  'bag_subbag' => $ket,
		  'kode_perkiraan' => $kode_perkiraan,
		);

		$this->load->view('dashboard/pdf/report_lap_realisasi_revisi_anggaran_koper', $data);
	}

	function cetak_excel(){
		$bagian = "";
		$sub_bagian = "";
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
			$bagian = $q_bag->ID_BAGIAN;
			$sub_bagian = $this->input->post('divisi');
		}else if($level == "ADMIN"){
			$bagian = $this->input->post('departemen');
			$sub_bagian = $this->input->post('divisi');
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
			$bagian = $q_bag->ID_BAGIAN;
			$sub_bagian = $q_bag->ID_SUB_BAGIAN;
		}

		$tahun = $this->input->post('tahun');
		$kriteria = $this->input->post('kriteria');
		$kode_perkiraan = $this->input->post('kode_perkiraan');

		$ket = "";
		$nama_bag = $this->db->query("SELECT * FROM stp_departemen WHERE ID = '$bagian'")->row()->NAMA;
		$nama_sub_bag = $this->db->query("SELECT * FROM stp_divisi WHERE ID = '$sub_bagian'")->row()->NAMA;

		if($kriteria == "semua_bagian"){
			$ket = "SEMUA BAGIAN";
		}else if($kriteria == "bagian"){
			$ket = "BAGIAN ".strtoupper($nama_bag);
		}else{
			$ket = "BAGIAN ".strtoupper($nama_bag)." SUB BAGIAN ".strtoupper($nama_sub_bag);
		}

		$data = array(
		  'title' => "LAPORAN REALISASI REVISI ANGGARAN",
		  'thn'   => $tahun,
		  'kriteria' => $kriteria,
		  'bagian' => $bagian,
		  'sub_bagian' => $sub_bagian,
		  'kd_perkiraan' => $this->model->get_kode_perkiraan_new($tahun,$kriteria,$bagian,$sub_bagian,$kode_perkiraan),
		  'bag_subbag' => $ket,
		  'filename' => 'laporan_realisasi_revisi_'.str_replace(' ', '_', strtolower($ket)).'_'.$tahun,
		);

		$this->load->view('dashboard/excel/report_lap_realisasi_revisi_anggaran_xls', $data);
	}

	function cetak_per_kode_perkiraan_excel(){
		$bagian = "";
		$sub_bagian = "";
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
			$bagian = $q_bag->ID_BAGIAN;
			$sub_bagian = $this->input->post('divisi');
		}else if($level == "ADMIN"){
			$bagian = $this->input->post('departemen');
			$sub_bagian = $this->input->post('divisi');
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
			$bagian = $q_bag->ID_BAGIAN;
			$sub_bagian = $q_bag->ID_SUB_BAGIAN;
		}

		$tahun = $this->input->post('tahun');
		$kriteria = $this->input->post('kriteria');
		$kode_perkiraan = $this->input->post('kode_perkiraan');

		$ket = "";
		$nama_bag = $this->db->query("SELECT * FROM stp_departemen WHERE ID = '$bagian'")->row()->NAMA;
		$nama_sub_bag = $this->db->query("SELECT * FROM stp_divisi WHERE ID = '$sub_bagian'")->row()->NAMA;

		if($kriteria == "semua_bagian"){
			$ket = "SEMUA BAGIAN";
		}else if($kriteria == "bagian"){
			$ket = "BAGIAN ".strtoupper($nama_bag);
		}else{
			$ket = "BAGIAN ".strtoupper($nama_bag)." SUB BAGIAN ".strtoupper($nama_sub_bag);
		}

		$data = array(
		  'title' => "LAPORAN REALISASI REVISI ANGGARAN",
		  'thn'   => $tahun,
		  'kriteria' => $kriteria,
		  'bagian' => $bagian,
		  'sub_bagian' => $sub_bagian,
		  'kd_perkiraan' => $this->model->get_kode_perkiraan_new($tahun,$kriteria,$bagian,$sub_bagian,$kode_perkiraan),
		  'bag_subbag' => $ket,
		  'kode_perkiraan' => $kode_perkiraan,
		  'filename' => 'laporan_realisasi_revisi_'.str_replace(' ', '_', strtolower($ket)).'_'.$tahun,
		);

		$this->load->view('dashboard/excel/report_lap_realisasi_revisi_anggaran_koper_xls', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */