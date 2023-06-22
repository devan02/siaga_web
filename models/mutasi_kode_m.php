<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mutasi_kode_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_log_user(){
		$sql = "
			SELECT a.*, b.NAMA AS NAMA_PEGAWAI, b.USERNAME FROM stp_log_user a 
			LEFT JOIN stp_pegawai b ON a.ID_PEGAWAI = b.ID
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function simpan_mutasi_jns_ag($id_ag, $jenis_ag_ed){
		$sql = "
			INSERT INTO stp_mutasi_anggaran
			(ID_ANGGARAN, JENIS_ANGGARAN)
			VALUES
			($id_ag, '$jenis_ag_ed')
		";

		$this->db->query($sql);
	}

	function update_jns_ag($id_ag, $jns_ag_ed){
		$sql = "
			UPDATE stp_anggaran_dasar SET JENIS_ANGGARAN = '$jns_ag_ed'
			WHERE ID_ANGGARAN = $id_ag
		";

		$this->db->query($sql);
	}

	function simpan_mutasi_dep_div($val, $id_dep2, $id_div2){
		$sql = "
			INSERT INTO stp_mutasi_anggaran
			(ID_ANGGARAN, DEPARTEMEN, DIVISI)
			VALUES
			($id_ag, $id_dep2, $id_div2)
		";

		$this->db->query($sql);
	}

	function update_dep_div_ag($id_ag, $departemen_ed, $divisi_ed){
		$sql = "
			UPDATE stp_anggaran_dasar SET DEPARTEMEN = $departemen_ed, DIVISI = $divisi_ed
			WHERE ID_ANGGARAN = $id_ag
		";

		$this->db->query($sql);
	}

}

?>