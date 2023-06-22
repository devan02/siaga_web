<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate_neraca_m extends CI_Model
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

	function delete_neraca($tahun, $periode){
		$sql = "
			DELETE FROM stp_neraca WHERE TAHUN = $tahun AND PERIODE = $periode
		";

		$this->db->query($sql);
	}

	function get_nilai_bank($tahun, $periode){
		$sql = "
		SELECT (JUMLAH_TERIMA - JUMLAH_KELUAR) AS NILAI FROM (
			SELECT IFNULL(JUMLAH_TERIMA, 0) AS JUMLAH_TERIMA, IFNULL(JUMLAH_KELUAR,0) AS JUMLAH_KELUAR FROM (
				SELECT SUM(JUMLAH) AS JUMLAH_TERIMA, 0 AS JUMLAH_KELUAR FROM stp_revisi_arus_kas
				WHERE PERIODE = $periode AND TAHUN = $tahun AND ( JENIS LIKE '%Penerimaan%' OR JENIS LIKE '%Saldo%' )

				UNION ALL 

				SELECT 0 AS JUMLAH_TERIMA, SUM(JUMLAH) AS JUMLAH_KELUAR FROM stp_revisi_arus_kas
				WHERE PERIODE = $periode AND TAHUN = $tahun AND JENIS LIKE '%Pengeluaran%'
			) a
		) a
		";

		$query = $this->db->query($sql);
		return $query->row();
	}	

	function simpan_nilai_neraca($id_nrc, $tahun, $periode, $nilai_bank){
		$sql = "
		INSERT INTO stp_neraca
		(ID_NERACA, NILAI, TAHUN, PERIODE, STATUS)
		VALUES
		($id_nrc, $nilai_bank, $tahun, $periode, 'AKTIVA')
		";

		$this->db->query($sql);
	}

	function simpan_nilai_neraca_wajib($id_nrc, $tahun, $periode, $nilai_bank){
		$sql = "
		INSERT INTO stp_neraca
		(ID_NERACA, NILAI, TAHUN, PERIODE, STATUS)
		VALUES
		($id_nrc, $nilai_bank, $tahun, $periode, 'KEWAJIBAN')
		";

		$this->db->query($sql);
	}

	function get_nilai_bahan_operasi($tahun, $periode){

        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
        SELECT IFNULL(SUM(JML),0) AS NILAI FROM (
            SELECT
                    IFNULL(AG.JML,0) AS JML
            FROM stp_setup_lap_rencana_beli laba
            LEFT JOIN stp_setup_kode_perkiraan koper on laba.KODE_PERKIRAAN = koper.KODE_PERKIRAAN
            LEFT JOIN (

                SELECT
              
                        CIL.KODE_PERKIRAAN AS KODE_PERKIRAAN,                    
                        ( CIL.JML + IFNULL(SUM(DAS.TOTAL),0) + IFNULL(SUM(DAS.TOTAL_PELAKSANAAN),0) ) AS JML,
                        DAS.TAHUN,
                        CIL.KODE_PERKIRAAN AS INDUK_KODE
                FROM stp_koper_child_vw CIL
                LEFT JOIN $tbl DAS ON CIL.KODE_PERKIRAAN = DAS.KODE_PERKIRAAN

                WHERE CIL.INDUK_KODE = '' OR CIL.INDUK_KODE IS NULL
                GROUP BY CIL.KODE_PERKIRAAN, DAS.TAHUN

                UNION ALL

                SELECT
                        CASE 
                          WHEN CHILD.INDUK_KODE = '' THEN
                        dasar.KODE_PERKIRAAN ELSE CONCAT(CHILD.INDUK_KODE,'-',dasar.KODE_PERKIRAAN)
                        END AS KODE_PERKIRAAN,
                        (SUM(dasar.TOTAL) + SUM(dasar.TOTAL_PELAKSANAAN)) AS JML,
                        dasar.TAHUN,
                        CHILD.INDUK_KODE
                   FROM $tbl dasar
                   LEFT JOIN stp_koper_child_vw CHILD 
                   ON CHILD.INDUK_KODE = dasar.KODE_PERKIRAAN OR CHILD.KODE_PERKIRAAN = dasar.KODE_PERKIRAAN

                   GROUP BY CHILD.INDUK_KODE, dasar.KODE_PERKIRAAN, dasar.TAHUN
            ) AG ON AG.INDUK_KODE = koper.KODE_PERKIRAAN

            WHERE AG.TAHUN = $tahun
        ) a
        ";
        return $this->db->query($sql)->row();
    }

    function get_nilai_perolehan($tahun, $periode){

        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
        SELECT * FROM (
            SELECT
                    laba.ID_NERACA, 
                    IFNULL(SUM(AG.JML),0) + IFNULL(SUM(AG2.JML),0) AS NILAI
            FROM stp_setup_lap_proyeksi_investasi laba
            LEFT JOIN stp_setup_kode_perkiraan koper on laba.KODE_PERKIRAAN = koper.KODE_PERKIRAAN
            LEFT JOIN (
                    SELECT
                        a.KODE_PERKIRAAN,
                        SUM(a.TOTAL + a.TOTAL_PELAKSANAAN) AS JML,
                        a.TAHUN
                   FROM $tbl a
                   GROUP BY a.KODE_PERKIRAAN, a.TAHUN

            ) AG ON koper.KODE_PERKIRAAN = AG.KODE_PERKIRAAN AND AG.TAHUN = $tahun

            LEFT JOIN stp_koper_child_vw CHILD 
            ON CHILD.INDUK_KODE = koper.KODE_PERKIRAAN

            LEFT JOIN (
                SELECT
                        a.KODE_PERKIRAAN,
                        SUM(a.TOTAL + a.TOTAL_PELAKSANAAN) AS JML,
                        a.TAHUN
                FROM $tbl a

                GROUP BY a.KODE_PERKIRAAN, a.TAHUN

            ) AG2 ON CHILD.KODE_PERKIRAAN = AG2.KODE_PERKIRAAN AND AG2.TAHUN = $tahun

			WHERE laba.ID_NERACA != '' OR laba.ID_NERACA IS NOT NULL
            GROUP BY laba.ID_NERACA
            ORDER BY laba.ID_NERACA
        ) a
        ";
        return $this->db->query($sql)->result();
    }

    function get_nilai_utang_usaha($tahun, $periode){

        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }


        $sql = "
        SELECT * FROM (
            SELECT
                    IFNULL(SUM(AG.JML),0) AS NILAI
            FROM stp_setup_lap_rencana_bayar_hutang laba
            LEFT JOIN stp_setup_kode_perkiraan koper on laba.KODE_PERKIRAAN = koper.KODE_PERKIRAAN
            LEFT JOIN (

                SELECT
                        CIL.KODE_PERKIRAAN AS KODE_PERKIRAAN,                
                        ( CIL.JML + IFNULL(SUM(DAS.TOTAL),0) + IFNULL(SUM(DAS.TOTAL_PELAKSANAAN),0) ) AS JML,
                        $tahun AS TAHUN,
                        CIL.KODE_PERKIRAAN AS INDUK_KODE
                FROM stp_koper_child_vw CIL
                LEFT JOIN $tbl DAS ON CIL.KODE_PERKIRAAN = DAS.KODE_PERKIRAAN AND DAS.TAHUN = $tahun
                WHERE CIL.INDUK_KODE = '' OR CIL.INDUK_KODE IS NULL
                GROUP BY CIL.KODE_PERKIRAAN

                UNION ALL

                SELECT

                        CASE 
                          WHEN CHILD.INDUK_KODE = '' THEN
                        dasar.KODE_PERKIRAAN ELSE CONCAT(CHILD.INDUK_KODE,'-',dasar.KODE_PERKIRAAN)
                        END AS KODE_PERKIRAAN,                                             
                        (SUM(dasar.TOTAL) + SUM(dasar.TOTAL_PELAKSANAAN)) AS JML,
                        dasar.TAHUN,
                        CHILD.INDUK_KODE
                   FROM $tbl dasar
                   LEFT JOIN stp_koper_child_vw CHILD 
                   ON CHILD.INDUK_KODE = dasar.KODE_PERKIRAAN OR CHILD.KODE_PERKIRAAN = dasar.KODE_PERKIRAAN

                   GROUP BY CHILD.INDUK_KODE, dasar.KODE_PERKIRAAN,  dasar.TAHUN

            ) AG ON AG.INDUK_KODE = koper.KODE_PERKIRAAN

            WHERE AG.TAHUN = $tahun
        ) a
        ";
        return $this->db->query($sql)->row();
    }

    function get_laba_rugi($tahun, $periode){

        $tbl = "stp_anggaran_dasar";

        if($periode == 2){
            $tbl = "stp_revisi_anggaran";
        }

        $sql = "
        SELECT 
            IFNULL(SUM(a.JML),0) AS NILAI
        FROM (
            SELECT
                    0 + IFNULL(SUM(AG2.JML),0) AS JML
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
                        ((SUM(a.TOTAL) + SUM(a.TOTAL_PELAKSANAAN)) * -1) AS JML,
                        a.KODE_PERKIRAAN,
                        a.TAHUN
                FROM $tbl a
                

                GROUP BY a.KODE_PERKIRAAN, a.TAHUN

                UNION ALL

                SELECT
                        SUM(a.JUMLAH) AS JML,
                        a.KODE_PERKIRAAN,
                        a.TAHUN
                FROM stp_non_pendapatan a
                WHERE a.PERIODE = $periode
                GROUP BY a.KODE_PERKIRAAN, a.TAHUN

                UNION ALL

                SELECT
                        SUM(a.JUMLAH) AS JML,
                        a.KODE_PERKIRAAN,
                        a.TAHUN
                FROM stp_input_pendapatan_vw a

                WHERE a.PERIODE = $periode
                GROUP BY a.KODE_PERKIRAAN, a.TAHUN

            ) AG2 ON CHILD.KODE_PERKIRAAN = AG2.KODE_PERKIRAAN OR CHILD2.KODE_PERKIRAAN = AG2.KODE_PERKIRAAN AND AG2.TAHUN = $tahun
        ) a
        ";
        return $this->db->query($sql)->row();
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


}

?>