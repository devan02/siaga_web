<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_bagian_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_bagian_all(){
		$sql = "
			SELECT * FROM stp_departemen 
			ORDER BY AKTIF DESC, ID DESC
		";
		return $this->db->query($sql)->result();
	}

	function simpan_bagian($kode_bagian, $nama_bagian, $keterangan){
		$sql = "
			INSERT INTO stp_departemen 
			(KODE, NAMA, KETERANGAN, AKTIF)
			VALUES 
			('$kode_bagian', '$nama_bagian', '$keterangan', 1)
		";
		$this->db->query($sql);
	}

	function hapus_bagian($id_hapus){
		$sql = "
			UPDATE stp_departemen SET AKTIF = 0
			WHERE ID = $id_hapus
		";
		$this->db->query($sql);
	}

	function get_bagian_by_id($id){
		$sql = "
			SELECT * FROM stp_departemen WHERE ID = $id
		";
		return $this->db->query($sql)->row();
	}

	function cek_kode_bagian($kode_bagian){
		$sql = "
			SELECT * FROM stp_departemen WHERE KODE = '$kode_bagian'
		";
		return $this->db->query($sql)->result();
	}

	function edit_bagian($id_edit, $nama_bagian_ed, $keterangan_ed){
		$sql = "
			UPDATE stp_departemen SET NAMA = '$nama_bagian_ed', KETERANGAN = '$keterangan_ed'
			WHERE ID = $id_edit
		";
		$this->db->query($sql);
	}


}

?>