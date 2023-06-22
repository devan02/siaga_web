<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_rkap_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_kode_perkiraan($tahun,$krit,$dep,$div){
		$where = "1 = 1 " ;
		if($krit == 'dep'){
			$where = $where." AND TRIM(a.DEPARTEMEN) =TRIM('".$dep."') AND a.SETUJU = 'DISETUJUI'";
		}else if($krit == 'div'){
			$where = $where." AND TRIM(a.DEPARTEMEN) =TRIM('".$dep."') AND TRIM(a.DIVISI) = TRIM('".$div."') AND a.SETUJU = 'DISETUJUI'";
		}else if($krit == ''){
			$where = $where;
		}
		//
		$query = "
			SELECT a.*,b.NAMA_PERKIRAAN, CHILD.INDUK_KODE, bb.NAMA_PERKIRAAN AS NAMA_PERKIRAAN2
			FROM
			(
				SELECT trim(a.KODE_PERKIRAAN) KODE_PERKIRAAN, trim(a.KODE_PERKIRAAN2) KODE_PERKIRAAN2   FROM stp_anggaran_dasar a
				WHERE ".$where."
				AND a.TAHUN = '$tahun'
				group by trim(a.KODE_PERKIRAAN), trim(a.KODE_PERKIRAAN2)
			)a
			JOIN stp_setup_kode_perkiraan b ON trim(b.KODE_PERKIRAAN) = trim(a.KODE_PERKIRAAN)

			LEFT JOIN stp_koper_child_vw CHILD 
            ON TRIM(CHILD.KODE_PERKIRAAN) = TRIM(a.KODE_PERKIRAAN)

            LEFT JOIN stp_setup_kode_perkiraan bb ON trim(CHILD.INDUK_KODE) = trim(bb.KODE_PERKIRAAN)

			ORDER BY CHILD.INDUK_KODE, a.KODE_PERKIRAAN ASC
		";
		return $this->db->query($query)->result();
	}

	function get_report_rinci($kode_perkiraan,$thn,$krit,$dep,$div){
		$sql = "
			SELECT 
			a.KODE_PERKIRAAN,
			a.KODE_ANGGARAN,
			a.TMT_PELAKSANAAN,
			a.LAMA_PELAKSANAAN,
			a.SATUAN,
			a.SETUJU,
			a.URAIAN,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.TOTAL ELSE a.TOTAL
			END AS TOTAL,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.TOTAL_PELAKSANAAN ELSE a.TOTAL_PELAKSANAAN
			END AS TOTAL_PELAKSANAAN,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.JUMLAH ELSE a.JUMLAH
			END AS JUMLAH,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.HARGA ELSE a.HARGA
			END AS HARGA,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.JANUARI ELSE a.JANUARI
			END AS JANUARI,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.FEBRUARI ELSE a.FEBRUARI
			END AS FEBRUARI,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.MARET ELSE a.MARET
			END AS MARET,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.APRIL ELSE a.APRIL
			END AS APRIL,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.MEI ELSE a.MEI
			END AS MEI,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.JUNI ELSE a.JUNI
			END AS JUNI,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.JULI ELSE a.JULI
			END AS JULI,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.AGUSTUS ELSE a.AGUSTUS
			END AS AGUSTUS,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.SEPTEMBER ELSE a.SEPTEMBER
			END AS SEPTEMBER,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.OKTOBER ELSE a.OKTOBER
			END AS OKTOBER,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.NOVEMBER ELSE a.NOVEMBER
			END AS NOVEMBER,

			CASE 
			WHEN a.STS_REVISI = 5 THEN
			d.DESEMBER ELSE a.DESEMBER
			END AS DESEMBER,

			(b.TOTAL_USULAN + b.TOTAL_PELAKSANAAN) AS BIAYA_USULAN, b.JUMLAH_USULAN AS VOL_USULAN, c.NAMA AS NAMA_DIVISI
			FROM stp_anggaran_dasar a
			LEFT JOIN (
				SELECT ID_ANGGARAN, TOTAL_USULAN, TOTAL_PELAKSANAAN, JUMLAH_USULAN
				FROM stp_usulan_anggaran
				WHERE AKTIF = 1
			) b ON a.ID_ANGGARAN = b.ID_ANGGARAN
			LEFT JOIN stp_divisi c ON a.DIVISI = c.ID

			LEFT JOIN ( 
				SELECT 
					KODE_ANGGARAN, 
					TOTAL, 
					TOTAL_PELAKSANAAN, 
					JUMLAH, 
					HARGA,
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
					DESEMBER
				FROM stp_revisi_anggaran
			) d ON a.KODE_ANGGARAN = d.KODE_ANGGARAN

			WHERE a.TAHUN = $thn AND a.DEPARTEMEN LIKE '%$dep%' AND a.DIVISI LIKE '%$div%' AND a.KODE_PERKIRAAN LIKE '%$kode_perkiraan%'
		";
		return $this->db->query($sql)->result();
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
	

}

?>