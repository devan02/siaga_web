<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rencana_biaya_tk_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_biaya_tenaga_kerja($tahun,  $periode){

        $tbl = "stp_biaya_tenaga_kerja";

        if($periode == 2){
        $tbl = "stp_biaya_tenaga_kerja_revisi";
        }

        $sql = "
        
        SELECT 
        a.*, 
        (a.JAN + a.FEB + a.MAR + a.APR + a.MEI + a.JUN + a.JUL + a.AGU + a.SEP + a.OKT + a.NOP + a.DES) AS TOTAL
        FROM (
            SELECT 
            a.NO, 
            a.INDUK, 
            a.JUDUL, 
            a.STS_NO,
            IFNULL(b.JAN ,0) AS JAN,
            IFNULL(b.FEB ,0) AS FEB,
            IFNULL(b.MAR ,0) AS MAR,
            IFNULL(b.APR ,0) AS APR,
            IFNULL(b.MEI ,0) AS MEI,
            IFNULL(b.JUN ,0) AS JUN,
            IFNULL(b.JUL ,0) AS JUL,
            IFNULL(b.AGU ,0) AS AGU,
            IFNULL(b.SEP ,0) AS SEP,
            IFNULL(b.OKT ,0) AS OKT,
            IFNULL(b.NOP ,0) AS NOP,
            IFNULL(b.DES ,0) AS DES,
            IFNULL(b.JML ,0) AS JML,
            IFNULL(LALU.TOTAL_LALU ,0) AS TOTAL_LALU
            FROM stp_setup_biaya_tenaga_kerja a
            LEFT JOIN(
                SELECT 
                    ID_GOL,
                    TAHUN,
                    IFNULL(SUM(JANUARI),0) AS JAN,
                    IFNULL(SUM(FEBRUARI),0) AS FEB,
                    IFNULL(SUM(MARET),0) AS MAR,
                    IFNULL(SUM(APRIL),0) AS APR,
                    IFNULL(SUM(MEI),0) AS MEI,
                    IFNULL(SUM(JUNI),0) AS JUN,
                    IFNULL(SUM(JULI),0) AS JUL,
                    IFNULL(SUM(AGUSTUS),0) AS AGU,
                    IFNULL(SUM(SEPTEMBER),0) AS SEP,
                    IFNULL(SUM(OKTOBER),0) AS OKT,
                    IFNULL(SUM(NOVEMBER),0) AS NOP,
                    IFNULL(SUM(DESEMBER),0) AS DES,
                    IFNULL(SUM(JUMLAH),0) AS JML
                FROM $tbl
                GROUP BY ID_GOL, TAHUN
            ) b ON a.ID = b.ID_GOL AND b.TAHUN = $tahun

            LEFT JOIN(

                SELECT a.ID_GOL, a.TAHUN, (a.JAN + a.FEB + a.MAR + a.APR + a.MEI + a.JUN + a.JUL + a.AGU + a.SEP + a.OKT + a.NOP + a.DES) AS TOTAL_LALU
                FROM ( 
                    SELECT
                        a.ID_GOL,
                        a.TAHUN,
                        IFNULL(a.JAN ,0) AS JAN,
                        IFNULL(a.FEB ,0) AS FEB,
                        IFNULL(a.MAR ,0) AS MAR,
                        IFNULL(a.APR ,0) AS APR,
                        IFNULL(a.MEI ,0) AS MEI,
                        IFNULL(a.JUN ,0) AS JUN,
                        IFNULL(a.JUL ,0) AS JUL,
                        IFNULL(a.AGU ,0) AS AGU,
                        IFNULL(a.SEP ,0) AS SEP,
                        IFNULL(a.OKT ,0) AS OKT,
                        IFNULL(a.NOP ,0) AS NOP,
                        IFNULL(a.DES ,0) AS DES
                        FROM (
                            SELECT 
                                ID_GOL,
                                TAHUN,
                                IFNULL(SUM(JANUARI),0) AS JAN,
                                IFNULL(SUM(FEBRUARI),0) AS FEB,
                                IFNULL(SUM(MARET),0) AS MAR,
                                IFNULL(SUM(APRIL),0) AS APR,
                                IFNULL(SUM(MEI),0) AS MEI,
                                IFNULL(SUM(JUNI),0) AS JUN,
                                IFNULL(SUM(JULI),0) AS JUL,
                                IFNULL(SUM(AGUSTUS),0) AS AGU,
                                IFNULL(SUM(SEPTEMBER),0) AS SEP,
                                IFNULL(SUM(OKTOBER),0) AS OKT,
                                IFNULL(SUM(NOVEMBER),0) AS NOP,
                                IFNULL(SUM(DESEMBER),0) AS DES
                            FROM $tbl
                            GROUP BY ID_GOL, TAHUN
                        ) a
                    )a
            ) LALU ON a.ID = LALU.ID_GOL AND LALU.TAHUN = $tahun - 1
        
            ORDER BY a.ID
        ) a
        ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_data_biaya_tenaga_kerja_peg($tahun,  $periode){

        $tbl = "stp_biaya_tenaga_kerja";

        if($periode == 2){
        $tbl = "stp_biaya_tenaga_kerja_revisi";
        }

        $sql = "
        
        SELECT 
        a.*, 
        (a.JAN + a.FEB + a.MAR + a.APR + a.MEI + a.JUN + a.JUL + a.AGU + a.SEP + a.OKT + a.NOP + a.DES) AS TOTAL
        FROM (
            SELECT 
            a.NO, 
            a.INDUK, 
            a.JUDUL, 
            a.STS_NO,
            IFNULL(b.JAN ,0) AS JAN,
            IFNULL(b.FEB ,0) AS FEB,
            IFNULL(b.MAR ,0) AS MAR,
            IFNULL(b.APR ,0) AS APR,
            IFNULL(b.MEI ,0) AS MEI,
            IFNULL(b.JUN ,0) AS JUN,
            IFNULL(b.JUL ,0) AS JUL,
            IFNULL(b.AGU ,0) AS AGU,
            IFNULL(b.SEP ,0) AS SEP,
            IFNULL(b.OKT ,0) AS OKT,
            IFNULL(b.NOP ,0) AS NOP,
            IFNULL(b.DES ,0) AS DES,
            IFNULL(b.JML ,0) AS JML,
            IFNULL(LALU.TOTAL_LALU ,0) AS TOTAL_LALU
            FROM stp_setup_biaya_tenaga_kerja a
            LEFT JOIN(
                SELECT 
                    ID_GOL,
                    TAHUN,
                    STS,
                    IFNULL(SUM(JANUARI),0) AS JAN,
                    IFNULL(SUM(FEBRUARI),0) AS FEB,
                    IFNULL(SUM(MARET),0) AS MAR,
                    IFNULL(SUM(APRIL),0) AS APR,
                    IFNULL(SUM(MEI),0) AS MEI,
                    IFNULL(SUM(JUNI),0) AS JUN,
                    IFNULL(SUM(JULI),0) AS JUL,
                    IFNULL(SUM(AGUSTUS),0) AS AGU,
                    IFNULL(SUM(SEPTEMBER),0) AS SEP,
                    IFNULL(SUM(OKTOBER),0) AS OKT,
                    IFNULL(SUM(NOVEMBER),0) AS NOP,
                    IFNULL(SUM(DESEMBER),0) AS DES,
                    IFNULL(SUM(JUMLAH),0) AS JML
                FROM $tbl
                GROUP BY ID_GOL, TAHUN, STS
            ) b ON a.ID = b.ID_GOL AND b.TAHUN = $tahun AND b.STS = 'PEG'

            LEFT JOIN(

                SELECT a.ID_GOL, a.TAHUN, a.STS, (a.JAN + a.FEB + a.MAR + a.APR + a.MEI + a.JUN + a.JUL + a.AGU + a.SEP + a.OKT + a.NOP + a.DES) AS TOTAL_LALU
                FROM ( 
                    SELECT
                        a.ID_GOL,
                        a.TAHUN,
                        a.STS,
                        IFNULL(a.JAN ,0) AS JAN,
                        IFNULL(a.FEB ,0) AS FEB,
                        IFNULL(a.MAR ,0) AS MAR,
                        IFNULL(a.APR ,0) AS APR,
                        IFNULL(a.MEI ,0) AS MEI,
                        IFNULL(a.JUN ,0) AS JUN,
                        IFNULL(a.JUL ,0) AS JUL,
                        IFNULL(a.AGU ,0) AS AGU,
                        IFNULL(a.SEP ,0) AS SEP,
                        IFNULL(a.OKT ,0) AS OKT,
                        IFNULL(a.NOP ,0) AS NOP,
                        IFNULL(a.DES ,0) AS DES
                        FROM (
                            SELECT 
                                ID_GOL,
                                TAHUN,
                                STS,
                                IFNULL(SUM(JANUARI),0) AS JAN,
                                IFNULL(SUM(FEBRUARI),0) AS FEB,
                                IFNULL(SUM(MARET),0) AS MAR,
                                IFNULL(SUM(APRIL),0) AS APR,
                                IFNULL(SUM(MEI),0) AS MEI,
                                IFNULL(SUM(JUNI),0) AS JUN,
                                IFNULL(SUM(JULI),0) AS JUL,
                                IFNULL(SUM(AGUSTUS),0) AS AGU,
                                IFNULL(SUM(SEPTEMBER),0) AS SEP,
                                IFNULL(SUM(OKTOBER),0) AS OKT,
                                IFNULL(SUM(NOVEMBER),0) AS NOP,
                                IFNULL(SUM(DESEMBER),0) AS DES
                            FROM $tbl
                            GROUP BY ID_GOL, TAHUN, STS
                        ) a
                    )a
            ) LALU ON a.ID = LALU.ID_GOL AND LALU.TAHUN = $tahun - 1 AND LALU.STS = 'PEG'
        
            ORDER BY a.ID
        ) a
        ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_data_biaya_tenaga_kerja_tkk($tahun,  $periode){

        $tbl = "stp_biaya_tenaga_kerja";

        if($periode == 2){
        $tbl = "stp_biaya_tenaga_kerja_revisi";
        }

        $sql = "
        
        SELECT 
        a.*, 
        (a.JAN + a.FEB + a.MAR + a.APR + a.MEI + a.JUN + a.JUL + a.AGU + a.SEP + a.OKT + a.NOP + a.DES) AS TOTAL
        FROM (
            SELECT 
            a.NO, 
            a.INDUK, 
            a.JUDUL, 
            a.STS_NO,
            IFNULL(b.JAN ,0) AS JAN,
            IFNULL(b.FEB ,0) AS FEB,
            IFNULL(b.MAR ,0) AS MAR,
            IFNULL(b.APR ,0) AS APR,
            IFNULL(b.MEI ,0) AS MEI,
            IFNULL(b.JUN ,0) AS JUN,
            IFNULL(b.JUL ,0) AS JUL,
            IFNULL(b.AGU ,0) AS AGU,
            IFNULL(b.SEP ,0) AS SEP,
            IFNULL(b.OKT ,0) AS OKT,
            IFNULL(b.NOP ,0) AS NOP,
            IFNULL(b.DES ,0) AS DES,
            IFNULL(b.JML ,0) AS JML,
            IFNULL(LALU.TOTAL_LALU ,0) AS TOTAL_LALU
            FROM stp_setup_biaya_tenaga_kerja a
            LEFT JOIN(
                SELECT 
                    ID_GOL,
                    TAHUN,
                    STS,
                    IFNULL(SUM(JANUARI),0) AS JAN,
                    IFNULL(SUM(FEBRUARI),0) AS FEB,
                    IFNULL(SUM(MARET),0) AS MAR,
                    IFNULL(SUM(APRIL),0) AS APR,
                    IFNULL(SUM(MEI),0) AS MEI,
                    IFNULL(SUM(JUNI),0) AS JUN,
                    IFNULL(SUM(JULI),0) AS JUL,
                    IFNULL(SUM(AGUSTUS),0) AS AGU,
                    IFNULL(SUM(SEPTEMBER),0) AS SEP,
                    IFNULL(SUM(OKTOBER),0) AS OKT,
                    IFNULL(SUM(NOVEMBER),0) AS NOP,
                    IFNULL(SUM(DESEMBER),0) AS DES,
                    IFNULL(SUM(JUMLAH),0) AS JML
                FROM $tbl
                GROUP BY ID_GOL, TAHUN, STS
            ) b ON a.ID = b.ID_GOL AND b.TAHUN = $tahun AND b.STS = 'TKK'

            LEFT JOIN(

                SELECT a.ID_GOL, a.TAHUN, a.STS, (a.JAN + a.FEB + a.MAR + a.APR + a.MEI + a.JUN + a.JUL + a.AGU + a.SEP + a.OKT + a.NOP + a.DES) AS TOTAL_LALU
                FROM ( 
                    SELECT
                        a.ID_GOL,
                        a.TAHUN,
                        a.STS,
                        IFNULL(a.JAN ,0) AS JAN,
                        IFNULL(a.FEB ,0) AS FEB,
                        IFNULL(a.MAR ,0) AS MAR,
                        IFNULL(a.APR ,0) AS APR,
                        IFNULL(a.MEI ,0) AS MEI,
                        IFNULL(a.JUN ,0) AS JUN,
                        IFNULL(a.JUL ,0) AS JUL,
                        IFNULL(a.AGU ,0) AS AGU,
                        IFNULL(a.SEP ,0) AS SEP,
                        IFNULL(a.OKT ,0) AS OKT,
                        IFNULL(a.NOP ,0) AS NOP,
                        IFNULL(a.DES ,0) AS DES
                        FROM (
                            SELECT 
                                ID_GOL,
                                TAHUN,
                                STS,
                                IFNULL(SUM(JANUARI),0) AS JAN,
                                IFNULL(SUM(FEBRUARI),0) AS FEB,
                                IFNULL(SUM(MARET),0) AS MAR,
                                IFNULL(SUM(APRIL),0) AS APR,
                                IFNULL(SUM(MEI),0) AS MEI,
                                IFNULL(SUM(JUNI),0) AS JUN,
                                IFNULL(SUM(JULI),0) AS JUL,
                                IFNULL(SUM(AGUSTUS),0) AS AGU,
                                IFNULL(SUM(SEPTEMBER),0) AS SEP,
                                IFNULL(SUM(OKTOBER),0) AS OKT,
                                IFNULL(SUM(NOVEMBER),0) AS NOP,
                                IFNULL(SUM(DESEMBER),0) AS DES
                            FROM $tbl
                            GROUP BY ID_GOL, TAHUN, STS
                        ) a
                    )a
            ) LALU ON a.ID = LALU.ID_GOL AND LALU.TAHUN = $tahun - 1 AND LALU.STS = 'TKK'
            WHERE a.STS = 'TKK'
            ORDER BY a.ID
        ) a
        ";

        $query = $this->db->query($sql);
        return $query->result();
    }

}

?>