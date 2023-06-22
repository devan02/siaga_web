<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_aktifitas_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_log_user(){
		$sql = "
			SELECT a.*, b.NAMA AS NAMA_PEGAWAI, b.USERNAME FROM stp_log_user a 
			LEFT JOIN stp_pegawai b ON a.ID_PEGAWAI = b.ID
			ORDER BY a.ID DESC
		";
		$query = $this->db->query($sql);
		return $query->result();
	}


}

?>