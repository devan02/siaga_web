<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_rkap_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('laporan_rkap_m','model');
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

		if($this->input->post('pdf')){
			$this->cetak_pdf();
		} else if($this->input->post('excel')){
			$this->cetak_excel();
		} else if($this->input->post('pdf_jadwal')){
			$this->cetak_pdf_jadwal();
		} else if($this->input->post('excel_jadwal')){
			$this->cetak_excel_jadwal();
		}

		$key = "";
		$data = array(
		  'page' => "dashboard/laporan_rkap_v",
		  'induk_menu' => "rencana_anggaran",
		  'menu' => "laporan_rkap",
		  'title' => "LAPORAN RKAP",	
		  'post_url' => 'dashboard/laporan_rkap_c',
		  'departemen'	=> $this->dep_div->departemen(),
		  'disable'		=> $disable,
		  'disable2'	=> $disable2,
		  'koper'		=> $this->koper2->get_koper_all($key),
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cetak_excel_jadwal(){
		$tahun = $this->input->post('tahun');
		$krit = $this->input->post('kriteria');

		$dep = "";
		$div = "";
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
			$dep = $q_bag->ID_BAGIAN;
			$div = $this->input->post('divisi');
		}else if($level == "ADMIN"){
			$dep = $this->input->post('departemen');
			$div = $this->input->post('divisi');
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
			$dep = $q_bag->ID_BAGIAN;
			$div = $q_bag->ID_SUB_BAGIAN;
		}

		$ket = "";

		if($krit == ""){
			$dep = "";
			$div = "";
			$ket = "SEMUA BAGIAN";
		} else if($krit == "dep"){
			$nama_dep = $this->model->get_nama_dep($dep)->NAMA;
			$div = "";
			$ket = "BAGIAN $nama_dep";
		} else if($krit == "div"){
			$nama_div = $this->model->get_nama_div($div)->NAMA;
			$ket = "SUB BAGIAN $nama_div";

		}

		$data = array(
		  'title' => "LAPORAN RKAP",
		  'koper' => $this->model->get_kode_perkiraan($tahun,$krit,$dep,$div),
		  'thn'				=> $tahun,
		  'krit'			=> $krit,
		  'dep'				=> $dep,
		  'div'				=> $div,
		  'ket'				=> $ket,
		);
		$this->load->view('dashboard/excel/report_rkap_jadwal_xls', $data);
	}

	function cetak_pdf_jadwal(){
		$tahun = $this->input->post('tahun');
		$krit = $this->input->post('kriteria');
		
		$dep = "";
		$div = "";
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
			$dep = $q_bag->ID_BAGIAN;
			$div = $this->input->post('divisi');
		}else if($level == "ADMIN"){
			$dep = $this->input->post('departemen');
			$div = $this->input->post('divisi');
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
			$dep = $q_bag->ID_BAGIAN;
			$div = $q_bag->ID_SUB_BAGIAN;
		}

		$ket = "";

		if($krit == ""){
			$dep = "";
			$div = "";
			$ket = "SEMUA BAGIAN";
		} else if($krit == "dep"){
			$nama_dep = $this->model->get_nama_dep($dep)->NAMA;
			$div = "";
			$ket = "BAGIAN $nama_dep";
		} else if($krit == "div"){
			$nama_div = $this->model->get_nama_div($div)->NAMA;
			$ket = "SUB BAGIAN $nama_div";

		}

		$data = array(
		  'title' => "LAPORAN RKAP",
		  'koper' => $this->model->get_kode_perkiraan($tahun,$krit,$dep,$div),
		  'thn'				=> $tahun,
		  'krit'			=> $krit,
		  'dep'				=> $dep,
		  'div'				=> $div,
		  'ket'				=> $ket,
		);
		$this->load->view('dashboard/pdf/report_rkap_pdf_jadwal_v', $data);
	}


	function cetak_pdf(){
		$tahun = $this->input->post('tahun');
		$krit = $this->input->post('kriteria');
		
		$dep = "";
		$div = "";
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
			$dep = $q_bag->ID_BAGIAN;
			$div = $this->input->post('divisi');
		}else if($level == "ADMIN"){
			$dep = $this->input->post('departemen');
			$div = $this->input->post('divisi');
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
			$dep = $q_bag->ID_BAGIAN;
			$div = $q_bag->ID_SUB_BAGIAN;
		}

		$ket = "";

		if($krit == ""){
			$dep = "";
			$div = "";
			$ket = "SEMUA BAGIAN";
		} else if($krit == "dep"){
			$nama_dep = $this->model->get_nama_dep($dep)->NAMA;
			$div = "";
			$ket = "BAGIAN $nama_dep";
		} else if($krit == "div"){
			$nama_div = $this->model->get_nama_div($div)->NAMA;
			$ket = "SUB BAGIAN $nama_div";

		}

		$data = array(
		  'title' => "LAPORAN RKAP",
		  'koper' => $this->model->get_kode_perkiraan($tahun,$krit,$dep,$div),
		  'thn'				=> $tahun,
		  'krit'			=> $krit,
		  'dep'				=> $dep,
		  'div'				=> $div,
		  'ket'				=> $ket,
		);
		$this->load->view('dashboard/pdf/report_rkap_pdf_v', $data);
	}


	function cetak_excel(){
		$tahun = $this->input->post('tahun');
		$krit = $this->input->post('kriteria');
		
		$dep = "";
		$div = "";
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
			$dep = $q_bag->ID_BAGIAN;
			$div = $this->input->post('divisi');
		}else if($level == "ADMIN"){
			$dep = $this->input->post('departemen');
			$div = $this->input->post('divisi');
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
			$dep = $q_bag->ID_BAGIAN;
			$div = $q_bag->ID_SUB_BAGIAN;
		}
		
		$ket = "";

		if($krit == ""){
			$dep = "";
			$div = "";
			$ket = "SEMUA BAGIAN";
		} else if($krit == "dep"){
			$nama_dep = $this->model->get_nama_dep($dep)->NAMA;
			$div = "";
			$ket = "BAGIAN $nama_dep";
		} else if($krit == "div"){
			$nama_div = $this->model->get_nama_div($div)->NAMA;
			$ket = "SUB BAGIAN $nama_div";

		}

		$data = array(
		  'title' => "LAPORAN RKAP",
		  'koper' => $this->model->get_kode_perkiraan($tahun,$krit,$dep,$div),
		  'thn'				=> $tahun,
		  'krit'			=> $krit,
		  'dep'				=> $dep,
		  'div'				=> $div,
		  'ket'				=> $ket,
		);
		$this->load->view('dashboard/excel/report_rkap_xls', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */