<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kode_anggaran_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function add_leading_zero($value, $threshold = 2) {
	    return sprintf('%0' . $threshold . 's', $value);
	}

	function kode_anggaran($departemen,$tahun){
		$deparray = array(
			'KEUANGAN' => 'KEU',
			'DISTRIBUSI' => 'DIS',
			'FUNGSIONAL (SPI)' => 'FNGS',
			'HUBLANG' => 'HUBL',
			'KEPEGAWAIAN' => 'KEPEG',
			'PERENCANAAN' => 'PERNC',
			'PRODUKSI' => 'PRO',
			'UMUM' => 'UMUM'
		);

		$dep_ex = $deparray[$departemen];
		$sql = "SELECT COUNT(*) AS JUMLAH FROM stp_kode_anggaran WHERE DEPARTEMEN = '$departemen' AND TAHUN = $tahun";
		$jumlah = $this->db->query($sql)->row()->JUMLAH;

		if($jumlah != 0){
			//IT/001/2016
			$query = "SELECT * FROM stp_kode_anggaran WHERE DEPARTEMEN = '$departemen' AND TAHUN = $tahun";
			$data = $this->db->query($query)->row();
			$dep = $deparray[$data->DEPARTEMEN];
			$next = $data->NEXT+1;
			$tahun = $data->TAHUN;
			$kode = $this->add_leading_zero($next, 3);
			$kode_anggaran = $dep.'/'.$kode.'/'.$tahun;
		}else{
			$kode_anggaran = $dep_ex.'/001/'.$tahun;
		}

		return $kode_anggaran;
	}

	function kode_anggaran_revisi($departemen,$tahun){
		$deparray = array(
			'KEUANGAN' => 'KEU',
			'DISTRIBUSI' => 'DIS',
			'FUNGSIONAL (SPI)' => 'FNGS',
			'HUBLANG' => 'HUBL',
			'KEPEGAWAIAN' => 'KEPEG',
			'PERENCANAAN' => 'PERNC',
			'PRODUKSI' => 'PRO',
			'UMUM' => 'UMUM'
		);

		$dep_ex = $deparray[$departemen];
		$sql = "SELECT COUNT(*) AS JUMLAH FROM stp_kode_anggaran WHERE DEPARTEMEN = '$departemen' AND TAHUN = $tahun";
		$jumlah = $this->db->query($sql)->row()->JUMLAH;

		if($jumlah != 0){
			//IT/001/2016
			$query = "SELECT * FROM stp_kode_anggaran WHERE DEPARTEMEN = '$departemen' AND TAHUN = $tahun";
			$data = $this->db->query($query)->row();
			$dep = $deparray[$data->DEPARTEMEN];
			$next = $data->NEXT+1;
			$tahun = $data->TAHUN;
			$kode = $this->add_leading_zero($next, 3);
			$kode_anggaran = $dep.'/'.$kode.'/REV/'.$tahun;
		}else{
			$kode_anggaran = $dep_ex.'/001/REV'.$tahun;
		}

		return $kode_anggaran;
	}

	function cek_kode_anggaran($departemen,$tahun){
		$sql = "SELECT COUNT(*) AS JUMLAH FROM stp_kode_anggaran WHERE DEPARTEMEN = '$departemen' AND TAHUN = $tahun";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function insert_kode_baru($departemen,$next,$tahun,$id_departemen){
		$sql = "
			INSERT INTO stp_kode_anggaran(
				DEPARTEMEN,
				NEXT,
				TAHUN,
				ID_DEPARTEMEN
			)VALUES(
				'$departemen',
				'$next',
				'$tahun',
				'$id_departemen'
			)
		";
		$this->db->query($sql);
	}

	function update_kode_ag($departemen,$tahun,$next){
		$sql = "UPDATE stp_kode_anggaran SET NEXT = $next WHERE DEPARTEMEN = '$departemen' AND TAHUN = $tahun";
		$this->db->query($sql);
	}

	function sumber_dana(){
		$sql_sumber_dana = "SELECT * FROM stp_sumber_dana WHERE AKTIF = 1";
		$query_sumber_dana = $this->db->query($sql_sumber_dana);
		return $query_sumber_dana->result();
	}

}

?>