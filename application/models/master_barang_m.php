<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_barang_m extends CI_Model
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

	function simpan_barang($kode_barang, $nama_barang, $harga_barang, $satuan_barang){
		$sql = "
			INSERT INTO stp_kode_barang 
			(KODE_BARANG, NAMA_BARANG, HARGA_BARANG, SATUAN)
			VALUES 
			('$kode_barang', '$nama_barang', $harga_barang, '$satuan_barang')
		";
		$this->db->query($sql);
	}

	function hapus_barang($id_hapus){
		$sql = "
			DELETE FROM stp_kode_barang WHERE ID = $id_hapus
		";
		$this->db->query($sql);
	}

	function get_barang_by_id($id){
		$sql = "
			SELECT * FROM stp_kode_barang WHERE ID = $id
		";
		return $this->db->query($sql)->row();
	}

	function edit_barang($id_edit, $kode_barang_ed, $nama_barang_ed, $satuan_ed, $harga_barang_ed){
		$sql = "
			UPDATE stp_kode_barang SET NAMA_BARANG = '$nama_barang_ed', SATUAN = '$satuan_ed', HARGA_BARANG = $harga_barang_ed
			WHERE ID = $id_edit
		";
		$this->db->query($sql);
	}

	function cek_kode_barang($kode_barang){
		$sql = "
			SELECT * FROM stp_kode_barang WHERE KODE_BARANG = '$kode_barang'
		";
		return $this->db->query($sql)->result();
	}


}

?>