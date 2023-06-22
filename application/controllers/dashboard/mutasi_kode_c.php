<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mutasi_kode_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
		$this->load->model('mutasi_kode_m','model');
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

		if($this->input->post('simpan_mutasi')){

			$msg = 1;

			$jns_ag_ed = $this->input->post('jns_ag_ed');
			$departemen_ed = $this->input->post('departemen_ed');
			$divisi_ed = $this->input->post('divisi_ed');	

			$show_chkbox_jns = $this->input->post('show_chkbox_jns');			
			$show_dep_div_chk = $this->input->post('show_dep_div_chk');	

			$id_ag = $this->input->post('cek');		

			$id_dep2 = $this->input->post('id_dep2');			
			$id_div2 = $this->input->post('id_div2');			
			$jenis_ag_ed_asli = $this->input->post('jenis_ag_ed');	

			foreach ($id_ag as $key => $val) {
				
				if($show_chkbox_jns){
					$this->model->simpan_mutasi_jns_ag($val, $jenis_ag_ed_asli[$key]);
					$this->model->update_jns_ag($val, $jns_ag_ed);
				}

				if($show_dep_div_chk){
					$this->model->simpan_mutasi_dep_div($val, $id_dep2[$key], $id_div2[$key]);
					$this->model->update_dep_div_ag($val, $departemen_ed, $divisi_ed);
				}

			}

		}


		$data = array(
		  'page' => "dashboard/mutasi_kode_v",
		  'induk_menu' => "mutasi_kode",
		  'menu' => "mutasi_kode",
		  'title' => "MUTASI KODE ANGGARAN",		
		  'departemen'	=> $this->dep_div->departemen(),  
		  'post_url' => "dashboard/mutasi_kode_c",  
		  'msg'  => $msg,
		  'disable'		=> $disable,
		  'disable2'	=> $disable2,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function get_kd_anggaran(){
		$keyword = $this->input->post('keyword');
		$bagian = $this->input->post('bagian');
		$sub_bagian = $this->input->post('sub_bagian');
		$tahun = $this->input->post('tahun');

		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (a.KODE_ANGGARAN LIKE '%$keyword%' OR a.URAIAN LIKE '%$keyword%')";
		}

		$sql = "
			SELECT a.* FROM stp_anggaran_dasar a
			LEFT JOIN (
				SELECT MAX(ID) AS ID_MUTASI, ID_ANGGARAN FROM stp_mutasi_anggaran
				GROUP BY ID_ANGGARAN
			) b ON a.ID_ANGGARAN = b.ID_ANGGARAN
			WHERE $where 
			AND a.DEPARTEMEN LIKE '%$bagian%' 
			AND a.DIVISI LIKE '%$sub_bagian%'
			AND a.TAHUN = '$tahun' 
			AND (b.ID_MUTASI IS NULL OR b.ID_MUTASI = '')
			LIMIT 10";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}

	function get_anggaran_kode(){
		$id = $this->input->post('id');

		$sql = "SELECT * FROM stp_anggaran_dasar WHERE ID_ANGGARAN = $id";
		$q   = $this->db->query($sql)->row();

		echo json_encode($q);
	}

	function get_data(){
		$kode_perkiraan = $this->input->post('kode_perkiraan');
		$kode_anggaran  = $this->input->post('kode_anggaran');

		$sql = "
			SELECT a.*, 
				   IFNULL(b.VOLUME_DPBM,0) AS VOLUME_DPBM, 
				   IFNULL(b.VOLUME_RAB,0) AS VOLUME_RAB, 
				   IFNULL(b.JML_DPBM,0) AS JML_DPBM, 
				   IFNULL(b.JML_SPK,0) AS JML_SPK, 
				   IFNULL(b.JML_RAB,0) AS JML_RAB
		    FROM stp_anggaran_dasar a 
			LEFT JOIN ( 

				SELECT a.ID_ANGGARAN, SUM(a.VOLUME_DPBM) AS VOLUME_DPBM, SUM(a.VOLUME_RAB) AS VOLUME_RAB, SUM(a.JML_DPBM) AS JML_DPBM, SUM(a.JML_RAB) AS JML_RAB, SUM(a.JML_SPK) AS JML_SPK FROM (
					SELECT ID_ANGGARAN, ( IFNULL(VOLUME_DPBM,0) * IFNULL(HARGA_SATUAN_DPBM,0) + IFNULL(NILAI_SPM,0) ) AS JML_DPBM, (IFNULL(VOLUME_RAB,0) * IFNULL(HARGA_SATUAN_RAB,0)) AS JML_RAB,
					(IFNULL(HARGA_SATUAN_SPK,0) + IFNULL(NILAI_SPK_ADENDUM,0) ) AS JML_SPK, IFNULL(VOLUME_DPBM,0) AS VOLUME_DPBM, IFNULL(VOLUME_RAB, 0) AS VOLUME_RAB  FROM stp_realisasi_anggaran
				) a
				GROUP BY a.ID_ANGGARAN
			) b ON a.ID_ANGGARAN = b.ID_ANGGARAN
			WHERE a.KODE_ANGGARAN LIKE '%$kode_anggaran%' AND a.KODE_PERKIRAAN LIKE '%$kode_perkiraan%'
		";

		$q   = $this->db->query($sql)->result();

		echo json_encode($q);		
	}
}