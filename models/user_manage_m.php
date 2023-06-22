<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_manage_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}


	function get_all_pegawai(){
		$sql = "
			SELECT a.*, b.NAMA AS BAGIAN, c.NAMA AS SUB_BAGIAN FROM stp_pegawai a 
			LEFT JOIN stp_departemen b ON a.ID_DEPARTEMEN = b.ID 
			LEFT JOIN stp_divisi c ON a.ID_DIVISI = c.ID 
			ORDER BY a.ID 
		";
		return $this->db->query($sql)->result();
	}

	function get_pegawai_by_id($id_peg){
		$sql = "
			SELECT * FROM stp_pegawai 
			WHERE ID = $id_peg
			ORDER BY ID 
		";
		return $this->db->query($sql)->row();
	}

	function cek_username($username){
		$sql = "
			SELECT COUNT(*) AS JML FROM stp_pegawai 
			WHERE USERNAME = '$username'
		";
		return $this->db->query($sql)->row()->JML;
	}

	function update_user_login($id_peg, $username, $sts, $level_akun){
		$sql = "
			UPDATE stp_pegawai SET USERNAME = '$username', STATUS = $sts, LEVEL = '$level_akun'
			WHERE ID = $id_peg
		";
		$this->db->query($sql);
	}

	function update_user_password($id_peg, $pass){
		$sql = "
			UPDATE stp_pegawai SET PASSWORD = '$pass'
			WHERE ID = $id_peg
		";
		$this->db->query($sql);
	}

	function get_user_detail($id_user){
        $sql = "
            SELECT a.*, b.NAMA AS DEPARTEMEN_USER, c.NAMA AS DIVISI_USER
            FROM stp_pegawai a
            LEFT JOIN stp_departemen b ON a.ID_DEPARTEMEN = b.ID 
            LEFT JOIN stp_divisi c ON a.ID_DIVISI = c.ID
            WHERE ID = $id_user
        ";
        return $this->db->query($sql)->row();
    }


}

?>