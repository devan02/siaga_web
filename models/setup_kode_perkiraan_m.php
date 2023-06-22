<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup_kode_perkiraan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_koper_all(){
		$sql = "
			SELECT * FROM stp_setup_kode_perkiraan ORDER BY ID DESC
		";
		return $this->db->query($sql)->result();
	}

	function get_grup_koper(){
		$sql = "
			SELECT * FROM stp_setup_grup ORDER BY ID DESC
		";
		return $this->db->query($sql)->result();
	}

	function simpan_kode_perkiraan($kode_perkiraan, $nama_perkiraan, $grup, $sub){
		$sql = "
			INSERT INTO stp_setup_kode_perkiraan 
			(KODE_PERKIRAAN, NAMA_PERKIRAAN, KP_GRUP, KP_SUB)
			VALUES
			('$kode_perkiraan', '$nama_perkiraan', '$grup', '$sub')
		";
		$this->db->query($sql);
	}

	function hapus_koper($id_hapus){
		$sql = "
			DELETE FROM stp_setup_kode_perkiraan WHERE ID = $id_hapus
		";
		$this->db->query($sql);
	}

	function cek_kode($kode_perkiraan){
		$sql = "
			SELECT * FROM stp_setup_kode_perkiraan WHERE KODE_PERKIRAAN = '$kode_perkiraan'
		";
		return $this->db->query($sql)->result();
	}

	function get_kode_perkiraan($id){
		$sql = "
			SELECT * FROM stp_setup_kode_perkiraan WHERE ID = $id
		";
		return $this->db->query($sql)->row();
	}

	function edit_koper($id_edit, $nama_perkiraan_ed){
		$sql = "
			UPDATE stp_setup_kode_perkiraan SET 
				NAMA_PERKIRAAN = '$nama_perkiraan_ed'
			WHERE ID = $id_edit
		";
		$this->db->query($sql);
	}

}

?>