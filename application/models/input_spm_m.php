<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_spm_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_all_spm(){
		$sql = "
		SELECT * FROM stp_input_spm 
		WHERE AKTIF = 1
		ORDER BY ID DESC
		";

		return $this->db->query($sql)->result();
	}

	function get_spm_by_id($id){
		$sql = "
		SELECT * FROM stp_input_spm 
		WHERE ID = $id
		";

		return $this->db->query($sql)->row();
	}

	function simpan_spm($no_spm, $tgl_spm, $keterangan, $nilai_spm){

		$keterangan = addslashes($keterangan);

		$sql = "
		INSERT INTO stp_input_spm
		(NO_SPM, TGL_SPM, KET, NILAI, AKTIF)
		VALUES
		('$no_spm', '$tgl_spm', '$keterangan', $nilai_spm, 1)
 		";

		$this->db->query($sql);
	}

	function edit_spm($no_spm, $tgl_spm, $keterangan, $nilai_spm){

		$keterangan = addslashes($keterangan);

		$sql = "
		UPDATE stp_input_spm SET TGL_SPM = '$tgl_spm', KET = '$keterangan', NILAI = $nilai_spm
		WHERE NO_SPM = '$no_spm'
 		";

		$this->db->query($sql);
	}


	function delete_spm($id_hapus){
		$sql = "
		UPDATE stp_input_spm SET AKTIF = 0 WHERE ID = $id_hapus
		";
		$this->db->query($sql);
	}

	function cek_tahun_spm($thn, $bln){
		$sql = "
			SELECT * FROM stp_nomor_spm WHERE TAHUN = $thn AND BULAN = $bln
		";
		return $this->db->query($sql)->result();
	}

	function simpan_nomor_spm($thn, $bln){
		$sql = "
			INSERT INTO stp_nomor_spm
			(TAHUN, NEXT, BULAN)
			VALUES
			($thn, 1, $bln)
		";
		$this->db->query($sql);
	}

	function get_next_nomor_spm($thn, $bln){
		$sql = "
			SELECT * FROM stp_nomor_spm WHERE TAHUN = $thn AND BULAN = $bln
		";
		return $this->db->query($sql)->row();
	}

	function save_next_spm($tahun, $bln){
		$sql = "
			UPDATE stp_nomor_spm SET NEXT = NEXT+1
			WHERE TAHUN = $tahun AND BULAN = $bln
		";
		$this->db->query($sql);
	}
}

?>