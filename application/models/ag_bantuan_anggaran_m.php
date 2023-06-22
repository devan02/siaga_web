<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ag_bantuan_anggaran_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}
	
	function insert_data(
		$URAIAN,
		$KELOMPOK_PELANGGAN,
		$JENIS_KELOMPOK_PELANGGAN,
		$TARIF,
		$TAHUN,
		$JANUARI,
		$FEBRUARI,
		$MARET,
		$APRIL,
		$MEI,
		$JUNI,
		$JULI,
		$AGUSTUS,
		$SEPTEMBER,
		$OKTOBER,
		$NOVEMBER,
		$DESEMBER,
		$JUMLAH,
		$ESTIMASI_2014,
		$ESTIMASI_DES_2014,
		$PERIODE){

		$sql = "INSERT INTO stp_sambungan_pelanggan(
			URAIAN,
			KELOMPOK_PELANGGAN,
			JENIS_KELOMPOK_PELANGGAN,
			TARIF,
			TAHUN,
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
			JUMLAH,
			ESTIMASI_2014,
			ESTIMASI_DES_2014,
			PERIODE
		)VALUES(
			'$URAIAN',
			'$KELOMPOK_PELANGGAN',
			'$JENIS_KELOMPOK_PELANGGAN',
			'$TARIF',
			'$TAHUN',
			'$JANUARI',
			'$FEBRUARI',
			'$MARET',
			'$APRIL',
			'$MEI',
			'$JUNI',
			'$JULI',
			'$AGUSTUS',
			'$SEPTEMBER',
			'$OKTOBER',
			'$NOVEMBER',
			'$DESEMBER',
			'$JUMLAH',
			'$ESTIMASI_2014',
			'$ESTIMASI_DES_2014',
			'$PERIODE'
		)";
		$this->db->query($sql);
	}

}