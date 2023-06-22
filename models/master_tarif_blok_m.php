<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_tarif_blok_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_data_tarif_blok($keyword){
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND KELOMPOK_PELANGGAN LIKE '%$keyword%'";
		}
		$sql = "SELECT * FROM stp_master_tarif_blok WHERE $where";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_jenis_kelompok_pel(){
		$sql = "
		SELECT JENIS_KELOMPOK_PELANGGAN FROM stp_master_tarif_blok
		GROUP BY JENIS_KELOMPOK_PELANGGAN
		";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_tarif_id($id_tarif){
		$sql = "SELECT * FROM stp_master_tarif_blok WHERE ID = $id_tarif";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data($id_tarif,$kelompok_pelanggan,$blok_1_kurang_dr_sepuluh,$blok_2_lebih_dr_sepuluh,$blok_1_kurang_dr_sepuluh2,$blok_2_lebih_dr_sepuluh2, $sts){

		$blok_1_kurang_dr_sepuluh = str_replace(',', '', $blok_1_kurang_dr_sepuluh);
		$blok_2_lebih_dr_sepuluh = str_replace(',', '', $blok_2_lebih_dr_sepuluh);
		$blok_1_kurang_dr_sepuluh2 = str_replace(',', '', $blok_1_kurang_dr_sepuluh2);
		$blok_2_lebih_dr_sepuluh2 = str_replace(',', '', $blok_2_lebih_dr_sepuluh2);

		$sql = "
			UPDATE stp_master_tarif_blok SET
				KELOMPOK_PELANGGAN = '$kelompok_pelanggan',
				BLOK_1 = '$blok_1_kurang_dr_sepuluh',
				BLOK_2 = '$blok_2_lebih_dr_sepuluh',
				TARIF_NAIK_BLOK_1 = '$blok_1_kurang_dr_sepuluh2',
				TARIF_NAIK_BLOK_2 = '$blok_2_lebih_dr_sepuluh2',
				STATUS = $sts
			WHERE ID = $id_tarif
		";
		$this->db->query($sql);
	}

	function cek_tarif($kp){
		$sql = "
			SELECT 
				TARIF.ID,
				TARIF.KELOMPOK_PELANGGAN,
				TARIF.BLOK_1,
				TARIF.BLOK_2,
				TARIF.TARIF_NAIK_BLOK_1,
				TARIF.TARIF_NAIK_BLOK_2
			FROM stp_master_tarif_blok TARIF
			WHERE TARIF.JENIS_KELOMPOK_PELANGGAN = '$kp'
		";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function simpan_data($kelompok_pelanggan,$blok_1_kurang_dr_sepuluh,$blok_2_lebih_dr_sepuluh,$blok_1_kurang_dr_sepuluh2,$blok_2_lebih_dr_sepuluh2, $sts, $jkp){
		
		$blok_1_kurang_dr_sepuluh = str_replace(',', '', $blok_1_kurang_dr_sepuluh);
		$blok_2_lebih_dr_sepuluh = str_replace(',', '', $blok_2_lebih_dr_sepuluh);
		$blok_1_kurang_dr_sepuluh2 = str_replace(',', '', $blok_1_kurang_dr_sepuluh2);
		$blok_2_lebih_dr_sepuluh2 = str_replace(',', '', $blok_2_lebih_dr_sepuluh2);

		$sql = "
		INSERT INTO stp_master_tarif_blok
		(KELOMPOK_PELANGGAN, BLOK_1, BLOK_2, TARIF_NAIK_BLOK_1, TARIF_NAIK_BLOK_2, STATUS, JENIS_KELOMPOK_PELANGGAN)
		VALUES
		('$kelompok_pelanggan', '$blok_1_kurang_dr_sepuluh', '$blok_2_lebih_dr_sepuluh', '$blok_1_kurang_dr_sepuluh2', '$blok_2_lebih_dr_sepuluh2', $sts, '$jkp')
		";

		$this->db->query($sql);
	}

}