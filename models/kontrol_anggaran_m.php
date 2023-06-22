<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontrol_anggaran_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_kode_anggaran($kode_anggaran,$tahun){
		$sql = "
			SELECT 
				ANGGARAN.ID_ANGGARAN,
				ANGGARAN.URAIAN,
				ANGGARAN.KODE_ANGGARAN,
				(CASE
					WHEN ANGGARAN.JENIS_ANGGARAN = 'Barang' THEN 
						ANGGARAN.TOTAL
					ELSE 
						ANGGARAN.TOTAL_PELAKSANAAN
				END) AS TOTAL,
				ANGGARAN.KODE_PERKIRAAN, 
				KOPER.NAMA_PERKIRAAN, 
				ANGGARAN.SATUAN,  
				ANGGARAN.TAHUN, 
				ANGGARAN.JUMLAH,
				ANGGARAN.JENIS_ANGGARAN,
				REAL.ID_ANGGARAN REAL,
				HIS.ID_ANGGARAN RAPAT, 
				ANGGARAN.STS_TAMBAHAN
			FROM stp_anggaran_dasar ANGGARAN
			LEFT JOIN stp_setup_kode_perkiraan KOPER ON ANGGARAN.KODE_PERKIRAAN = KOPER.KODE_PERKIRAAN
			LEFT JOIN(
				SELECT ID_ANGGARAN FROM stp_realisasi_anggaran GROUP BY ID_ANGGARAN
			) REAL ON REAL.ID_ANGGARAN = ANGGARAN.ID_ANGGARAN
			LEFT JOIN (
				SELECT ID_ANGGARAN FROM stp_usulan_anggaran GROUP BY ID_ANGGARAN
			)HIS ON HIS.ID_ANGGARAN = ANGGARAN.ID_ANGGARAN
			WHERE ANGGARAN.KODE_ANGGARAN = '$kode_anggaran'
			AND ANGGARAN.TAHUN = '$tahun'
			AND ANGGARAN.SETUJU = 'DISETUJUI'
			ORDER BY ANGGARAN.TAHUN DESC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	//RKAP
	function get_data_anggaran_rkap($kriteria,$bagian,$sub_bagian,$tahun,$kode_perkiraan,$kode_anggaran,$kondisi,$tgl_awal,$tgl_akhir){
		$where = "1 = 1";
		$where_real = "1 = 1";

		if($kriteria == "semua_bagian"){
			$where = $where;
		}else if($kriteria == "bagian"){
			$where = $where." AND DASAR.DEPARTEMEN = '$bagian'";
		}else{
			$where = $where." AND DASAR.DEPARTEMEN = '$bagian' AND DASAR.DIVISI = '$sub_bagian'";
		}

		if($kondisi == "semua_kondisi"){
			$where = $where;
		}else if($kondisi == "per_kode_perkiraan"){
			if($kode_perkiraan != ""){
				$where = $where." AND DASAR.KODE_PERKIRAAN = '$kode_perkiraan'";
			}
		}else if($kondisi == "per_kode_anggaran"){
			if($kode_anggaran != ""){
				$where = $where." AND DASAR.KODE_ANGGARAN = '$kode_anggaran'";
			}
		}

		if($tgl_awal != "" || $tgl_awal != null){
			$where = $where." AND DASAR.TANGGAL_INPUT >= '$tgl_awal'";
			$where_real = $where_real." AND TANGGAL >= '$tgl_awal'";
		}

		if($tgl_akhir != "" || $tgl_akhir != null){
			$where = $where." AND DASAR.TANGGAL_INPUT <= '$tgl_akhir'";
			$where_real = $where_real." AND TANGGAL <= '$tgl_akhir'";
		}
		
		$sql = "
			SELECT
				ID_ANGGARAN,
				KODE_PERKIRAAN,
				NAMA_PERKIRAAN,
				JUMLAH,
				HARGA,
				RKAP,
				NILAI_REALISASI,
				ANGGARAN,
				STS_TAMBAHAN,
				STS_REVISI,
				(CASE
					WHEN (NILAI_REALISASI > RKAP && NILAI_REALISASI > 0) THEN 'merah'
					WHEN (NILAI_REALISASI < RKAP && NILAI_REALISASI > 0) THEN 'kuning'
					WHEN (STS_TAMBAHAN = 2) THEN 'orange'
					ELSE 'putih'
				END) AS WARNA
			FROM(
				SELECT
					DASAR.ID_ANGGARAN,
					DASAR.KODE_PERKIRAAN,
					KOPER.NAMA_PERKIRAAN,
					DASAR.JUMLAH AS JUMLAH,
					(CASE
						WHEN DASAR.JENIS_ANGGARAN = 'Barang' THEN
							DASAR.TOTAL
						ELSE
							DASAR.TOTAL_PELAKSANAAN
					END) AS RKAP,
					DASAR.HARGA AS HARGA,
					DASAR.STS_TAMBAHAN,
					DASAR.STS_REVISI,
					SUM(
						(CASE
							WHEN REALISASI.ID_SPK != 0 THEN 
								REALISASI.HARGA_SATUAN_SPK * REALISASI.VOLUME_SPK
							ELSE 
								(CASE
									WHEN REALISASI.ID_RAB != 0 THEN 
										REALISASI.VOLUME_RAB * REALISASI.HARGA_SATUAN_RAB
									ELSE 
										REALISASI.VOLUME_DPBM * REALISASI.HARGA_SATUAN_DPBM
								END)
						END)
					) AS NILAI_REALISASI,
					SUM(
		 				(CASE 
							WHEN DASAR.JENIS_ANGGARAN = 'Barang' THEN 
								DASAR.TOTAL 
							ELSE 
								DASAR.TOTAL_PELAKSANAAN 
						END)
		 			) AS ANGGARAN
				FROM stp_anggaran_dasar DASAR
				LEFT JOIN stp_usulan_anggaran USULAN ON USULAN.ID_ANGGARAN = DASAR.ID_ANGGARAN
				LEFT JOIN stp_divisi b ON b.id = DASAR.DIVISI
				LEFT JOIN stp_departemen c ON c.id = DASAR.DEPARTEMEN
				LEFT JOIN stp_setup_kode_perkiraan KOPER ON KOPER.KODE_PERKIRAAN = DASAR.KODE_PERKIRAAN
				LEFT JOIN(
					SELECT * FROM stp_realisasi_anggaran
					WHERE $where_real
				) REALISASI ON REALISASI.ID_ANGGARAN = DASAR.ID_ANGGARAN
				WHERE $where
				AND DASAR.TAHUN = '$tahun'
				GROUP BY 
					DASAR.KODE_PERKIRAAN
			) a
			ORDER BY a.KODE_PERKIRAAN ASC
		";

		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_kode_anggaran_rinci_rkap($kriteria,$kode_perkiraan,$kode_anggaran,$tahun,$bagian,$sub_bagian,$kondisi,$tgl_awal,$tgl_akhir){
		$where = "1 = 1";
		$where_real = "1 = 1";

		if($kriteria == "semua_bagian"){
			$where = $where;
		}else if($kriteria == "bagian"){
			$where = $where." AND DASAR.DEPARTEMEN = '$bagian'";
		}else{
			$where = $where." AND DASAR.DEPARTEMEN = '$bagian' AND DASAR.DIVISI = '$sub_bagian'";
		}

		if($kondisi == "semua_kondisi"){
			$where = $where;
		}else if($kondisi == "per_kode_perkiraan"){
			if($kode_perkiraan != ""){
				$where = $where." AND DASAR.KODE_PERKIRAAN = '$kode_perkiraan'";
			}
		}else if($kondisi == "per_kode_anggaran"){
			if($kode_anggaran != ""){
				$where = $where." AND DASAR.KODE_ANGGARAN = '$kode_anggaran'";
			}
		}

		if($tgl_awal != "" || $tgl_awal != null){
			$where = $where." AND DASAR.TANGGAL_INPUT >= '$tgl_awal'";
			$where_real = $where_real." AND TANGGAL >= '$tgl_awal'";
		}

		if($tgl_akhir != "" || $tgl_akhir != null){
			$where = $where." AND DASAR.TANGGAL_INPUT <= '$tgl_akhir'";
			$where_real = $where_real." AND TANGGAL <= '$tgl_akhir'";
		}

		$sql = "
			SELECT
				ID_ANGGARAN,
				KODE_PERKIRAAN,
				KODE_ANGGARAN,
				URAIAN,
				RKAP,
				REALISASI,
				SUBSTR(TANGGAL_REALISASI,4,2) AS TANGGAL_REALISASI,
				(CASE
				  WHEN (REALISASI > RKAP) AND (REALISASI  > 0) THEN 'merah'
				  WHEN (REALISASI < RKAP) AND (REALISASI  > 0) THEN 'kuning'
				  WHEN (STS_TAMBAHAN = 2) THEN 'orange'
				  ELSE 'putih'
			   END) AS WARNA,
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
			FROM(
				SELECT
					DASAR.ID_ANGGARAN,
					DASAR.KODE_PERKIRAAN,
					DASAR.KODE_ANGGARAN,
					DASAR.URAIAN,
					DASAR.STS_TAMBAHAN,
					DASAR.STS_REVISI,
					(CASE 
						WHEN DASAR.JENIS_ANGGARAN = 'Barang' THEN 
							DASAR.TOTAL 
						ELSE 
							DASAR.TOTAL_PELAKSANAAN 
					END) AS RKAP,
					SUM(
						(CASE
		        		  WHEN REALISASI.ID_SPK != 0 THEN
		        			REALISASI.HARGA_SATUAN_SPK * REALISASI.VOLUME_SPK
		        		  ELSE
		        		  	(CASE
		        		  		WHEN REALISASI.ID_RAB != 0 THEN
		        		  			REALISASI.HARGA_SATUAN_RAB * REALISASI.VOLUME_RAB
		        		  		ELSE
		        					REALISASI.HARGA_SATUAN_DPBM * REALISASI.VOLUME_DPBM
		        		  	END)
		        		END)
					) AS REALISASI,
					REALISASI.TANGGAL AS TANGGAL_REALISASI,
					DASAR.JANUARI,
					DASAR.FEBRUARI,
					DASAR.MARET,
					DASAR.APRIL,
					DASAR.MEI,
					DASAR.JUNI,
					DASAR.JULI,
					DASAR.AGUSTUS,
					DASAR.SEPTEMBER,
					DASAR.OKTOBER,
					DASAR.NOVEMBER,
					DASAR.DESEMBER
				FROM stp_anggaran_dasar DASAR
				LEFT JOIN stp_usulan_anggaran USULAN ON USULAN.ID_ANGGARAN = DASAR.ID_ANGGARAN
				LEFT JOIN stp_setup_kode_perkiraan c ON c.kode_perkiraan = DASAR.kode_perkiraan
			  	LEFT JOIN(
					SELECT * FROM stp_realisasi_anggaran
					WHERE $where_real
				) REALISASI ON REALISASI.ID_ANGGARAN = DASAR.ID_ANGGARAN
			  	WHERE $where 
			  	AND DASAR.TAHUN = '$tahun'
			  	AND DASAR.KODE_PERKIRAAN = '$kode_perkiraan'
			  	GROUP BY
			  		DASAR.KODE_ANGGARAN
			) a
			ORDER BY a.KODE_ANGGARAN ASC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_no_bukti_rinci_rkap($id_anggaran,$tahun,$tgl_awal,$tgl_akhir){
		$where = "1 = 1";
		$where_real = "1 = 1";

		if($tgl_awal != "" || $tgl_awal != null){
			$where = $where." AND DASAR.TANGGAL_INPUT >= '$tgl_awal'";
			$where_real = $where_real." AND TANGGAL >= '$tgl_awal'";
		}

		if($tgl_akhir != "" || $tgl_akhir != null){
			$where = $where." AND DASAR.TANGGAL_INPUT <= '$tgl_akhir'";
			$where_real = $where_real." AND TANGGAL <= '$tgl_akhir'";
		}

		$sql = "
			SELECT
				(CASE
				    WHEN REALISASI.ID_SPK != 0 THEN 
				     	REALISASI.NO_SPK
				    WHEN REALISASI.ID_RAB != 0 THEN 
		            	REALISASI.NO_RAB
		          	WHEN REALISASI.ID_SPM != 0 THEN 
		            	REALISASI.NO_SPM
		          	ELSE 
		            	CONCAT(REALISASI.NO_DPBM,'.',REALISASI.ID_DPBM)
				END) AS NO_BUKTI,
				(CASE
					WHEN REALISASI.ID_SPK != 0 THEN 
						REALISASI.HARGA_SATUAN_SPK * REALISASI.VOLUME_SPK
					ELSE (
						CASE
							WHEN REALISASI.ID_RAB != 0 THEN 
								REALISASI.VOLUME_RAB * REALISASI.HARGA_SATUAN_RAB
							ELSE 
								REALISASI.VOLUME_DPBM * REALISASI.HARGA_SATUAN_DPBM
						END)
				END) AS REALISASI
			FROM stp_anggaran_dasar DASAR
			LEFT JOIN(
				SELECT * FROM stp_realisasi_anggaran
				WHERE $where_real
			) REALISASI ON REALISASI.ID_ANGGARAN = DASAR.ID_ANGGARAN
			WHERE $where 
			AND DASAR.ID_ANGGARAN = '$id_anggaran' 
			AND DASAR.TAHUN = '$tahun'
			AND REALISASI.PERIODE = 1
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	//REVISI
	function get_data_anggaran_revisi($kriteria,$bagian,$sub_bagian,$tahun,$kode_perkiraan,$kode_anggaran,$kondisi,$tgl_awal,$tgl_akhir){
		$where = "1 = 1";
		$where_real = "1 = 1";

		if($kriteria == "semua_bagian"){
			$where = $where;
		}else if($kriteria == "bagian"){
			$where = $where." AND REVISI.DEPARTEMEN = '$bagian'";
		}else{
			$where = $where." AND REVISI.DEPARTEMEN = '$bagian' AND REVISI.DIVISI = '$sub_bagian'";
		}

		if($kondisi == "semua_kondisi"){
			$where = $where;
		}else if($kondisi == "per_kode_perkiraan"){
			if($kode_perkiraan != ""){
				$where = $where." AND REVISI.KODE_PERKIRAAN = '$kode_perkiraan'";
			}
		}else if($kondisi == "per_kode_anggaran"){
			if($kode_anggaran != ""){
				$where = $where." AND REVISI.KODE_ANGGARAN = '$kode_anggaran'";
			}
		}

		if($tgl_awal != "" || $tgl_awal != null){
			$where = $where." AND REVISI.TANGGAL_INPUT >= '$tgl_awal'";
			$where_real = $where_real." AND TANGGAL >= '$tgl_awal'";
		}

		if($tgl_akhir != "" || $tgl_akhir != null){
			$where = $where." AND REVISI.TANGGAL_INPUT <= '$tgl_akhir'";
			$where_real = $where_real." AND TANGGAL <= '$tgl_akhir'";
		}

		$sql = "
			SELECT
				ID_ANGGARAN,
				KODE_PERKIRAAN,
				NAMA_PERKIRAAN,
				JUMLAH,
				HARGA,
				RKAP,
				NILAI_REALISASI,
				ANGGARAN,
				STS_TAMBAHAN,
				STS_REVISI,
				(CASE
					WHEN (NILAI_REALISASI > RKAP && NILAI_REALISASI > 0) THEN 'merah'
					WHEN (NILAI_REALISASI < RKAP && NILAI_REALISASI > 0) THEN 'kuning'
					WHEN (STS_TAMBAHAN = 4) THEN 'orange'
					WHEN (STS_TAMBAHAN = 3) THEN 'ungu'
					WHEN (STS_TAMBAHAN = 1 && STS_REVISI = 6) THEN 'biru'
					ELSE 'putih'
				END) AS WARNA
			FROM(
				SELECT
					REVISI.ID_ANGGARAN,
					REVISI.KODE_PERKIRAAN,
					KOPER.NAMA_PERKIRAAN,
					REVISI.JUMLAH AS JUMLAH,
					(CASE
						WHEN REVISI.JENIS_ANGGARAN = 'Barang' THEN
							REVISI.TOTAL
						ELSE
							REVISI.TOTAL_PELAKSANAAN
					END) AS RKAP,
					(CASE
						WHEN REVISI.JENIS_ANGGARAN = 'Barang' THEN
							REVISI.TOTAL
						ELSE
							REVISI.TOTAL_PELAKSANAAN
					END) AS RKAP_DASAR,
					REVISI.HARGA AS HARGA,
					REVISI.STS_TAMBAHAN,
					REVISI.STS_REVISI,
					SUM(
						(CASE
							WHEN REALISASI.ID_SPK != 0 THEN 
									REALISASI.HARGA_SATUAN_SPK * REALISASI.VOLUME_SPK
							ELSE 
								(CASE
									WHEN REALISASI.ID_RAB != 0 THEN 
										REALISASI.VOLUME_RAB * REALISASI.HARGA_SATUAN_RAB
									ELSE 
										REALISASI.VOLUME_DPBM * REALISASI.HARGA_SATUAN_DPBM
								END)
						END)
					) AS NILAI_REALISASI,
					SUM(
		 				(CASE 
		 					WHEN REVISI.SETUJU = 'DISETUJUI' THEN 
		 						(CASE 
	 								WHEN REVISI.JENIS_ANGGARAN = 'Barang' THEN 
	 									REVISI.TOTAL 
	 								ELSE 
	 									REVISI.TOTAL_PELAKSANAAN
	 							END)
		 				END)
		 			) AS ANGGARAN
				FROM stp_revisi_anggaran REVISI
				LEFT JOIN stp_anggaran_dasar DASAR ON DASAR.ID_ANGGARAN = REVISI.ID_ANGGARAN
				LEFT JOIN stp_usulan_anggaran USULAN ON USULAN.ID_ANGGARAN = REVISI.ID
				LEFT JOIN stp_divisi b ON b.id = REVISI.DIVISI
				LEFT JOIN stp_departemen c ON c.id = REVISI.DEPARTEMEN
				LEFT JOIN stp_setup_kode_perkiraan KOPER ON KOPER.KODE_PERKIRAAN = REVISI.KODE_PERKIRAAN
				LEFT JOIN(
					SELECT * FROM stp_realisasi_anggaran
					WHERE $where_real
				) REALISASI ON REALISASI.ID_ANGGARAN = REVISI.ID
				WHERE $where
				AND REVISI.TAHUN = '$tahun'
				GROUP BY 
					REVISI.KODE_PERKIRAAN
			) a
			ORDER BY a.KODE_PERKIRAAN ASC
		";

		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_kode_anggaran_revisi($kriteria,$kode_perkiraan,$kode_anggaran,$tahun,$bagian,$sub_bagian,$kondisi,$tgl_awal,$tgl_akhir){
		$where = "1 = 1";
		$where_real = "1 = 1";

		if($kriteria == "semua_bagian"){
			$where = $where;
		}else if($kriteria == "bagian"){
			$where = $where." AND REVISI.DEPARTEMEN = '$bagian'";
		}else{
			$where = $where." AND REVISI.DEPARTEMEN = '$bagian' AND REVISI.DIVISI = '$sub_bagian'";
		}

		if($kondisi == "semua_kondisi"){
			$where = $where;
		}else if($kondisi == "per_kode_perkiraan"){
			if($kode_perkiraan != ""){
				$where = $where." AND REVISI.KODE_PERKIRAAN = '$kode_perkiraan'";
			}
		}else if($kondisi == "per_kode_anggaran"){
			if($kode_anggaran != ""){
				$where = $where." AND REVISI.KODE_ANGGARAN = '$kode_anggaran'";
			}
		}

		if($tgl_awal != "" || $tgl_awal != null){
			$where = $where." AND REVISI.TANGGAL_INPUT >= '$tgl_awal'";
			$where_real = $where_real." AND TANGGAL >= '$tgl_awal'";
		}

		if($tgl_akhir != "" || $tgl_akhir != null){
			$where = $where." AND REVISI.TANGGAL_INPUT <= '$tgl_akhir'";
			$where_real = $where_real." AND TANGGAL <= '$tgl_akhir'";
		}

		$sql = "
			SELECT
				ID_ANGGARAN,
				KODE_PERKIRAAN,
				KODE_ANGGARAN,
				URAIAN,
				REALISASI,
				SUBSTR(TANGGAL_REALISASI,4,2) AS TANGGAL_REALISASI,
				(CASE
				  WHEN (REALISASI > TOTAL) AND (REALISASI  > 0) THEN 'merah'
				  WHEN (REALISASI < TOTAL) AND (REALISASI  > 0) THEN 'kuning'
				  WHEN (STS_TAMBAHAN = 4) THEN 'orange'
				  WHEN (STS_TAMBAHAN = 3) THEN 'ungu'
				  WHEN (STS_TAMBAHAN = 1 && STS_REVISI = 6) THEN 'biru'
				  ELSE 'putih'
			   END) AS WARNA,
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
			FROM(
				SELECT
					REVISI.ID_ANGGARAN,
					REVISI.KODE_PERKIRAAN,
					REVISI.KODE_ANGGARAN,
					REVISI.URAIAN,
					DASAR.STS_TAMBAHAN,
					DASAR.STS_REVISI,
					SUM(
						(CASE 
							WHEN DASAR.SETUJU = 'DISETUJUI' THEN 
								(CASE 
									WHEN DASAR.STS_REVISI = 5 THEN 
										(CASE 
											WHEN REVISI.JENIS_ANGGARAN = 'Barang' THEN 
												REVISI.TOTAL 
											ELSE 
												REVISI.TOTAL_PELAKSANAAN 
										END)
								ELSE 
									(CASE 
										WHEN REVISI.JENIS_ANGGARAN = 'Barang' THEN 
											DASAR.TOTAL 
										ELSE 
											DASAR.TOTAL_PELAKSANAAN 
									END)
								END)
						END)
					) AS TOTAL,
					(CASE
	        		  WHEN REALISASI.ID_SPK != 0 THEN
	        			SUM(REALISASI.HARGA_SATUAN_SPK * REALISASI.VOLUME_SPK)
	        		  ELSE
	        		  	(CASE
	        		  		WHEN REALISASI.ID_RAB != 0 THEN
	        		  			SUM(REALISASI.HARGA_SATUAN_RAB * REALISASI.VOLUME_RAB)
	        		  		ELSE
	        					SUM(REALISASI.HARGA_SATUAN_DPBM * REALISASI.VOLUME_DPBM)
	        		  	END)
	        		END) AS REALISASI,
					REALISASI.TANGGAL AS TANGGAL_REALISASI,
					REVISI.JANUARI,
					REVISI.FEBRUARI,
					REVISI.MARET,
					REVISI.APRIL,
					REVISI.MEI,
					REVISI.JUNI,
					REVISI.JULI,
					REVISI.AGUSTUS,
					REVISI.SEPTEMBER,
					REVISI.OKTOBER,
					REVISI.NOVEMBER,
					REVISI.DESEMBER
				FROM stp_revisi_anggaran REVISI
			  	LEFT JOIN stp_anggaran_dasar DASAR ON REVISI.ID_ANGGARAN = DASAR.ID_ANGGARAN
				LEFT JOIN stp_usulan_anggaran USULAN ON USULAN.ID_ANGGARAN = REVISI.ID
				LEFT JOIN stp_setup_kode_perkiraan c ON c.KODE_PERKIRAAN = REVISI.KODE_PERKIRAAN
			  	LEFT JOIN(
					SELECT * FROM stp_realisasi_anggaran
					WHERE $where_real
				) REALISASI ON REALISASI.ID_ANGGARAN = REVISI.ID
			  	WHERE $where 
			  	AND REVISI.TAHUN = '$tahun'
			  	AND REVISI.KODE_PERKIRAAN = '$kode_perkiraan'
			) a
			ORDER BY a.KODE_PERKIRAAN ASC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_no_bukti_revisi($id_anggaran,$tahun,$tgl_awal,$tgl_akhir){
		$where = "1 = 1";
		$where_real = "1 = 1";

		if($tgl_awal != "" || $tgl_awal != null){
			$where = $where." AND REVISI.TANGGAL_INPUT >= '$tgl_awal'";
			$where_real = $where_real." AND TANGGAL >= '$tgl_awal'";
		}

		if($tgl_akhir != "" || $tgl_akhir != null){
			$where = $where." AND REVISI.TANGGAL_INPUT <= '$tgl_akhir'";
			$where_real = $where_real." AND TANGGAL <= '$tgl_akhir'";
		}

		$sql = "
			SELECT
				(CASE
				    WHEN REALISASI.ID_SPK != 0 THEN 
				     	REALISASI.NO_SPK
				    WHEN REALISASI.ID_RAB != 0 THEN 
		            	REALISASI.NO_RAB
		          	WHEN REALISASI.ID_SPM != 0 THEN 
		            	REALISASI.NO_SPM
		          	ELSE 
		            	CONCAT(REALISASI.NO_DPBM,'.',REALISASI.ID_DPBM)
				END) AS NO_BUKTI,
				SUM(
			        (CASE
			          WHEN REALISASI.ID_SPK != 0 THEN 
			            REALISASI.HARGA_SATUAN_SPK * REALISASI.VOLUME_SPK
			          ELSE (
			              CASE
			                WHEN REALISASI.ID_RAB != 0 THEN 
			                  REALISASI.VOLUME_RAB * REALISASI.HARGA_SATUAN_RAB
			                ELSE 
			                  REALISASI.VOLUME_DPBM * REALISASI.HARGA_SATUAN_DPBM
			              END)
			        END)
			    ) AS REALISASI
			FROM stp_revisi_anggaran REVISI
			LEFT JOIN stp_anggaran_dasar DASAR ON DASAR.ID_ANGGARAN = REVISI.ID_ANGGARAN
			LEFT JOIN(
				SELECT * FROM stp_realisasi_anggaran
				WHERE $where_real
			) REALISASI ON REALISASI.ID_ANGGARAN = REVISI.ID
			WHERE $where 
			AND REVISI.ID_ANGGARAN = '$id_anggaran' 
			AND REVISI.TAHUN = '$tahun'
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

}

?>