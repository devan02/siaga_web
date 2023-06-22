<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_spk_m extends CI_Model
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

	function get_id_spk($nomor_spk){
		$sql = "
			SELECT * FROM stp_master_spk 
			WHERE NO_SPK = '$nomor_spk'
			ORDER BY ID DESC
		";
		return $this->db->query($sql)->row();
	}

	function update_realisasi_by_spk($id_spk, $biaya_kontrak_spk, $no_rab_spk){
		$sql = "
			UPDATE stp_realisasi_anggaran SET ID_SPK = $id_spk, HARGA_SATUAN_SPK = $biaya_kontrak_spk
			WHERE NO_RAB = '$no_rab_spk'
		";
		$this->db->query($sql);
	}

	function cek_spk_in_realisasi($id_spk){
		$sql = "
			SELECT * FROM stp_realisasi_anggaran 
			WHERE ID_SPK = $id_spk
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

	function save_spk($nomor_spk, $no_rab, $kepada, $uraian_pekerjaan, $dasar, $biaya_tawar, $biaya_kontrak, $beban_biaya, 
								   $pembayaran, $sanksi2, $selisihan, $tgl_awal, $tgl_akhir, $nomor_spk_adendum, $jenis_adendum, $nilai_adendum, $tgl_adendum, $selesai,
								   $kepada_ad, $uraian_ad,  $dasar_ad,  $beban_biaya_ad,  $pembayaran_ad,  $sanksi2_ad,  $selisihan_ad){

		$sql = "
			INSERT INTO stp_master_spk
			(
			  NO_SPK,
			  NO_RAB,
			  KEPADA,
			  URAIAN_PEKERJAAN,
			  DASAR_KERJA,
			  BIAYA_PENAWARAN,
			  BIAYA_KONTRAK,
			  BEBAN_BIAYA,
			  PEMBAYARAN,
			  TGL_AWAL,
			  TGL_AKHIR,
			  SANKSI,
			  SELISIH,
			  ADENDUM,
			  JENIS_ADENDUM,
			  NILAI_ADENDUM,
			  TGL_ADENDUM,
			  SELESAI,
			  KEPADA_AD,
			  URAIAN_PEKERJAAN_AD,
			  DASAR_KERJA_AD,
			  BEBAN_BIAYA_AD,
			  PEMBAYARAN_AD,
			  SANKSI_AD,
			  SELISIH_AD
			)
			VALUES 
			(
			  '$nomor_spk',
			  '$no_rab',
			  '$kepada',
			  '$uraian_pekerjaan',
			  '$dasar',
			  $biaya_tawar,
			  $biaya_kontrak,
			  '$beban_biaya',
			  '$pembayaran',
			  '$tgl_awal',
			  '$tgl_akhir',
			  '$sanksi2',
			  '$selisihan',
			  '$nomor_spk_adendum',
			  '$jenis_adendum',
			  $nilai_adendum,
			  '$tgl_adendum',
			  $selesai,
			  '$kepada_ad', 
			  '$uraian_ad',  
			  '$dasar_ad',  
			  '$beban_biaya_ad',  
			  '$pembayaran_ad',  
			  '$sanksi2_ad',  
			  '$selisihan_ad'
			)
		";

		$this->db->query($sql);
	}

	function get_all_spk(){
		$sql = "
			SELECT * FROM stp_master_spk ORDER BY ID DESC
		";
		return $this->db->query($sql)->result();
	}

	function cek_nomor_spk($nomor_spk){
		$sql = "
			SELECT * FROM stp_master_spk WHERE NO_SPK = '$nomor_spk'
		";
		return $this->db->query($sql)->result();
	}

	function hapus_spk($id_hapus){
		$sql = "
			DELETE FROM stp_master_spk WHERE ID = $id_hapus
		";
		$this->db->query($sql);
	}

	function get_spk_by_id($id){
		$sql = "
			SELECT * FROM stp_master_spk WHERE ID = $id
		";
		return $this->db->query($sql)->row();
	}

	function edit_spk($id_spk, $nomor_spk, $no_rab, $kepada, $uraian_pekerjaan, $dasar, $biaya_tawar, $biaya_kontrak, $beban_biaya, 
								   $pembayaran, $sanksi2, $selisihan, $tgl_awal, $tgl_akhir, $nomor_spk_adendum, $jenis_adendum, $nilai_adendum, $tgl_adendum, $selesai,
								   $kepada_ad, $uraian_ad,  $dasar_ad,  $beban_biaya_ad,  $pembayaran_ad,  $sanksi2_ad,  $selisihan_ad){

		$sql = "
			UPDATE stp_master_spk SET
			
			  NO_SPK = '$nomor_spk',
			  NO_RAB = '$no_rab',
			  KEPADA = '$kepada',
			  URAIAN_PEKERJAAN = '$uraian_pekerjaan',
			  DASAR_KERJA = '$dasar',
			  BIAYA_PENAWARAN =  $biaya_tawar,
			  BIAYA_KONTRAK =  $biaya_kontrak,
			  BEBAN_BIAYA = '$beban_biaya',
			  PEMBAYARAN = '$pembayaran',
			  TGL_AWAL = '$tgl_awal',
			  TGL_AKHIR = '$tgl_akhir',
			  SANKSI = '$sanksi2',
			  SELISIH = '$selisihan',
			  ADENDUM = '$nomor_spk_adendum',
			  JENIS_ADENDUM = '$jenis_adendum',
			  NILAI_ADENDUM = $nilai_adendum,
			  TGL_ADENDUM = '$tgl_adendum',
			  SELESAI = $selesai,
			  KEPADA_AD = '$kepada_ad',
			  URAIAN_PEKERJAAN_AD = '$uraian_ad',
			  DASAR_KERJA_AD = '$dasar_ad',
			  BEBAN_BIAYA_AD = '$beban_biaya_ad',
			  PEMBAYARAN_AD = '$pembayaran_ad',
			  SANKSI_AD = '$sanksi2_ad',
			  SELISIH_AD = '$selisihan_ad'
			WHERE ID = $id_spk
		";

		$this->db->query($sql);

	}


}

?>