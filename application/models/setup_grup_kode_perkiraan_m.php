<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup_grup_kode_perkiraan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_sub_grup_koper(){
		$sql = "
			SELECT * FROM stp_setup_grup ORDER BY ID DESC
		";
		return $this->db->query($sql)->result();
	}

	function simpan_grup_koper($kode_grup, $kode_sub, $nama_grup, $sub_grup1, $sub_grup2, $sub_grup3){
		$sql = "
			INSERT INTO stp_setup_grup 
			(KP_GRUP, KP_SUB, GRUP, SUB_GRUP1, SUB_GRUP2, SUB_GRUP3)
			VALUES
			('$kode_grup', '$kode_sub', '$nama_grup', '$sub_grup1', '$sub_grup2', '$sub_grup3')
		";
		$this->db->query($sql);
	}

	function get_sub_grup_koper_by_id($id){
		$sql = "
			SELECT * FROM stp_setup_grup WHERE ID = $id
		";
		return $this->db->query($sql)->row();
	}

	function hapus_grup($id_hapus){
		$sql = "
			DELETE FROM stp_setup_grup WHERE ID = $id_hapus
		";
		$this->db->query($sql);
	}

	function edit_grup($id_edit, $kode_grup_ed, $kode_sub_ed, $nama_grup_ed, $sub_grup1_ed, $sub_grup2_ed, $sub_grup3_ed){
		$sql = "
			UPDATE stp_setup_grup SET 
				KP_GRUP = '$kode_grup_ed', 
				KP_SUB  = '$kode_sub_ed', 
				GRUP    = '$nama_grup_ed', 
				SUB_GRUP1 = '$sub_grup1_ed', 
				SUB_GRUP2 = '$sub_grup2_ed',
				SUB_GRUP3 = '$sub_grup3_ed'
			WHERE ID = $id_edit
		";
		$this->db->query($sql);
	}

	function cek_grup_sub($kode_grup, $kode_sub){
		$sql = "
			SELECT * FROM stp_setup_grup WHERE KP_GRUP = '$kode_grup' AND KP_SUB = '$kode_sub'
		";
		return $this->db->query($sql)->result();
	}

}

?>