<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kunci_anggaran_m extends CI_Model
{ 
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_kunci($kriteria,$setting_kunci,$departemen,$divisi,$tgl_awal,$tgl_akhir,$tahun, $value_kunci){
		$value = "";

		if($kriteria == "departemen"){

			$sql_del = "
			DELETE FROM stp_kunci_anggaran 
			WHERE DEPARTEMEN = '$departemen' AND DIVISI = 0 AND TAHUN = '$tahun' AND NAMA_MENU_KUNCI = '$value_kunci'
			";

			$this->db->query($sql_del);


			$value = "
				'$departemen',
				0,
				'$tgl_awal',
				'$tgl_akhir',
				'$tahun',
				'$value_kunci'
			";
		}else{

			$sql_del = "
			DELETE FROM stp_kunci_anggaran 
			WHERE DEPARTEMEN = '$departemen' AND DIVISI = $divisi AND TAHUN = '$tahun' AND NAMA_MENU_KUNCI = '$value_kunci'
			";

			$this->db->query($sql_del);

			$value = "
				'$departemen',
				'$divisi',
				'$tgl_awal',
				'$tgl_akhir',
				'$tahun',
				'$value_kunci'
			";
		}

		if($setting_kunci == "all_dep"){

			$sql_del_all = "
			DELETE FROM stp_kunci_anggaran 
			WHERE DIVISI = 0 AND TAHUN = '$tahun' AND NAMA_MENU_KUNCI = '$value_kunci'
			";

			$this->db->query($sql_del_all);

			$sql_dep = "SELECT ID FROM stp_departemen";
			$query_dep = $this->db->query($sql_dep)->result();

			foreach ($query_dep as $value_dep) {
				$id_dep = $value_dep->ID;
				$insert = "
					INSERT INTO stp_kunci_anggaran(
						DEPARTEMEN,
						DIVISI,
						TGL_AWAL,
						TGL_AKHIR,
						TAHUN,
						NAMA_MENU_KUNCI
					)VALUES(
						$id_dep,
						0,
						'$tgl_awal',
						'$tgl_akhir',
						'$tahun',
						'$value_kunci'
					)
				";
				$this->db->query($insert);
			}
		}else{
			$sql = "
				INSERT INTO stp_kunci_anggaran(
					DEPARTEMEN,
					DIVISI,
					TGL_AWAL,
					TGL_AKHIR,
					TAHUN,
					NAMA_MENU_KUNCI
				)VALUES(
					$value
				)
			";
			$this->db->query($sql);
		}
	}

	function simpan_det_kunci($id_kunci,$nama_menu){
		$sql = "INSERT INTO stp_detail_kunci_anggaran(ID_KUNCI,NAMA_MENU_KUNCI) VALUE('$id_kunci','$nama_menu')";
		$this->db->query($sql);
	}

	function get_all_kunci(){

		$now = date('d-m-Y');

		$sql = "
		SELECT a.ID, a.NAMA_MENU_KUNCI, a.TAHUN, a.TGL_AWAL, a.TGL_AKHIR, dep.NAMA AS NAMA_DEP, IFNULL(divi.NAMA, '-') AS NAMA_DIV FROM stp_kunci_anggaran a 
		LEFT JOIN stp_departemen dep ON a.DEPARTEMEN = dep.ID
		LEFT JOIN stp_divisi divi ON a.DIVISI = divi.ID
		WHERE STR_TO_DATE(a.TGL_AKHIR, '%d-%m-%Y') >= STR_TO_DATE('$now', '%d-%m-%Y') 
		";

		$query = $this->db->query($sql);
		return $query->result();
	}

	function delete_kunci($id_hapus){
		$sql = "DELETE FROM stp_kunci_anggaran WHERE ID = $id_hapus";
		$this->db->query($sql);
	}

}

?>