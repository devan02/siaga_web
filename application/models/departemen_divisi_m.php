<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departemen_divisi_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function departemen(){
		$sql = "SELECT * FROM stp_departemen WHERE AKTIF = 1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function divisi($id_departemen){
		$sql = "
			SELECT 
				DIVISI.*,
				stp_departemen.NAMA AS NAMA_DEPARTEMEN 
			FROM stp_divisi DIVISI
			LEFT JOIN stp_departemen ON stp_departemen.ID = DIVISI.ID_DEPARTEMEN
			WHERE DIVISI.ID_DEPARTEMEN = $id_departemen 
			AND DIVISI.AKTIF = 1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_divisi_id($id_divisi){
		$sql = "SELECT * FROM stp_divisi WHERE ID = $id_divisi AND AKTIF = 1";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function get_bagian_id($id_bagian){
		$sql = "SELECT * FROM stp_departemen WHERE ID = '$id_bagian' AND AKTIF = 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
}

?>