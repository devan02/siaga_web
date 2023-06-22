<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rapat_usulan_anggaran_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data($keyword,$bagian,$sub_bagian,$tahun,$kriteria,$kode_perkiraan){
        $where = "1 = 1";
        if($kriteria == "semua_bagian"){
            $where = $where;
        }else if($kriteria == "bagian"){
            $where = $where." AND DASAR.DEPARTEMEN = '$bagian'";
        }else{
            $where = $where." AND DASAR.DEPARTEMEN = '$bagian' AND DASAR.DIVISI = '$sub_bagian'"; 
        }

        if($kode_perkiraan != ""){
            $where = $where." AND DASAR.KODE_PERKIRAAN = '$kode_perkiraan'";
        }

        if($keyword != ""){
            $where = $where." AND 
                (
                    DASAR.KODE_ANGGARAN LIKE '%$keyword%' 
                    OR DASAR.URAIAN LIKE '%$keyword%' 
                    OR DASAR.KODE_PERKIRAAN LIKE '%$keyword%' 
                    OR DASAR.KODE_PERKIRAAN2 LIKE '%$keyword%'
                )
            ";
        }
        
        $sql = "
            SELECT 
                DASAR.ID_ANGGARAN,
                DASAR.KODE_ANGGARAN,
                DASAR.KODE_PERKIRAAN,
                DASAR.URAIAN,
                DASAR.SATUAN,
                DASAR.JUMLAH AS JUMLAH,
                REVISI.JUMLAH AS JUMLAH_REV,
                DASAR.HARGA AS HARGA,
                DASAR.JENIS_ANGGARAN,
                (CASE
                    WHEN USULAN.ID IS NOT NULL THEN
                        USULAN.TOTAL_USULAN
                    ELSE
                        DASAR.TOTAL
                END) AS TOTAL,
                DASAR.TOTAL_PELAKSANAAN,
                DASAR.TMT_PELAKSANAAN,
                DASAR.LAMA_PELAKSANAAN,
                DASAR.SETUJU,
                stp_departemen.NAMA AS DEPARTEMEN,
                stp_divisi.NAMA AS DIVISI,
                DASAR.JANUARI,
                DASAR.FEBRUARI,
                DASAR.MARET,
                DASAR.APRIL,
                DASAR.MEI,
                DASAR.APRIL,
                DASAR.MEI,
                DASAR.JUNI,
                DASAR.JULI,
                DASAR.AGUSTUS,
                DASAR.SEPTEMBER,
                DASAR.OKTOBER,
                DASAR.NOVEMBER,
                DASAR.DESEMBER,
                DASAR.STS_TAMBAHAN,
                DASAR.STS_REVISI,
                USULAN.RAPAT_KE
            FROM stp_anggaran_dasar DASAR
            LEFT JOIN stp_revisi_anggaran REVISI ON DASAR.KODE_ANGGARAN = REVISI.KODE_ANGGARAN
            LEFT JOIN(
                SELECT * FROM stp_usulan_anggaran
                WHERE AKTIF = 1
            ) USULAN ON DASAR.ID_ANGGARAN = USULAN.ID_ANGGARAN
            LEFT JOIN stp_departemen ON stp_departemen.ID = DASAR.DEPARTEMEN
            LEFT JOIN stp_divisi ON stp_divisi.ID = DASAR.DIVISI
            WHERE $where 
            AND DASAR.TAHUN = '$tahun'
            ORDER BY DASAR.KODE_ANGGARAN ASC
        ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_data_notif(){    
        $sql = "
            SELECT
                COUNT(*) AS JUMLAH,
                b.NAMA_DEP,
                b.NAMA_DIVISI,
                b.DIVISI
            FROM(
                SELECT
                 a.*
                FROM(
                    SELECT
                        USULAN.ID,
                        USULAN.ID_ANGGARAN,
                        USULAN.KODE_ANGGARAN,
                        USULAN.DEPARTEMEN,
                        DEP.NAMA AS NAMA_DEP,
                        USULAN.DIVISI,
                        DIVISI.NAMA AS NAMA_DIVISI,
                        USULAN.AKTIF
                    FROM stp_usulan_anggaran USULAN
                    LEFT JOIN stp_departemen DEP ON DEP.ID = USULAN.DEPARTEMEN
                    LEFT JOIN stp_divisi DIVISI ON DIVISI.ID = USULAN.DIVISI
                    LEFT JOIN(
                        SELECT ID,KODE_ANGGARAN FROM stp_usulan_anggaran
                    ) NGUSUL ON USULAN.ID = NGUSUL.ID
                    WHERE USULAN.AKTIF = 1 AND USULAN.JENIS_RAPAT = 'RKAP'
                    GROUP BY
                        USULAN.KODE_ANGGARAN
                ) a
            ) b
            GROUP BY b.NAMA_DEP
        ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_data_by_id($id_anggaran){
        $sql = "
            SELECT
                USULAN.ID AS ID_USULAN,
                DASAR.ID_ANGGARAN,
                DASAR.TAHUN,
                DASAR.KODE_ANGGARAN,
                DASAR.KODE_PERKIRAAN,
                DASAR.KODE_PERKIRAAN2,
                DASAR.URAIAN,
                DASAR.SATUAN,
                DASAR.JUMLAH AS JUMLAH,
                USULAN.JUMLAH_USULAN AS JUMLAH_USULAN,
                DASAR.HARGA AS HARGA,
                USULAN.HARGA_USULAN AS HARGA_USULAN,
                DASAR.JENIS_ANGGARAN,
                DASAR.ID_JENIS_ANGGARAN,
                DASAR.JENIS_RAPAT,
                (CASE
                    WHEN USULAN.ID IS NOT NULL THEN
                        USULAN.TOTAL_USULAN
                    ELSE
                        DASAR.TOTAL
                END) AS TOTAL,
                DASAR.TOTAL_PELAKSANAAN,
                DASAR.TMT_PELAKSANAAN,
                DASAR.LAMA_PELAKSANAAN,
                DASAR.SETUJU,
                DASAR.DEPARTEMEN AS ID_DEPARTEMEN,
                stp_departemen.NAMA AS DEPARTEMEN,
                DASAR.DIVISI AS ID_DIVISI,
                stp_divisi.NAMA AS DIVISI,
                DASAR.JANUARI,
                DASAR.FEBRUARI,
                DASAR.MARET,
                DASAR.APRIL,
                DASAR.MEI,
                DASAR.APRIL,
                DASAR.MEI,
                DASAR.JUNI,
                DASAR.JULI,
                DASAR.AGUSTUS,
                DASAR.SEPTEMBER,
                DASAR.OKTOBER,
                DASAR.NOVEMBER,
                DASAR.DESEMBER,
                USULAN.RAPAT_KE,
                USULAN.AKTIF
            FROM stp_anggaran_dasar DASAR
            LEFT JOIN(
                SELECT * FROM stp_usulan_anggaran
                WHERE AKTIF = 1
            ) USULAN ON DASAR.ID_ANGGARAN = USULAN.ID_ANGGARAN
            LEFT JOIN stp_departemen ON stp_departemen.ID = DASAR.DEPARTEMEN
            LEFT JOIN stp_divisi ON stp_divisi.ID = DASAR.DIVISI
            WHERE DASAR.ID_ANGGARAN = '$id_anggaran'
        ";
        $query = $this->db->query($sql);
        return $query->row();
    }

    function simpan_usulan(
        $id_anggaran,
        $kode_perkiraan,
        $kode_perkiraan2,
        $kode_anggaran,
        $uraian,
        $tahun,
        $departemen,
        $divisi,
        $jenis_anggaran,
        $id_jenis_anggaran,
        $satuan,
        $harga_usulan,
        $jumlah_usulan,
        $total_usulan,
        $tmt_pelaksanaan,
        $lama_pelaksanaan,
        $total_pelaksanaan,
        $jenis_rapat,
        $setuju,
        $rapat_ke,
        $januari,
        $februari,
        $maret,
        $april,
        $mei,
        $juni,
        $juli,
        $agustus,
        $september,
        $oktober,
        $november,
        $desember,
        $tanggal){

        $sql = "
            INSERT INTO stp_usulan_anggaran(
                ID_ANGGARAN,
                KODE_PERKIRAAN,
                KODE_PERKIRAAN2,
                KODE_ANGGARAN,
                URAIAN,
                TAHUN,
                DEPARTEMEN,
                DIVISI,
                JENIS_ANGGARAN,
                ID_JENIS_ANGGARAN,
                SATUAN,
                HARGA_USULAN,
                JUMLAH_USULAN,
                TOTAL_USULAN,
                TMT_PELAKSANAAN,
                LAMA_PELAKSANAAN,
                TOTAL_PELAKSANAAN,
                JENIS_RAPAT,
                SETUJU,
                RAPAT_KE,
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
                TANGGAL_INPUT,
                AKTIF
            )VALUES(
                '$id_anggaran',
                '$kode_perkiraan',
                '$kode_perkiraan2',
                '$kode_anggaran',
                '$uraian',
                '$tahun',
                '$departemen',
                '$divisi',
                '$jenis_anggaran',
                '$id_jenis_anggaran',
                '$satuan',
                '$harga_usulan',
                '$jumlah_usulan',
                '$total_usulan',
                '$tmt_pelaksanaan',
                '$lama_pelaksanaan',
                '$total_pelaksanaan',
                '$jenis_rapat',
                '$setuju',
                '$rapat_ke',
                '$januari',
                '$februari',
                '$maret',
                '$april',
                '$mei',
                '$juni',
                '$juli',
                '$agustus',
                '$september',
                '$oktober',
                '$november',
                '$desember',
                '$tanggal',
                1
            )
        ";
        $this->db->query($sql);
    }

    function update_anggaran_dasar_rkap(
        $id_anggaran,
        $jenis_anggaran,
        $volume_rkap,
        $harga_rkap,
        $total_rkap,
        $januari,$februari,$maret,$april,$mei,$juni,$juli,$agustus,$september,$oktober,$november,$desember){

        $sql = "";
        if($jenis_anggaran == "Barang"){
            $sql = "
                UPDATE stp_anggaran_dasar SET
                    JUMLAH = '$volume_rkap',
                    HARGA = '$harga_rkap',
                    TOTAL = '$total_rkap',
                    TOTAL_PELAKSANAAN = '0',
                    JANUARI = '$januari',
                    FEBRUARI = '$februari',
                    MARET = '$maret',
                    APRIL = '$april',
                    MEI = '$mei',
                    JUNI = '$juni',
                    JULI = '$juli',
                    AGUSTUS = '$agustus',
                    SEPTEMBER = '$september',
                    OKTOBER = '$oktober',
                    NOVEMBER = '$november',
                    DESEMBER = '$desember'
                WHERE ID_ANGGARAN = $id_anggaran
            ";
        }else{
            $sql = "
                UPDATE stp_anggaran_dasar SET
                    JUMLAH = '$volume_rkap',
                    HARGA = '$harga_rkap',
                    TOTAL = '0',
                    TOTAL_PELAKSANAAN = '$total_rkap',
                    JANUARI = '$januari',
                    FEBRUARI = '$februari',
                    MARET = '$maret',
                    APRIL = '$april',
                    MEI = '$mei',
                    JUNI = '$juni',
                    JULI = '$juli',
                    AGUSTUS = '$agustus',
                    SEPTEMBER = '$september',
                    OKTOBER = '$oktober',
                    NOVEMBER = '$november',
                    DESEMBER = '$desember'
                WHERE ID_ANGGARAN = $id_anggaran
            ";
        }
        $this->db->query($sql);
    }

    function update_usulan(
        $id_anggaran,
        $harga_usulan,
        $jumlah_usulan,
        $total_usulan,
        $total_pelaksanaan,
        $rapat_ke,
        $januari,
        $februari,
        $maret,
        $april,
        $mei,
        $juni,
        $juli,
        $agustus,
        $september,
        $oktober,
        $november,
        $desember){
        
        $sql = "
            UPDATE stp_usulan_anggaran SET
                HARGA_USULAN = '$harga_usulan',
                JUMLAH_USULAN = '$jumlah_usulan',
                TOTAL_USULAN = '$total_usulan',
                TOTAL_PELAKSANAAN = '$total_pelaksanaan',
                RAPAT_KE = '$rapat_ke',
                JANUARI = '$januari',
                FEBRUARI = '$februari',
                MARET = '$maret',
                APRIL = '$april',
                MEI = '$mei',
                JUNI = '$juni',
                JULI = '$juli',
                AGUSTUS = '$agustus',
                SEPTEMBER = '$september',
                OKTOBER = '$oktober',
                NOVEMBER = '$november',
                DESEMBER = '$desember'
            WHERE ID_ANGGARAN = $id_anggaran
        ";
        $this->db->query($sql);
    }

    function get_detail_notif($divisi){
        $sql = "
            SELECT 
                DASAR.ID_ANGGARAN,
                DASAR.KODE_ANGGARAN,
                DASAR.KODE_PERKIRAAN,
                DASAR.URAIAN,
                DASAR.SATUAN,
                DASAR.JUMLAH AS JUMLAH,
                DASAR.HARGA AS HARGA,
                DASAR.JENIS_ANGGARAN,
                (CASE
                    WHEN USULAN.ID IS NOT NULL THEN
                        USULAN.TOTAL_USULAN
                    ELSE
                        DASAR.TOTAL
                END) AS TOTAL,
                DASAR.TOTAL_PELAKSANAAN,
                DASAR.TMT_PELAKSANAAN,
                DASAR.LAMA_PELAKSANAAN,
                DASAR.SETUJU,
                stp_departemen.NAMA AS DEPARTEMEN,
                stp_divisi.NAMA AS DIVISI,
                DASAR.JANUARI,
                DASAR.FEBRUARI,
                DASAR.MARET,
                DASAR.APRIL,
                DASAR.MEI,
                DASAR.APRIL,
                DASAR.MEI,
                DASAR.JUNI,
                DASAR.JULI,
                DASAR.AGUSTUS,
                DASAR.SEPTEMBER,
                DASAR.OKTOBER,
                DASAR.NOVEMBER,
                DASAR.DESEMBER,
                DASAR.STS_TAMBAHAN,
                USULAN.RAPAT_KE
            FROM stp_anggaran_dasar DASAR
            LEFT JOIN(
                SELECT * FROM stp_usulan_anggaran
                WHERE AKTIF = 1
            ) USULAN ON DASAR.ID_ANGGARAN = USULAN.ID_ANGGARAN
            LEFT JOIN stp_departemen ON stp_departemen.ID = DASAR.DEPARTEMEN
            LEFT JOIN stp_divisi ON stp_divisi.ID = DASAR.DIVISI
            WHERE DASAR.DIVISI = $divisi AND USULAN.RAPAT_KE >= 1
            ORDER BY DASAR.KODE_ANGGARAN ASC
        ";
        $query = $this->db->query($sql);
        return $query->result();
    }

}

?>