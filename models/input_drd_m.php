<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_drd_m extends CI_Model
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

	function get_nilai_blok($periode, $tahun){
		$sql = "
			SELECT 
				a.KELOMPOK_PELANGGAN,
				a.ID,
				IFNULL(b.JAN,0) AS JAN,
            	IFNULL(b.FEB,0) AS FEB,
            	IFNULL(b.MAR,0) AS MAR,
            	IFNULL(b.APR,0) AS APR,
            	IFNULL(b.MEI,0) AS MEI,
            	IFNULL(b.JUN,0) AS JUN,
            	IFNULL(b.JUL,0) AS JUL,
            	IFNULL(b.AGU,0) AS AGU,
            	IFNULL(b.SEP,0) AS SEP,
            	IFNULL(b.OKT,0) AS OKT,
            	IFNULL(b.NOP,0) AS NOP,
            	IFNULL(b.DES,0) AS DES
			FROM stp_master_tarif_blok a
			LEFT JOIN(
				SELECT 
					ID_BLOK,
					IFNULL(JANUARI,0) AS JAN,
                	IFNULL(FEBRUARI,0) AS FEB,
                	IFNULL(MARET,0) AS MAR,
                	IFNULL(APRIL,0) AS APR,
                	IFNULL(MEI,0) AS MEI,
                	IFNULL(JUNI,0) AS JUN,
                	IFNULL(JULI,0) AS JUL,
                	IFNULL(AGUSTUS,0) AS AGU,
                	IFNULL(SEPTEMBER,0) AS SEP,
                	IFNULL(OKTOBER,0) AS OKT,
                	IFNULL(NOVEMBER,0) AS NOP,
                	IFNULL(DESEMBER,0) AS DES
				FROM stp_realisasi_drd
				WHERE TAHUN = $tahun AND PERIODE = $periode
			) b ON a.ID = b.ID_BLOK
		";

		return $this->db->query($sql)->result();
	}

	function delete_nilai_blok($tahun, $periode){
		$sql = "
			DELETE FROM stp_realisasi_drd WHERE TAHUN = $tahun AND PERIODE = $periode
		";
		$this->db->query($sql);
	}

	function save_nilai_blok($tahun, $periode, $id_blok,  $JAN, $FEB, $MAR, $APR, $MEI, $JUN, $JUL, $AGU, $SEP, $OKT, $NOP, $DES){

		$JAN 	 = str_replace(',', '', $JAN);
		$FEB 	 = str_replace(',', '', $FEB);
		$MAR 	 = str_replace(',', '', $MAR);
		$APR 	 = str_replace(',', '', $APR);
		$MEI 	 = str_replace(',', '', $MEI);
		$JUN 	 = str_replace(',', '', $JUN);
		$JUL 	 = str_replace(',', '', $JUL);
		$AGU 	 = str_replace(',', '', $AGU);
		$SEP 	 = str_replace(',', '', $SEP);
		$OKT 	 = str_replace(',', '', $OKT);
		$NOP 	 = str_replace(',', '', $NOP);
		$DES 	 = str_replace(',', '', $DES);

		$sql = "
			INSERT INTO stp_realisasi_drd
			(TAHUN, PERIODE, ID_BLOK, JANUARI, FEBRUARI, MARET, APRIL, MEI, JUNI, JULI, AGUSTUS, SEPTEMBER, OKTOBER, NOVEMBER, DESEMBER)
			VALUES
			($tahun, $periode, $id_blok,  $JAN, $FEB, $MAR, $APR, $MEI, $JUN, $JUL, $AGU, $SEP, $OKT, $NOP, $DES)
		";

		$this->db->query($sql);
	}
}

?>