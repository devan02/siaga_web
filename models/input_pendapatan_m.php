<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_pendapatan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan(
		$kelompok_pelanggan,
		$jenis_kelompok_pelanggan,
		$uraian,
		$m3,
		$tarif,
		$jumlah_blok1,
		$tarif_blok1,
		$total_blok1,
		$jumlah_blok2,
		$tarif_blok2,
		$total_blok2,
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
		$jumlah,
		$tahun,
		$periode){
		
		$sql = "
			INSERT INTO stp_input_pendapatan(
				KODE_PERKIRAAN,
				KELOMPOK_PELANGGAN,
				JENIS_KELOMPOK_PELANGGAN,
				URAIAN,
				M3,
				TARIF,
				JUMLAH_BLOK1,
				TARIF_BLOK1,
				TOTAL_BLOK1,
				JUMLAH_BLOK2,
				TARIF_BLOK2,
				TOTAL_BLOK2,
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
				JUMLAH,
				TAHUN,
				ESTIMASI_TAHUN_2014,
				PERIODE
			)VALUES(
				'81.01.00',
				'$kelompok_pelanggan',
				'$jenis_kelompok_pelanggan',
				'$uraian',
				'$m3',
				'$tarif',
				'$jumlah_blok1',
				'$tarif_blok1',
				'$total_blok1',
				'$jumlah_blok2',
				'$tarif_blok2',
				'$total_blok2',
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
				'$jumlah',
				'$tahun',
				'0',
				'$periode'
			)
		";
		$this->db->query($sql);
	}

	function simpan_non_air($kode_perkiraan,$jenis,$nama_perkiraan,$tahun,$januari,$februari,$maret,$april,$mei,$juni,$juli,$agustus,$september,$oktober,$november,$desember,$jumlah,$periode){
		$sql = "INSERT INTO stp_non_pendapatan(
			KODE_PERKIRAAN,
			JENIS,
			NAMA_PERKIRAAN,
			TAHUN,
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
			JUMLAH,
			PERIODE
		) VALUES(
			'$kode_perkiraan',
			'$jenis',
			'$nama_perkiraan',
			'$tahun',
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
			'$jumlah',
			'$periode'
		)";
		$this->db->query($sql);
	}

	function get_report_sambungan_pelanggan($tahun,$periode){
		$sql = "
			SELECT 
				SPG.ID,
				SPG.URAIAN,
				SPG.KELOMPOK_PELANGGAN,
				SPG.JENIS_KELOMPOK_PELANGGAN,
				SPG.TARIF,
				SPG.TAHUN,
				SPG.JANUARI,
				SPG.FEBRUARI,
				SPG.MARET,
				SPG.APRIL,
				SPG.MEI,
				SPG.JUNI,
				SPG.JULI,
				SPG.AGUSTUS,
				SPG.SEPTEMBER,
				SPG.OKTOBER,
				SPG.NOVEMBER,
				SPG.DESEMBER,
				SPG.JUMLAH,
				SPG.ESTIMASI_2014,
				SPG.ESTIMASI_DES_2014,
				PENDAPATAN.JUMLAH AS JUMLAH_PENDAPATAN
			FROM stp_sambungan_pelanggan SPG
			JOIN(
			  SELECT * FROM stp_input_pendapatan
			  WHERE URAIAN = 'Jumlah sambungan pelanggan ( SP )'
			  AND PERIODE = '$periode'
			) PENDAPATAN ON PENDAPATAN.JENIS_KELOMPOK_PELANGGAN = SPG.JENIS_KELOMPOK_PELANGGAN
			WHERE SPG.TAHUN = '$tahun' AND SPG.PERIODE = '$periode'
			GROUP BY
			SPG.JENIS_KELOMPOK_PELANGGAN
			ORDER BY SPG.ID ASC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function cek_tarif($kp){
		$sql = "
			SELECT 
				TARIF.ID,
				TARIF.KELOMPOK_PELANGGAN,
				(CASE
					WHEN TARIF.STATUS = 1 THEN
						TARIF.BLOK_1
					ELSE
						TARIF.TARIF_NAIK_BLOK_1
				END) AS BLOK_1,
				(CASE
					WHEN TARIF.STATUS = 1 THEN
						TARIF.BLOK_2
					ELSE
						TARIF.TARIF_NAIK_BLOK_2
				END) AS BLOK_2
			FROM stp_master_tarif_blok TARIF
			WHERE TARIF.JENIS_KELOMPOK_PELANGGAN = '$kp'
		";
		$query = $this->db->query($sql);
		return $query->row();
	}

}

?>