<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Realisasi_revisi_anggaran_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}
	
	function get_realisasi($tahun,$bagian,$sub_bagian,$kode_perkiraan,$kriteria,$keyword){
		$where = "1 = 1";

		if($kriteria == "semua_bagian"){
			$where = $where;
		}else if($kriteria == "bagian"){
			$where = $where." AND a.DEPARTEMEN = '$bagian'";
		}else{
			$where = $where." AND a.DEPARTEMEN = '$bagian' AND a.DIVISI = '$sub_bagian'";
		}

		if($kode_perkiraan != ""){
			$where = $where." AND a.KODE_PERKIRAAN = '$kode_perkiraan'";
		}

		if($keyword != ""){
			$where = $where." AND (a.KODE_ANGGARAN LIKE '%$keyword%' OR a.URAIAN LIKE '%$keyword%' OR a.KODE_PERKIRAAN LIKE '%$keyword%')";
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
					a.JUMLAH,
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
					IFNULL(c.REALISASI,0) AS REALISASI,
					IFNULL(c.REAL_VOL,0) AS REAL_VOL,
					c.ID_ANGGARAN AS ID_REAL, 
					2 AS STS_INPUT
				FROM stp_revisi_anggaran a
				JOIN stp_divisi b ON a.DIVISI = b.ID
				LEFT JOIN ( 
					SELECT 
						a.ID_ANGGARAN,
						SUM(a.REALISASI) AS REALISASI,
						SUM(a.REAL_VOL) AS REAL_VOL
					FROM (
						SELECT 
							ID_ANGGARAN,
							(CASE
								WHEN ID_SPK != 0 THEN 
									(HARGA_SATUAN_SPK + NILAI_SPK_ADENDUM)
								ELSE
									(CASE
										WHEN ID_RAB != 0 THEN 
											(VOLUME_RAB * HARGA_SATUAN_RAB)
										WHEN ID_SPM != 0 THEN 
											NILAI_SPM
										ELSE 
											(VOLUME_DPBM * HARGA_SATUAN_DPBM + NILAI_SPM)
									END)
							END) AS REALISASI,
							(CASE
								WHEN ID_SPK != 0 THEN 
									1
								ELSE
									(CASE
										WHEN ID_RAB != 0 THEN 
											VOLUME_RAB
										WHEN ID_SPM != 0 THEN 
											1
										ELSE 
											VOLUME_DPBM
									END)
							END) AS REAL_VOL
						FROM stp_realisasi_anggaran
						WHERE PERIODE = 2
					) a
					GROUP BY a.ID_ANGGARAN
				) c ON a.ID = c.ID_ANGGARAN
				LEFT JOIN(
					SELECT * FROM stp_anggaran_dasar
				) DSR ON DSR.KODE_ANGGARAN = a.KODE_ANGGARAN
				LEFT JOIN(
					SELECT * FROM stp_usulan_anggaran WHERE JENIS_RAPAT = 'REVISI-RKAP' AND AKTIF = 1
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
					a.JUMLAH,
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
					IFNULL(c.REALISASI,0) AS REALISASI, 
					IFNULL(c.REAL_VOL,0) AS REAL_VOL,
					c.ID_ANGGARAN AS ID_REAL,
					1 AS STS_INPUT
				FROM stp_anggaran_dasar a
				JOIN stp_divisi b ON a.DIVISI = b.ID
				LEFT JOIN (
					SELECT 
						a.ID_ANGGARAN,
						SUM(a.REALISASI) AS REALISASI,
						SUM(a.REAL_VOL) AS REAL_VOL
					FROM (
						SELECT 
							ID_ANGGARAN, 
							(CASE
								WHEN ID_SPK != 0 THEN 
									(HARGA_SATUAN_SPK + NILAI_SPK_ADENDUM)
								ELSE
									(CASE
										WHEN ID_RAB != 0 THEN 
											(VOLUME_RAB * HARGA_SATUAN_RAB)
										WHEN ID_SPM != 0 THEN
											NILAI_SPM
										ELSE 
											(VOLUME_DPBM * HARGA_SATUAN_DPBM + NILAI_SPM)
									END)
							END) AS REALISASI,
							(CASE
								WHEN ID_SPK != 0 THEN 
									1
								ELSE
									(CASE
										WHEN ID_RAB != 0 THEN 
											VOLUME_RAB
										WHEN ID_SPM != 0 THEN 
											1
										ELSE 
											VOLUME_DPBM
									END)
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
		$query = $this->db->query($sql2);
		return $query->result();
	}

	function cek_do_realisasi($id_anggaran,$id_dpbm = 0){
		$where = "1 = 1";
		if($id_dpbm == 1){
			$where = $where." AND ID_DPBM != 0";
		}else if($id_dpbm == 2){
			$where = $where." AND ID_RAB != 0";
		}else if($id_dpbm == 3){
			$where = $where." AND ID_SPM != 0";
		}

		$sql = "SELECT * FROM stp_realisasi_anggaran WHERE $where AND ID_ANGGARAN = $id_anggaran";
		$query = $this->db->query($sql);
		return $query;
	}

	function do_realisasi($id_anggaran,$periode){
		$sql = "";
		if($periode == "1"){
			$sql = "
				SELECT
				  ID_ANGGARAN,
				  KODE_PERKIRAAN,
				  KODE_PERKIRAAN2,
				  KODE_ANGGARAN,
				  TAHUN,
				  NAMA_DEPARTEMEN,
				  NAMA_DIVISI,
				  JENIS_ANGGARAN,
				  URAIAN,
				  SATUAN,
				  HARGA,
				  JUMLAH,
				  ID_DPBM,
				  ID_RAB,
				  TOTAL,
				  VOLUME,
				  HARGA_SATUAN,
				  REALISASI,
				  (TOTAL-REALISASI) AS SISA
				FROM(
					SELECT 
						DASAR.ID_ANGGARAN,
						DASAR.KODE_PERKIRAAN,
						DASAR.KODE_PERKIRAAN2,
						DASAR.KODE_ANGGARAN,
						DASAR.TAHUN,
						DASAR.DEPARTEMEN,
						DEP.NAMA AS NAMA_DEPARTEMEN,
						DASAR.DIVISI,
						DIVISI.NAMA AS NAMA_DIVISI,
						DASAR.JENIS_ANGGARAN,
						DASAR.URAIAN,
						DASAR.SATUAN,
						DASAR.HARGA,
						DASAR.JUMLAH,
						REALISASI.ID_DPBM,
						REALISASI.ID_RAB,
						(CASE
						  WHEN DASAR.JENIS_ANGGARAN = 'Barang' THEN
						    DASAR.TOTAL
						  ELSE
						    DASAR.TOTAL_PELAKSANAAN
						END) AS TOTAL,
						(CASE
						  WHEN REALISASI.ID_DPBM IS NOT NULL THEN
						    SUM(DET_DPBM.VOLUME)
						  ELSE
						    SUM(REALISASI.VOLUME_DPBM)
						END) AS VOLUME,
						(CASE
						  WHEN REALISASI.ID_DPBM IS NOT NULL THEN
						    DET_DPBM.HARGA
						  ELSE
						    REALISASI.HARGA_SATUAN_DPBM
						END) AS HARGA_SATUAN,
						(CASE
						  WHEN REALISASI.ID_DPBM IS NOT NULL THEN
						    (SUM(DET_DPBM.VOLUME)*DET_DPBM.HARGA)
						  ELSE
						    (SUM(REALISASI.VOLUME_DPBM)*REALISASI.HARGA_SATUAN_DPBM)
						END) AS REALISASI
					FROM stp_anggaran_dasar DASAR
					LEFT JOIN stp_realisasi_anggaran REALISASI ON DASAR.ID_ANGGARAN = REALISASI.ID_ANGGARAN
					LEFT JOIN stp_dpbm DPBM ON DPBM.ID = REALISASI.ID_DPBM
					LEFT JOIN stp_dpbm_detail DET_DPBM ON DPBM.ID = DET_DPBM.ID_DPBM
					LEFT JOIN stp_departemen DEP ON DEP.ID = DASAR.DEPARTEMEN
					LEFT JOIN stp_divisi DIVISI ON DIVISI.ID = DASAR.DIVISI
					WHERE DASAR.ID_ANGGARAN = $id_anggaran
					GROUP BY
				      DASAR.ID_ANGGARAN,
				      DASAR.KODE_PERKIRAAN,
				      DASAR.KODE_PERKIRAAN2,
				      DASAR.KODE_ANGGARAN,
				      DASAR.TAHUN,
				      DASAR.DEPARTEMEN,
				      DEP.NAMA,
				      DASAR.DIVISI,
				      DIVISI.NAMA,
				      DASAR.JENIS_ANGGARAN,
				      DASAR.URAIAN,
				      DASAR.SATUAN,
				      DASAR.HARGA,
				      DASAR.JUMLAH,
				      REALISASI.ID_DPBM,
				      REALISASI.ID_RAB,
				      DASAR.TOTAL,
				      DASAR.TOTAL_PELAKSANAAN,
				      REALISASI.ID_DPBM,
				      DET_DPBM.HARGA,
				      REALISASI.HARGA_SATUAN_DPBM
				) a
			";
		}else{
			$sql = "
				SELECT
				  ID_ANGGARAN,
				  KODE_PERKIRAAN,
				  KODE_PERKIRAAN2,
				  KODE_ANGGARAN,
				  TAHUN,
				  NAMA_DEPARTEMEN,
				  NAMA_DIVISI,
				  JENIS_ANGGARAN,
				  URAIAN,
				  SATUAN,
				  HARGA,
				  JUMLAH,
				  ID_DPBM,
				  ID_RAB,
				  TOTAL,
				  VOLUME,
				  HARGA_SATUAN,
				  REALISASI,
				  (TOTAL-REALISASI) AS SISA
				FROM(
					SELECT 
						REVISI.ID_ANGGARAN,
						REVISI.KODE_PERKIRAAN,
						REVISI.KODE_PERKIRAAN2,
						REVISI.KODE_ANGGARAN,
						REVISI.TAHUN,
						REVISI.DEPARTEMEN,
						DEP.NAMA AS NAMA_DEPARTEMEN,
						REVISI.DIVISI,
						DIVISI.NAMA AS NAMA_DIVISI,
						REVISI.JENIS_ANGGARAN,
						REVISI.URAIAN,
						REVISI.SATUAN,
						REVISI.HARGA,
						REVISI.JUMLAH,
						REALISASI.ID_DPBM,
						REALISASI.ID_RAB,
						(CASE
						  WHEN REVISI.JENIS_ANGGARAN = 'Barang' THEN
						    REVISI.TOTAL
						  ELSE
						    REVISI.TOTAL_PELAKSANAAN
						END) AS TOTAL,
						(CASE
						  WHEN REALISASI.ID_DPBM IS NOT NULL THEN
						    SUM(DET_DPBM.VOLUME)
						  ELSE
						    SUM(REALISASI.VOLUME_DPBM)
						END) AS VOLUME,
						(CASE
						  WHEN REALISASI.ID_DPBM IS NOT NULL THEN
						    DET_DPBM.HARGA
						  ELSE
						    REALISASI.HARGA_SATUAN_DPBM
						END) AS HARGA_SATUAN,
						(CASE
						  WHEN REALISASI.ID_DPBM IS NOT NULL THEN
						    (SUM(DET_DPBM.VOLUME)*DET_DPBM.HARGA)
						  ELSE
						    (SUM(REALISASI.VOLUME_DPBM)*REALISASI.HARGA_SATUAN_DPBM)
						END) AS REALISASI
					FROM stp_revisi_anggaran REVISI
					LEFT JOIN stp_realisasi_anggaran REALISASI ON REVISI.ID = REALISASI.ID_ANGGARAN
					LEFT JOIN stp_dpbm DPBM ON DPBM.ID = REALISASI.ID_DPBM
					LEFT JOIN stp_dpbm_detail DET_DPBM ON DPBM.ID = DET_DPBM.ID_DPBM
					LEFT JOIN stp_departemen DEP ON DEP.ID = REVISI.DEPARTEMEN
					LEFT JOIN stp_divisi DIVISI ON DIVISI.ID = REVISI.DIVISI
					WHERE REVISI.ID = $id_anggaran
					GROUP BY
				      REVISI.ID_ANGGARAN,
				      REVISI.KODE_PERKIRAAN,
				      REVISI.KODE_PERKIRAAN2,
				      REVISI.KODE_ANGGARAN,
				      REVISI.TAHUN,
				      REVISI.DEPARTEMEN,
				      DEP.NAMA,
				      REVISI.DIVISI,
				      DIVISI.NAMA,
				      REVISI.JENIS_ANGGARAN,
				      REVISI.URAIAN,
				      REVISI.SATUAN,
				      REVISI.HARGA,
				      REVISI.JUMLAH,
				      REALISASI.ID_DPBM,
				      REALISASI.ID_RAB,
				      REVISI.TOTAL,
				      REVISI.TOTAL_PELAKSANAAN,
				      REALISASI.ID_DPBM,
				      DET_DPBM.HARGA,
				      REALISASI.HARGA_SATUAN_DPBM
				) a
			";
		}
		$query = $this->db->query($sql);
		return $query->row();
	}

	function realisasi_by_dpbm($id_anggaran){
		$sql = "
			SELECT 
				a.ID,
				a.ID_DPBM,
				DPBM.NO_DPBM,
				a.TANGGAL,
				a.VOLUME_DPBM AS VOLUME,
				DPBM.NO_KEU,
				b.ID AS ID_DET_DPBM,
				b.KODE_BARANG,
				b.HARGA
		  	FROM stp_realisasi_anggaran a
		  	JOIN stp_dpbm_detail b ON b.ID = a.ID_DPBM
		  	LEFT JOIN stp_dpbm DPBM ON b.ID_DPBM = DPBM.ID
			WHERE a.ID_ANGGARAN = '$id_anggaran'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	//DPBM
	function get_dpbm($keyword){
		$where = "1 = 1";

		if($keyword != ""){
			$where = $where." AND (DPBM.NO_DPBM LIKE '%$keyword%' OR DET_DPBM.NAMA_BARANG LIKE '%$keyword%')";
		}

		$sql = "
			SELECT
				DET_DPBM.ID AS ID_DET_DPBM,
				DPBM.NO_DPBM,
				DPBM.TANGGAL,
				DPBM.DIMINTA_OLEH,
				DPBM.KETERANGAN,
				DPBM.NO_KEU,
				DET_DPBM.KODE_BARANG,
				DET_DPBM.NAMA_BARANG,
				DET_DPBM.VOLUME,
				BRG.SATUAN,
				DET_DPBM.HARGA
			FROM stp_dpbm DPBM
			LEFT JOIN stp_dpbm_detail DET_DPBM ON DET_DPBM.ID_DPBM = DPBM.ID
			LEFT JOIN stp_kode_barang BRG ON BRG.KODE_BARANG = DET_DPBM.KODE_BARANG
			WHERE $where
			AND DPBM.NO_KEU != ''
			GROUP BY
				DPBM.NO_DPBM,
				DPBM.TANGGAL,
				DPBM.DIMINTA_OLEH,
				DPBM.KETERANGAN,
				DPBM.NO_KEU
			ORDER BY DPBM.NO_KEU ASC
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
			WHERE DET_DPBM.ID = $id_dpbm
		";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function realisasi_by_id_dpbm($id_dpbm){
		$sql = "
			SELECT
			  REALISASI.ID,
			  REALISASI.ID_DPBM,
			  DPBM.NO_DPBM,
			  REALISASI.TANGGAL,
			  REALISASI.VOLUME_DPBM,
			  REALISASI.NO_KEU,
			  DET_DPBM.KODE_BARANG,
			  DET_DPBM.HARGA
			FROM stp_realisasi_anggaran REALISASI
			LEFT JOIN stp_dpbm_detail DET_DPBM ON DET_DPBM.ID = REALISASI.ID_DPBM 
			LEFT JOIN stp_dpbm DPBM ON DPBM.ID = DET_DPBM.ID_DPBM
			WHERE DET_DPBM.ID = $id_dpbm
		";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function update_status_dpbm($id_det_dpbm){
		$sql = "UPDATE stp_dpbm_detail SET STATUS = 1 WHERE ID = $id_det_dpbm";
		$this->db->query($sql);
	}

	//RAB
	function get_rab($keyword){
		$where = "1 = 1";

		if($keyword != ""){
			$where = $where." AND (RAB.NO_RAB LIKE '%$keyword%' OR DET_RAB.KEGIATAN LIKE '%$keyword%')";
		}

		$sql = "
			SELECT
			  DET_RAB.ID AS ID_DET_RAB,
			  RAB.ID,
			  RAB.JENIS,
			  RAB.NO_RAB,
			  RAB.NO_KEU,
			  DET_RAB.KEGIATAN,
			  DET_RAB.VOLUME,
			  DET_RAB.SATUAN,
			  DET_RAB.HARGA_SATUAN,
			  SPK.ID AS ID_SPK,
			  SPK.NO_SPK,
			  SPK.KEPADA,
			  SPK.URAIAN_PEKERJAAN,
			  SPK.BIAYA_PENAWARAN,
			  SPK.BIAYA_KONTRAK,
			  SPK.ADENDUM,
			  SPK.NILAI_ADENDUM
			FROM stp_rincian_anggaran_biaya RAB
			LEFT JOIN stp_rincian_anggaran_biaya_detail DET_RAB ON DET_RAB.ID_RAB = RAB.ID
			LEFT JOIN stp_master_spk SPK ON SPK.NO_RAB = RAB.NO_RAB
			WHERE $where AND DET_RAB.STATUS = 0
			GROUP BY
			  DET_RAB.KEGIATAN,
			  DET_RAB.VOLUME,
			  DET_RAB.SATUAN,
			  DET_RAB.HARGA_SATUAN
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_rab_id($id_rab){
		$sql = "
			SELECT
			  DET_RAB.ID AS ID_DET_RAB,
			  RAB.ID,
			  RAB.JENIS,
			  RAB.NO_RAB,
			  RAB.NO_KEU,
			  DET_RAB.KEGIATAN,
			  DET_RAB.VOLUME,
			  DET_RAB.SATUAN,
			  DET_RAB.HARGA_SATUAN,
			  SPK.ID AS ID_SPK,
			  SPK.NO_SPK,
			  SPK.KEPADA,
			  SPK.URAIAN_PEKERJAAN,
			  SPK.BIAYA_PENAWARAN,
			  SPK.BIAYA_KONTRAK,
			  SPK.ADENDUM,
			  SPK.NILAI_ADENDUM
			FROM stp_rincian_anggaran_biaya RAB
			LEFT JOIN stp_rincian_anggaran_biaya_detail DET_RAB ON DET_RAB.ID_RAB = RAB.ID
			LEFT JOIN stp_master_spk SPK ON SPK.NO_RAB = RAB.NO_RAB
			WHERE DET_RAB.ID = $id_rab
			GROUP BY
			  DET_RAB.KEGIATAN,
			  DET_RAB.VOLUME,
			  DET_RAB.SATUAN,
			  DET_RAB.HARGA_SATUAN
		";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function get_realisasi_rab($id_anggaran){
		$sql = "
			SELECT 
				a.ID,
				a.TANGGAL,
				a.ID_RAB,
				a.ID_SPK,
				s.NO_KEU,
				s.KEGIATAN,
			  	a.NO_RAB AS NO_BUKTI,
				a.VOLUME_RAB AS VOLUME,
			  	a.HARGA_SATUAN_RAB AS HARGA_SATUAN,
			  	s.NO_SPK,
			  	s.BIAYA_KONTRAK
			FROM stp_realisasi_anggaran a
			JOIN(
				SELECT 
					DISTINCT R.NO_RAB,
					R.KEGIATAN,
					D.VOLUME,
					R.NO_KEU,
					SPK.NO_SPK,
					SPK.BIAYA_KONTRAK
				FROM stp_rincian_anggaran_biaya R
				LEFT JOIN stp_rincian_anggaran_biaya_detail D ON D.ID_RAB = R.ID
				LEFT JOIN stp_master_spk SPK ON R.NO_RAB = SPK.NO_RAB
			) s ON s.NO_RAB = a.NO_RAB
			WHERE a.ID_ANGGARAN = '$id_anggaran'
			GROUP BY
				a.ID,
				a.TANGGAL,
				a.ID_RAB,
				a.ID_SPK,
				s.NO_KEU,
				s.KEGIATAN
		";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_rab_click($id_anggaran){
		$sql = "
			SELECT
			  REALISASI.ID,
			  REALISASI.TANGGAL,
			  REALISASI.ID_RAB,
			  REALISASI.ID_SPK,
			  REALISASI.NO_KEU,
			  DET_RAB.ID AS ID_DET_RAB,
			  DET_RAB.KEGIATAN,
			  RAB.JENIS,
			  (CASE
			    WHEN REALISASI.ID_SPK != 0 THEN
			      REALISASI.NO_SPK
			    ELSE
			      REALISASI.NO_RAB
			  END) AS NO_BUKTI,
			  (CASE
			    WHEN REALISASI.ID_SPK != 0 THEN
			      REALISASI.VOLUME_SPK
			    ELSE
			  	  REALISASI.VOLUME_RAB
			  END) AS VOLUME,
			  (CASE
			    WHEN REALISASI.ID_SPK != 0 THEN
			      REALISASI.HARGA_SATUAN_SPK
			    ELSE
			      REALISASI.HARGA_SATUAN_RAB
			  END) HARGA_SATUAN
			FROM stp_realisasi_anggaran REALISASI
			LEFT JOIN stp_rincian_anggaran_biaya_detail DET_RAB ON DET_RAB.ID = REALISASI.ID_RAB
			LEFT JOIN stp_rincian_anggaran_biaya RAB ON DET_RAB.ID_RAB = RAB.ID
			WHERE REALISASI.ID = $id_anggaran
		";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function update_status_rab($id_rab){
		$sql = "UPDATE stp_rincian_anggaran_biaya_detail SET STATUS = 1 WHERE ID = $id_rab";
		$this->db->query($sql);
	}


	//SPM
	function get_realisasi_spm($id_anggaran){
		$sql = "
			SELECT 
				a.ID,
				a.TANGGAL,
				a.ID_SPM,
				a.NO_SPM,
				s.NO_KEU,
				s.KET,
			  	s.NILAI
			FROM stp_realisasi_anggaran a
			JOIN(
				SELECT 
					SPM.ID AS ID_SPM,
					SPM.NO_SPM,
					SPM.KET,
					SPM.TGL_SPM,
					SPM.NILAI,
					SPM.NO_KEU
				FROM stp_input_spm SPM
			) s ON s.ID_SPM = a.ID_SPM
			WHERE a.ID_ANGGARAN = '$id_anggaran'
			GROUP BY
				a.ID,
				a.TANGGAL,
				a.ID_SPM,
				s.NO_KEU,
				s.KET
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	//REALISASI
	function simpan_realisasi(
		$tanggal,
		$id_anggaran,
		$no_keu,
		$id_dpbm,
		$no_dpbm,
		$volume_dpbm,
		$harga_satuan_dpbm,
		$id_rab,
		$no_rab,
		$volume_rab,
		$harga_satuan_rab,
		$id_spk,
		$no_spk,
		$volume_spk,
		$biaya_kontrak_spk,
		$nilai_spk_adendum,
		$id_spm,
		$no_spm,
		$nilai_spm){

		$sql = "
			INSERT INTO stp_realisasi_anggaran(
				TANGGAL,
				ID_ANGGARAN,
				NO_KEU,
				ID_DPBM,
				NO_DPBM,
				VOLUME_DPBM,
				HARGA_SATUAN_DPBM,
				ID_RAB,
				NO_RAB,
				VOLUME_RAB,
				HARGA_SATUAN_RAB,
				ID_SPK,
				NO_SPK,
				VOLUME_SPK,
				HARGA_SATUAN_SPK,
				NILAI_SPK_ADENDUM,
				PERIODE,
				ID_SPM,
				NO_SPM,
				NILAI_SPM
			) VALUES(
				'$tanggal',
				'$id_anggaran',
				'$no_keu',
				'$id_dpbm',
				'$no_dpbm',
				'$volume_dpbm',
				'$harga_satuan_dpbm',
				'$id_rab',
				'$no_rab',
				'$volume_rab',
				'$harga_satuan_rab',
				'$id_spk',
				'$no_spk',
				'$volume_spk',
				'$biaya_kontrak_spk',
				'$nilai_spk_adendum',
				2,
				'$id_spm',
				'$no_spm',
				'$nilai_spm'
			)
		";
		$this->db->query($sql);
	}

	function simpan_anggaran_tambahan(
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
		$no_surat,
		$sts_tambahan,
		$tanggal_input){

		$bln = date("n");
		$bulanarray	= array( 1 => 'JANUARI', 	2 => 'FEBRUARI', 3 => 'MARET', 		4  => 'APRIL',
							 5 => 'MEI',     	6 => 'JUNI',     7 => 'JULI',  		8  => 'AGUSTUS',
							 9 => 'SEPTEMBER', 10 => 'OKTOBER', 11 => 'NOVEMBER', 	12 => 'DESEMBER');
		$field_bln = $bulanarray[$bln];
		if($total_pelaksanaan == 0){
			$nilai = $total;
		}
		else{
			$nilai = $total_pelaksanaan;
		}

		$sql = "
			INSERT INTO stp_revisi_anggaran(
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
				NO_SURAT,
				$field_bln,
				STS_TAMBAHAN,
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
				'$no_surat',
				'$nilai',
				'$sts_tambahan',
				'$tanggal_input',
				2
			)
		";
		$this->db->query($sql);
	}

	//LAPORAN REALISASI REVISI RKAP
	function get_kode_perkiraan($tahun,$kriteria,$bagian,$sub_bagian,$kode_perkiraan){
		$where = "1 = 1";
		if($kriteria == "semua_bagian"){
			$where = $where;
		}else if($kriteria == "bagian"){
			$where = $where." AND a.DEPARTEMEN = '$bagian'";
		}else{
			$where = $where." AND a.DEPARTEMEN = '$bagian' AND a.DIVISI = '$sub_bagian'";
		}

		if($kode_perkiraan != ""){
			$where = $where." AND a.KODE_PERKIRAAN = '$kode_perkiraan'";
		}

		$sql = "
			SELECT 
				a.*,
				b.NAMA_PERKIRAAN 
			FROM(
				SELECT 
					a.KODE_PERKIRAAN AS KODE_PERKIRAAN
				FROM stp_revisi_anggaran a
				LEFT JOIN stp_realisasi_anggaran b ON a.ID_ANGGARAN = b.ID_ANGGARAN
				WHERE $where
				AND a.SETUJU = 'DISETUJUI'
				AND a.TAHUN = '$tahun'
				GROUP BY a.KODE_PERKIRAAN		
			) a JOIN stp_setup_kode_perkiraan b ON b.KODE_PERKIRAAN = a.KODE_PERKIRAAN
			ORDER BY a.KODE_PERKIRAAN ASC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_kode_perkiraan_new($tahun,$kriteria,$bagian,$sub_bagian,$kode_perkiraan){
		$where = "1 = 1";

		if($kriteria == "semua_bagian"){
			$where = $where;
		}else if($kriteria == "bagian"){
			$where = $where." AND a.DEPARTEMEN = '$bagian'";
		}else{
			$where = $where." AND a.DEPARTEMEN = '$bagian' AND a.DIVISI = '$sub_bagian'";
		}

		if($kode_perkiraan != ""){
			$where = $where." AND a.KODE_PERKIRAAN = '$kode_perkiraan'";
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
					AND a.STS_REVISI != 6
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
			) z
			GROUP BY
				z.KODE_PERKIRAAN
			ORDER BY 
				z.INDUK_KODE, 
				z.KODE_PERKIRAAN ASC
		";
		return $this->db->query($query)->result();
	}

	function laporan_realisasi($tahun,$kriteria,$bagian,$sub_bagian,$kode_perkiraan){
		$where = "1 = 1";

		if($kriteria == "semua_bagian"){
			$where = $where;
		}else if($kriteria == "bagian"){
			$where = $where." AND a.DEPARTEMEN = '$bagian'";
		}else{
			$where = $where." AND a.DEPARTEMEN = '$bagian' AND a.DIVISI = '$sub_bagian'";
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
					a.JUMLAH,
					a.HARGA,
					a.SATUAN,
					a.CAT_TAMBAHAN,
					a.JENIS_RAPAT,
					a.JENIS_ANGGARAN,
					a.TOTAL,
					a.TOTAL_PELAKSANAAN,
					(CASE
						WHEN a.JENIS_ANGGARAN = 'Barang' THEN
							a.TOTAL
						ELSE
							a.TOTAL_PELAKSANAAN
					END) AS RKAP,
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
					IFNULL(c.REAL_VOL,0) AS REAL_VOL,
					IFNULL(c.REAL_HARGA,0) AS REAL_HARGA,
					c.ID_ANGGARAN AS ID_REAL,
					c.TANGGAL,
					c.NO_SPK,
					c.NO_BUKTI,
					c.NO_KEU,
					SPK.ADENDUM,
					SPK.NILAI_ADENDUM,
					2 AS STS_INPUT
				FROM stp_revisi_anggaran a
				JOIN stp_divisi b ON a.DIVISI = b.ID
				LEFT JOIN ( 
					SELECT 
						a.ID_ANGGARAN,
						a.TANGGAL,
						a.NO_SPK,
						a.NO_BUKTI,
						a.NO_KEU,
						a.JML_DPBM AS JML_DPBM, 
						a.JML_RAB AS JML_RAB, 
						a.JML_SPK AS JML_SPK,
						a.REAL_VOL AS REAL_VOL,
						a.REAL_HARGA AS REAL_HARGA
					FROM (
						SELECT 
							ID_ANGGARAN,
							TANGGAL,
							NO_SPK,
							(CASE
								WHEN ID_SPK != 0 THEN 
									NO_SPK
								ELSE 
									(CASE
										WHEN ID_RAB != 0 THEN 
											NO_RAB
										WHEN ID_SPM != 0 THEN 
											NO_SPM
										ELSE 
											CONCAT(NO_DPBM,'.',ID_DPBM)
									END)
							END) AS NO_BUKTI,
							NO_KEU,
							(VOLUME_DPBM * HARGA_SATUAN_DPBM + NILAI_SPM) AS JML_DPBM, 
							(VOLUME_RAB * HARGA_SATUAN_RAB) AS JML_RAB,
							(HARGA_SATUAN_SPK + NILAI_SPK_ADENDUM) AS JML_SPK,
							(CASE
								WHEN ID_SPK != 0 THEN 
									1
								ELSE
									(CASE
										WHEN ID_RAB != 0 THEN 
											VOLUME_RAB
										WHEN ID_SPM != 0 THEN 
											1
										ELSE 
											VOLUME_DPBM
									END)
							END) AS REAL_VOL,
							(CASE
								WHEN ID_SPK != 0 THEN 
									HARGA_SATUAN_SPK
								ELSE
									(CASE
										WHEN ID_RAB != 0 THEN 
											HARGA_SATUAN_RAB
										WHEN ID_SPM != 0 THEN 
											NILAI_SPM
										ELSE 
											HARGA_SATUAN_DPBM
									END)
							END) AS REAL_HARGA
						FROM stp_realisasi_anggaran
						WHERE PERIODE = 2
					) a
				) c ON a.ID = c.ID_ANGGARAN
				LEFT JOIN(
					SELECT * FROM stp_anggaran_dasar
				) DSR ON DSR.KODE_ANGGARAN = a.KODE_ANGGARAN
				LEFT JOIN(
					SELECT * FROM stp_usulan_anggaran WHERE JENIS_RAPAT = 'REVISI-RKAP' AND AKTIF = 1
				) d ON d.ID_ANGGARAN = a.ID
				LEFT JOIN stp_master_spk SPK ON SPK.NO_SPK = c.NO_SPK
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
					a.JUMLAH,
					a.HARGA,
					a.SATUAN,
					a.CAT_TAMBAHAN,
					a.JENIS_RAPAT,
					a.JENIS_ANGGARAN,
					a.TOTAL,
					a.TOTAL_PELAKSANAAN,
					(CASE
						WHEN a.JENIS_ANGGARAN = 'Barang' THEN
							a.TOTAL
						ELSE
							a.TOTAL_PELAKSANAAN
					END) AS RKAP,
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
					IFNULL(c.REAL_VOL,0) AS REAL_VOL,
					IFNULL(c.REAL_HARGA,0) AS REAL_HARGA,
					c.ID_ANGGARAN AS ID_REAL,
					c.TANGGAL,
					c.NO_SPK,
					c.NO_BUKTI,
					c.NO_KEU,
					SPK.ADENDUM,
					SPK.NILAI_ADENDUM,
					1 AS STS_INPUT
				FROM stp_anggaran_dasar a
				JOIN stp_divisi b ON a.DIVISI = b.ID
				LEFT JOIN (
					SELECT 
						a.ID_ANGGARAN,
						a.TANGGAL,
						a.NO_SPK,
						a.NO_BUKTI,
						a.NO_KEU,
						a.JML_DPBM AS JML_DPBM, 
						a.JML_RAB AS JML_RAB, 
						a.JML_SPK AS JML_SPK,
						a.REAL_VOL AS REAL_VOL,
						a.REAL_HARGA AS REAL_HARGA
					FROM (
						SELECT 
							ID_ANGGARAN,
							TANGGAL,
							NO_SPK,
							(CASE
								WHEN ID_SPK != 0 THEN 
									NO_SPK
								ELSE 
									(CASE
										WHEN ID_RAB != 0 THEN 
											NO_RAB
										WHEN ID_SPM != 0 THEN 
											NO_SPM
										ELSE 
											CONCAT(NO_DPBM,'.',ID_DPBM)
									END)
							END) AS NO_BUKTI,
							NO_KEU,
							(VOLUME_DPBM * HARGA_SATUAN_DPBM + NILAI_SPM) AS JML_DPBM, 
							(VOLUME_RAB * HARGA_SATUAN_RAB) AS JML_RAB,
							(HARGA_SATUAN_SPK + NILAI_SPK_ADENDUM) AS JML_SPK,
							(CASE
								WHEN ID_SPK != 0 THEN 
									1
								ELSE
									(CASE
										WHEN ID_RAB != 0 THEN 
											VOLUME_RAB
										WHEN ID_SPM != 0 THEN 
											1
										ELSE 
											VOLUME_DPBM
									END)
							END) AS REAL_VOL,
							(CASE
								WHEN ID_SPK != 0 THEN 
									HARGA_SATUAN_SPK
								ELSE
									(CASE
										WHEN ID_RAB != 0 THEN 
											HARGA_SATUAN_RAB
										WHEN ID_SPM != 0 THEN 
											NILAI_SPM
										ELSE 
											HARGA_SATUAN_DPBM
									END)
							END) AS REAL_HARGA
						FROM stp_realisasi_anggaran
						WHERE PERIODE = 1
					) a
				) c ON a.ID_ANGGARAN = c.ID_ANGGARAN
				LEFT JOIN stp_master_spk SPK ON SPK.NO_SPK = c.NO_SPK
				WHERE $where
				AND a.TAHUN = '$tahun'
				AND a.SETUJU = 'DISETUJUI' AND a.STS_REVISI != 5
			) a 
			ORDER BY a.KODE_ANGGARAN ASC
		";
		$query = $this->db->query($sql2);
		return $query->result();
	}

	function hitung_realisasi($tahun,$kriteria,$bagian,$sub_bagian,$kode_perkiraan,$kode_anggaran){
		$where = "1 = 1";

		if($kriteria == "semua_bagian"){ 
			$where = $where;
		}else if($kriteria == "bagian"){
			$where = $where." AND z.DEPARTEMEN = '$bagian'";
		}else{
			$where = $where." AND z.DEPARTEMEN = '$bagian' AND z.DIVISI = '$sub_bagian'";
		}

		if($kode_perkiraan != ""){
			$where = $where." AND z.KODE_PERKIRAAN = '$kode_perkiraan'";
		}

		$query2 = "
			SELECT
				a.*
			FROM(
				SELECT
					z.ID AS ID_ANGGARAN,
					z.KODE_ANGGARAN,
					z.STS_REVISI,
					z.STS_TAMBAHAN,
					(CASE
						WHEN z.JENIS_ANGGARAN = 'Barang' THEN
							z.TOTAL
						ELSE
							z.TOTAL_PELAKSANAAN
					END) AS RKAP,
					DIVISI.NAMA AS NAMA_DIVISI,
					c.ID_ANGGARAN AS ID_REAL,
					IFNULL(c.REALISASI, 0) AS REALISASI,
					IFNULL(c.REAL_VOL, 0) AS REAL_VOL
				FROM stp_revisi_anggaran z
				LEFT JOIN stp_divisi DIVISI ON DIVISI.ID = z.DIVISI
				LEFT JOIN (
					SELECT 
						a.ID_ANGGARAN,
						a.NO_SPK,
						SUM(a.REALISASI) AS REALISASI, 
						SUM(a.REAL_VOL) AS REAL_VOL
					FROM (
						SELECT 
							ID_ANGGARAN, 
							NO_SPK,
							(CASE
								WHEN (ID_SPK != 0) THEN
									(HARGA_SATUAN_SPK + NILAI_SPK_ADENDUM)
								ELSE
									(CASE
										WHEN (ID_RAB != 0) THEN
											(VOLUME_RAB * HARGA_SATUAN_RAB)
										WHEN (ID_SPM != 0) THEN
											NILAI_SPM
										ELSE
											(VOLUME_DPBM * HARGA_SATUAN_DPBM)
									END)		
							END) AS REALISASI,
							(CASE
								WHEN (ID_SPK != 0) THEN
									1
								ELSE
									(CASE
										WHEN (ID_RAB != 0) THEN
											VOLUME_RAB
										WHEN (ID_SPM != 0) THEN
											1
										ELSE
											VOLUME_DPBM
									END)
							END) AS REAL_VOL
						FROM stp_realisasi_anggaran
						WHERE PERIODE = 2
					) a
					GROUP BY a.ID_ANGGARAN
				) c ON z.ID = c.ID_ANGGARAN
				LEFT JOIN(
					SELECT * FROM stp_anggaran_dasar
				) DSR ON DSR.KODE_ANGGARAN = z.KODE_ANGGARAN
				LEFT JOIN(
					SELECT * FROM stp_usulan_anggaran WHERE JENIS_RAPAT = 'REVISI-RKAP' AND AKTIF = 1
				) d ON d.ID_ANGGARAN = z.ID
				LEFT JOIN stp_master_spk SPK ON SPK.NO_SPK = c.NO_SPK
				WHERE $where
				AND z.TAHUN = '$tahun'
				AND z.KODE_ANGGARAN = '$kode_anggaran'
				AND z.SETUJU = 'DISETUJUI'

				UNION ALL

				SELECT
					z.ID_ANGGARAN,
					z.KODE_ANGGARAN,
					z.STS_REVISI,
					z.STS_TAMBAHAN,
					(CASE
						WHEN z.JENIS_ANGGARAN = 'Barang' THEN
							z.TOTAL
						ELSE
							z.TOTAL_PELAKSANAAN
					END) AS RKAP,
					DIVISI.NAMA AS NAMA_DIVISI,
					c.ID_ANGGARAN AS ID_REAL,
					IFNULL(c.REALISASI, 0) AS REALISASI,
					IFNULL(c.REAL_VOL, 0) AS REAL_VOL
				FROM stp_anggaran_dasar z
				LEFT JOIN stp_divisi DIVISI ON DIVISI.ID = z.DIVISI
				LEFT JOIN (
					SELECT 
						a.ID_ANGGARAN,
						a.NO_SPK,
						SUM(a.REALISASI) AS REALISASI, 
						SUM(a.REAL_VOL) AS REAL_VOL
					FROM (
						SELECT 
							ID_ANGGARAN,
							NO_SPK,
							(CASE
								WHEN (ID_SPK != 0) THEN
									(HARGA_SATUAN_SPK + NILAI_SPK_ADENDUM)
								ELSE
									(CASE
										WHEN (ID_RAB != 0) THEN
											(VOLUME_RAB * HARGA_SATUAN_RAB)
										WHEN (ID_SPM != 0) THEN
											NILAI_SPM
										ELSE
											(VOLUME_DPBM * HARGA_SATUAN_DPBM)
									END)		
							END) AS REALISASI,
							(CASE
								WHEN (ID_SPK != 0) THEN
									1
								ELSE
									(CASE
										WHEN (ID_RAB != 0) THEN
											VOLUME_RAB
										WHEN (ID_SPM != 0) THEN
											1
										ELSE
											VOLUME_DPBM
									END)
							END) AS REAL_VOL
						FROM stp_realisasi_anggaran
						WHERE PERIODE = 1
					) a
					GROUP BY a.ID_ANGGARAN
				) c ON z.ID_ANGGARAN = c.ID_ANGGARAN
				LEFT JOIN stp_master_spk SPK ON SPK.NO_SPK = c.NO_SPK
				WHERE $where 
				AND z.TAHUN = '$tahun'
				AND z.KODE_ANGGARAN = '$kode_anggaran'
				AND z.SETUJU = 'DISETUJUI'
			)a
			ORDER BY a.KODE_ANGGARAN ASC
		";
		$sql = $this->db->query($query2);
		return $sql->result();
	}

}

?>