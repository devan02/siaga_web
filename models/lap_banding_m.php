<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_banding_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_kode_perkiraan($tahun){
		$where = "1 = 1 ";

		if($tahun != 0){
			$where = $where." AND a.TAHUN = $tahun";
		} 
		
		$query = "
				SELECT 
					a.*,
					b.nama_perkiraan
				FROM(
					SELECT 
						TRIM(a.kode_perkiraan) kode_perkiraan  
					FROM stp_anggaran_dasar a
					WHERE $where 
					AND a.SETUJU = 'DISETUJUI'
					GROUP BY 
						a.kode_perkiraan
				)a
				JOIN stp_setup_kode_perkiraan b ON trim(b.kode_perkiraan) = trim(a.kode_perkiraan)
				ORDER BY 
					a.kode_perkiraan ASC
		";
		$sql = $this->db->query($query);
		return $sql->result();
	}

	function get_kode_perkiraan_new($tahun){
		$where = "1 = 1";
		//
		$query = "
			SELECT a.*,b.NAMA_PERKIRAAN, CHILD.INDUK_KODE, bb.NAMA_PERKIRAAN AS NAMA_PERKIRAAN2
			FROM
			(
				SELECT trim(a.KODE_PERKIRAAN) KODE_PERKIRAAN, trim(a.KODE_PERKIRAAN2) KODE_PERKIRAAN2   FROM stp_revisi_anggaran a
				WHERE $where
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

	function get_perbandingan_rkap_revisi($kode_perkiraan,$tahun){
		$where = "1 = 1";
		if($tahun != 0){
			$where = $where." AND a.TAHUN = '$tahun'";
		}

		$query = "
			SELECT
			  ID_ANGGARAN,
			  KODE_ANGGARAN,
			  KODE_PERKIRAAN,
			  URAIAN,
			  NAMA_SUB_BAGIAN,
			  NAMA_BAGIAN,
			  DIVISI,
			  SATUAN,
			  JUMLAH,
			  HARGA,
			  VOL_USULAN,
			  STS_TAMBAHAN,
			  STS_REVISI,
			  BIAYA_USULAN,
			  RKAP,
			  RKAP_REVISI,
			  (HARGA * (SUM(JUMLAH))) AS REALISASI,
			  (RKAP - (HARGA*SUM(JUMLAH))) AS SISA
			FROM(
				SELECT 
				  a.ID_ANGGARAN AS ID_ANGGARAN,
				  a.KODE_ANGGARAN AS KODE_ANGGARAN,
				  a.KODE_PERKIRAAN AS KODE_PERKIRAAN,
				  a.URAIAN AS URAIAN,
				  b.nama AS NAMA_SUB_BAGIAN,
				  c.nama AS NAMA_BAGIAN,
				  a.DIVISI AS DIVISI,
				  a.SATUAN AS SATUAN,
				  a.JUMLAH AS JUMLAH,
				  a.HARGA AS HARGA,
				  (CASE
				    WHEN USULAN.ID_ANGGARAN IS NULL THEN 
				      a.jumlah
				    ELSE 
				      USULAN.JUMLAH_USULAN
				   END) AS VOL_USULAN,
				  USULAN.TOTAL_USULAN AS BIAYA_USULAN,
				  (CASE
				    WHEN a.JENIS_ANGGARAN = 'Barang' THEN 
				      a.TOTAL
				    ELSE 
				      a.TOTAL_PELAKSANAAN
				   END) AS RKAP,
				  (CASE
				    WHEN REVISI.JENIS_ANGGARAN = 'Barang' THEN
				      REVISI.TOTAL
				    ELSE
				      REVISI.TOTAL_PELAKSANAAN
				    END) AS RKAP_REVISI,
				  a.STS_TAMBAHAN AS STS_TAMBAHAN,
				  a.STS_REVISI AS STS_REVISI
				FROM stp_anggaran_dasar a
				LEFT JOIN stp_divisi b ON b.id = a.divisi
				LEFT JOIN stp_departemen c ON c.id = a.departemen
				LEFT JOIN stp_usulan_anggaran USULAN ON a.ID_ANGGARAN = USULAN.ID_ANGGARAN
				LEFT JOIN stp_revisi_anggaran REVISI ON REVISI.ID_ANGGARAN = a.ID_ANGGARAN
				WHERE $where
				AND trim(a.kode_perkiraan) = trim('$kode_perkiraan')
			) a
			GROUP BY
				a.ID_ANGGARAN,
				a.KODE_ANGGARAN
			ORDER BY 
			  a.KODE_PERKIRAAN ASC 
		";
		return $this->db->query($query)->result();
	}

}

?>