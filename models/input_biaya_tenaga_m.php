<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_biaya_tenaga_m extends CI_Model
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

    function get_data_tenaga_kerja($no_gol, $tahun, $periode){

        $tbl = "stp_biaya_tenaga_kerja";

        if($periode == 2){
        $tbl = "stp_biaya_tenaga_kerja_revisi";
        }

        $sql = "
            SELECT a.*, b.* FROM stp_setup_biaya_tenaga_kerja a
            LEFT JOIN(
                SELECT 
                    ID_GOL,
                    TAHUN,
                    STS AS STS_B,
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
                    IFNULL(DESEMBER,0) AS DES,
                    IFNULL(JUMLAH,0) AS JML
                FROM $tbl
            ) b ON a.ID = b.ID_GOL AND b.TAHUN = $tahun AND b.STS_B = 'PEG'
            WHERE a.NO = '$no_gol'
            ORDER BY a.ID 
        ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function delete_biaya_tenaga_kerja($no_gol, $tahun, $periode){
        $tbl = "stp_biaya_tenaga_kerja";

        if($periode == 2){
        $tbl = "stp_biaya_tenaga_kerja_revisi";
        }

        $sql = "
            DELETE FROM $tbl WHERE NO_GOL = '$no_gol' AND TAHUN = $tahun AND STS = 'PEG'
        ";

        $this->db->query($sql);
    }

    function simpan_biaya_tenaga_kerja($periode, $id_judul, $tahun, $no_gol, $JML,  $JAN, $FEB, $MAR, $APR, $MEI, $JUN, $JUL, $AGU, $SEP, $OKT, $NOP, $DES){

        $tbl = "stp_biaya_tenaga_kerja";

        if($periode == 2){
        $tbl = "stp_biaya_tenaga_kerja_revisi";
        }

        $sql = "
        INSERT INTO $tbl
        (ID_GOL, TAHUN, NO_GOL, JUMLAH, JANUARI, FEBRUARI, MARET, APRIL, MEI, JUNI, JULI, AGUSTUS, SEPTEMBER, OKTOBER, NOVEMBER, DESEMBER, STS)
        VALUES 
        ($id_judul, $tahun, '$no_gol', $JML,  $JAN, $FEB, $MAR, $APR, $MEI, $JUN, $JUL, $AGU, $SEP, $OKT, $NOP, $DES, 'PEG')
        ";

        $this->db->query($sql);
    }

}

?>