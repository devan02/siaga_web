<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rencana_biaya_diluar_usaha_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}


    

    function get_condition_rinci($tahun, $periode){

        $tbl = "stp_anggaran_dasar_2015";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran_2015";
        }

        $sql = "
        SELECT * FROM (
            SELECT
                    AG.KODE_PERKIRAAN, 
                    AG.URAIAN AS NAMA_PERKIRAAN, 
                    laba.NAMA AS INDUK ,
                    AG.STS_KODE,
                    IFNULL(AG.JAN,0) AS JAN,
                    IFNULL(AG.FEB,0) AS FEB,
                    IFNULL(AG.MAR,0) AS MAR,
                    IFNULL(AG.APR,0) AS APR,
                    IFNULL(AG.MEI,0) AS MEI,
                    IFNULL(AG.JUN,0) AS JUN,
                    IFNULL(AG.JUL,0) AS JUL,
                    IFNULL(AG.AGU,0) AS AGU,
                    IFNULL(AG.SEP,0) AS SEP,
                    IFNULL(AG.OKT,0) AS OKT,
                    IFNULL(AG.NOP,0) AS NOP,
                    IFNULL(AG.DES,0) AS DES,
                    IFNULL(AG.JML,0) AS JML,
                    IFNULL(AG.JML_LALU1,0) AS JML_LALU1
            FROM stp_setup_lap_biaya_luar_ush laba
            LEFT JOIN stp_setup_kode_perkiraan koper on laba.KODE_PERKIRAAN = koper.KODE_PERKIRAAN
            LEFT JOIN (
                SELECT
                        a.ID AS ID_AG,
                        CASE 
                          WHEN a.KOPER_INDUK = '' THEN
                        a.KODE_PERKIRAAN ELSE CONCAT(a.KOPER_INDUK,'-',a.KODE_PERKIRAAN)
                        END AS KODE_PERKIRAAN,                        
                        CASE 
                          WHEN a.KOPER_INDUK = '' THEN
                        '' ELSE a.KOPER_INDUK
                        END AS STS_KODE,
                        a.URAIAN,                        
                        a.JANUARI AS JAN,
                        a.FEBRUARI AS FEB,
                        a.MARET AS MAR,
                        a.APRIL AS APR,
                        a.MEI AS MEI,
                        a.JUNI AS JUN,
                        a.JULI AS JUL,
                        a.AGUSTUS AS AGU,
                        a.SEPTEMBER AS SEP,
                        a.OKTOBER AS OKT,
                        a.NOVEMBER AS NOP,
                        a.DESEMBER AS DES,
                        a.JUMLAH AS JML,
                        dasar_lalu1.JML_LALU1 AS JML_LALU1,
                        a.TAHUN,
                        a.KOPER_INDUK
                   FROM $tbl a

                   LEFT JOIN (
                        SELECT KODE_PERKIRAAN, IFNULL(SUM(JUMLAH),0) AS JML_LALU1
                        FROM $tbl
                        WHERE TAHUN = $tahun-1
                        GROUP BY KODE_PERKIRAAN
                   ) dasar_lalu1 ON a.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN 

            ) AG ON koper.KODE_PERKIRAAN = AG.KODE_PERKIRAAN OR AG.KOPER_INDUK = koper.KODE_PERKIRAAN

            WHERE AG.TAHUN = $tahun
            ORDER BY laba.URUT, AG.ID_AG, AG.KODE_PERKIRAAN ASC
        ) a
        ";
        return $this->db->query($sql)->result();
    }

    function get_condition_rinci_new($tahun, $periode){

        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
        SELECT * FROM (
            SELECT
                    AG.KODE_PERKIRAAN, 
                    AG.URAIAN AS NAMA_PERKIRAAN, 
                    laba.NAMA AS INDUK ,
                    AG.STS_KODE,
                    IFNULL(AG.JAN,0) AS JAN,
                    IFNULL(AG.FEB,0) AS FEB,
                    IFNULL(AG.MAR,0) AS MAR,
                    IFNULL(AG.APR,0) AS APR,
                    IFNULL(AG.MEI,0) AS MEI,
                    IFNULL(AG.JUN,0) AS JUN,
                    IFNULL(AG.JUL,0) AS JUL,
                    IFNULL(AG.AGU,0) AS AGU,
                    IFNULL(AG.SEP,0) AS SEP,
                    IFNULL(AG.OKT,0) AS OKT,
                    IFNULL(AG.NOP,0) AS NOP,
                    IFNULL(AG.DES,0) AS DES,
                    IFNULL(AG.JML,0) AS JML,
                    IFNULL(AG.JML_LALU1,0) AS JML_LALU1
            FROM stp_setup_lap_biaya_luar_ush laba
            LEFT JOIN stp_setup_kode_perkiraan koper on laba.KODE_PERKIRAAN = koper.KODE_PERKIRAAN
            LEFT JOIN (

                SELECT
                        CIL.KODE_PERKIRAAN AS TAMPUNG,
                        0 AS ID_AG,
                        CIL.KODE_PERKIRAAN AS KODE_PERKIRAAN,
                        '' AS STS_KODE,
                        CIL.NAMA_PERKIRAAN AS URAIAN,                     
                        IFNULL(SUM(DAS.JANUARI),0) + CIL.JANUARI AS JAN,
                        IFNULL(SUM(DAS.FEBRUARI),0) + CIL.FEBRUARI AS FEB,
                        IFNULL(SUM(DAS.MARET),0) + CIL.MARET AS MAR,
                        IFNULL(SUM(DAS.APRIL),0) + CIL.APRIL AS APR,
                        IFNULL(SUM(DAS.MEI),0) + CIL.MEI AS MEI,
                        IFNULL(SUM(DAS.JUNI),0) + CIL.JUNI AS JUN,
                        IFNULL(SUM(DAS.JULI),0) + CIL.JULI AS JUL,
                        IFNULL(SUM(DAS.AGUSTUS),0) + CIL.AGUSTUS AS AGU,
                        IFNULL(SUM(DAS.SEPTEMBER),0) + CIL.SEPTEMBER AS SEP,
                        IFNULL(SUM(DAS.OKTOBER),0) + CIL.OKTOBER AS OKT,
                        IFNULL(SUM(DAS.NOVEMBER),0) + CIL.NOVEMBER AS NOP,
                        IFNULL(SUM(DAS.DESEMBER),0) + CIL.DESEMBER AS DES,
                        ( CIL.JML + IFNULL(SUM(DAS.TOTAL),0) + IFNULL(SUM(DAS.TOTAL_PELAKSANAAN),0) ) AS JML,
                        ( CIL.JML + IFNULL(SUM(dasar_lalu1.TOTAL),0) + IFNULL(SUM(dasar_lalu1.TOTAL_PELAKSANAAN),0) ) AS JML_LALU1,
                        $tahun AS TAHUN,
                        CIL.KODE_PERKIRAAN AS INDUK_KODE
                FROM stp_koper_child_vw CIL
                LEFT JOIN $tbl DAS ON CIL.KODE_PERKIRAAN = DAS.KODE_PERKIRAAN AND DAS.TAHUN = $tahun

                LEFT JOIN (
                    SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0) AS TOTAL, IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL_PELAKSANAAN
                    FROM $tbl
                    WHERE TAHUN = $tahun-1
                    GROUP BY KODE_PERKIRAAN
                ) dasar_lalu1 ON CIL.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN 

                WHERE CIL.INDUK_KODE = '' OR CIL.INDUK_KODE IS NULL
                GROUP BY CIL.KODE_PERKIRAAN, CIL.NAMA_PERKIRAAN

                UNION ALL

                SELECT
                        CONCAT(dasar.KODE_PERKIRAAN,'',1) AS TAMPUNG,
                        1 AS ID_AG,
                        CASE 
                          WHEN CHILD.INDUK_KODE = '' THEN
                        dasar.KODE_PERKIRAAN ELSE CONCAT(CHILD.INDUK_KODE,'-',dasar.KODE_PERKIRAAN)
                        END AS KODE_PERKIRAAN,                        
                        CASE 
                          WHEN CHILD.INDUK_KODE = '' THEN
                        '' ELSE INDUK_KODE
                        END AS STS_KODE,
                        CHILD.NAMA_PERKIRAAN AS URAIAN,                        
                        SUM(dasar.JANUARI) AS JAN,
                        SUM(dasar.FEBRUARI) AS FEB,
                        SUM(dasar.MARET) AS MAR,
                        SUM(dasar.APRIL) AS APR,
                        SUM(dasar.MEI) AS MEI,
                        SUM(dasar.JUNI) AS JUN,
                        SUM(dasar.JULI) AS JUL,
                        SUM(dasar.AGUSTUS) AS AGU,
                        SUM(dasar.SEPTEMBER) AS SEP,
                        SUM(dasar.OKTOBER) AS OKT,
                        SUM(dasar.NOVEMBER) AS NOP,
                        SUM(dasar.DESEMBER) AS DES,
                        (SUM(dasar.TOTAL) + SUM(dasar.TOTAL_PELAKSANAAN)) AS JML,
                        (SUM(dasar_lalu1.TOTAL) + SUM(dasar_lalu1.TOTAL_PELAKSANAAN)) AS JML_LALU1,
                        dasar.TAHUN,
                        CHILD.INDUK_KODE
                   FROM $tbl dasar
                   LEFT JOIN stp_koper_child_vw CHILD 
                   ON CHILD.INDUK_KODE = dasar.KODE_PERKIRAAN OR CHILD.KODE_PERKIRAAN = dasar.KODE_PERKIRAAN

                   LEFT JOIN (
                        SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0) AS TOTAL, IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL_PELAKSANAAN
                        FROM $tbl
                        WHERE TAHUN = $tahun-1
                        GROUP BY KODE_PERKIRAAN
                    ) dasar_lalu1 ON CHILD.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN 

                   GROUP BY CHILD.INDUK_KODE, dasar.KODE_PERKIRAAN, CHILD.NAMA_PERKIRAAN, dasar.TAHUN

            ) AG ON AG.INDUK_KODE = koper.KODE_PERKIRAAN

            WHERE AG.TAHUN = $tahun
            ORDER BY laba.URUT, AG.TAMPUNG, AG.KODE_PERKIRAAN ASC
        ) a
        ";
        return $this->db->query($sql)->result();
    }

    function get_anak_data($koper, $tahun){
        $sql = "
                SELECT
                        KODE_PERKIRAAN,
                        URAIAN AS NAMA_PERKIRAAN,
                        JANUARI AS JAN,
                        FEBRUARI AS FEB,
                        MARET AS MAR,
                        APRIL AS APR,
                        MEI AS MEI,
                        JUNI AS JUN,
                        JULI AS JUL,
                        AGUSTUS AS AGU,
                        SEPTEMBER AS SEP,
                        OKTOBER AS OKT,
                        NOPEMBER AS NOP,
                        DESEMBER AS DES,
                        JUMLAH AS JML
                   FROM stp_anggaran_dasar_2015
                   WHERE KOPER_INDUK = '$koper' AND TAHUN = $tahun
                   ORDER BY KODE_PERKIRAAN

        ";
        return $this->db->query($sql)->result();
    }


}

?>