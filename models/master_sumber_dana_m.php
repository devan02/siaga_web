<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_sumber_dana_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_all_dana(){
		$sql = "
			SELECT * FROM stp_sumber_dana WHERE AKTIF = 1
			ORDER BY ID DESC
		";
		return $this->db->query($sql)->result();
	}

	function save_sumber_dana($sumber){
		$sql = "
			INSERT INTO stp_sumber_dana
			(NAMA, AKTIF)
			VALUES 
			('$sumber', 1)
		";
		$this->db->query($sql);
	}

	function hapus_sumber_dana($id_hapus){
		$sql = "
			UPDATE stp_sumber_dana SET AKTIF = 0
			WHERE ID = $id_hapus
		";
		$this->db->query($sql);
	}

	function cek_sumber_dana($sumber){
		$sql = "
			SELECT * FROM stp_sumber_dana WHERE AKTIF = 1 AND TRIM(NAMA) = '$sumber'
		";
		return $this->db->query($sql)->result();
	}

	function get_dana_by_id($id){
		$sql = "
			SELECT * FROM stp_sumber_dana WHERE ID = $id
		";

		return $this->db->query($sql)->row();
	}

	function edit_sumber_dana($id, $nama){
		$sql = "
			UPDATE stp_sumber_dana SET NAMA = '$nama'
			WHERE ID = $id
		";
		$this->db->query($sql);
	}


}

?>