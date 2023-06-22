<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_revisi_rkap_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_kode_perkiraan($tahun,$krit,$dep,$div){
		$where = "1 = 1 " ;
		$where2 = "1 = 1";
		if($krit == 'bagian'){
			$where = $where." AND TRIM(a.DEPARTEMEN) =TRIM('".$dep."')";
			$where2 = $where2." AND TRIM(a.DEPARTEMEN) =TRIM('".$dep."')";
		}else if($krit == 'sub_bagian'){
			$where = $where." AND TRIM(a.DEPARTEMEN) =TRIM('".$dep."') AND TRIM(a.DIVISI) = TRIM('".$div."')";
			$where2 = $where2." AND TRIM(a.DEPARTEMEN) =TRIM('".$dep."') AND TRIM(a.DIVISI) = TRIM('".$div."')";
		}else if($krit == 'semua_bagian'){
			$where = $where;
			$where2 = $where2;
		}
		//
		$query = "
			SELECT
				z.*
			FROM(
				SELECT 
					a.*,
					b.NAMA_PERKIRAAN, 
					CHILD.INDUK_KODE, 
					bb.NAMA_PERKIRAAN AS NAMA_PERKIRAAN2
				FROM(
					SELECT 
						trim(a.KODE_PERKIRAAN) KODE_PERKIRAAN, 
						trim(a.KODE_PERKIRAAN2) KODE_PERKIRAAN2 
					FROM stp_revisi_anggaran a
					WHERE ".$where."
					AND a.TAHUN = '$tahun'
					AND a.SETUJU = 'DISETUJUI'
					GROUP BY 
						TRIM(a.KODE_PERKIRAAN), 
						TRIM(a.KODE_PERKIRAAN2)
				)a
				JOIN stp_setup_kode_perkiraan b ON trim(b.KODE_PERKIRAAN) = trim(a.KODE_PERKIRAAN)
				LEFT JOIN stp_koper_child_vw CHILD ON TRIM(CHILD.KODE_PERKIRAAN) = TRIM(a.KODE_PERKIRAAN)
	            LEFT JOIN stp_setup_kode_perkiraan bb ON trim(CHILD.INDUK_KODE) = trim(bb.KODE_PERKIRAAN)

	            UNION ALL

	            SELECT 
					a.*,
					b.NAMA_PERKIRAAN,
					CHILD.INDUK_KODE, 
					bb.NAMA_PERKIRAAN AS NAMA_PERKIRAAN2
				FROM(
					SELECT 
						trim(a.KODE_PERKIRAAN) KODE_PERKIRAAN, 
						trim(a.KODE_PERKIRAAN2) KODE_PERKIRAAN2 
					FROM stp_anggaran_dasar a
					WHERE ".$where2."
					AND a.TAHUN = '$tahun'
					AND a.SETUJU = 'DISETUJUI'
					GROUP BY 
						TRIM(a.KODE_PERKIRAAN), 
						TRIM(a.KODE_PERKIRAAN2)
				)a
				JOIN stp_setup_kode_perkiraan b ON trim(b.KODE_PERKIRAAN) = trim(a.KODE_PERKIRAAN)
				LEFT JOIN stp_koper_child_vw CHILD ON TRIM(CHILD.KODE_PERKIRAAN) = TRIM(a.KODE_PERKIRAAN)
	            LEFT JOIN stp_setup_kode_perkiraan bb ON trim(CHILD.INDUK_KODE) = trim(bb.KODE_PERKIRAAN)
			) z
			GROUP BY
				z.KODE_PERKIRAAN
			ORDER BY 
				z.INDUK_KODE, 
				z.KODE_PERKIRAAN ASC
		";
		return $this->db->query($query)->result();
	}

	function get_nama_dep($dep){
		$sql = "
			SELECT * FROM stp_departemen WHERE ID = $dep
		";
		return $this->db->query($sql)->row();
	}

	function get_nama_div($div){
		$sql = "
			SELECT * FROM stp_divisi WHERE ID = $div
		";
		return $this->db->query($sql)->row();
	}

	function get_report_rinci($kode_perkiraan,$tahun,$krit,$dep,$div){

		// STS_TAMBAHAN 1 = DATA INPUT ANGGARAN
		// STS_TAMBAHAN 2 = DATA INPUT ANGGARAN TAMBAHAN DI REALISASI ANGGARAN
		// STS_TAMBAHAN 3 = DATA INPUT REVISI RKAP
		// STS_TAMBAHAN 4 = DATA INPUT ANGGARAN TAMBAHAN DI REALISASI REVISI RKAP
		// STS_REVISI 5 (di tabel stp_anggaran_dasar) & STS_TAMBAHAN 6 (di tabel stp_revisi_anggaran) = 
		// DATA RKAP (PERIODE 1) DI UBAH DI INPUT REVISI RKAP

		$where = "1 = 1";

		if($krit == "semua_bagian"){
			$where = $where;
		} else if($krit == "bagian"){
			$where = $where." AND a.DEPARTEMEN = '$dep'";
		} else if($krit == "sub_bagian"){
			$where = $where." AND a.DEPARTEMEN = '$dep' AND a.DIVISI = '$div'";
		}

		if($kode_perkiraan != ""){
			$where = $where." AND a.KODE_PERKIRAAN = '$kode_perkiraan'";
		}

		$sql2 = "
			SELECT 
				a.*
			FROM (
				SELECT 
					a.ID AS ID_ANGGARAN,
					a.KODE_PERKIRAAN,
					a.KODE_PERKIRAAN2,
					a.KODE_ANGGARAN,
					a.URAIAN,
					a.DIVISI,
					a.STS_REVISI,
					a.STS_TAMBAHAN,
					a.DEPARTEMEN,
					DSR.JUMLAH AS JUMLAH_DASAR,
					a.JUMLAH AS JUMLAH_REVISI,
					d.JUMLAH_USULAN AS JUMLAH_USULAN,
					a.HARGA,
					a.SATUAN,
					a.CAT_TAMBAHAN,
					a.JENIS_RAPAT,
					a.JENIS_ANGGARAN,
					a.TOTAL,
					a.TOTAL_PELAKSANAAN,
					a.JANUARI,
					a.FEBRUARI,
					a.MARET,
					a.APRIL,
					a.MEI,
					a.JUNI,
					a.JULI,
					a.AGUSTUS,
					a.SEPTEMBER,
					a.OKTOBER,
					a.NOVEMBER,
					a.DESEMBER,
					b.NAMA AS NAMA_DIVISI, 
					IFNULL(c.JML_DPBM, 0) AS JML_DPBM,
					IFNULL(c.JML_RAB, 0) AS JML_RAB, 
					IFNULL(c.JML_SPK,0) AS JML_SPK,
					IFNULL(c.REALISASI,0) AS REALISASI,
					IFNULL(c.REAL_VOL,0) AS REAL_VOL,
					c.ID_ANGGARAN AS ID_REAL,
					2 AS STS_INPUT
				FROM stp_revisi_anggaran a
				JOIN stp_divisi b ON a.DIVISI = b.ID
				LEFT JOIN(
					SELECT * FROM stp_anggaran_dasar
				) DSR ON DSR.KODE_ANGGARAN = a.KODE_ANGGARAN
				LEFT JOIN ( 
					SELECT 
						a.ID_ANGGARAN,
						SUM(a.JML_DPBM) AS JML_DPBM, 
						SUM(a.JML_RAB) AS JML_RAB, 
						SUM(a.JML_SPK) AS JML_SPK,
						SUM(a.REALISASI) AS REALISASI,
						SUM(a.REAL_VOL) AS REAL_VOL
					FROM (
						SELECT 
							ID_ANGGARAN, 
							(VOLUME_DPBM * HARGA_SATUAN_DPBM + NILAI_SPM) AS JML_DPBM, 
							(VOLUME_RAB * HARGA_SATUAN_RAB) AS JML_RAB,
							(HARGA_SATUAN_SPK + NILAI_SPK_ADENDUM) AS JML_SPK,
							(CASE
								WHEN ID_SPK != 0 THEN 
									(HARGA_SATUAN_SPK + NILAI_SPK_ADENDUM)		
								WHEN ID_RAB != 0 THEN 
									(VOLUME_RAB * HARGA_SATUAN_RAB)
								ELSE 
									(VOLUME_DPBM * HARGA_SATUAN_DPBM + NILAI_SPM)
							END) AS REALISASI,
							(CASE
								WHEN ID_SPK != 0 THEN 
									1
								WHEN ID_RAB != 0 THEN 
									VOLUME_RAB
								ELSE 
									VOLUME_DPBM
							END) AS REAL_VOL
						FROM stp_realisasi_anggaran
						WHERE PERIODE = 2
					) a
					GROUP BY a.ID_ANGGARAN
				) c ON a.ID = c.ID_ANGGARAN
				LEFT JOIN(
					SELECT * FROM stp_usulan_anggaran 
					WHERE JENIS_RAPAT = 'REVISI-RKAP' AND AKTIF = 1
				) d ON d.ID_ANGGARAN = a.ID
				WHERE $where
				AND a.TAHUN = '$tahun'
				AND a.SETUJU = 'DISETUJUI'

				UNION ALL

				SELECT 
					a.ID_ANGGARAN,
					a.KODE_PERKIRAAN,
					a.KODE_PERKIRAAN2,
					a.KODE_ANGGARAN,
					a.URAIAN,
					a.DIVISI,
					a.STS_REVISI,
					a.STS_TAMBAHAN,
					a.DEPARTEMEN,
					a.JUMLAH AS JUMLAH_DASAR,
					'0' AS JUMLAH_REVISI,
					'0' AS JUMLAH_USULAN,
					a.HARGA,
					a.SATUAN,
					a.CAT_TAMBAHAN,
					a.JENIS_RAPAT,
					a.JENIS_ANGGARAN,
					a.TOTAL,
					a.TOTAL_PELAKSANAAN,
					a.JANUARI,
					a.FEBRUARI,
					a.MARET,
					a.APRIL,
					a.MEI,
					a.JUNI,
					a.JULI,
					a.AGUSTUS,
					a.SEPTEMBER,
					a.OKTOBER,
					a.NOVEMBER,
					a.DESEMBER, 
					b.NAMA AS NAMA_DIVISI, 
					IFNULL(c.JML_DPBM, 0) AS JML_DPBM, 
					IFNULL(c.JML_RAB, 0) AS JML_RAB, 
					IFNULL(c.JML_SPK,0) AS JML_SPK, 
					IFNULL(c.REALISASI,0) AS REALISASI,
					IFNULL(c.REAL_VOL,0) AS REAL_VOL,
					c.ID_ANGGARAN AS ID_REAL,
					1 AS STS_INPUT
				FROM stp_anggaran_dasar a
				JOIN stp_divisi b ON a.DIVISI = b.ID
				LEFT JOIN (
					SELECT 
						a.ID_ANGGARAN, 
						SUM(a.JML_DPBM) AS JML_DPBM, 
						SUM(a.JML_RAB) AS JML_RAB, 
						SUM(a.JML_SPK) AS JML_SPK,
						SUM(a.REALISASI) AS REALISASI,
						SUM(a.REAL_VOL) AS REAL_VOL
					FROM (
						SELECT 
							ID_ANGGARAN, 
							(VOLUME_DPBM * HARGA_SATUAN_DPBM + NILAI_SPM) AS JML_DPBM, 
							(VOLUME_RAB * HARGA_SATUAN_RAB) AS JML_RAB,
							(HARGA_SATUAN_SPK + NILAI_SPK_ADENDUM) AS JML_SPK,
							(CASE
								WHEN ID_SPK != 0 THEN 
									(HARGA_SATUAN_SPK + NILAI_SPK_ADENDUM)		
								WHEN ID_RAB != 0 THEN 
									(VOLUME_RAB * HARGA_SATUAN_RAB)
								ELSE 
									(VOLUME_DPBM * HARGA_SATUAN_DPBM + NILAI_SPM)
							END) AS REALISASI,
							(CASE
								WHEN ID_SPK != 0 THEN 
									1
								WHEN ID_RAB != 0 THEN 
									VOLUME_RAB
								ELSE 
									VOLUME_DPBM
							END) AS REAL_VOL
						FROM stp_realisasi_anggaran
						WHERE PERIODE = 1
					) a
					GROUP BY a.ID_ANGGARAN
				) c ON a.ID_ANGGARAN = c.ID_ANGGARAN
				WHERE $where
				AND a.TAHUN = '$tahun'
				AND a.SETUJU = 'DISETUJUI'
			) a
			GROUP BY a.KODE_ANGGARAN
			ORDER BY a.KODE_ANGGARAN ASC
		";
		return $this->db->query($sql2)->result();
	}

}

?>