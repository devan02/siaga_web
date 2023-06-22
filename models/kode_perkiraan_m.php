<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kode_perkiraan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_koper_all($key){
		$where = "1 = 1";
		if($key != ""){
			$where = $where." AND (KODE_PERKIRAAN LIKE '%$key%' OR NAMA_PERKIRAAN LIKE '%$key%')";
		}
		$sql = "SELECT * FROM stp_setup_kode_perkiraan WHERE $where ORDER BY KODE_PERKIRAAN ASC LIMIT 0,10";
		return $this->db->query($sql)->result();
	}

	function get_koper_id($id_koper){
		$sql = "SELECT * FROM stp_setup_kode_perkiraan WHERE ID = '$id_koper'";
		$query = $this->db->query($sql);
		return $query->row();
	}

}

?>