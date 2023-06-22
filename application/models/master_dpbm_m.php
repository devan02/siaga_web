<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_dpbm_m extends CI_Model
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

	function cek_dpbm_in_realisasi($no_dpbm){
		$sql = "
			SELECT * FROM stp_realisasi_anggaran 
			WHERE NO_DPBM = '$no_dpbm'
		";
		return $this->db->query($sql)->result();
	}

	function save_dpbm($nomor_dpbm, $tanggal, $diminta, $keterangan){
		$sql = "
			INSERT INTO stp_dpbm
			(NO_DPBM, TANGGAL, DIMINTA_OLEH, KETERANGAN)
			VALUES
			('$nomor_dpbm', '$tanggal', '$diminta', '$keterangan')
		";
		 $this->db->query($sql);
	}

	function get_id_dpbm(){
		$sql = "
			SELECT * FROM stp_dpbm ORDER BY ID DESC
		";
		return $this->db->query($sql)->row();
	}

	function save_detail_dpbm($get_id_dpbm, $val, $nama_barang, $vol_barang, $harga, $no_po){

		$nama_barang = addslashes($nama_barang);
		$no_po       = addslashes($no_po);

		$sql = "
			INSERT INTO stp_dpbm_detail
			(ID_DPBM, KODE_BARANG, NAMA_BARANG, VOLUME, HARGA, NO_PO)
			VALUES
			('$get_id_dpbm', '$val', '$nama_barang', '$vol_barang', '$harga', '$no_po')
		";
		 $this->db->query($sql);
	}

	function get_data_dpbm(){
		$sql = "
			SELECT * FROM stp_dpbm ORDER BY ID DESC
		";
		return $this->db->query($sql)->result();
	}

	function get_dpbm_by_id($id){
		$sql = "
			SELECT * FROM stp_dpbm WHERE ID = $id
		";
		return $this->db->query($sql)->row();
	}

	function get_detail_dpbm_by_id($id){
		$sql = "
			SELECT * FROM stp_dpbm_detail 
			WHERE ID_DPBM = $id
			ORDER BY ID DESC
		";
		return $this->db->query($sql)->result();
	}

	function update_dpbm($id_dpbm, $nomor_dpbm, $tanggal, $diminta, $keterangan){
		$sql = "
			UPDATE stp_dpbm SET
				NO_DPBM = '$nomor_dpbm', 
				TANGGAL = '$tanggal',
				DIMINTA_OLEH = '$diminta', 
				KETERANGAN = '$keterangan'
			WHERE ID = $id_dpbm
		";
		 $this->db->query($sql);
	}

	function delete_detail($id_dpbm){

		$sql = "
			DELETE FROM stp_dpbm_detail WHERE ID_DPBM = $id_dpbm
		";
		$this->db->query($sql);
	}

	function hapus_dpbm($id_hapus){
		$sql = "
			DELETE FROM stp_dpbm_detail WHERE ID_DPBM = $id_hapus
		";
		$this->db->query($sql);

		$sql2 = "
			DELETE FROM stp_dpbm WHERE ID = $id_hapus
		";
		$this->db->query($sql2);
	}

	function update_harga_barang($kode_barang, $harga){
		$sql = "
			UPDATE stp_kode_barang SET HARGA_BARANG = $harga
			WHERE KODE_BARANG = '$kode_barang'
		";
		$this->db->query($sql);
	}
}

?>