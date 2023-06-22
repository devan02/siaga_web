<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_revisi_rkap_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_revisi_anggaran(
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
		$sts_tambahan,
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
		$sts_revisi,
		$tgl_revisi,
		$tanggal_input){

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
				STS_TAMBAHAN,
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
				STS_REVISI,
				TGL_REVISI,
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
				'$sts_tambahan',
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
				'$sts_revisi',
				'$tgl_revisi',
				'$tanggal_input',
				2
			)
		";
		$this->db->query($sql);
	}

	function insert_rkap_to_revisi(
		$id_anggaran,
		$kode_perkiraan,
		$kode_perkiraan2,
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
		$sts_revisi,
		$tgl_revisi,
		$tanggal_input,
		$periode){

		$sql = "
			INSERT INTO stp_revisi_anggaran(
				ID_ANGGARAN,
				KODE_PERKIRAAN,
				KODE_PERKIRAAN2,
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
				STS_TAMBAHAN,
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
				STS_REVISI,
				TGL_REVISI,
				TANGGAL_INPUT,
				PERIODE
			)VALUES(
				'$id_anggaran',
				'$kode_perkiraan',
				'$kode_perkiraan2',
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
				'$sts_tambahan',
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
				'$sts_revisi',
				'$tgl_revisi',
				'$tanggal_input',
				'$periode'
			)
		";
		$this->db->query($sql);
	}

	function ubah_anggaran(
		$kode_anggaran,
		$kode_perkiraan,
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
		$desember){

		$tgl_revisi = date("d-m-Y");

		$sql = "
			UPDATE stp_anggaran_dasar SET
				KODE_PERKIRAAN = '$kode_perkiraan',
				JENIS_ANGGARAN = '$jenis_anggaran',
				ID_JENIS_ANGGARAN = '$id_jenis_anggaran',
				URAIAN = '$uraian',
				SUMBER_DANA = '$sumber_dana',
				LOKASI = '$lokasi',
				SATUAN = '$satuan',
				HARGA = '$harga',
				JUMLAH = '$jumlah',
				TOTAL = '$total',
				TMT_PELAKSANAAN = '$tmt_pelaksanaan',
				LAMA_PELAKSANAAN = '$lama_pelaksanaan',
				TOTAL_PELAKSANAAN = '$total_pelaksanaan',
				JANUARI = '$januari', 
				FEBRUARI = '$februari', 
				MARET = '$maret', 
				APRIL = '$april', 
				MEI = '$mei', 
				JUNI = '$juni', 
				JULI = '$juli', 
				AGUSTUS = '$agustus', 
				SEPTEMBER = '$september', 
				OKTOBER = '$oktober', 
				NOVEMBER = '$november', 
				DESEMBER = '$desember',
				STS_REVISI = 5,
				TGL_REVISI = '$tgl_revisi'
			WHERE KODE_ANGGARAN = '$kode_anggaran'
		";
		$this->db->query($sql);
	}

	function ubah_revisi_anggaran(
		$kode_anggaran,
		$kode_perkiraan,
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
		$desember){
		$sql = "
			UPDATE stp_revisi_anggaran SET
				KODE_PERKIRAAN = '$kode_perkiraan',
				JENIS_ANGGARAN = '$jenis_anggaran',
				ID_JENIS_ANGGARAN = '$id_jenis_anggaran',
				URAIAN = '$uraian',
				SUMBER_DANA = '$sumber_dana',
				LOKASI = '$lokasi',
				SATUAN = '$satuan',
				HARGA = '$harga',
				JUMLAH = '$jumlah',
				TOTAL = '$total',
				TMT_PELAKSANAAN = '$tmt_pelaksanaan',
				LAMA_PELAKSANAAN = '$lama_pelaksanaan',
				TOTAL_PELAKSANAAN = '$total_pelaksanaan',
				JANUARI = '$januari', 
				FEBRUARI = '$februari', 
				MARET = '$maret', 
				APRIL = '$april', 
				MEI = '$mei', 
				JUNI = '$juni', 
				JULI = '$juli', 
				AGUSTUS = '$agustus', 
				SEPTEMBER = '$september', 
				OKTOBER = '$oktober', 
				NOVEMBER = '$november', 
				DESEMBER = '$desember'
			WHERE KODE_ANGGARAN = '$kode_anggaran'
		";
		$this->db->query($sql);
	}
	
	function hapus_anggaran($kode_anggaran){
		$sql = "DELETE FROM stp_revisi_anggaran WHERE KODE_ANGGARAN = '$kode_anggaran'";
		$this->db->query($sql);
	} 

	function get_anggaran_id($kode_anggaran){
		$sql = "
			SELECT
				a.*
			FROM(
				SELECT
				    REVISI.ID_ANGGARAN AS ID_ANGGARAN,
				    REVISI.KODE_ANGGARAN AS KODE_ANGGARAN,
				    REVISI.URAIAN AS URAIAN,
				    REVISI.KODE_PERKIRAAN AS KODE_PERKIRAAN,
				    REVISI.KODE_PERKIRAAN2 AS KODE_PERKIRAAN2,
				    REVISI.TAHUN AS TAHUN,
				    REVISI.DEPARTEMEN AS DEPARTEMEN,
				    REVISI.DIVISI AS DIVISI,
				    BRG.ID AS ID_BARANG,
				    REVISI.ID_JENIS_ANGGARAN AS ID_JENIS_ANGGARAN,
				    REVISI.JENIS_ANGGARAN AS JENIS_ANGGARAN,
				    REVISI.SUMBER_DANA AS SUMBER_DANA,
				    REVISI.LOKASI AS LOKASI,
				    REVISI.SATUAN AS SATUAN,
				    REVISI.HARGA AS HARGA,
				    REVISI.SETUJU AS SETUJU,
				    REVISI.NO_SURAT AS NO_SURAT,
				    REVISI.JUMLAH AS JUMLAH,
					(CASE
		    			WHEN REVISI.JENIS_ANGGARAN = 'Barang' THEN
		    				REVISI.TOTAL
		    			ELSE
		    				REVISI.TOTAL_PELAKSANAAN
		    		END) AS RKAP,
					REVISI.TMT_PELAKSANAAN AS TMT_PELAKSANAAN,
				    REVISI.LAMA_PELAKSANAAN AS LAMA_PELAKSANAAN,
				    REVISI.TOTAL_PELAKSANAAN AS TOTAL_PELAKSANAAN,
				    REVISI.JANUARI AS JANUARI,
					REVISI.FEBRUARI AS FEBRUARI,
					REVISI.MARET AS MARET,
					REVISI.APRIL AS APRIL,
					REVISI.MEI AS MEI,
					REVISI.JUNI AS JUNI,
					REVISI.JULI AS JULI,
					REVISI.AGUSTUS AS AGUSTUS,
					REVISI.SEPTEMBER AS SEPTEMBER,
					REVISI.OKTOBER AS OKTOBER,
					REVISI.NOVEMBER AS NOVEMBER,
					REVISI.DESEMBER AS DESEMBER,
					REVISI.TANGGAL_INPUT,
					REVISI.JENIS_RAPAT,
					REVISI.STS_TAMBAHAN,
				    REVISI.PERIODE AS PERIODE,
				    'REVISI' AS EPISODE
				FROM stp_revisi_anggaran REVISI
				LEFT JOIN stp_kode_barang BRG ON BRG.KODE_BARANG = REVISI.ID_JENIS_ANGGARAN
				WHERE REVISI.STS_REVISI != 6
				
				UNION ALL

				SELECT
				    DASAR.ID_ANGGARAN AS ID_ANGGARAN,
				    DASAR.KODE_ANGGARAN AS KODE_ANGGARAN,
				    DASAR.URAIAN AS URAIAN,
				    DASAR.KODE_PERKIRAAN AS KODE_PERKIRAAN,
				    DASAR.KODE_PERKIRAAN2 AS KODE_PERKIRAAN2,
				    DASAR.TAHUN AS TAHUN,
				    DASAR.DEPARTEMEN AS DEPARTEMEN,
				    DASAR.DIVISI AS DIVISI,
				    BRG.ID AS ID_BARANG,
				    DASAR.ID_JENIS_ANGGARAN AS ID_JENIS_ANGGARAN,
				    DASAR.JENIS_ANGGARAN AS JENIS_ANGGARAN,
				    DASAR.SUMBER_DANA AS SUMBER_DANA,
				    DASAR.LOKASI AS LOKASI,
				    DASAR.SATUAN AS SATUAN,
				    DASAR.HARGA AS HARGA,
				    DASAR.SETUJU AS SETUJU,
				    DASAR.NO_SURAT AS NO_SURAT,
				    DASAR.JUMLAH AS JUMLAH,
					(CASE
		    			WHEN DASAR.JENIS_ANGGARAN = 'Barang' THEN
		    				DASAR.TOTAL
		    			ELSE
		    				DASAR.TOTAL_PELAKSANAAN
		    		END) AS RKAP,
					DASAR.TMT_PELAKSANAAN AS TMT_PELAKSANAAN,
				    DASAR.LAMA_PELAKSANAAN AS LAMA_PELAKSANAAN,
				    DASAR.TOTAL_PELAKSANAAN AS TOTAL_PELAKSANAAN,
				    DASAR.JANUARI AS JANUARI,
					DASAR.FEBRUARI AS FEBRUARI,
					DASAR.MARET AS MARET,
					DASAR.APRIL AS APRIL,
					DASAR.MEI AS MEI,
					DASAR.JUNI AS JUNI,
					DASAR.JULI AS JULI,
					DASAR.AGUSTUS AS AGUSTUS,
					DASAR.SEPTEMBER AS SEPTEMBER,
					DASAR.OKTOBER AS OKTOBER,
					DASAR.NOVEMBER AS NOVEMBER,
					DASAR.DESEMBER AS DESEMBER,
					DASAR.TANGGAL_INPUT,
					DASAR.JENIS_RAPAT,
					DASAR.STS_TAMBAHAN,
				    DASAR.PERIODE AS PERIODE,
				    'RKAP' AS EPISODE
				FROM stp_anggaran_dasar DASAR
				LEFT JOIN stp_kode_barang BRG ON BRG.KODE_BARANG = DASAR.ID_JENIS_ANGGARAN
			) a
			WHERE a.KODE_ANGGARAN = '$kode_anggaran'
		";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function update_sts_revisi($kode_anggaran){
		$tgl_revisi = date("d-m-Y");
		$sql = "
			UPDATE stp_anggaran_dasar SET 
				STS_REVISI = 5,
				TGL_REVISI = '$tgl_revisi'
			WHERE KODE_ANGGARAN = '$kode_anggaran'
		";
		$this->db->query($sql);
	}

}

?>