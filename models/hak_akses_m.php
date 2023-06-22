<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hak_akses_m extends CI_Model
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

	function get_all_pegawai(){
		$sql = "
			SELECT a.*, b.NAMA AS BAGIAN, c.NAMA AS SUB_BAGIAN FROM stp_pegawai a 
			LEFT JOIN stp_departemen b ON a.ID_DEPARTEMEN = b.ID 
			LEFT JOIN stp_divisi c ON a.ID_DIVISI = c.ID 
			ORDER BY a.ID 
		";
		return $this->db->query($sql)->result();
	}

	function get_menu_lev1(){
        $sql = "
            SELECT * FROM stp_menu_lev1
            ORDER BY URUT ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_menu_lev2($id_induk_menu){
        $sql = "
            SELECT * FROM stp_menu_lev2
            WHERE ID_INDUK_MENU = $id_induk_menu
            ORDER BY URUT ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_menu_lev1_with_peg($id_peg){
    	$sql = "
            SELECT a.*, hak.ID_PEGAWAI AS STS FROM stp_menu_lev1 a
            LEFT JOIN stp_hak_akses hak ON a.ID = hak.ID_MENU2 AND hak.ID_PEGAWAI = $id_peg
            ORDER BY a.URUT ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_menu_lev2_peg($id_induk_menu, $id_peg){
        $sql = "
            SELECT a.*, hak.ID_PEGAWAI AS STS FROM stp_menu_lev2 a
            LEFT JOIN stp_hak_akses hak ON a.ID = hak.ID_MENU1 AND hak.ID_PEGAWAI = $id_peg
            WHERE a.ID_INDUK_MENU = $id_induk_menu
            ORDER BY a.URUT ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_pegawai_by_id($id_peg){
    	$sql = "
            SELECT a.*, dep.NAMA AS DEPARTEMEN_NAMA, diva.NAMA AS DIVISI_NAMA FROM stp_pegawai a
            LEFT JOIN stp_departemen dep ON a.ID_DEPARTEMEN = dep.ID
            LEFT JOIN stp_divisi diva ON a.ID_DIVISI = diva.ID
            WHERE a.ID = $id_peg
        ";

        return $this->db->query($sql)->row();
    }

    function delete_hak_akses($id_peg){

    	$sql = "
    	DELETE FROM stp_hak_akses WHERE ID_PEGAWAI = $id_peg
    	";

    	$this->db->query($sql);
    }

    function simpan_hak_akses($id_peg, $menu1){

    	$sql = "
    	INSERT INTO stp_hak_akses
    	(ID_PEGAWAI, ID_MENU1)
    	VALUES
    	($id_peg, $menu1)
    	";

    	$this->db->query($sql);
    }

    function simpan_hak_akses2($id_peg, $menu2){
    	
    	$sql = "
    	INSERT INTO stp_hak_akses
    	(ID_PEGAWAI, ID_MENU2)
    	VALUES
    	($id_peg, $menu2)
    	";

    	$this->db->query($sql);
    }

}

?>