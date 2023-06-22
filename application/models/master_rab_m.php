<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_rab_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function update_harga_barang($kode_barang, $harga_satuan){
		$sql = "
			UPDATE stp_kode_barang SET HARGA_BARANG = $harga_satuan
			WHERE KODE_BARANG = '$kode_barang'
		";
		$this->db->query($sql);
	}

	function get_barang_all(){
		$sql = "
			SELECT * FROM stp_kode_barang ORDER BY ID DESC
		";
		return $this->db->query($sql)->result();
	}

	function cek_rab_in_spk($no_rab){
		$sql = "
			SELECT * FROM stp_master_spk 
			WHERE NO_RAB = '$no_rab'
		";
		return $this->db->query($sql)->result();
	}

	function cek_rab_in_realisasi($no_rab){
		$sql = "
			SELECT * FROM stp_realisasi_anggaran 
			WHERE NO_RAB = '$no_rab'
		";
		return $this->db->query($sql)->result();
	}
	

	function cek_tahun_rab($jns, $thn, $bln){
		$sql = "
			SELECT * FROM stp_nomor_rab WHERE TAHUN = $thn AND JENIS = '$jns' AND BULAN = $bln
		";
		return $this->db->query($sql)->result();
	}

	function simpan_nomor_rab($jns, $thn, $bln){
		$sql = "
			INSERT INTO stp_nomor_rab
			(TAHUN, JENIS, NEXT, BULAN)
			VALUES
			($thn, '$jns', 1, $bln)
		";
		$this->db->query($sql);
	}

	function get_next_nomor_rab($jns, $thn, $bln){
		$sql = "
			SELECT * FROM stp_nomor_rab WHERE TAHUN = $thn AND JENIS = '$jns' AND BULAN = $bln
		";
		return $this->db->query($sql)->row();
	}

	function save_rab($jenis_rab, $tahun, $nomor_rab, $kota, $kegiatan, $pekerjaan, $lokasi, $sumber_dana){
		$sql = "
			INSERT INTO stp_rincian_anggaran_biaya
			(JENIS, NO_RAB, TAHUN, KOTA, KEGIATAN, PEKERJAAN, LOKASI, SUMBER_DANA)
			VALUES
			('$jenis_rab', '$nomor_rab', $tahun, '$kota', '$kegiatan', '$pekerjaan', '$lokasi', '$sumber_dana' )
		";
		$this->db->query($sql);
	}

	function save_next_norab($tahun, $jns, $bln){
		$sql = "
			UPDATE stp_nomor_rab SET NEXT = NEXT+1
			WHERE TAHUN = $tahun AND JENIS = '$jns' AND BULAN = $bln
		";
		$this->db->query($sql);
	}

	function get_id_rab(){
		$sql = "
			SELECT * FROM stp_rincian_anggaran_biaya ORDER BY ID DESC
		";
		return $this->db->query($sql)->row();
	}

	function save_detail_rab($id_rab, $jns_kegiatan, $volume2, $satuan2, $harga_satuan2){
		$jns_kegiatan = addslashes($jns_kegiatan);
		$satuan2      = addslashes($satuan2);

		$sql = "
			INSERT INTO stp_rincian_anggaran_biaya_detail
			(ID_RAB, KEGIATAN, VOLUME, SATUAN, HARGA_SATUAN)
			VALUES
			($id_rab, '$jns_kegiatan', $volume2, '$satuan2', $harga_satuan2)
		";

		$this->db->query($sql);

	}

	function get_all_rab(){
		$sql = "
			SELECT * FROM stp_rincian_anggaran_biaya ORDER BY ID DESC
		";
		return $this->db->query($sql)->result();
	}

	function hapus_rab($id_hapus){
		$sql = "
			DELETE FROM stp_rincian_anggaran_biaya_detail WHERE ID_RAB = $id_hapus
		";
		$this->db->query($sql);

		$sql2 = "
			DELETE FROM stp_rincian_anggaran_biaya WHERE ID = $id_hapus
		";
		$this->db->query($sql2);
	}

	function get_rab_by_id($id){
		$sql = "
			SELECT * FROM stp_rincian_anggaran_biaya WHERE ID = $id
		";
		return $this->db->query($sql)->row();
	}

	function get_detail_rab_by_id($id){
		$sql = "
			SELECT * FROM stp_rincian_anggaran_biaya_detail WHERE ID_RAB = $id
		";
		return $this->db->query($sql)->result();
	}

	function edit_rab($id_rab, $jenis_rab, $tahun, $nomor_rab, $kota, $kegiatan, $pekerjaan, $lokasi, $sumber_dana){
		$sql = "
			UPDATE stp_rincian_anggaran_biaya SET
				JENIS = '$jenis_rab', 
				NO_RAB = '$nomor_rab', 
				TAHUN = $tahun, 
				KOTA = '$kota', 
				KEGIATAN = '$kegiatan', 
				PEKERJAAN = '$pekerjaan', 
				LOKASI = '$lokasi', 
				SUMBER_DANA = '$sumber_dana'
			WHERE ID = $id_rab
		";
		$this->db->query($sql);
	}

	function delete_rinci($id_rab){
		$sql = "
			DELETE FROM stp_rincian_anggaran_biaya_detail WHERE ID_RAB = $id_rab
		";
		$this->db->query($sql);
	}

}

?>