<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Histori_anggaran_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_divisi_m','dep_div');
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

		  'page' => "dashboard/histori_anggaran_v",
		  'menu' => "histori",
		  'title' => "HISTORY ANGARAN",		  
		  'induk_menu' => "",
		  'departemen'	=> $this->dep_div->departemen(),  
		  'disable'		=> $disable,
		  'disable2'	=> $disable2,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function get_anggaran_kode(){
		$id = $this->input->post('id');

		$sql = "SELECT * FROM stp_anggaran_dasar WHERE ID_ANGGARAN = $id";
		$q   = $this->db->query($sql)->row();

		echo json_encode($q);
	}

	function get_kd_anggaran(){
		$keyword = $this->input->post('keyword');
		$bagian = $this->input->post('bagian');
		$sub_bagian = $this->input->post('sub_bagian');
		$tahun = $this->input->post('tahun');

		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (KODE_ANGGARAN LIKE '%$keyword%' OR URAIAN LIKE '%$keyword%')";
		}

		$sql = "
			SELECT ID_ANGGARAN, KODE_ANGGARAN, URAIAN FROM stp_usulan_anggaran 
			WHERE $where 
			AND DEPARTEMEN LIKE '%$bagian%' 
			AND DIVISI LIKE '%$sub_bagian%'
			AND TAHUN = '$tahun' 
			GROUP BY ID_ANGGARAN, KODE_ANGGARAN, URAIAN
			ORDER BY KODE_ANGGARAN ASC
			LIMIT 10";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}

	function get_history(){
		$kode = $this->input->post('kode');

		$sql = "

		SELECT a.* FROM (
			SELECT a.*, (a.TOTAL_USULAN + a.TOTAL_PELAKSANAAN) AS TOTAL_USULAN2, 
			CASE 
			WHEN c.KODE_ANGGARAN IS NULL OR c.KODE_ANGGARAN = '' THEN
			b.JUMLAH ELSE c.JUMLAH_USULAN
			END AS JUMLAH_REVISI,

			CASE 
			WHEN c.KODE_ANGGARAN IS NULL OR c.KODE_ANGGARAN = '' THEN
			(b.TOTAL + b.TOTAL_PELAKSANAAN) ELSE (c.TOTAL_USULAN + c.TOTAL_PELAKSANAAN)
			END AS TOTAL_REVISI
			FROM stp_usulan_anggaran a 

			LEFT JOIN stp_anggaran_dasar b ON a.KODE_ANGGARAN = b.KODE_ANGGARAN
			
			LEFT JOIN (
				SELECT TOTAL_USULAN, TOTAL_PELAKSANAAN, JUMLAH_USULAN, KODE_ANGGARAN FROM stp_usulan_anggaran
				WHERE RAPAT_KE = 2
			) c ON a.KODE_ANGGARAN = c.KODE_ANGGARAN

			WHERE a.KODE_ANGGARAN = '$kode' AND a.RAPAT_KE = 1

				UNION ALL 

			SELECT a.*, (a.TOTAL_USULAN + a.TOTAL_PELAKSANAAN) AS TOTAL_USULAN2, 
			CASE 
			WHEN d.KODE_ANGGARAN IS NULL OR d.KODE_ANGGARAN = '' THEN
			b.JUMLAH ELSE d.JUMLAH_USULAN
			END AS JUMLAH_REVISI,

			CASE 
			WHEN d.KODE_ANGGARAN IS NULL OR d.KODE_ANGGARAN = '' THEN
			(b.TOTAL + b.TOTAL_PELAKSANAAN) ELSE (d.TOTAL_USULAN + d.TOTAL_PELAKSANAAN)
			END AS TOTAL_REVISI

			FROM stp_usulan_anggaran a 

			LEFT JOIN stp_anggaran_dasar b ON a.KODE_ANGGARAN = b.KODE_ANGGARAN
			LEFT JOIN (
				SELECT TOTAL_USULAN, TOTAL_PELAKSANAAN, KODE_ANGGARAN FROM stp_usulan_anggaran
				WHERE RAPAT_KE = 1
			) c ON a.KODE_ANGGARAN = c.KODE_ANGGARAN

			LEFT JOIN (
				SELECT TOTAL_USULAN, TOTAL_PELAKSANAAN, JUMLAH_USULAN, KODE_ANGGARAN FROM stp_usulan_anggaran
				WHERE RAPAT_KE = 3
			) d ON a.KODE_ANGGARAN = d.KODE_ANGGARAN

			WHERE a.KODE_ANGGARAN = '$kode' AND a.RAPAT_KE = 2

				UNION ALL 

			SELECT a.*, (a.TOTAL_USULAN + a.TOTAL_PELAKSANAAN) AS TOTAL_USULAN2, 
			b.JUMLAH AS JUMLAH_REVISI, (b.TOTAL + b.TOTAL_PELAKSANAAN) AS TOTAL_REVISI FROM stp_usulan_anggaran a 
			LEFT JOIN stp_anggaran_dasar b ON a.KODE_ANGGARAN = b.KODE_ANGGARAN
			LEFT JOIN (
				SELECT TOTAL_USULAN, TOTAL_PELAKSANAAN, KODE_ANGGARAN FROM stp_usulan_anggaran
				WHERE RAPAT_KE = 2
			) c ON a.KODE_ANGGARAN = c.KODE_ANGGARAN
			WHERE a.KODE_ANGGARAN = '$kode' AND a.RAPAT_KE = 3
		) a 
		ORDER BY a.KODE_ANGGARAN ASC
		";
		$q   = $this->db->query($sql)->result();

		echo json_encode($q);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */