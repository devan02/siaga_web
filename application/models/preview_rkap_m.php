<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preview_rkap_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_rkap_by_seleksi($id_departemen, $id_divisi, $tahun, $jenis, $sumber){
		$sql = "
		SELECT a.* FROM (
		SELECT a.*,
			CASE 
			WHEN a.SUMBER_DANA LIKE '%PEMERINTAH%' THEN 'MPP' ELSE 'PAM'
			END 
			AS SD_1
			FROM (
			SELECT a.*, b.NAMA AS NAMA_DIVISI, c.JML_DPBM, c.JML_RAB, c.JML_SPK, c.ID_ANGGARAN AS ID_REAL,
			d.TOTAL AS TOTAL_2, d.TOTAL_PELAKSANAAN AS TOTAL_PELAKSANAAN_2, d.JUMLAH AS JUMLAH_2, d.HARGA AS HARGA_2
			FROM stp_anggaran_dasar a
			JOIN stp_divisi b ON a.DIVISI = b.ID

			LEFT JOIN ( 

				SELECT a.ID_ANGGARAN, SUM(a.JML_DPBM) AS JML_DPBM, SUM(a.JML_RAB) AS JML_RAB, SUM(a.JML_SPK) AS JML_SPK FROM (
					SELECT ID_ANGGARAN, (VOLUME_DPBM * HARGA_SATUAN_DPBM + NILAI_SPM) AS JML_DPBM, (VOLUME_RAB * HARGA_SATUAN_RAB) AS JML_RAB,
					(HARGA_SATUAN_SPK + NILAI_SPK_ADENDUM) AS JML_SPK  FROM stp_realisasi_anggaran
					WHERE PERIODE = 1
				) a
				GROUP BY a.ID_ANGGARAN
			) c ON a.ID_ANGGARAN = c.ID_ANGGARAN

			LEFT JOIN ( 
				SELECT KODE_ANGGARAN, TOTAL, TOTAL_PELAKSANAAN, JUMLAH, HARGA
				FROM stp_revisi_anggaran
			) d ON a.KODE_ANGGARAN = d.KODE_ANGGARAN

			WHERE a.DEPARTEMEN LIKE '%$id_departemen%' AND a.DIVISI LIKE '%$id_divisi%' AND a.TAHUN = $tahun AND a.JENIS_ANGGARAN LIKE '%$jenis%'
			AND a.SUMBER_DANA LIKE '%$sumber%' AND a.STS_REVISI != 5
			ORDER BY a.KODE_ANGGARAN ASC
		) a 

		UNION ALL 

		SELECT a.*,
			CASE 
			WHEN a.SUMBER_DANA LIKE '%PEMERINTAH%' THEN 'MPP' ELSE 'PAM'
			END 
			AS SD_1
			FROM (
			SELECT a.*, b.NAMA AS NAMA_DIVISI, c.JML_DPBM, c.JML_RAB, c.JML_SPK, c.ID_ANGGARAN AS ID_REAL,
			d.TOTAL AS TOTAL_2, d.TOTAL_PELAKSANAAN AS TOTAL_PELAKSANAAN_2, d.JUMLAH AS JUMLAH_2, d.HARGA AS HARGA_2
			FROM stp_revisi_anggaran a
			JOIN stp_divisi b ON a.DIVISI = b.ID

			LEFT JOIN ( 

				SELECT a.ID_ANGGARAN, SUM(a.JML_DPBM) AS JML_DPBM, SUM(a.JML_RAB) AS JML_RAB, SUM(a.JML_SPK) AS JML_SPK FROM (
					SELECT ID_ANGGARAN, (VOLUME_DPBM * HARGA_SATUAN_DPBM + NILAI_SPM) AS JML_DPBM, (VOLUME_RAB * HARGA_SATUAN_RAB) AS JML_RAB,
					(HARGA_SATUAN_SPK + NILAI_SPK_ADENDUM) AS JML_SPK  FROM stp_realisasi_anggaran
					WHERE PERIODE = 1
				) a
				GROUP BY a.ID_ANGGARAN
			) c ON a.ID_ANGGARAN = c.ID_ANGGARAN

			LEFT JOIN ( 
				SELECT KODE_ANGGARAN, TOTAL, TOTAL_PELAKSANAAN, JUMLAH, HARGA
				FROM stp_anggaran_dasar
			) d ON a.KODE_ANGGARAN = d.KODE_ANGGARAN

			WHERE a.DEPARTEMEN LIKE '%$id_departemen%' AND a.DIVISI LIKE '%$id_divisi%' AND a.TAHUN = $tahun AND a.JENIS_ANGGARAN LIKE '%$jenis%'
			AND a.SUMBER_DANA LIKE '%$sumber%' AND a.STS_REVISI = 6
			ORDER BY a.KODE_ANGGARAN ASC
		) a 
		) a 
		ORDER BY a.KODE_ANGGARAN ASC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}


}

?>