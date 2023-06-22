<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengelompokan_kode_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_barang_all(){
		$sql = "
			SELECT * FROM stp_kode_barang ORDER BY ID DESC
		";
		return $this->db->query($sql)->result();
	}

	function get_koper_lama($id_divisi, $tahun){
		$sql = "
			SELECT DISTINCT KODE_PERKIRAAN FROM stp_anggaran_dasar 
			WHERE (KODE_PERKIRAAN2 IS NULL OR KODE_PERKIRAAN2 = '') AND CHAR_LENGTH(KODE_PERKIRAAN) = 10 AND DIVISI = $id_divisi AND TAHUN = $tahun
		";
		return $this->db->query($sql)->result();
	}

	function get_data_anggaran_by_koper_lama($id_divisi, $tahun, $koper_lama){
		$sql = "
			SELECT * FROM stp_anggaran_dasar 
			WHERE (KODE_PERKIRAAN2 IS NULL OR KODE_PERKIRAAN2 = '')  AND KODE_PERKIRAAN = '$koper_lama' AND DIVISI = $id_divisi AND TAHUN = $tahun
		";
		return $this->db->query($sql)->result();
	}

	function save_koper_baru($kode_ag, $kode_perkiraan){
		$sql = "
			UPDATE stp_anggaran_dasar SET KODE_PERKIRAAN = '$kode_perkiraan'
			WHERE KODE_ANGGARAN = '$kode_ag'
		";
		$this->db->query($sql);
	}


}

?>