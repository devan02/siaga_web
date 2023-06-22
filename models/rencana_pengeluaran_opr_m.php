<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rencana_pengeluaran_opr_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}


	function get_biaya_opr($tahun, $periode){

        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
        
            SELECT
                    IFNULL(SUM(AG.JAN),0) + IFNULL(SUM(AG2.JAN),0) AS JAN,
                    IFNULL(SUM(AG.FEB),0) + IFNULL(SUM(AG2.FEB),0) AS FEB,
                    IFNULL(SUM(AG.MAR),0) + IFNULL(SUM(AG2.MAR),0) AS MAR,
                    IFNULL(SUM(AG.APR),0) + IFNULL(SUM(AG2.APR),0) AS APR,
                    IFNULL(SUM(AG.MEI),0) + IFNULL(SUM(AG2.MEI),0) AS MEI,
                    IFNULL(SUM(AG.JUN),0) + IFNULL(SUM(AG2.JUN),0) AS JUN,
                    IFNULL(SUM(AG.JUL),0) + IFNULL(SUM(AG2.JUL),0) AS JUL,
                    IFNULL(SUM(AG.AGU),0) + IFNULL(SUM(AG2.AGU),0) AS AGU,
                    IFNULL(SUM(AG.SEP),0) + IFNULL(SUM(AG2.SEP),0) AS SEP,
                    IFNULL(SUM(AG.OKT),0) + IFNULL(SUM(AG2.OKT),0) AS OKT,
                    IFNULL(SUM(AG.NOP),0) + IFNULL(SUM(AG2.NOP),0) AS NOP,
                    IFNULL(SUM(AG.DES),0) + IFNULL(SUM(AG2.DES),0) AS DES,
                    IFNULL(SUM(AG.JML),0) + IFNULL(SUM(AG2.JML),0) AS JML,
                    IFNULL(SUM(AG.JML_LALU1),0) + IFNULL(SUM(AG2.JML_LALU1),0) AS JML_LALU1
            FROM stp_setup_lap_biaya_opr laba
            LEFT JOIN stp_setup_kode_perkiraan koper on laba.KODE_PERKIRAAN = koper.KODE_PERKIRAAN
            LEFT JOIN (
                    SELECT
                        a.KODE_PERKIRAAN,
                        SUM(a.JANUARI) AS JAN,
                        SUM(a.FEBRUARI) AS FEB,
                        SUM(a.MARET) AS MAR,
                        SUM(a.APRIL) AS APR,
                        SUM(a.MEI) AS MEI,
                        SUM(a.JUNI) AS JUN,
                        SUM(a.JULI) AS JUL,
                        SUM(a.AGUSTUS) AS AGU,
                        SUM(a.SEPTEMBER) AS SEP,
                        SUM(a.OKTOBER) AS OKT,
                        SUM(a.NOVEMBER) AS NOP,
                        SUM(a.DESEMBER) AS DES,
                        SUM(a.TOTAL + a.TOTAL_PELAKSANAAN) AS JML,
                        (SUM(dasar_lalu1.TOTAL) + SUM(dasar_lalu1.TOTAL_PELAKSANAAN)) AS JML_LALU1,
                        a.TAHUN
                   FROM $tbl a

                   LEFT JOIN (
                    SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0) AS TOTAL, IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL_PELAKSANAAN
                    FROM $tbl
                    WHERE TAHUN = $tahun - 1
                    GROUP BY KODE_PERKIRAAN
                   ) dasar_lalu1 ON a.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN 

                   GROUP BY a.KODE_PERKIRAAN, a.TAHUN

            ) AG ON koper.KODE_PERKIRAAN = AG.KODE_PERKIRAAN AND AG.TAHUN = $tahun

            LEFT JOIN stp_koper_child_vw CHILD 
            ON CHILD.INDUK_KODE = koper.KODE_PERKIRAAN

            LEFT JOIN (
                SELECT
                        a.KODE_PERKIRAAN,
                        SUM(a.JANUARI)AS JAN,
                        SUM(a.FEBRUARI) AS FEB,
                        SUM(a.MARET) AS MAR,
                        SUM(a.APRIL) AS APR,
                        SUM(a.MEI) AS MEI,
                        SUM(a.JUNI) AS JUN,
                        SUM(a.JULI) AS JUL,
                        SUM(a.AGUSTUS) AS AGU,
                        SUM(a.SEPTEMBER) AS SEP,
                        SUM(a.OKTOBER) AS OKT,
                        SUM(a.NOVEMBER) AS NOP,
                        SUM(a.DESEMBER) AS DES,
                        SUM(a.TOTAL + a.TOTAL_PELAKSANAAN) AS JML,
                        (SUM(dasar_lalu1.TOTAL) + SUM(dasar_lalu1.TOTAL_PELAKSANAAN)) AS JML_LALU1,
                        a.TAHUN
                FROM $tbl a

                LEFT JOIN (
                    SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0) AS TOTAL, IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL_PELAKSANAAN
                    FROM $tbl
                    WHERE TAHUN = $tahun - 1
                    GROUP BY KODE_PERKIRAAN
                ) dasar_lalu1 ON a.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN

                GROUP BY a.KODE_PERKIRAAN, a.TAHUN

            ) AG2 ON CHILD.KODE_PERKIRAAN = AG2.KODE_PERKIRAAN AND AG2.TAHUN = $tahun
            ORDER BY laba.URUT, laba.KODE_PERKIRAAN ASC

        ";
        return $this->db->query($sql)->row();
    }

    function get_biaya_luar($tahun, $periode){

        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
        
            SELECT
                    IFNULL(SUM(AG.JAN),0) + IFNULL(SUM(AG2.JAN),0) AS JAN,
                    IFNULL(SUM(AG.FEB),0) + IFNULL(SUM(AG2.FEB),0) AS FEB,
                    IFNULL(SUM(AG.MAR),0) + IFNULL(SUM(AG2.MAR),0) AS MAR,
                    IFNULL(SUM(AG.APR),0) + IFNULL(SUM(AG2.APR),0) AS APR,
                    IFNULL(SUM(AG.MEI),0) + IFNULL(SUM(AG2.MEI),0) AS MEI,
                    IFNULL(SUM(AG.JUN),0) + IFNULL(SUM(AG2.JUN),0) AS JUN,
                    IFNULL(SUM(AG.JUL),0) + IFNULL(SUM(AG2.JUL),0) AS JUL,
                    IFNULL(SUM(AG.AGU),0) + IFNULL(SUM(AG2.AGU),0) AS AGU,
                    IFNULL(SUM(AG.SEP),0) + IFNULL(SUM(AG2.SEP),0) AS SEP,
                    IFNULL(SUM(AG.OKT),0) + IFNULL(SUM(AG2.OKT),0) AS OKT,
                    IFNULL(SUM(AG.NOP),0) + IFNULL(SUM(AG2.NOP),0) AS NOP,
                    IFNULL(SUM(AG.DES),0) + IFNULL(SUM(AG2.DES),0) AS DES,
                    IFNULL(SUM(AG.JML),0) + IFNULL(SUM(AG2.JML),0) AS JML,
                    IFNULL(SUM(AG.JML_LALU1),0) + IFNULL(SUM(AG2.JML_LALU1),0) AS JML_LALU1
            FROM stp_setup_lap_biaya_luar_ush laba
            LEFT JOIN stp_setup_kode_perkiraan koper on laba.KODE_PERKIRAAN = koper.KODE_PERKIRAAN
            LEFT JOIN (
                    SELECT
                        a.KODE_PERKIRAAN,
                        SUM(a.JANUARI) AS JAN,
                        SUM(a.FEBRUARI) AS FEB,
                        SUM(a.MARET) AS MAR,
                        SUM(a.APRIL) AS APR,
                        SUM(a.MEI) AS MEI,
                        SUM(a.JUNI) AS JUN,
                        SUM(a.JULI) AS JUL,
                        SUM(a.AGUSTUS) AS AGU,
                        SUM(a.SEPTEMBER) AS SEP,
                        SUM(a.OKTOBER) AS OKT,
                        SUM(a.NOVEMBER) AS NOP,
                        SUM(a.DESEMBER) AS DES,
                        SUM(a.TOTAL + a.TOTAL_PELAKSANAAN) AS JML,
                        (SUM(dasar_lalu1.TOTAL) + SUM(dasar_lalu1.TOTAL_PELAKSANAAN)) AS JML_LALU1,
                        a.TAHUN
                   FROM $tbl a

                   LEFT JOIN (
                    SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0) AS TOTAL, IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL_PELAKSANAAN
                    FROM $tbl
                    WHERE TAHUN = $tahun - 1
                    GROUP BY KODE_PERKIRAAN
                   ) dasar_lalu1 ON a.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN 

                   GROUP BY a.KODE_PERKIRAAN, a.TAHUN

            ) AG ON koper.KODE_PERKIRAAN = AG.KODE_PERKIRAAN AND AG.TAHUN = $tahun

            LEFT JOIN stp_koper_child_vw CHILD 
            ON CHILD.INDUK_KODE = koper.KODE_PERKIRAAN

            LEFT JOIN (
                SELECT
                        a.KODE_PERKIRAAN,
                        SUM(a.JANUARI)AS JAN,
                        SUM(a.FEBRUARI) AS FEB,
                        SUM(a.MARET) AS MAR,
                        SUM(a.APRIL) AS APR,
                        SUM(a.MEI) AS MEI,
                        SUM(a.JUNI) AS JUN,
                        SUM(a.JULI) AS JUL,
                        SUM(a.AGUSTUS) AS AGU,
                        SUM(a.SEPTEMBER) AS SEP,
                        SUM(a.OKTOBER) AS OKT,
                        SUM(a.NOVEMBER) AS NOP,
                        SUM(a.DESEMBER) AS DES,
                        SUM(a.TOTAL + a.TOTAL_PELAKSANAAN) AS JML,
                        (SUM(dasar_lalu1.TOTAL) + SUM(dasar_lalu1.TOTAL_PELAKSANAAN)) AS JML_LALU1,
                        a.TAHUN
                FROM $tbl a

                LEFT JOIN (
                    SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0) AS TOTAL, IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL_PELAKSANAAN
                    FROM $tbl
                    WHERE TAHUN = $tahun - 1
                    GROUP BY KODE_PERKIRAAN
                ) dasar_lalu1 ON a.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN

                GROUP BY a.KODE_PERKIRAAN, a.TAHUN

            ) AG2 ON CHILD.KODE_PERKIRAAN = AG2.KODE_PERKIRAAN AND AG2.TAHUN = $tahun
            ORDER BY laba.URUT, laba.KODE_PERKIRAAN ASC

        ";
        return $this->db->query($sql)->row();
    }

    function get_rencana_beli($tahun, $periode){

        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
        
            SELECT 
                SUM(a.JAN) AS JAN,
                SUM(a.FEB) AS FEB,
                SUM(a.MAR) AS MAR,
                SUM(a.APR) AS APR,
                SUM(a.MEI) AS MEI,
                SUM(a.JUN) AS JUN,
                SUM(a.JUL) AS JUL,
                SUM(a.AGU) AS AGU,
                SUM(a.SEP) AS SEP,
                SUM(a.OKT) AS OKT,
                SUM(a.NOP) AS NOP,
                SUM(a.DES) AS DES,
                SUM(a.JML) AS JML,
                SUM(a.JML_LALU1) AS JML_LALU1
            FROM (
            SELECT
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
            FROM stp_setup_lap_rencana_beli laba
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
                    WHERE TAHUN = $tahun - 1
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
                        WHERE TAHUN = $tahun - 1
                        GROUP BY KODE_PERKIRAAN
                    ) dasar_lalu1 ON CHILD.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN 

                   GROUP BY CHILD.INDUK_KODE, dasar.KODE_PERKIRAAN, CHILD.NAMA_PERKIRAAN, dasar.TAHUN

            ) AG ON AG.INDUK_KODE = koper.KODE_PERKIRAAN AND AG.TAHUN = $tahun
            ORDER BY laba.URUT, AG.TAMPUNG, AG.KODE_PERKIRAAN ASC
        ) a

        ";
        return $this->db->query($sql)->row();
    }

    function get_rencana_adm($tahun, $periode){

        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
        
            SELECT
                    IFNULL(SUM(AG.JAN),0) + IFNULL(SUM(AG2.JAN),0) AS JAN,
                    IFNULL(SUM(AG.FEB),0) + IFNULL(SUM(AG2.FEB),0) AS FEB,
                    IFNULL(SUM(AG.MAR),0) + IFNULL(SUM(AG2.MAR),0) AS MAR,
                    IFNULL(SUM(AG.APR),0) + IFNULL(SUM(AG2.APR),0) AS APR,
                    IFNULL(SUM(AG.MEI),0) + IFNULL(SUM(AG2.MEI),0) AS MEI,
                    IFNULL(SUM(AG.JUN),0) + IFNULL(SUM(AG2.JUN),0) AS JUN,
                    IFNULL(SUM(AG.JUL),0) + IFNULL(SUM(AG2.JUL),0) AS JUL,
                    IFNULL(SUM(AG.AGU),0) + IFNULL(SUM(AG2.AGU),0) AS AGU,
                    IFNULL(SUM(AG.SEP),0) + IFNULL(SUM(AG2.SEP),0) AS SEP,
                    IFNULL(SUM(AG.OKT),0) + IFNULL(SUM(AG2.OKT),0) AS OKT,
                    IFNULL(SUM(AG.NOP),0) + IFNULL(SUM(AG2.NOP),0) AS NOP,
                    IFNULL(SUM(AG.DES),0) + IFNULL(SUM(AG2.DES),0) AS DES,
                    IFNULL(SUM(AG.JML),0) + IFNULL(SUM(AG2.JML),0) AS JML,
                    IFNULL(SUM(AG.JML_LALU1),0) + IFNULL(SUM(AG2.JML_LALU1),0) AS JML_LALU1
            FROM stp_setup_lap_biaya_umum_adm laba
            LEFT JOIN stp_setup_kode_perkiraan koper on laba.KODE_PERKIRAAN = koper.KODE_PERKIRAAN
            LEFT JOIN (
                    SELECT
                        a.KODE_PERKIRAAN,
                        SUM(a.JANUARI) AS JAN,
                        SUM(a.FEBRUARI) AS FEB,
                        SUM(a.MARET) AS MAR,
                        SUM(a.APRIL) AS APR,
                        SUM(a.MEI) AS MEI,
                        SUM(a.JUNI) AS JUN,
                        SUM(a.JULI) AS JUL,
                        SUM(a.AGUSTUS) AS AGU,
                        SUM(a.SEPTEMBER) AS SEP,
                        SUM(a.OKTOBER) AS OKT,
                        SUM(a.NOVEMBER) AS NOP,
                        SUM(a.DESEMBER) AS DES,
                        SUM(a.TOTAL + a.TOTAL_PELAKSANAAN) AS JML,
                        (SUM(dasar_lalu1.TOTAL) + SUM(dasar_lalu1.TOTAL_PELAKSANAAN)) AS JML_LALU1,
                        a.TAHUN
                   FROM $tbl a

                   LEFT JOIN (
                    SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0) AS TOTAL, IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL_PELAKSANAAN
                    FROM $tbl
                    WHERE TAHUN = $tahun - 1
                    GROUP BY KODE_PERKIRAAN
                   ) dasar_lalu1 ON a.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN 

                   GROUP BY a.KODE_PERKIRAAN, a.TAHUN

            ) AG ON koper.KODE_PERKIRAAN = AG.KODE_PERKIRAAN AND AG.TAHUN = $tahun

            LEFT JOIN stp_koper_child_vw CHILD 
            ON CHILD.INDUK_KODE = koper.KODE_PERKIRAAN

            LEFT JOIN (
                SELECT
                        a.KODE_PERKIRAAN,
                        SUM(a.JANUARI)AS JAN,
                        SUM(a.FEBRUARI) AS FEB,
                        SUM(a.MARET) AS MAR,
                        SUM(a.APRIL) AS APR,
                        SUM(a.MEI) AS MEI,
                        SUM(a.JUNI) AS JUN,
                        SUM(a.JULI) AS JUL,
                        SUM(a.AGUSTUS) AS AGU,
                        SUM(a.SEPTEMBER) AS SEP,
                        SUM(a.OKTOBER) AS OKT,
                        SUM(a.NOVEMBER) AS NOP,
                        SUM(a.DESEMBER) AS DES,
                        SUM(a.TOTAL + a.TOTAL_PELAKSANAAN) AS JML,
                        (SUM(dasar_lalu1.TOTAL) + SUM(dasar_lalu1.TOTAL_PELAKSANAAN)) AS JML_LALU1,
                        a.TAHUN
                FROM $tbl a

                LEFT JOIN (
                    SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0) AS TOTAL, IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL_PELAKSANAAN
                    FROM $tbl
                    WHERE TAHUN = $tahun - 1
                    GROUP BY KODE_PERKIRAAN
                ) dasar_lalu1 ON a.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN

                GROUP BY a.KODE_PERKIRAAN, a.TAHUN

            ) AG2 ON CHILD.KODE_PERKIRAAN = AG2.KODE_PERKIRAAN AND AG2.TAHUN = $tahun
            ORDER BY laba.URUT, laba.KODE_PERKIRAAN ASC

        ";
        return $this->db->query($sql)->row();

    }

    function get_penyusutan_lalu($tahun, $periode){
        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
        SELECT * FROM (
            SELECT
                    IFNULL(SUM(AG.JML),0) + IFNULL(SUM(AG2.JML),0) AS JML
            FROM stp_setup_lap_proyeksi_investasi laba
            LEFT JOIN stp_setup_kode_perkiraan koper on laba.KODE_PERKIRAAN = koper.KODE_PERKIRAAN
            LEFT JOIN (
                SELECT
                        KODE_PERKIRAAN,
                        SUM(TOTAL + TOTAL_PELAKSANAAN) AS JML,
                        TAHUN
                   FROM $tbl
                   GROUP BY KODE_PERKIRAAN, TAHUN

            ) AG ON koper.KODE_PERKIRAAN = AG.KODE_PERKIRAAN AND AG.TAHUN = $tahun - 1

            LEFT JOIN stp_koper_child_vw CHILD 
            ON CHILD.INDUK_KODE = koper.KODE_PERKIRAAN

            LEFT JOIN (
                SELECT
                        KODE_PERKIRAAN,
                        SUM(TOTAL + TOTAL_PELAKSANAAN) AS JML,
                        TAHUN
                FROM $tbl
                GROUP BY KODE_PERKIRAAN, TAHUN

            ) AG2 ON CHILD.KODE_PERKIRAAN = AG2.KODE_PERKIRAAN AND AG2.TAHUN = $tahun - 1

            WHERE laba.KODE_PERKIRAAN = '31.10.00'
        ) a
        ";

        return $this->db->query($sql)->row();

    }

    function get_penyusutan_lalu2($tahun, $periode){
        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
        SELECT * FROM (
            SELECT
                    IFNULL(SUM(AG.JML),0) + IFNULL(SUM(AG2.JML),0) AS JML
            FROM stp_setup_lap_proyeksi_investasi laba
            LEFT JOIN stp_setup_kode_perkiraan koper on laba.KODE_PERKIRAAN = koper.KODE_PERKIRAAN
            LEFT JOIN (
                SELECT
                        KODE_PERKIRAAN,
                        SUM(TOTAL + TOTAL_PELAKSANAAN) AS JML,
                        TAHUN
                   FROM $tbl
                   GROUP BY KODE_PERKIRAAN, TAHUN

            ) AG ON koper.KODE_PERKIRAAN = AG.KODE_PERKIRAAN AND AG.TAHUN = $tahun - 2

            LEFT JOIN stp_koper_child_vw CHILD 
            ON CHILD.INDUK_KODE = koper.KODE_PERKIRAAN

            LEFT JOIN (
                SELECT
                        KODE_PERKIRAAN,
                        SUM(TOTAL + TOTAL_PELAKSANAAN) AS JML,
                        TAHUN
                FROM $tbl
                GROUP BY KODE_PERKIRAAN, TAHUN

            ) AG2 ON CHILD.KODE_PERKIRAAN = AG2.KODE_PERKIRAAN AND AG2.TAHUN = $tahun - 2

            WHERE laba.KODE_PERKIRAAN = '31.10.00'
        ) a
        ";

        return $this->db->query($sql)->row();

    }

    function get_penyusutan_now($tahun, $periode){
        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
        SELECT * FROM (
            SELECT
                    IFNULL(SUM(AG.JML),0) + IFNULL(SUM(AG2.JML),0) AS JML
            FROM stp_setup_lap_proyeksi_investasi laba
            LEFT JOIN stp_setup_kode_perkiraan koper on laba.KODE_PERKIRAAN = koper.KODE_PERKIRAAN
            LEFT JOIN (
                SELECT
                        KODE_PERKIRAAN,
                        SUM(TOTAL + TOTAL_PELAKSANAAN) AS JML,
                        TAHUN
                   FROM $tbl
                   GROUP BY KODE_PERKIRAAN, TAHUN

            ) AG ON koper.KODE_PERKIRAAN = AG.KODE_PERKIRAAN AND AG.TAHUN = $tahun

            LEFT JOIN stp_koper_child_vw CHILD 
            ON CHILD.INDUK_KODE = koper.KODE_PERKIRAAN

            LEFT JOIN (
                SELECT
                        KODE_PERKIRAAN,
                        SUM(TOTAL + TOTAL_PELAKSANAAN) AS JML,
                        TAHUN
                FROM $tbl
                GROUP BY KODE_PERKIRAAN, TAHUN

            ) AG2 ON CHILD.KODE_PERKIRAAN = AG2.KODE_PERKIRAAN AND AG2.TAHUN = $tahun

            WHERE laba.KODE_PERKIRAAN = '31.10.00'
        ) a
        ";

        return $this->db->query($sql)->row();

    }

    


}

?>