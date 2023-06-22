<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Biaya_luar_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database(); 
	}

	function insert_next_no_surat($nomor,$bulan,$tahun){
		$sql = "INSERT INTO stp_no_surat(NOMOR,BULAN,TAHUN) VALUES('$nomor','$bulan','$tahun')";
		$this->db->query($sql);
	}

	function update_next_no_surat($id,$next){
		$sql = "UPDATE stp_no_surat SET NOMOR = $next WHERE ID = $id";
		$this->db->query($sql);
	}

	function simpan_biaya_luar($no_surat,$bagian,$sub_bagian,$program_biaya,$alasan,$tanggal,$bulan,$id_dpbm,$id_rab){
		$sql = "
			INSERT INTO stp_biaya_luar_anggaran(
				NO_SURAT,
				BAGIAN,
				SUB_BAGIAN,
				PROGRAM_BIAYA,
				ALASAN,
				TANGGAL,
				BULAN,
				ID_DPBM,
				ID_RAB,
				STATUS
			) VALUES(
				'$no_surat',
				'$bagian',
				'$sub_bagian',
				'$program_biaya',
				'$alasan',
				'$tanggal',
				'$bulan',
				'$id_dpbm',
				'$id_rab',
				0
			)
		";
		$this->db->query($sql);
	}

	function get_no_surat($keyword){
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND ((d.NO_SURAT LIKE '%$keyword%') OR (TRIM(DPBM.NO_DPBM) LIKE '%$keyword%'))";
		}

		$sql = "
			SELECT
			  d.ID,
			  d.NO_SURAT,
			  d.PROGRAM_BIAYA,
			  d.ALASAN,
			  d.TANGGAL,
			  (CASE
			  	WHEN d.ID_DPBM != 0 THEN
			  		DPBM.NO_DPBM
			  	ELSE
			  		RAB.NO_RAB
			  END) AS NO_BUKTI,
			  (CASE
			  	WHEN d.ID_DPBM != 0 THEN
			  		DET_DPBM.NAMA_BARANG
			  	ELSE
			  		DET_RAB.KEGIATAN
			  END) AS NAMA_BARANG,
			  DEP.NAMA NAMA_BAGIAN,
			  SUB_BAG.NAMA NAMA_SUB_BAGIAN
			FROM stp_biaya_luar_anggaran d
			LEFT JOIN stp_dpbm DPBM ON d.ID_DPBM = DPBM.ID
			LEFT JOIN stp_dpbm_detail DET_DPBM ON DET_DPBM.ID_DPBM = DPBM.ID
			LEFT JOIN stp_rincian_anggaran_biaya_detail DET_RAB ON DET_RAB.ID = d.ID_RAB
			LEFT JOIN stp_rincian_anggaran_biaya RAB ON RAB.ID = DET_RAB.ID_RAB
			LEFT JOIN stp_divisi SUB_BAG ON SUB_BAG.ID = d.SUB_BAGIAN
			LEFT JOIN stp_departemen DEP ON DEP.ID = d.BAGIAN
			LEFT JOIN stp_kode_barang BARANG ON BARANG.KODE_BARANG = DET_DPBM.KODE_BARANG
			WHERE $where AND d.STATUS = 0
			GROUP BY
				d.ID,
				d.NO_SURAT,
				d.PROGRAM_BIAYA,
				d.ALASAN,
				d.TANGGAL,
				DPBM.NO_DPBM
			ORDER BY
			  d.ID ASC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_surat_id($id_surat){
		$sql = "
			SELECT
			  d.ID,
			  d.NO_SURAT,
			  d.PROGRAM_BIAYA,
			  d.ALASAN,
			  d.TANGGAL,
			  d.BAGIAN,
			  d.SUB_BAGIAN,
			  (CASE
			  	WHEN d.ID_DPBM != 0 THEN
			  		DPBM.NO_DPBM
			  	ELSE
			  		RAB.NO_RAB
			  END) AS NO_BUKTI,
			  (CASE
			  	WHEN d.ID_DPBM != 0 THEN
			  		DET_DPBM.NAMA_BARANG
			  	ELSE
			  		DET_RAB.KEGIATAN
			  END) AS NAMA_BARANG,
			  DEP.NAMA NAMA_BAGIAN,
			  SUB_BAG.NAMA NAMA_SUB_BAGIAN
			FROM stp_biaya_luar_anggaran d
			LEFT JOIN stp_dpbm DPBM ON d.ID_DPBM = DPBM.ID
			LEFT JOIN stp_dpbm_detail DET_DPBM ON DET_DPBM.ID_DPBM = DPBM.ID
			LEFT JOIN stp_rincian_anggaran_biaya_detail DET_RAB ON DET_RAB.ID = d.ID_RAB
			LEFT JOIN stp_rincian_anggaran_biaya RAB ON RAB.ID = DET_RAB.ID_RAB
			LEFT JOIN stp_divisi SUB_BAG ON SUB_BAG.ID = d.SUB_BAGIAN
			LEFT JOIN stp_departemen DEP ON DEP.ID = d.BAGIAN
			LEFT JOIN stp_kode_barang BARANG ON BARANG.KODE_BARANG = DET_DPBM.KODE_BARANG
			WHERE d.ID = '$id_surat'
			GROUP BY
				d.ID,
				d.NO_SURAT,
				d.PROGRAM_BIAYA,
				d.ALASAN,
				d.TANGGAL,
				DPBM.NO_DPBM
			ORDER BY
			  d.ID ASC
		";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function update_status($id_surat){
		$sql = "UPDATE stp_biaya_luar_anggaran SET STATUS = 1 WHERE ID = '$id_surat'";
		$this->db->query($sql);
	}

	function get_dpbm($keyword){
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (DPBM.NO_DPBM LIKE '%$keyword%' OR DET_DPBM.NAMA_BARANG LIKE '%$keyword%' OR DET_DPBM.KODE_BARANG LIKE '%$keyword%')";
		}

		$sql = "
			SELECT
				DPBM.ID,
				DPBM.NO_DPBM,
				DET_DPBM.ID AS ID_DET_DPBM,
				DET_DPBM.KODE_BARANG,
				DET_DPBM.NAMA_BARANG,
				DET_DPBM.VOLUME,
				BARANG.SATUAN,
				DET_DPBM.HARGA
			FROM stp_dpbm DPBM
			LEFT JOIN stp_dpbm_detail DET_DPBM ON DET_DPBM.ID_DPBM = DPBM.ID
			LEFT JOIN stp_kode_barang BARANG ON BARANG.KODE_BARANG = DET_DPBM.KODE_BARANG
			WHERE $where 
			AND DET_DPBM.STATUS = 0 
			AND DPBM.NO_KEU != ''
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_dpbm_by_id($id_dpbm){
		$sql = "
			SELECT
				DPBM.ID,
				DPBM.NO_DPBM,
				DET_DPBM.ID AS ID_DET_DPBM,
				DET_DPBM.KODE_BARANG,
				DET_DPBM.NAMA_BARANG,
				DET_DPBM.VOLUME,
				BARANG.SATUAN,
				DET_DPBM.HARGA,
				DPBM.NO_KEU
			FROM stp_dpbm DPBM
			LEFT JOIN stp_dpbm_detail DET_DPBM ON DET_DPBM.ID_DPBM = DPBM.ID
			LEFT JOIN stp_kode_barang BARANG ON BARANG.KODE_BARANG = DET_DPBM.KODE_BARANG
			WHERE DPBM.ID = $id_dpbm
		";
		$query = $this->db->query($sql);
		return $query->row();
	}

}

?>