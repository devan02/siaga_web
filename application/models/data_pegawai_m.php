<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_pegawai_m extends CI_Model
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
			WHERE a.STATUS = 1
			ORDER BY a.ID 
		";
		return $this->db->query($sql)->result();
	}

	function hapus_pegawai($id_hapus){
		$sql = "
			DELETE FROM stp_pegawai WHERE ID = $id_hapus
		";
		$this->db->query($sql);
	}

}

?>