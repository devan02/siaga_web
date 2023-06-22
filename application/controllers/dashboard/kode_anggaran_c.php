<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kode_anggaran_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function index(){
		
	}

	function get_kode_anggaran($bagian,$sub_bagian){
		$keyword = $this->input->get('keyword');
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (KODE_ANGGARAN LIKE '%$keyword%' OR URAIAN LIKE '%$keyword%')";
		}
		$sql = "SELECT * FROM stp_anggaran_dasar WHERE $where AND DEPARTEMEN = $bagian AND DIVISI = $sub_bagian";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
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
			SELECT * FROM stp_anggaran_dasar 
			WHERE $where 
			AND DEPARTEMEN = '$bagian' 
			AND DIVISI = '$sub_bagian'
			AND TAHUN = '$tahun' 
			LIMIT 10";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}

	function get_kd_anggaran_revisi(){
		$keyword = $this->input->post('keyword');
		$bagian = $this->input->post('bagian');
		$sub_bagian = $this->input->post('sub_bagian');
		$tahun = $this->input->post('tahun');
		$where = "1 = 1";

		if($keyword != ""){
			$where = $where." AND (a.KODE_ANGGARAN LIKE '%$keyword%' OR a.URAIAN LIKE '%$keyword%')";
		}

		$sql = "
			SELECT
				a.*
			FROM(
			  SELECT
			     REVISI.ID_ANGGARAN AS ID_ANGGARAN,
			     REVISI.KODE_ANGGARAN AS KODE_ANGGARAN,
			     REVISI.URAIAN AS URAIAN,
			     REVISI.TAHUN AS TAHUN,
			     REVISI.DEPARTEMEN AS DEPARTEMEN,
			     REVISI.DIVISI AS DIVISI
			  FROM stp_revisi_anggaran REVISI
			  WHERE REVISI.STS_REVISI != 6
			  
			  UNION ALL

			  SELECT
			     DASAR.ID_ANGGARAN AS ID_ANGGARAN,
			     DASAR.KODE_ANGGARAN AS KODE_ANGGARAN,
			     DASAR.URAIAN AS URAIAN,
			     DASAR.TAHUN AS TAHUN,
			     DASAR.DEPARTEMEN AS DEPARTEMEN,
			     DASAR.DIVISI AS DIVISI
			  FROM stp_anggaran_dasar DASAR
			) a
			WHERE $where
			AND a.TAHUN = '$tahun'
			AND a.DEPARTEMEN = '$bagian'
			AND a.DIVISI = '$sub_bagian'
			ORDER BY
				a.KODE_ANGGARAN ASC
		";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */