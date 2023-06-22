<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_revisi_rkap_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('laporan_revisi_rkap_m','model');

		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index(){
		$sessi = $this->session->userdata('masuk_bos');
		$disable = "";
		$disable2 = "";
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
		  'page' => "dashboard/laporan_revisi_rkap_v",
		  'induk_menu' => "revisi_anggaran",
		  'menu' => "laporan_revisi_rkap",
		  'title' => "LAPORAN REVISI RKAP",
		  'departemen'	=> $this->dep_div->departemen(),
		  'url'	=> base_url()."dashboard/laporan_revisi_rkap_c/cetak_laporan",
		  'disable'		=> $disable,
		  'disable2'	=> $disable2,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cetak_laporan(){
		if($this->input->post('pdf')){
			$this->laporan_pdf();
		}else if($this->input->post('pdf_terjadwal')){
			$this->laporan_terjadwal_pdf();
		}else if($this->input->post('excel')){
			$this->laporan_excel();
		}else{
			$this->laporan_terjadwal_excel();
		}
	}

	//PDF
	function laporan_pdf(){
		$tahun = $this->input->post('tahun');
		$krit = $this->input->post('kriteria');
		
		$ket = "";

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

		if($krit == "semua_bagian"){
			$dep = "";
			$div = "";
			$ket = "SEMUA BAGIAN";
		} else if($krit == "bagian"){
			$nama_dep = $this->model->get_nama_dep($dep)->NAMA;
			$div = "";
			$ket = "BAGIAN ".strtoupper($nama_dep);
		} else if($krit == "sub_bagian"){
			$nama_dep = $this->model->get_nama_dep($dep)->NAMA;
			$nama_div = $this->model->get_nama_div($div)->NAMA;
			$ket = "BAGIAN ".strtoupper($nama_dep)." SUB BAGIAN ".strtoupper($nama_div);
		}

		$data = array(
		  'title' => "LAPORAN REVISI RKAP",
		  'koper' => $this->model->get_kode_perkiraan($tahun,$krit,$dep,$div),
		  'thn'				=> $tahun,
		  'krit'			=> $krit,
		  'dep'				=> $dep,
		  'div'				=> $div,
		  'ket'				=> $ket,
		);
		$this->load->view('dashboard/pdf/report_rkap_revisi_pdf_v', $data); 
	}

	function laporan_terjadwal_pdf(){
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
		$ket2 = "";

		if($krit == "semua_bagian"){
			$dep = "";
			$div = "";
			$ket = "SEMUA BAGIAN";
			$ket2 = "semua_bagian";
		} else if($krit == "bagian"){
			$nama_dep = $this->model->get_nama_dep($dep)->NAMA;
			$div = "";
			$ket = "BAGIAN ".strtoupper($nama_dep);
			$ket2 = "bagian_".strtolower($nama_dep);
		} else if($krit == "sub_bagian"){
			$nama_dep = $this->model->get_nama_dep($dep)->NAMA;
			$nama_div = $this->model->get_nama_div($div)->NAMA;
			$ket = "BAGIAN ".strtoupper($nama_dep)." SUB BAGIAN ".strtoupper($nama_div);
			$ket2 = "bagian_".strtolower($nama_dep)."_sub_bagian_".strtolower($nama_div);
		}

		$data = array(
		  'title' => "LAPORAN REVISI RKAP",
		  'koper' => $this->model->get_kode_perkiraan($tahun,$krit,$dep,$div),
		  'thn'				=> $tahun,
		  'krit'			=> $krit,
		  'dep'				=> $dep,
		  'div'				=> $div,
		  'ket'				=> $ket,
		  'filename'	=> 'laporan_revisi_rkap_'.$ket2.'_'.$tahun,
		);
		$this->load->view('dashboard/pdf/report_rkap_revisi_terjadwal_pdf', $data);
	}

	//EXCEL
	function laporan_excel(){
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
		$ket2 = "";

		if($krit == "semua_bagian"){
			$dep = "";
			$div = "";
			$ket = "SEMUA BAGIAN";
			$ket2 = "semua_bagian";
		} else if($krit == "bagian"){
			$nama_dep = $this->model->get_nama_dep($dep)->NAMA;
			$div = "";
			$ket = "BAGIAN ".strtoupper($nama_dep);
			$ket2 = "bagian_".strtolower($nama_dep);
		} else if($krit == "sub_bagian"){
			$nama_dep = $this->model->get_nama_dep($dep)->NAMA;
			$nama_div = $this->model->get_nama_div($div)->NAMA;
			$ket = "BAGIAN ".strtoupper($nama_dep)." SUB BAGIAN ".strtoupper($nama_div);
			$ket2 = "bagian_".strtolower($nama_dep)."_sub_bagian_".strtolower($nama_div);
		}

		$data = array(
		  'title' 		=> "LAPORAN REVISI RKAP",
		  'koper' 		=> $this->model->get_kode_perkiraan($tahun,$krit,$dep,$div),
		  'thn'			=> $tahun,
		  'krit'		=> $krit,
		  'dep'			=> $dep,
		  'div'			=> $div,
		  'ket'			=> $ket,
		  'filename'	=> 'laporan_revisi_rkap_'.$ket2.'_'.$tahun,
		);
		$this->load->view('dashboard/excel/report_rkap_revisi_xls', $data);
	}

	function laporan_terjadwal_excel(){
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
		$ket2 = "";

		if($krit == "semua_bagian"){
			$dep = "";
			$div = "";
			$ket = "SEMUA BAGIAN";
			$ket2 = "semua_bagian";
		} else if($krit == "bagian"){
			$nama_dep = $this->model->get_nama_dep($dep)->NAMA;
			$div = "";
			$ket = "BAGIAN ".strtoupper($nama_dep);
			$ket2 = "bagian_".strtolower($nama_dep);
		} else if($krit == "sub_bagian"){
			$nama_dep = $this->model->get_nama_dep($dep)->NAMA;
			$nama_div = $this->model->get_nama_div($div)->NAMA;
			$ket = "BAGIAN ".strtoupper($nama_dep)." SUB BAGIAN ".strtoupper($nama_div);
			$ket2 = "bagian_".strtolower($nama_dep)."_sub_bagian_".strtolower($nama_div);
		}

		$data = array(
		  'title' 		=> "LAPORAN REVISI RKAP",
		  'koper' 		=> $this->model->get_kode_perkiraan($tahun,$krit,$dep,$div),
		  'thn'			=> $tahun,
		  'krit'		=> $krit,
		  'dep'			=> $dep,
		  'div'			=> $div,
		  'ket'			=> $ket,
		  'filename'	=> 'laporan_revisi_rkap_'.$ket2.'_'.$tahun,
		);
		$this->load->view('dashboard/excel/report_rkap_revisi_terjadwal_xls', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */