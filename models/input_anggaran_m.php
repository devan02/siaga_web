<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_anggaran_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database(); 
	}

	function simpan_anggaran(
		$kode_perkiraan,
		$kode_anggaran,
		$tahun,
		$departemen,
		$divisi,
		$jenis_anggaran,
		$id_jenis_anggaran,
		$uraian,
		$sumber_dana,
		$lokasi,
		$satuan,
		$harga,
		$jumlah,
		$total,
		$tmt_pelaksanaan,
		$lama_pelaksanaan,
		$total_pelaksanaan,
		$jenis_rapat,
		$setuju,
		$sts_tambahan,
		$januari,
		$februari,
		$maret,
		$april,
		$mei,
		$juni,
		$juli,
		$agustus,
		$september,
		$oktober,
		$november,
		$desember,
		$tanggal_input){

		$sql = "
			INSERT INTO stp_anggaran_dasar(
				KODE_PERKIRAAN,
				KODE_ANGGARAN,
				TAHUN,
				DEPARTEMEN,
				DIVISI,
				JENIS_ANGGARAN,
				ID_JENIS_ANGGARAN,
				URAIAN,
				SUMBER_DANA,
				LOKASI,
				SATUAN,
				HARGA,
				JUMLAH,
				TOTAL,
				TMT_PELAKSANAAN,
				LAMA_PELAKSANAAN,
				TOTAL_PELAKSANAAN,
				JENIS_RAPAT,
				SETUJU,
				STS_TAMBAHAN,
				JANUARI, 
				FEBRUARI, 
				MARET, 
				APRIL, 
				MEI, 
				JUNI, 
				JULI, 
				AGUSTUS, 
				SEPTEMBER, 
				OKTOBER, 
				NOVEMBER, 
				DESEMBER,
				TANGGAL_INPUT,
				PERIODE
			)VALUES(
				'$kode_perkiraan',
				'$kode_anggaran',
				'$tahun',
				'$departemen',
				'$divisi',
				'$jenis_anggaran',
				'$id_jenis_anggaran',
				'$uraian',
				'$sumber_dana',
				'$lokasi',
				'$satuan',
				'$harga',
				'$jumlah',
				'$total',
				'$tmt_pelaksanaan',
				'$lama_pelaksanaan',
				'$total_pelaksanaan',
				'$jenis_rapat',
				'$setuju',
				'$sts_tambahan',
				'$januari',
				'$februari',
				'$maret',
				'$april',
				'$mei',
				'$juni',
				'$juli',
				'$agustus',
				'$september',
				'$oktober',
				'$november',
				'$desember',
				'$tanggal_input',
				1
			)
		";
		$this->db->query($sql);
	}

	function ubah_anggaran(
		$kode_anggaran,
		$kode_perkiraan,
		$jenis_anggaran,
		$id_jenis_anggaran,
		$uraian,
		$sumber_dana,
		$lokasi,
		$satuan,
		$harga,
		$jumlah,
		$total,
		$tmt_pelaksanaan,
		$lama_pelaksanaan,
		$total_pelaksanaan,
		$januari,
		$februari,
		$maret,
		$april,
		$mei,
		$juni,
		$juli,
		$agustus,
		$september,
		$oktober,
		$november,
		$desember){
		$sql = "
			UPDATE stp_anggaran_dasar SET
				KODE_PERKIRAAN = '$kode_perkiraan',
				JENIS_ANGGARAN = '$jenis_anggaran',
				ID_JENIS_ANGGARAN = '$id_jenis_anggaran',
				URAIAN = '$uraian',
				SUMBER_DANA = '$sumber_dana',
				LOKASI = '$lokasi',
				SATUAN = '$satuan',
				HARGA = '$harga',
				JUMLAH = '$jumlah',
				TOTAL = '$total',
				TMT_PELAKSANAAN = '$tmt_pelaksanaan',
				LAMA_PELAKSANAAN = '$lama_pelaksanaan',
				TOTAL_PELAKSANAAN = '$total_pelaksanaan',
				JANUARI = '$januari', 
				FEBRUARI = '$februari', 
				MARET = '$maret', 
				APRIL = '$april', 
				MEI = '$mei', 
				JUNI = '$juni', 
				JULI = '$juli', 
				AGUSTUS = '$agustus', 
				SEPTEMBER = '$september', 
				OKTOBER = '$oktober', 
				NOVEMBER = '$november', 
				DESEMBER = '$desember'
			WHERE KODE_ANGGARAN = '$kode_anggaran'
		";
		$this->db->query($sql);
	}

	function get_anggaran_id($kode_anggaran){
		$sql = "
			SELECT 
				DASAR.*,
				BRG.ID AS ID_BARANG
			FROM stp_anggaran_dasar DASAR
			LEFT JOIN stp_kode_barang BRG ON BRG.KODE_BARANG = DASAR.ID_JENIS_ANGGARAN
			WHERE DASAR.ID_ANGGARAN = '$kode_anggaran'
		";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function hapus_anggaran($id_anggaran){
		$sql = "DELETE FROM stp_anggaran_dasar WHERE ID_ANGGARAN = $id_anggaran";
		$this->db->query($sql);
	}
}

?>