<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_usulan_anggaran_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_report_condition($tahun, $departemen, $divisi, $koper){
		
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

			b.NAMA AS NAMA_DIVISI, c.NAMA_PERKIRAAN FROM stp_anggaran_dasar a
			LEFT JOIN stp_divisi b ON a.DIVISI = b.ID
			LEFT JOIN stp_Setup_kode_perkiraan c  ON a.KODE_PERKIRAAN = c.KODE_PERKIRAAN

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

			WHERE a.TAHUN = $tahun AND a.DEPARTEMEN LIKE '%$departemen%' AND a.DIVISI LIKE '%$divisi%' AND a.KODE_PERKIRAAN LIKE '%$koper%'
			ORDER BY a.KODE_PERKIRAAN ASC
		";

		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_nama_dep($departemen){

		$sql = "
			SELECT * FROM stp_departemen WHERE ID = $departemen
		";

		$query = $this->db->query($sql);
		return $query->row();
	}

	function get_nama_div($divisi){

		$sql = "
			SELECT * FROM stp_divisi WHERE ID = $divisi
		";

		$query = $this->db->query($sql);
		return $query->row();
	}


}

?>