<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyeksi_anggaran_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}


	function get_condition($tahun, $periode){

        $tbl = "stp_anggaran_dasar_2015";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran_2015";
        }

        $sql = "
        SELECT * FROM (
            SELECT
                    laba.KODE_PERKIRAAN, 
                    koper.NAMA_PERKIRAAN, 
                    laba.NAMA AS INDUK ,
                    laba.URUT,
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
                    0 AS JML_LALU1,
                    0 AS JML_LALU2
            FROM stp_setup_proyeksi_lr laba
            LEFT JOIN stp_setup_kode_perkiraan koper on laba.KODE_PERKIRAAN = koper.KODE_PERKIRAAN
            LEFT JOIN stp_setup_kode_perkiraan koper2 on koper.KP_GRUP = koper2.KP_GRUP
            LEFT JOIN (
                SELECT
                        KODE_PERKIRAAN,
                        SUM(JANUARI) AS JAN,
                        SUM(FEBRUARI) AS FEB,
                        SUM(MARET) AS MAR,
                        SUM(APRIL) AS APR,
                        SUM(MEI) AS MEI,
                        SUM(JUNI) AS JUN,
                        SUM(JULI) AS JUL,
                        SUM(AGUSTUS) AS AGU,
                        SUM(SEPTEMBER) AS SEP,
                        SUM(OKTOBER) AS OKT,
                        SUM(NOVEMBER) AS NOP,
                        SUM(DESEMBER) AS DES,
                        SUM(JUMLAH) AS JML,
                        KOPER_INDUK,
                        TAHUN
                   FROM $tbl
                   GROUP BY KODE_PERKIRAAN, KOPER_INDUK, TAHUN

            ) AG ON koper2.KODE_PERKIRAAN = AG.KODE_PERKIRAAN

            LEFT JOIN (
                SELECT
                        SUM(JANUARI)AS JAN,
                        SUM(FEBRUARI) AS FEB,
                        SUM(MARET) AS MAR,
                        SUM(APRIL) AS APR,
                        SUM(MEI) AS MEI,
                        SUM(JUNI) AS JUN,
                        SUM(JULI) AS JUL,
                        SUM(AGUSTUS) AS AGU,
                        SUM(SEPTEMBER) AS SEP,
                        SUM(OKTOBER) AS OKT,
                        SUM(NOVEMBER) AS NOP,
                        SUM(DESEMBER) AS DES,
                        SUM(JUMLAH) AS JML,
                        KOPER_INDUK,
                        TAHUN
                FROM $tbl
                   GROUP BY KOPER_INDUK, TAHUN

            ) AG2 ON AG.KODE_PERKIRAAN = AG2.KOPER_INDUK

            WHERE AG.TAHUN = $tahun AND laba.KODE_PERKIRAAN NOT LIKE '%81%'
            GROUP BY laba.KODE_PERKIRAAN, koper.NAMA_PERKIRAAN, laba.NAMA

            UNION ALL 


            SELECT
                    laba.KODE_PERKIRAAN, 
                    koper.NAMA_PERKIRAAN, 
                    laba.NAMA AS INDUK ,
                    laba.URUT,
                    IFNULL(SUM(AG.JAN),0)  AS JAN,
                    IFNULL(SUM(AG.FEB),0)  AS FEB,
                    IFNULL(SUM(AG.MAR),0)  AS MAR,
                    IFNULL(SUM(AG.APR),0)  AS APR,
                    IFNULL(SUM(AG.MEI),0)  AS MEI,
                    IFNULL(SUM(AG.JUN),0)  AS JUN,
                    IFNULL(SUM(AG.JUL),0)  AS JUL,
                    IFNULL(SUM(AG.AGU),0)  AS AGU,
                    IFNULL(SUM(AG.SEP),0)  AS SEP,
                    IFNULL(SUM(AG.OKT),0)  AS OKT,
                    IFNULL(SUM(AG.NOP),0)  AS NOP,
                    IFNULL(SUM(AG.DES),0)  AS DES,
                    IFNULL(SUM(AG.JML),0)  AS JML,
                    0 AS JML_LALU1,
                    0 AS JML_LALU2
            FROM stp_setup_proyeksi_lr laba
            LEFT JOIN stp_setup_kode_perkiraan koper on laba.KODE_PERKIRAAN = koper.KODE_PERKIRAAN
            LEFT JOIN (
                SELECT
                        KODE_PERKIRAAN,
                        SUM(JANUARI) AS JAN,
                        SUM(FEBRUARI) AS FEB,
                        SUM(MARET) AS MAR,
                        SUM(APRIL) AS APR,
                        SUM(MEI) AS MEI,
                        SUM(JUNI) AS JUN,
                        SUM(JULI) AS JUL,
                        SUM(AGUSTUS) AS AGU,
                        SUM(SEPTEMBER) AS SEP,
                        SUM(OKTOBER) AS OKT,
                        SUM(NOVEMBER) AS NOP,
                        SUM(DESEMBER) AS DES,
                        SUM(JUMLAH) AS JML,
                        KOPER_INDUK,
                        TAHUN
                   FROM $tbl
                   GROUP BY KODE_PERKIRAAN, KOPER_INDUK, TAHUN

            ) AG ON koper.KODE_PERKIRAAN = AG.KODE_PERKIRAAN


            WHERE AG.TAHUN = $tahun AND laba.KODE_PERKIRAAN LIKE '%81%'
            GROUP BY laba.KODE_PERKIRAAN, koper.NAMA_PERKIRAAN, laba.NAMA

        ) a
        ORDER BY a.URUT, a.KODE_PERKIRAAN ASC
        ";
        return $this->db->query($sql)->result();
    }


    function get_condition_laba_new($tahun, $periode){

        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
        SELECT * FROM (
            SELECT
                    laba.KODE_PERKIRAAN, 
                    koper.NAMA_PERKIRAAN, 
                    laba.NAMA AS INDUK ,
                    laba.URUT,
                    0 + IFNULL(SUM(AG2.JAN),0) AS JAN,
                    0 + IFNULL(SUM(AG2.FEB),0) AS FEB,
                    0 + IFNULL(SUM(AG2.MAR),0) AS MAR,
                    0 + IFNULL(SUM(AG2.APR),0) AS APR,
                    0 + IFNULL(SUM(AG2.MEI),0) AS MEI,
                    0 + IFNULL(SUM(AG2.JUN),0) AS JUN,
                    0 + IFNULL(SUM(AG2.JUL),0) AS JUL,
                    0 + IFNULL(SUM(AG2.AGU),0) AS AGU,
                    0 + IFNULL(SUM(AG2.SEP),0) AS SEP,
                    0 + IFNULL(SUM(AG2.OKT),0) AS OKT,
                    0 + IFNULL(SUM(AG2.NOP),0) AS NOP,
                    0 + IFNULL(SUM(AG2.DES),0) AS DES,
                    0 + IFNULL(SUM(AG2.JML),0) AS JML,
                    0 + IFNULL(SUM(AG2.JML_LALU1),0) AS JML_LALU1,
                    0 + IFNULL(SUM(AG2.JML_LALU2),0) AS JML_LALU2
            FROM stp_setup_proyeksi_lr laba
            LEFT JOIN stp_setup_kode_perkiraan koper on laba.KODE_PERKIRAAN = koper.KODE_PERKIRAAN

            LEFT JOIN (
                SELECT INDUK_KODE, KODE_PERKIRAAN FROM stp_koper_child_00
                WHERE substr(KODE_PERKIRAAN, 1, 1) != 8
            ) CHILD 
            ON CHILD.INDUK_KODE = koper.KODE_PERKIRAAN

            LEFT JOIN (
                SELECT INDUK_KODE, KODE_PERKIRAAN FROM stp_koper_child_prolaba
                WHERE substr(KODE_PERKIRAAN, 1, 1) = 8
            ) CHILD2 
            ON CHILD2.INDUK_KODE = koper.KODE_PERKIRAAN

            LEFT JOIN (
                SELECT
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
                        (SUM(a.TOTAL) + SUM(a.TOTAL_PELAKSANAAN)) AS JML,
                        (SUM(dasar_lalu1.TOTAL) + SUM(dasar_lalu1.TOTAL_PELAKSANAAN)) AS JML_LALU1,
                        (SUM(dasar_lalu2.TOTAL) + SUM(dasar_lalu2.TOTAL_PELAKSANAAN)) AS JML_LALU2,
                        a.KODE_PERKIRAAN,
                        a.TAHUN
                FROM $tbl a
                
                LEFT JOIN (
                    SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0) AS TOTAL, IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL_PELAKSANAAN
                    FROM $tbl
                    WHERE TAHUN = $tahun-1
                    GROUP BY KODE_PERKIRAAN
                )dasar_lalu1 ON a.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN 

                LEFT JOIN (
                    SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0) AS TOTAL, IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL_PELAKSANAAN
                    FROM $tbl
                    WHERE TAHUN = $tahun-2
                    GROUP BY KODE_PERKIRAAN
                )dasar_lalu2 ON a.KODE_PERKIRAAN = dasar_lalu2.KODE_PERKIRAAN 

                GROUP BY a.KODE_PERKIRAAN, a.TAHUN

                UNION ALL

                SELECT
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
                        SUM(a.JUMLAH) AS JML,
                        SUM(dasar_lalu1.JUMLAH) AS JML_LALU1,
                        SUM(dasar_lalu2.JUMLAH) AS JML_LALU2,
                        a.KODE_PERKIRAAN,
                        a.TAHUN
                FROM stp_non_pendapatan a

                LEFT JOIN (
                    SELECT KODE_PERKIRAAN, IFNULL(SUM(JUMLAH),0) AS JUMLAH
                    FROM stp_non_pendapatan
                    WHERE TAHUN = $tahun-1
                    GROUP BY KODE_PERKIRAAN
                )dasar_lalu1 ON a.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN 

                LEFT JOIN (
                    SELECT KODE_PERKIRAAN, IFNULL(SUM(JUMLAH),0) AS JUMLAH
                    FROM stp_non_pendapatan
                    WHERE TAHUN = $tahun-2
                    GROUP BY KODE_PERKIRAAN
                )dasar_lalu2 ON a.KODE_PERKIRAAN = dasar_lalu2.KODE_PERKIRAAN 

                WHERE a.PERIODE = $periode
                GROUP BY a.KODE_PERKIRAAN, a.TAHUN

                UNION ALL

                SELECT
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
                        SUM(a.JUMLAH) AS JML,
                        SUM(dasar_lalu1.JUMLAH) AS JML_LALU1,
                        SUM(dasar_lalu2.JUMLAH) AS JML_LALU2,
                        a.KODE_PERKIRAAN,
                        a.TAHUN
                FROM stp_input_pendapatan_vw a

                LEFT JOIN (
                    SELECT KODE_PERKIRAAN, IFNULL(SUM(JUMLAH),0) AS JUMLAH
                    FROM stp_input_pendapatan_vw
                    WHERE TAHUN = $tahun-1
                    GROUP BY KODE_PERKIRAAN
                )dasar_lalu1 ON a.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN 

                LEFT JOIN (
                    SELECT KODE_PERKIRAAN, IFNULL(SUM(JUMLAH),0) AS JUMLAH
                    FROM stp_input_pendapatan_vw
                    WHERE TAHUN = $tahun-2
                    GROUP BY KODE_PERKIRAAN
                )dasar_lalu2 ON a.KODE_PERKIRAAN = dasar_lalu2.KODE_PERKIRAAN 


                WHERE a.PERIODE = $periode
                GROUP BY a.KODE_PERKIRAAN, a.TAHUN

            ) AG2 ON CHILD.KODE_PERKIRAAN = AG2.KODE_PERKIRAAN OR CHILD2.KODE_PERKIRAAN = AG2.KODE_PERKIRAAN AND AG2.TAHUN = $tahun

            GROUP BY laba.KODE_PERKIRAAN, koper.NAMA_PERKIRAAN, laba.NAMA
            ORDER BY laba.URUT, laba.KODE_PERKIRAAN ASC
        ) a

        WHERE a.KODE_PERKIRAAN != '81.00.00'
        ";
        return $this->db->query($sql)->result();
    }

    function get_pph29($tahun, $periode){
        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
            SELECT IFNULL(a.TOTAL1,0) AS TOTAL1, IFNULL(a.TOTAL2,0) AS TOTAL2 FROM (
                SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0)+ IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL1, 0 AS TOTAL2
                FROM $tbl
                WHERE KODE_PERKIRAAN IN ('96.07.20','96.02.50') AND TAHUN = $tahun
                GROUP BY KODE_PERKIRAAN

                UNION ALL 

                SELECT KODE_PERKIRAAN, 0 AS TOTAL1, IFNULL(SUM(TOTAL),0)+ IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL2
                FROM $tbl
                WHERE KODE_PERKIRAAN IN ('88.01.10','88.01.20') AND TAHUN = $tahun
                GROUP BY KODE_PERKIRAAN
            )a
        ";

        return $this->db->query($sql)->row();
    }

    function get_pph29_lalu1($tahun, $periode){
        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
            SELECT IFNULL(a.TOTAL1,0) AS TOTAL1, IFNULL(a.TOTAL2,0) AS TOTAL2 FROM (
                SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0)+ IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL1, 0 AS TOTAL2
                FROM $tbl
                WHERE KODE_PERKIRAAN IN ('96.07.20','96.02.50') AND TAHUN = $tahun - 1
                GROUP BY KODE_PERKIRAAN

                UNION ALL 

                SELECT KODE_PERKIRAAN, 0 AS TOTAL1, IFNULL(SUM(TOTAL),0)+ IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL2
                FROM $tbl
                WHERE KODE_PERKIRAAN IN ('88.01.10','88.01.20') AND TAHUN = $tahun - 1
                GROUP BY KODE_PERKIRAAN
            )a
        ";

        return $this->db->query($sql)->row();
    }

    function get_pph29_lalu2($tahun, $periode){
        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
            SELECT IFNULL(a.TOTAL1,0) AS TOTAL1, IFNULL(a.TOTAL2,0) AS TOTAL2 FROM (
                SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0)+ IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL1, 0 AS TOTAL2
                FROM $tbl
                WHERE KODE_PERKIRAAN IN ('96.07.20','96.02.50') AND TAHUN = $tahun - 2
                GROUP BY KODE_PERKIRAAN

                UNION ALL 

                SELECT KODE_PERKIRAAN, 0 AS TOTAL1, IFNULL(SUM(TOTAL),0)+ IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL2
                FROM $tbl
                WHERE KODE_PERKIRAAN IN ('88.01.10','88.01.20') AND TAHUN = $tahun - 2
                GROUP BY KODE_PERKIRAAN
            )a
        ";

        return $this->db->query($sql)->row();
    }


    function arus_kas($tahun, $periode){
        $sql = "
        SELECT 
        TRIM(a.URAIAN) URAIAN, TRIM(a.JENIS) JENIS,
        IFNULL(b.JANUARI, 0)  AS  JANUARI,
        IFNULL(b.FEBRUARI, 0) AS  FEBRUARI,
        IFNULL(b.MARET, 0)    AS  MARET,
        IFNULL(b.APRIL, 0)    AS  APRIL,
        IFNULL(b.MEI, 0)      AS  MEI,
        IFNULL(b.JUNI, 0)     AS  JUNI,
        IFNULL(b.JULI, 0)     AS  JULI,
        IFNULL(b.AGUSTUS, 0)  AS  AGUSTUS,
        IFNULL(b.SEPTEMBER, 0) AS SEPTEMBER,
        IFNULL(b.OKTOBER, 0)   AS OKTOBER,
        IFNULL(b.NOVEMBER, 0)  AS NOVEMBER,
        IFNULL(b.DESEMBER, 0)  AS DESEMBER,
        IFNULL(b.JUMLAH, 0)    AS JUMLAH
        FROM stp_revisi_arus_kas_judul a
        LEFT JOIN (
            SELECT * FROM stp_revisi_arus_kas
            WHERE TAHUN = $tahun AND PERIODE = $periode
        ) b ON TRIM(a.URAIAN) = TRIM(b.URAIAN) AND TRIM(a.JENIS) = TRIM(b.JENIS)
        ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function arus_kas_tidak_rinci($tahun, $periode){
        $sql = "
            SELECT
               *
            FROM stp_revisi_arus_kas
            WHERE TAHUN = $tahun AND PERIODE = $periode
        ";
        $query = $this->db->query($sql);
        return $query->result();
    }


    function get_setup_neraca($periode, $tahun){
        $sql = "
        SELECT a.*, 
               IFNULL(b.NILAI, 0) AS NILAI, 
               IFNULL(c.NILAI, 0) AS NILAI_LALU1,
               IFNULL(d.NILAI, 0) AS NILAI_LALU2
        FROM (
            SELECT 
                ID AS ID,
                INDUK1 AS AKTIVA_INDUK1,
                INDUK2 AS AKTIVA_INDUK2,
                JUDUL   AS AKTIVA_JUDUL,
                '' AS KEWAJIBAN_INDUK1,
                '' AS KEWAJIBAN_INDUK2,
                '' AS KEWAJIBAN_JUDUL,
                'AKTIVA' AS STS
            FROM stp_setup_lap_neraca 
            WHERE STS = 'AKTIVA'

            UNION ALL

            SELECT 
                ID AS ID,
                '' AS AKTIVA_INDUK1,
                '' AS AKTIVA_INDUK2,
                '' AS AKTIVA_JUDUL,
                INDUK1 AS KEWAJIBAN_INDUK1,
                INDUK2 AS KEWAJIBAN_INDUK2,
                JUDUL   AS KEWAJIBAN_JUDUL,
                'KEWAJIBAN' AS STS
            FROM stp_setup_lap_neraca 
            WHERE STS = 'KEWAJIBAN'
            ) a 
        
        LEFT JOIN (
            SELECT ID_NERACA, NILAI FROM stp_neraca
            WHERE TAHUN = $tahun AND PERIODE = $periode
        ) b ON a.ID = b.ID_NERACA

        LEFT JOIN (
            SELECT ID_NERACA, NILAI FROM stp_neraca
            WHERE TAHUN = $tahun - 1 AND PERIODE = $periode
        ) c ON a.ID = c.ID_NERACA

        LEFT JOIN (
            SELECT ID_NERACA, NILAI FROM stp_neraca
            WHERE TAHUN = $tahun - 2 AND PERIODE = $periode
        ) d ON a.ID = d.ID_NERACA
    
        ORDER BY a.ID
        ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_penyesuaian($periode, $tahun){
        $sql = "
        SELECT IFNULL(a.NILAI_AKTIVA, 0) AS NILAI_AKTIVA, IFNULL(a.NILAI_KEWAJIBAN, 0) AS NILAI_KEWAJIBAN FROM (
            SELECT SUM(a.NILAI_AKTIVA) AS NILAI_AKTIVA, SUM(a.NILAI_KEWAJIBAN) AS NILAI_KEWAJIBAN FROM (
                SELECT SUM(NILAI) AS NILAI_AKTIVA, 0 AS NILAI_KEWAJIBAN
                FROM stp_neraca 
                WHERE PERIODE = $periode AND TAHUN = $tahun AND STATUS = 'AKTIVA'

                UNION ALL 

                SELECT 0 AS NILAI_AKTIVA, SUM(NILAI) AS NILAI_KEWAJIBAN
                FROM stp_neraca 
                WHERE PERIODE = $periode AND TAHUN = $tahun AND STATUS = 'KEWAJIBAN'
            ) a
        ) a
        ";  

        $query = $this->db->query($sql);
        return $query->row();
    }

     function susut1_old($tahun, $periode){
        $tbl = "stp_anggaran_dasar_2015";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran_2015";
        }


        $sql = "
        SELECT 
            IFNULL(SUM(a.JAN),0) AS JAN,
            IFNULL(SUM(a.FEB),0) AS FEB,
            IFNULL(SUM(a.MAR),0) AS MAR,
            IFNULL(SUM(a.APR),0) AS APR,
            IFNULL(SUM(a.MEI),0) AS MEI,
            IFNULL(SUM(a.JUN),0) AS JUN,
            IFNULL(SUM(a.JUL),0) AS JUL,
            IFNULL(SUM(a.AGU),0) AS AGU,
            IFNULL(SUM(a.SEP),0) AS SEP,
            IFNULL(SUM(a.OKT),0) AS OKT,
            IFNULL(SUM(a.NOP),0) AS NOP,
            IFNULL(SUM(a.DES),0) AS DES,
            IFNULL(SUM(a.JML),0) AS JML,
            IFNULL(SUM(a.JML_LALU1),0) AS JML_LALU1,
            IFNULL(SUM(a.JML_LALU2),0) AS JML_LALU2
        FROM (
            SELECT
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
                SUM(a.JUMLAH) AS JML,
                SUM(dasar_lalu1.JUMLAH) AS JML_LALU1,
                SUM(dasar_lalu2.JUMLAH) AS JML_LALU2,
                a.KODE_PERKIRAAN,
                a.TAHUN
            FROM $tbl a
            
            LEFT JOIN (
                SELECT KODE_PERKIRAAN, IFNULL(SUM(JUMLAH),0) AS JUMLAH
                FROM $tbl
                WHERE TAHUN = $tahun-1
                GROUP BY KODE_PERKIRAAN
            )dasar_lalu1 ON a.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN 

            LEFT JOIN (
                SELECT KODE_PERKIRAAN, IFNULL(SUM(JUMLAH),0) AS JUMLAH
                FROM $tbl
                WHERE TAHUN = $tahun-2
                GROUP BY KODE_PERKIRAAN
            )dasar_lalu2 ON a.KODE_PERKIRAAN = dasar_lalu2.KODE_PERKIRAAN 
            
            WHERE a.TAHUN = $tahun AND a.KODE_PERKIRAAN LIKE '%31.10%'
        ) a
    
        ";

        $query = $this->db->query($sql);
        return $query->row();
    }

    function susut2_old($tahun, $periode){
        $tahun = $tahun - 1;
        $tbl = "stp_anggaran_dasar_2015";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran_2015";
        }


       $sql = "
        SELECT 
            IFNULL(SUM(a.JAN),0) AS JAN,
            IFNULL(SUM(a.FEB),0) AS FEB,
            IFNULL(SUM(a.MAR),0) AS MAR,
            IFNULL(SUM(a.APR),0) AS APR,
            IFNULL(SUM(a.MEI),0) AS MEI,
            IFNULL(SUM(a.JUN),0) AS JUN,
            IFNULL(SUM(a.JUL),0) AS JUL,
            IFNULL(SUM(a.AGU),0) AS AGU,
            IFNULL(SUM(a.SEP),0) AS SEP,
            IFNULL(SUM(a.OKT),0) AS OKT,
            IFNULL(SUM(a.NOP),0) AS NOP,
            IFNULL(SUM(a.DES),0) AS DES,
            IFNULL(SUM(a.JML),0) AS JML,
            IFNULL(SUM(a.JML_LALU1),0) AS JML_LALU1,
            IFNULL(SUM(a.JML_LALU2),0) AS JML_LALU2
        FROM (
            SELECT
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
                SUM(a.JUMLAH) AS JML,
                SUM(dasar_lalu1.JUMLAH) AS JML_LALU1,
                SUM(dasar_lalu2.JUMLAH) AS JML_LALU2,
                a.KODE_PERKIRAAN,
                a.TAHUN
            FROM $tbl a
            
            LEFT JOIN (
                SELECT KODE_PERKIRAAN, IFNULL(SUM(JUMLAH),0) AS JUMLAH
                FROM $tbl
                WHERE TAHUN = $tahun-1
                GROUP BY KODE_PERKIRAAN
            )dasar_lalu1 ON a.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN 

            LEFT JOIN (
                SELECT KODE_PERKIRAAN, IFNULL(SUM(JUMLAH),0) AS JUMLAH
                FROM $tbl
                WHERE TAHUN = $tahun-2
                GROUP BY KODE_PERKIRAAN
            )dasar_lalu2 ON a.KODE_PERKIRAAN = dasar_lalu2.KODE_PERKIRAAN 
            
            WHERE a.TAHUN = $tahun AND a.KODE_PERKIRAAN LIKE '%31.10%'
        ) a
    
        ";

        $query = $this->db->query($sql);
        return $query->row();
    }



    function susut1($tahun, $periode){
        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
        SELECT 
            IFNULL(SUM(a.JAN),0) AS JAN,
            IFNULL(SUM(a.FEB),0) AS FEB,
            IFNULL(SUM(a.MAR),0) AS MAR,
            IFNULL(SUM(a.APR),0) AS APR,
            IFNULL(SUM(a.MEI),0) AS MEI,
            IFNULL(SUM(a.JUN),0) AS JUN,
            IFNULL(SUM(a.JUL),0) AS JUL,
            IFNULL(SUM(a.AGU),0) AS AGU,
            IFNULL(SUM(a.SEP),0) AS SEP,
            IFNULL(SUM(a.OKT),0) AS OKT,
            IFNULL(SUM(a.NOP),0) AS NOP,
            IFNULL(SUM(a.DES),0) AS DES,
            IFNULL(SUM(a.JML),0) AS JML,
            IFNULL(SUM(a.JML_LALU1),0) AS JML_LALU1,
            IFNULL(SUM(a.JML_LALU2),0) AS JML_LALU2
        FROM (
            SELECT
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
                (SUM(a.TOTAL) + SUM(a.TOTAL_PELAKSANAAN)) AS JML,
                (SUM(dasar_lalu1.TOTAL) + SUM(dasar_lalu1.TOTAL_PELAKSANAAN)) AS JML_LALU1,
                (SUM(dasar_lalu2.TOTAL) + SUM(dasar_lalu2.TOTAL_PELAKSANAAN)) AS JML_LALU2,
                a.KODE_PERKIRAAN,
                a.TAHUN
            FROM $tbl a
            
            LEFT JOIN (
                SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0) AS TOTAL, IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL_PELAKSANAAN
                FROM $tbl
                WHERE TAHUN = $tahun-1
                GROUP BY KODE_PERKIRAAN
            )dasar_lalu1 ON a.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN 

            LEFT JOIN (
                SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0) AS TOTAL, IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL_PELAKSANAAN
                FROM $tbl
                WHERE TAHUN = $tahun-2
                GROUP BY KODE_PERKIRAAN
            )dasar_lalu2 ON a.KODE_PERKIRAAN = dasar_lalu2.KODE_PERKIRAAN 
            
            WHERE a.TAHUN = $tahun AND a.KODE_PERKIRAAN LIKE '%31.10%'
        ) a
    
        ";

        $query = $this->db->query($sql);
        return $query->row();
    }

    function susut2($tahun, $periode){
        $tahun = $tahun - 1;
        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
        SELECT 
            IFNULL(SUM(a.JAN),0) AS JAN,
            IFNULL(SUM(a.FEB),0) AS FEB,
            IFNULL(SUM(a.MAR),0) AS MAR,
            IFNULL(SUM(a.APR),0) AS APR,
            IFNULL(SUM(a.MEI),0) AS MEI,
            IFNULL(SUM(a.JUN),0) AS JUN,
            IFNULL(SUM(a.JUL),0) AS JUL,
            IFNULL(SUM(a.AGU),0) AS AGU,
            IFNULL(SUM(a.SEP),0) AS SEP,
            IFNULL(SUM(a.OKT),0) AS OKT,
            IFNULL(SUM(a.NOP),0) AS NOP,
            IFNULL(SUM(a.DES),0) AS DES,
            IFNULL(SUM(a.JML),0) AS JML,
            IFNULL(SUM(a.JML_LALU1),0) AS JML_LALU1,
            IFNULL(SUM(a.JML_LALU2),0) AS JML_LALU2
        FROM (
            SELECT
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
                (SUM(a.TOTAL) + SUM(a.TOTAL_PELAKSANAAN)) AS JML,
                (SUM(dasar_lalu1.TOTAL) + SUM(dasar_lalu1.TOTAL_PELAKSANAAN)) AS JML_LALU1,
                (SUM(dasar_lalu2.TOTAL) + SUM(dasar_lalu2.TOTAL_PELAKSANAAN)) AS JML_LALU2,
                a.KODE_PERKIRAAN,
                a.TAHUN
            FROM $tbl a
            
            LEFT JOIN (
                SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0) AS TOTAL, IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL_PELAKSANAAN
                FROM $tbl
                WHERE TAHUN = $tahun-1
                GROUP BY KODE_PERKIRAAN
            )dasar_lalu1 ON a.KODE_PERKIRAAN = dasar_lalu1.KODE_PERKIRAAN 

            LEFT JOIN (
                SELECT KODE_PERKIRAAN, IFNULL(SUM(TOTAL),0) AS TOTAL, IFNULL(SUM(TOTAL_PELAKSANAAN),0) AS TOTAL_PELAKSANAAN
                FROM $tbl
                WHERE TAHUN = $tahun-2
                GROUP BY KODE_PERKIRAAN
            )dasar_lalu2 ON a.KODE_PERKIRAAN = dasar_lalu2.KODE_PERKIRAAN 
            
            WHERE a.TAHUN = $tahun AND a.KODE_PERKIRAAN LIKE '%31.10%'
        ) a
    
        ";

        $query = $this->db->query($sql);
        return $query->row();
    }

}

?>