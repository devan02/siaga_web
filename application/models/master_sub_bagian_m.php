<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_sub_bagian_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_sub_bagian_all(){
		$sql = "
			SELECT a.*, b.NAMA AS BAGIAN FROM stp_divisi a 
			LEFT JOIN stp_departemen b ON a.ID_DEPARTEMEN = b.ID
			ORDER BY a.AKTIF DESC, a.ID DESC
		";
		return $this->db->query($sql)->result();
	}

	function get_bagian_all(){
		$sql = "
			SELECT * FROM stp_departemen
			WHERE AKTIF = 1
			ORDER BY ID DESC
		";
		return $this->db->query($sql)->result();
	}

	function simpan_sub_bagian($kode_sub_bagian, $nama_sub_bagian, $keterangan, $id_bagian){
		$sql = "
			INSERT INTO stp_divisi 
			(KODE, NAMA, KETERANGAN, AKTIF, ID_DEPARTEMEN)
			VALUES 
			('$kode_sub_bagian', '$nama_sub_bagian', '$keterangan', 1, $id_bagian)
		";
		$this->db->query($sql);
	}

	function hapus_sub_bagian($id_hapus){
		$sql = "
			UPDATE stp_divisi SET AKTIF = 0 
			WHERE ID = $id_hapus
		";
		$this->db->query($sql);
	}

	function get_sub_bagian_by_id($id){
		$sql = "SELECT * FROM stp_divisi WHERE ID = $id";
		return $this->db->query($sql)->row();
	}

	function cek_kode_subbagian($kode_sub_bagian){
		$sql = "SELECT * FROM stp_divisi WHERE KODE = '$kode_sub_bagian' AND KODE != '' ";
		return $this->db->query($sql)->result();
	}

	function edit_bagian($id_edit, $kode, $nama_sub, $keterangan){
		$sql = "
			UPDATE stp_divisi SET KODE = '$kode', NAMA = '$nama_sub', KETERANGAN = '$keterangan'
			WHERE ID = $id_edit
		";
		$this->db->query($sql);
	}


}

?>