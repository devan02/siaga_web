<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup_ttd_panitia_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_list_laporan(){
		$sql = " 
			SELECT * FROM stp_master_ttd
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function delete_detail_ttd($id_lap){
		$sql = "
			DELETE FROM stp_master_ttd_detail WHERE ID_TTD = $id_lap
		";

		$this->db->query($sql);
	}

	function simpan_detail_ttd($id_lap, $jabatan, $is_tgl, $pejabat){

		$jabatan = addslashes($jabatan);
		$pejabat = addslashes($pejabat);

		$sql = "
			INSERT INTO stp_master_ttd_detail
			(ID_TTD, JABATAN, NAMA, IS_TGL)
			VALUES
			($id_lap, '$jabatan', '$pejabat', '$is_tgl')
		";

		$this->db->query($sql);
	}

	function get_ttd_detail_by_id($id_ttd){
		$sql = "
			SELECT * FROM stp_master_ttd_detail WHERE ID_TTD = $id_ttd
			ORDER BY ID ASC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

}

?>