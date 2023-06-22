<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate_neraca_manual_m extends CI_Model
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

    function get_neraca($periode, $tahun){
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

    function simpan_nilai_neraca($id_nrc, $tahun, $periode, $nilai, $sts){

        $nilai = str_replace(',', '', $nilai);

        $sql = "
        INSERT INTO stp_neraca
        (ID_NERACA, NILAI, TAHUN, PERIODE, STATUS)
        VALUES
        ($id_nrc, $nilai, $tahun, $periode, '$sts')
        ";

        $this->db->query($sql);
    }

}

?>