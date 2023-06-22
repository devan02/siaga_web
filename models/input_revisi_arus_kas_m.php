<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_revisi_arus_kas_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_arus_kas($tahun,$periode,$jenis){

        $sql = "
            SELECT 
                AK.ID,
                JUDUL.*,
                IFNULL(AK.JANUARI,0) AS JANUARI,
                IFNULL(AK.FEBRUARI,0) AS FEBRUARI,
                IFNULL(AK.MARET,0) AS MARET,
                IFNULL(AK.APRIL,0) AS APRIL,
                IFNULL(AK.MEI,0) AS MEI,
                IFNULL(AK.JUNI,0) AS JUNI,
                IFNULL(AK.JULI,0) AS JULI,
                IFNULL(AK.AGUSTUS,0) AS AGUSTUS,
                IFNULL(AK.SEPTEMBER,0) AS SEPTEMBER,
                IFNULL(AK.OKTOBER,0) AS OKTOBER,
                IFNULL(AK.NOVEMBER,0) AS NOVEMBER,
                IFNULL(AK.DESEMBER,0) AS DESEMBER
            FROM stp_revisi_arus_kas_judul JUDUL
            LEFT JOIN (
                SELECT
                    ID,
                    JENIS,
                    URAIAN,
                    IFNULL(JANUARI,0) AS JANUARI,
                    IFNULL(FEBRUARI,0) AS FEBRUARI,
                    IFNULL(MARET,0) AS MARET,
                    IFNULL(APRIL,0) AS APRIL,
                    IFNULL(MEI,0) AS MEI,
                    IFNULL(JUNI,0) AS JUNI,
                    IFNULL(JULI,0) AS JULI,
                    IFNULL(AGUSTUS,0) AS AGUSTUS,
                    IFNULL(SEPTEMBER,0) AS SEPTEMBER,
                    IFNULL(OKTOBER,0) AS OKTOBER,
                    IFNULL(NOVEMBER,0) AS NOVEMBER,
                    IFNULL(DESEMBER,0) AS DESEMBER
                FROM stp_revisi_arus_kas 
                WHERE TAHUN = '$tahun'
                AND PERIODE = '$periode'
            ) AK ON AK.JENIS = JUDUL.JENIS AND AK.URAIAN = JUDUL.URAIAN
            WHERE JUDUL.JENIS = '$jenis'
        ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function simpan(
        $URAIAN,
        $JENIS,
        $TAHUN,
        $JANUARI,
        $FEBRUARI,
        $MARET,
        $APRIL,
        $MEI,
        $JUNI,
        $JULI,
        $AGUSTUS,
        $SEPTEMBER,
        $OKTOBER,
        $NOVEMBER,
        $DESEMBER,
        $JUMLAH,
        $PERIODE){

        $sql = "
            INSERT INTO stp_revisi_arus_kas(
                URAIAN,
                JENIS,
                TAHUN,
                JANUARI,
                FEBRUARI,
                MARET,
                APRIL,
                MEI,
                JUNI,
                JULI,
                AGUSTUS,
                SEPTEMBER,
                OKTOBER,
                NOVEMBER,
                DESEMBER,
                JUMLAH,
                PERIODE
            ) VALUES(
                '$URAIAN',
                '$JENIS',
                '$TAHUN',
                '$JANUARI',
                '$FEBRUARI',
                '$MARET',
                '$APRIL',
                '$MEI',
                '$JUNI',
                '$JULI',
                '$AGUSTUS',
                '$SEPTEMBER',
                '$OKTOBER',
                '$NOVEMBER',
                '$DESEMBER',
                '$JUMLAH',
                '$PERIODE'
            )
        ";
        $this->db->query($sql);
    }

    function delete($tahun,$jenis,$periode){
        $sql = "DELETE FROM stp_revisi_arus_kas WHERE TAHUN = '$tahun' AND JENIS = '$jenis' AND PERIODE = '$periode'";
        $this->db->query($sql);
    }

    function update($id,$JANUARI,$FEBRUARI,$MARET,$APRIL,$MEI,$JUNI,$JULI,$AGUSTUS,$SEPTEMBER,$OKTOBER,$NOVEMBER,$DESEMBER){
        $sql = "
            UPDATE stp_revisi_arus_kas SET
                JANUARI = '$JANUARI',
                FEBRUARI = '$FEBRUARI',
                MARET = '$MARET',
                APRIL = '$APRIL',
                MEI = '$MEI',
                JUNI = '$JUNI',
                JULI = '$JULI',
                AGUSTUS = '$AGUSTUS',
                SEPTEMBER = '$SEPTEMBER',
                OKTOBER = '$OKTOBER',
                NOVEMBER = '$NOVEMBER',
                DESEMBER = '$DESEMBER',
            WHERE ID = '$id'
        ";
        $this->db->query($sql);
    }

}

?>