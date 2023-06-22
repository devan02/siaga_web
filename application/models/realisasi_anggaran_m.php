<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Realisasi_anggaran_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_rencana_realisasi_dpbm($keyword){
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (DPBM.NO_DPBM LIKE '%$keyword%' OR DPBM.DIMINTA_OLEH LIKE '%$keyword%')";
		}

		$sql = "
			SELECT
				DPBM.*,
				DET_DPBM.HARGA
			FROM stp_dpbm DPBM
			LEFT JOIN stp_dpbm_detail DET_DPBM ON DET_DPBM.ID_DPBM = DPBM.ID
			WHERE $where AND DPBM.NO_KEU = ''
			ORDER BY DPBM.NO_KEU DESC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function preview_data_dpbm($keyword){
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (DPBM.NO_DPBM LIKE '%$keyword%' OR DPBM.DIMINTA_OLEH LIKE '%$keyword%' OR DASAR.KODE_ANGGARAN LIKE '%$keyword%')";
		}

		$sql = "
			SELECT
				DET_DPBM.ID AS ID_DET_DPBM,
				DPBM.NO_DPBM,
				DET_DPBM.HARGA,
				DPBM.TANGGAL,
				DPBM.DIMINTA_OLEH,
				DPBM.KETERANGAN,
				DPBM.NO_KEU,
				DASAR.KODE_ANGGARAN,
				(CASE
					WHEN DASAR.STS_REVISI = 5 THEN
						'REVISI RKAP'
					ELSE
						'RKAP'
				END) JENIS_RAPAT,
				DPBM.TANGGAL_CAIR
			FROM stp_dpbm DPBM
			LEFT JOIN stp_dpbm_detail DET_DPBM ON DET_DPBM.ID_DPBM = DPBM.ID
			LEFT JOIN stp_realisasi_anggaran REALISASI ON DET_DPBM.ID = REALISASI.ID_DPBM
			LEFT JOIN stp_anggaran_dasar DASAR ON DASAR.ID_ANGGARAN = REALISASI.ID_ANGGARAN
			LEFT JOIN stp_revisi_anggaran REVISI ON DASAR.KODE_ANGGARAN = REVISI.KODE_ANGGARAN
			WHERE $where
			GROUP BY
				DPBM.NO_DPBM,
				DPBM.TANGGAL,
				DPBM.DIMINTA_OLEH,
				DPBM.KETERANGAN,
				DPBM.NO_KEU,
				DASAR.KODE_ANGGARAN,
				DASAR.JENIS_RAPAT
			ORDER BY DPBM.NO_KEU DESC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_rencana_realisasi_rab_spk($keyword){
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (RAB.NO_RAB LIKE '%$keyword%' OR RAB.KEGIATAN LIKE '%$keyword%' OR RAB.PEKERJAAN LIKE '%$keyword%')";
		}

		$sql = "
			SELECT
			  RAB.*,
			  DET_RAB.HARGA_SATUAN
			FROM stp_rincian_anggaran_biaya RAB
			LEFT JOIN stp_rincian_anggaran_biaya_detail DET_RAB ON DET_RAB.ID_RAB = RAB.ID
			WHERE $where AND RAB.NO_KEU = ''
			ORDER BY NO_KEU DESC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function preview_data_rab_spk($keyword){
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (RAB.NO_RAB LIKE '%$keyword%' OR RAB.KEGIATAN LIKE '%$keyword%' OR RAB.PEKERJAAN LIKE '%$keyword%')";
		}

		$sql = "
			SELECT
			  RAB.NO_RAB,
			  RAB.KOTA,
			  DET_RAB.KEGIATAN,
			  RAB.PEKERJAAN,
			  RAB.LOKASI,
			  RAB.NO_KEU,
			  DASAR.KODE_ANGGARAN,
			  (CASE
			  	WHEN DASAR.STS_REVISI = 5 THEN
			  		'REVISI RKAP'
			  	ELSE
			  		'RKAP'
			  END) AS PERIODE,
			  DET_RAB.HARGA_SATUAN,
			  RAB.TANGGAL_CAIR
			FROM stp_rincian_anggaran_biaya RAB
			LEFT JOIN stp_rincian_anggaran_biaya_detail DET_RAB ON DET_RAB.ID_RAB = RAB.ID
			LEFT JOIN stp_realisasi_anggaran REALISASI ON DET_RAB.ID = REALISASI.ID_RAB
			LEFT JOIN stp_anggaran_dasar DASAR ON REALISASI.ID_ANGGARAN = DASAR.ID_ANGGARAN
			WHERE $where
			ORDER BY RAB.NO_KEU DESC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_anggaran($tahun,$bagian,$sub_bagian,$kode_perkiraan,$keyword,$kriteria){
		$where = "1 = 1";

		if($kriteria == "bagian"){
			$where = $where." AND DASAR.DEPARTEMEN = '$bagian'";
		}else if($kriteria == "sub_bagian"){
			$where = $where." AND DASAR.DEPARTEMEN = '$bagian' AND DASAR.DIVISI = '$sub_bagian'";
		}else{
			$where =  $where;
		}

		if($kode_perkiraan != ""){
			$where = $where." AND DASAR.KODE_PERKIRAAN = '$kode_perkiraan'";
		}

		if($keyword != ""){
			$where = $where." AND (DASAR.KODE_ANGGARAN LIKE '%$keyword%' OR DASAR.URAIAN LIKE '%$keyword%' OR DASAR.KODE_PERKIRAAN LIKE '%$keyword%')";
		}
		
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
			  JUMLAH_REV,
			  TOTAL,
			  VOLUME,
			  HARGA_SATUAN,
			  REALISASI,
			  (TOTAL-REALISASI) AS SISA,
			  (CASE
				  WHEN (REALISASI > TOTAL) AND (REALISASI  > 0) THEN 'merah'
				  WHEN (REALISASI < TOTAL) AND (REALISASI  > 0) THEN 'kuning'
				  WHEN (REALISASI = TOTAL) AND (REALISASI  > 0) THEN 'kuning'
				  WHEN (STS_TAMBAHAN = 2) THEN 'orange'
				  ELSE 'putih'
			   END) AS WARNA
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
				DASAR.JUMLAH AS JUMLAH,
				REVISI.JUMLAH AS JUMLAH_REV,
				(CASE
				  WHEN DASAR.JENIS_ANGGARAN = 'Barang' THEN
				    DASAR.TOTAL
				  ELSE
				    DASAR.TOTAL_PELAKSANAAN
				END) AS TOTAL,
				(CASE
        		  WHEN REALISASI.ID_SPK != 0 THEN
        			SUM(REALISASI.VOLUME_SPK)
        		  ELSE
        		  	(CASE
        		  		WHEN REALISASI.ID_RAB != 0 THEN
        		  			SUM(REALISASI.VOLUME_RAB)
        		  		WHEN REALISASI.ID_SPM != 0 THEN
        		  			SUM(1)
        		  		ELSE
        					SUM(REALISASI.VOLUME_DPBM)
        		  	END)
        		END) AS VOLUME,
				(CASE
        		  WHEN REALISASI.ID_SPK != 0 THEN
        			REALISASI.HARGA_SATUAN_SPK
        		  ELSE
        		  	(CASE
        		  		WHEN REALISASI.ID_RAB != 0 THEN
        		  			REALISASI.HARGA_SATUAN_RAB
        		  		WHEN REALISASI.ID_SPM != 0 THEN
        		  			REALISASI.NILAI_SPM
        		  		ELSE
        					REALISASI.HARGA_SATUAN_DPBM
        		  	END)
        		END) AS HARGA_SATUAN,
        		SUM(
			        (CASE
			          WHEN REALISASI.ID_SPK != 0 THEN 
			            REALISASI.HARGA_SATUAN_SPK * REALISASI.VOLUME_SPK
			          ELSE (
			              CASE
			                WHEN REALISASI.ID_RAB != 0 THEN 
			                  REALISASI.VOLUME_RAB * REALISASI.HARGA_SATUAN_RAB
			                WHEN REALISASI.ID_SPM != 0 THEN 
			                  1 * REALISASI.NILAI_SPM
			                ELSE 
			                  REALISASI.VOLUME_DPBM * REALISASI.HARGA_SATUAN_DPBM
			              END)
			        END)
			      ) AS REALISASI,
				DASAR.STS_TAMBAHAN
			FROM stp_anggaran_dasar DASAR
			LEFT JOIN stp_revisi_anggaran REVISI ON DASAR.KODE_ANGGARAN = REVISI.KODE_ANGGARAN
			LEFT JOIN stp_realisasi_anggaran REALISASI ON DASAR.ID_ANGGARAN = REALISASI.ID_ANGGARAN
			LEFT JOIN stp_departemen DEP ON DEP.ID = DASAR.DEPARTEMEN
			LEFT JOIN stp_divisi DIVISI ON DIVISI.ID = DASAR.DIVISI
			WHERE $where 
			AND DASAR.SETUJU = 'DISETUJUI'
			AND DASAR.TAHUN = '$tahun'
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
		      REVISI.JUMLAH,
		      DASAR.TOTAL,
		      DASAR.TOTAL_PELAKSANAAN,
		      DASAR.STS_TAMBAHAN
			) a
			ORDER BY a.KODE_ANGGARAN ASC
		";
		$query = $this->db->query($sql);
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

	function do_realisasi($id_anggaran){
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
			  ID_SPM,
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
				REALISASI.ID_SPM,
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
		$query = $this->db->query($sql);
		return $query->row();
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
				1,
				'$id_spm',
				'$no_spm',
				'$nilai_spm'
			)
		";
		$this->db->query($sql);
	}

	function update_status_dpbm($id_det_dpbm){
		$sql = "UPDATE stp_dpbm_detail SET STATUS = 1 WHERE ID = $id_det_dpbm";
		$this->db->query($sql);
	}

	function realisasi_by_dpbm($id_anggaran){
		// $sql = "
		// 	SELECT
		// 	  REALISASI.ID,
		// 	  REALISASI.ID_DPBM,
		// 	  DPBM.NO_DPBM,
		// 	  REALISASI.TANGGAL,
		// 	  REALISASI.VOLUME_DPBM AS VOLUME,
		// 	  REALISASI.NO_KEU,
		// 	  DET_DPBM.KODE_BARANG,
		// 	  DET_DPBM.HARGA
		// 	FROM stp_realisasi_anggaran REALISASI
		// 	LEFT JOIN stp_dpbm_detail DET_DPBM ON DET_DPBM.ID = REALISASI.ID_DPBM 
		// 	LEFT JOIN stp_dpbm DPBM ON DPBM.ID = DET_DPBM.ID_DPBM
		// 	WHERE REALISASI.ID_ANGGARAN = $id_anggaran
		// ";

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

	function get_rab($keyword){
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (RAB.NO_RAB LIKE '%$keyword%' OR DET_RAB.KEGIATAN LIKE '%$keyword%' OR SPK.URAIAN_PEKERJAAN LIKE '%$keyword%')";
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
			WHERE $where 
			AND DET_RAB.STATUS = 0 
			AND RAB.NO_KEU != ''
			GROUP BY
			  DET_RAB.KEGIATAN,
			  DET_RAB.VOLUME,
			  DET_RAB.SATUAN,
			  DET_RAB.HARGA_SATUAN
			LIMIT 10
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

	function update_status_rab($id_rab){
		$sql = "UPDATE stp_rincian_anggaran_biaya_detail SET STATUS = 1 WHERE ID = $id_rab";
		$this->db->query($sql);
	}

	function get_realisasi_rab($id_anggaran){
		// $sql = "
		// 	SELECT
		// 	  REALISASI.ID,
		// 	  REALISASI.TANGGAL,
		// 	  REALISASI.ID_RAB,
		// 	  REALISASI.ID_SPK,
		// 	  REALISASI.NO_KEU,
		// 	  DET_RAB.KEGIATAN,
		// 	  (CASE
		// 	    WHEN REALISASI.ID_SPK != 0 THEN
		// 	      REALISASI.NO_SPK
		// 	    ELSE
		// 	      REALISASI.NO_RAB
		// 	  END) AS NO_BUKTI,
		// 	  (CASE
		// 	    WHEN REALISASI.ID_SPK != 0 THEN
		// 	      REALISASI.VOLUME_SPK
		// 	    ELSE
		// 	  	  REALISASI.VOLUME_RAB
		// 	  END) AS VOLUME,
		// 	  (CASE
		// 	    WHEN REALISASI.ID_SPK != 0 THEN
		// 	      REALISASI.HARGA_SATUAN_SPK
		// 	    ELSE
		// 	      REALISASI.HARGA_SATUAN_RAB
		// 	  END) HARGA_SATUAN
		// 	FROM stp_realisasi_anggaran REALISASI
		// 	LEFT JOIN stp_rincian_anggaran_biaya_detail DET_RAB ON DET_RAB.ID = REALISASI.ID_RAB
		// 	WHERE REALISASI.ID_ANGGARAN = $id_anggaran
		// ";

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

	function get_rab_click($id_anggaran){
		$sql = "
			SELECT
			  REALISASI.ID,
			  REALISASI.TANGGAL,
			  REALISASI.ID_RAB,
			  REALISASI.ID_SPK,
			  REALISASI.NO_KEU,
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
				FROM stp_anggaran_dasar a
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
		// $where = "1 = 1 " ;
		// if($krit == 'dep'){
		// 	$where = $where." AND TRIM(a.DEPARTEMEN) =TRIM('".$dep."') AND a.SETUJU = 'DISETUJUI'";
		// }else if($krit == 'div'){
		// 	$where = $where." AND TRIM(a.DEPARTEMEN) =TRIM('".$dep."') AND TRIM(a.DIVISI) = TRIM('".$div."') AND a.SETUJU = 'DISETUJUI'";
		// }else if($krit == ''){
		// 	$where = $where;
		// }
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
				1
			)
		";
		$this->db->query($sql);
	}

	//LAPORAN REALISASI RKAP
	function laporan_realisasi($tahun,$kriteria,$bagian,$sub_bagian,$kode_perkiraan){
		$where = "1 = 1";
		if($kriteria == "semua_bagian"){
			$where = $where;
		}else if($kriteria == "bagian"){
			$where = $where." AND DASAR.DEPARTEMEN = '$bagian'";
		}else{
			$where = $where." AND DASAR.DEPARTEMEN = '$bagian' AND DASAR.DIVISI = '$sub_bagian'";
		}

		if($kode_perkiraan != ""){
			$where = $where." AND DASAR.KODE_PERKIRAAN = '$kode_perkiraan'";
		}

		$sql = "
			SELECT
				ID_ANGGARAN,
				KODE_ANGGARAN,
				URAIAN,
				NAMA_DIVISI,
				JUMLAH,
				JUMLAH_REV,
				SATUAN,
				HARGA,
				RKAP,
				NO_BUKTI,
				NO_KEU,
				TANGGAL,
				REAL_VOL,
				HARGA_SATUAN,
				STS_TAMBAHAN,
				ADENDUM,
				NILAI_ADENDUM
			FROM(
				SELECT
					DASAR.ID_ANGGARAN,
					DASAR.KODE_ANGGARAN,
					DASAR.URAIAN,
					DIVISI.NAMA AS NAMA_DIVISI,
					DASAR.JUMLAH,
					REVISI.JUMLAH AS JUMLAH_REV,
					DASAR.SATUAN,
					DASAR.HARGA,
					(CASE
						WHEN DASAR.JENIS_ANGGARAN = 'Barang' THEN
							DASAR.TOTAL
						ELSE
							DASAR.TOTAL_PELAKSANAAN
					END) AS RKAP,
					(CASE
					    WHEN REALISASI.ID_SPK != 0 THEN 
					      REALISASI.NO_SPK
					    ELSE 
					      (CASE
					          WHEN REALISASI.ID_RAB != 0 THEN 
					            REALISASI.NO_RAB
					          WHEN REALISASI.ID_SPM != 0 THEN 
					            REALISASI.NO_SPM
					          ELSE 
					            CONCAT(REALISASI.NO_DPBM,'.',REALISASI.ID_DPBM)
					      END)
					END) AS NO_BUKTI,
					REALISASI.NO_KEU,
					REALISASI.TANGGAL,
					(CASE
					    WHEN REALISASI.ID_SPK != 0 THEN 
					      REALISASI.VOLUME_SPK
					    ELSE 
					      (CASE
					          WHEN REALISASI.ID_RAB != 0 THEN 
					            REALISASI.VOLUME_RAB
					          WHEN REALISASI.ID_SPM != 0 THEN 
					            1
					          ELSE 
					            REALISASI.VOLUME_DPBM
					      END)
					END) AS REAL_VOL,
					(CASE
	        		  WHEN REALISASI.ID_SPK != 0 THEN
	        			REALISASI.HARGA_SATUAN_SPK
	        		  ELSE
	        		  	(CASE
	        		  		WHEN REALISASI.ID_RAB != 0 THEN
	        		  			REALISASI.HARGA_SATUAN_RAB
	        		  		WHEN REALISASI.ID_SPM != 0 THEN
	        		  			REALISASI.NILAI_SPM
	        		  		ELSE
	        					REALISASI.HARGA_SATUAN_DPBM
	        		  	END)
	        		END) AS HARGA_SATUAN,
					DASAR.STS_TAMBAHAN,
					SPK.ADENDUM,
					SPK.NILAI_ADENDUM
				FROM stp_anggaran_dasar DASAR
				LEFT JOIN stp_revisi_anggaran REVISI ON DASAR.KODE_ANGGARAN = REVISI.KODE_ANGGARAN
				LEFT JOIN stp_divisi DIVISI ON DIVISI.ID = DASAR.DIVISI
				LEFT JOIN stp_realisasi_anggaran REALISASI ON DASAR.ID_ANGGARAN = REALISASI.ID_ANGGARAN
				LEFT JOIN stp_master_spk SPK ON SPK.ID = REALISASI.ID_SPK
				WHERE $where
				AND DASAR.SETUJU = 'DISETUJUI'
				AND DASAR.TAHUN = '$tahun'
				ORDER BY DASAR.KODE_ANGGARAN ASC
			) a
			ORDER BY a.KODE_ANGGARAN ASC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function hitung_realisasi($tahun,$kriteria,$bagian,$sub_bagian,$kode_perkiraan,$kode_anggaran){
		$where = "1 = 1";
		if($kriteria == "semua_bagian"){
			$where = $where;
		}else if($kriteria == "bagian"){
			$where = $where." AND DASAR.DEPARTEMEN = '$bagian'";
		}else{
			$where = $where." AND DASAR.DEPARTEMEN = '$bagian' AND DASAR.DIVISI = '$sub_bagian'";
		}

		if($kode_perkiraan != ""){
			$where = $where." AND DASAR.KODE_PERKIRAAN = '$kode_perkiraan'";
		}

		$query = "
			SELECT
				KODE_ANGGARAN,
				TOTAL,
				REALISASI,
				(TOTAL-REALISASI) AS SISA,
				REAL_VOL,
				SUM_JUMLAH,
				(REAL_VOL-SUM_JUMLAH) AS SISA_VOL,
				STS_TAMBAHAN,
				(CASE
					WHEN (REALISASI > TOTAL) AND (REALISASI  > 0) THEN 'merah'
					WHEN (REALISASI < TOTAL) AND (REALISASI  > 0) THEN 'kuning'
					WHEN (REALISASI = TOTAL) AND (REALISASI  > 0) THEN 'kuning'
					WHEN (STS_TAMBAHAN = 2) THEN 'orange'
					ELSE 'putih'
				 END) AS WARNA
			FROM(
				SELECT
					KODE_ANGGARAN,
					JUMLAH,
					RKAP AS TOTAL,
					SUM(REALISASI) AS REALISASI,
					SUM(REAL_VOL) AS REAL_VOL,
					SUM(SUM_JUMLAH) AS SUM_JUMLAH,
					STS_TAMBAHAN
				FROM(
					SELECT
						DASAR.ID_ANGGARAN,
						DASAR.KODE_ANGGARAN,
						DASAR.URAIAN,
						DIVISI.NAMA AS NAMA_DIVISI,
						DASAR.JUMLAH,
						REVISI.JUMLAH AS JUMLAH_REV,
						DASAR.SATUAN,
						DASAR.HARGA,
						(CASE
							WHEN DASAR.JENIS_ANGGARAN = 'Barang' THEN
								DASAR.TOTAL
							ELSE
								DASAR.TOTAL_PELAKSANAAN
						END) AS RKAP,
						(CASE
							WHEN REALISASI.ID_SPK != 0 THEN 
								REALISASI.NO_SPK
							ELSE 
								(CASE
									WHEN REALISASI.ID_RAB != 0 THEN 
										REALISASI.NO_RAB
									WHEN REALISASI.ID_SPM != 0 THEN 
										REALISASI.NO_SPM
									ELSE 
										REALISASI.NO_DPBM
								END)
						END) AS NO_BUKTI,
						REALISASI.NO_KEU,
						REALISASI.TANGGAL,
						(CASE
							WHEN REALISASI.ID_SPK != 0 THEN 
								REALISASI.VOLUME_SPK
							ELSE 
								(CASE
									WHEN REALISASI.ID_RAB != 0 THEN 
										REALISASI.VOLUME_RAB
									WHEN REALISASI.ID_SPM != 0 THEN 
										1
									ELSE 
										REALISASI.VOLUME_DPBM
								END)
						END) AS REAL_VOL,
						(CASE
							WHEN REALISASI.ID_SPK != 0 THEN
								REALISASI.VOLUME_SPK
							ELSE
								(CASE
									WHEN REALISASI.ID_RAB != 0 THEN
										REALISASI.VOLUME_RAB
									WHEN REALISASI.ID_SPM != 0 THEN
										1
									ELSE
									REALISASI.VOLUME_DPBM
								END)
						END) AS SUM_JUMLAH,
						(CASE
							WHEN REALISASI.ID_SPK != 0 THEN
								REALISASI.HARGA_SATUAN_SPK
							ELSE
								(CASE
									WHEN REALISASI.ID_RAB != 0 THEN
										REALISASI.HARGA_SATUAN_RAB
									WHEN REALISASI.ID_SPM != 0 THEN
										REALISASI.NILAI_SPM
									ELSE
										REALISASI.HARGA_SATUAN_DPBM
								END)
						END) AS HARGA_SATUAN,
						(CASE
							WHEN REALISASI.ID_SPK != 0 THEN
								(CASE
									WHEN SPK.ADENDUM IS NOT NULL THEN
										(REALISASI.HARGA_SATUAN_SPK * REALISASI.VOLUME_SPK)+SPK.NILAI_ADENDUM
									ELSE
										REALISASI.HARGA_SATUAN_SPK * REALISASI.VOLUME_SPK
								END)
							ELSE
								(CASE
									WHEN REALISASI.ID_RAB != 0 THEN
										REALISASI.HARGA_SATUAN_RAB * REALISASI.VOLUME_RAB
									WHEN REALISASI.ID_SPM != 0 THEN
										REALISASI.NILAI_SPM * 1
									ELSE
										REALISASI.HARGA_SATUAN_DPBM * REALISASI.VOLUME_DPBM
								END)
						END) AS REALISASI,
						SPK.ADENDUM,
						SPK.NILAI_ADENDUM,
						DASAR.STS_TAMBAHAN
					FROM stp_anggaran_dasar DASAR
					LEFT JOIN stp_revisi_anggaran REVISI ON DASAR.KODE_ANGGARAN = REVISI.KODE_ANGGARAN
					LEFT JOIN stp_divisi DIVISI ON DIVISI.ID = DASAR.DIVISI
					LEFT JOIN stp_realisasi_anggaran REALISASI ON DASAR.ID_ANGGARAN = REALISASI.ID_ANGGARAN
					LEFT JOIN stp_master_spk SPK ON SPK.NO_SPK = REALISASI.NO_SPK
					WHERE $where
					AND DASAR.SETUJU = 'DISETUJUI'
					AND DASAR.TAHUN = '$tahun'
					AND DASAR.KODE_ANGGARAN = '$kode_anggaran'
					ORDER BY
						DASAR.KODE_ANGGARAN ASC
				) a
			) b
		";
		$sql = $this->db->query($query);
		return $sql->result();
	}

}

?>