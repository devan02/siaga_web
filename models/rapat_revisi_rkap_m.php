<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rapat_revisi_rkap_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data($keyword,$bagian,$sub_bagian,$tahun,$kriteria,$kode_perkiraan){
        $where = "1 = 1";
        $where2 = "1 = 1";

        if($kriteria == "semua_bagian"){
            $where = $where;
            $where2 = $where2;
        }else if($kriteria == "bagian"){
            $where = $where." AND REVISI.DEPARTEMEN = '$bagian'";
            $where2 = $where2." AND DASAR.DEPARTEMEN = '$bagian'";
        }else{
            $where = $where." AND REVISI.DEPARTEMEN = '$bagian' AND REVISI.DIVISI = '$sub_bagian'";
            $where2 = $where2." AND DASAR.DEPARTEMEN = '$bagian' AND DASAR.DIVISI = '$sub_bagian'";
        }

        if($kode_perkiraan != ""){
            $where = $where." AND REVISI.KODE_PERKIRAAN = '$kode_perkiraan'";
            $where2 = $where2." AND DASAR.KODE_PERKIRAAN = '$kode_perkiraan'";
        }

        if($keyword != ""){
            $where = $where." AND 
                (
                    REVISI.KODE_ANGGARAN LIKE '%$keyword%' 
                    OR REVISI.URAIAN LIKE '%$keyword%' 
                    OR REVISI.KODE_PERKIRAAN LIKE '%$keyword%' 
                    OR REVISI.KODE_PERKIRAAN2 LIKE '%$keyword%'
                )
            ";
            $where2 = $where2." AND 
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
                ID_ANGGARAN,
                KODE_ANGGARAN,
                KODE_PERKIRAAN,
                URAIAN,
                JUMLAH,
                SATUAN,
                RKAP,
                TAHUN,
                HARGA,
                DEPARTEMEN,
                DIVISI,
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
                SETUJU,
                STS_TAMBAHAN,
                STS_REVISI,
                RAPAT_KE,
                REALISASI,
                (CASE
                    WHEN (REALISASI > RKAP && REALISASI > 0) THEN 'merah'
                    WHEN (REALISASI < RKAP && REALISASI > 0) THEN 'kuning'
                    WHEN (STS_TAMBAHAN = 4) THEN 'orange'
                    WHEN (STS_TAMBAHAN = 3) THEN 'ungu'
                    WHEN (STS_TAMBAHAN = 1 && STS_REVISI = 6) THEN 'biru'
                    WHEN (STS_TAMBAHAN = 2 && STS_REVISI = 6) THEN 'biru'
                    ELSE 'putih'
                END) AS WARNA,
                PERIODE
            FROM(
                SELECT
                    REVISI.ID AS ID_ANGGARAN,
                    REVISI.KODE_ANGGARAN,
                    REVISI.KODE_PERKIRAAN,
                    REVISI.URAIAN,
                    REVISI.JUMLAH AS JUMLAH,
                    REVISI.SATUAN,
                    (CASE
                        WHEN REVISI.JENIS_ANGGARAN = 'Barang' THEN
                            REVISI.TOTAL
                        ELSE
                            REVISI.TOTAL_PELAKSANAAN
                    END) AS RKAP,
                    REVISI.TAHUN,
                    REVISI.HARGA AS HARGA,
                    c.nama DEPARTEMEN,
                    b.nama DIVISI,
                    REVISI.JANUARI,
                    REVISI.FEBRUARI,
                    REVISI.MARET,
                    REVISI.APRIL,
                    REVISI.MEI,
                    REVISI.JUNI,
                    REVISI.JULI,
                    REVISI.AGUSTUS,
                    REVISI.SEPTEMBER,
                    REVISI.OKTOBER,
                    REVISI.NOVEMBER,
                    REVISI.DESEMBER,
                    REVISI.SETUJU,
                    REVISI.STS_TAMBAHAN,
                    REVISI.STS_REVISI,
                    USULAN.RAPAT_KE,
                    SUM(
                        (CASE
                            WHEN REALISASI.ID_SPK != 0 THEN 
                                REALISASI.HARGA_SATUAN_SPK * REALISASI.VOLUME_SPK
                            ELSE 
                                (CASE
                                    WHEN REALISASI.ID_RAB != 0 THEN 
                                        REALISASI.VOLUME_RAB * REALISASI.HARGA_SATUAN_RAB
                                    ELSE 
                                        REALISASI.VOLUME_DPBM * REALISASI.HARGA_SATUAN_DPBM
                                END)
                        END)
                    ) AS REALISASI,
                    '2' AS PERIODE
                FROM stp_revisi_anggaran REVISI
                LEFT JOIN (
                        SELECT * FROM stp_realisasi_anggaran
                        WHERE PERIODE = 2
                ) REALISASI ON REALISASI.ID_ANGGARAN = REVISI.ID
                LEFT JOIN stp_divisi b ON b.id = REVISI.DIVISI
                LEFT JOIN stp_departemen c ON c.id = REVISI.DEPARTEMEN
                LEFT JOIN (
                    SELECT ID_ANGGARAN,RAPAT_KE FROM stp_usulan_anggaran
                    WHERE AKTIF = 1 AND JENIS_RAPAT = 'REVISI-RKAP'
                ) USULAN ON USULAN.ID_ANGGARAN = REVISI.ID
                WHERE $where
                AND REVISI.TAHUN = '$tahun'
                GROUP BY 
                    REVISI.KODE_ANGGARAN
                    
                UNION ALL
                    
                SELECT
                    DASAR.ID_ANGGARAN,
                    DASAR.KODE_ANGGARAN,
                    DASAR.KODE_PERKIRAAN,
                    DASAR.URAIAN,
                    DASAR.JUMLAH AS JUMLAH,
                    DASAR.SATUAN,
                    (CASE
                        WHEN DASAR.JENIS_ANGGARAN = 'Barang' THEN
                            DASAR.TOTAL
                        ELSE
                            DASAR.TOTAL_PELAKSANAAN
                    END) AS RKAP,
                    DASAR.TAHUN,
                    DASAR.HARGA AS HARGA,
                    c.nama DEPARTEMEN,
                    b.nama DIVISI,
                    DASAR.JANUARI,
                    DASAR.FEBRUARI,
                    DASAR.MARET,
                    DASAR.APRIL,
                    DASAR.MEI,
                    DASAR.JUNI,
                    DASAR.JULI,
                    DASAR.AGUSTUS,
                    DASAR.SEPTEMBER,
                    DASAR.OKTOBER,
                    DASAR.NOVEMBER,
                    DASAR.DESEMBER,
                    DASAR.SETUJU,
                    DASAR.STS_TAMBAHAN,
                    DASAR.STS_REVISI,
                    USULAN.RAPAT_KE,
                    SUM(
                        (CASE
                            WHEN REALISASI.ID_SPK != 0 THEN 
                                REALISASI.HARGA_SATUAN_SPK * REALISASI.VOLUME_SPK
                            ELSE 
                                (CASE
                                    WHEN REALISASI.ID_RAB != 0 THEN 
                                        REALISASI.VOLUME_RAB * REALISASI.HARGA_SATUAN_RAB
                                    ELSE 
                                        REALISASI.VOLUME_DPBM * REALISASI.HARGA_SATUAN_DPBM
                                END)
                        END)
                    ) AS REALISASI,
                    '1' AS PERIODE
                FROM stp_anggaran_dasar DASAR
                LEFT JOIN stp_divisi b ON b.id = DASAR.DIVISI
                LEFT JOIN stp_departemen c ON c.id = DASAR.DEPARTEMEN
                LEFT JOIN (
                    SELECT * FROM stp_realisasi_anggaran
                    WHERE PERIODE = 1
                ) REALISASI ON REALISASI.ID_ANGGARAN = DASAR.ID_ANGGARAN
                LEFT JOIN (
                        SELECT ID_ANGGARAN,RAPAT_KE FROM stp_usulan_anggaran
                        WHERE AKTIF = 1 AND JENIS_RAPAT = 'RKAP'
                ) USULAN ON USULAN.ID_ANGGARAN = DASAR.ID_ANGGARAN
                WHERE $where2
                AND DASAR.TAHUN = '$tahun'
                GROUP BY 
                    DASAR.KODE_ANGGARAN
            ) a
            GROUP BY a.KODE_ANGGARAN
            ORDER BY a.KODE_ANGGARAN ASC
        ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_data_by_id($id_anggaran,$periode){
        $where = "1 = 1";
        $cek_usulan = "SELECT COUNT(*) AS TOTAL FROM stp_usulan_anggaran WHERE ID_ANGGARAN = '$id_anggaran'";
        $query_usulan = $this->db->query($cek_usulan)->row();
        $total = $query_usulan->TOTAL;
        
        if($total != 0){
            $where = "USULAN.AKTIF = 1";
        }

        $isi = "";
        if($periode == "2"){
            $isi = "
                SELECT
                    ID,
                    ID_ANGGARAN,
                    KODE_ANGGARAN,
                    KODE_PERKIRAAN,
                    URAIAN,
                    JUMLAH,
                    SATUAN,
                    RKAP,
                    TAHUN,
                    HARGA,
                    DEPARTEMEN,
                    DIVISI,
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
                    SETUJU,
                    STS_TAMBAHAN,
                    STS_REVISI,
                    RAPAT_KE,
                    REALISASI,
                    (CASE
                        WHEN (REALISASI > RKAP && REALISASI > 0) THEN 'merah'
                        WHEN (REALISASI < RKAP && REALISASI > 0) THEN 'kuning'
                        WHEN (STS_TAMBAHAN = 4) THEN 'orange'
                        WHEN (STS_TAMBAHAN = 3) THEN 'ungu'
                        WHEN (STS_TAMBAHAN = 1 && STS_REVISI = 6) THEN 'biru'
                        WHEN (STS_TAMBAHAN = 2 && STS_REVISI = 6) THEN 'biru'
                        ELSE 'putih'
                    END) AS WARNA
                FROM(
                    SELECT
                        REVISI.ID,
                        REVISI.ID_ANGGARAN,
                        REVISI.KODE_ANGGARAN,
                        REVISI.KODE_PERKIRAAN,
                        REVISI.URAIAN,
                        REVISI.JUMLAH AS JUMLAH,
                        REVISI.SATUAN,
                        (CASE
                            WHEN REVISI.JENIS_ANGGARAN = 'Barang' THEN
                                REVISI.TOTAL
                            ELSE
                                REVISI.TOTAL_PELAKSANAAN
                        END) AS RKAP,
                        REVISI.TAHUN,
                        REVISI.HARGA AS HARGA,
                        c.nama DEPARTEMEN,
                        b.nama DIVISI,
                        REVISI.JANUARI,
                        REVISI.FEBRUARI,
                        REVISI.MARET,
                        REVISI.APRIL,
                        REVISI.MEI,
                        REVISI.JUNI,
                        REVISI.JULI,
                        REVISI.AGUSTUS,
                        REVISI.SEPTEMBER,
                        REVISI.OKTOBER,
                        REVISI.NOVEMBER,
                        REVISI.DESEMBER,
                        REVISI.SETUJU,
                        REVISI.STS_TAMBAHAN,
                        REVISI.STS_REVISI,
                        USULAN.RAPAT_KE,
                        SUM(
                            (CASE
                                WHEN REALISASI.ID_SPK != 0 THEN 
                                    REALISASI.HARGA_SATUAN_SPK * REALISASI.VOLUME_SPK
                                ELSE 
                                    (CASE
                                        WHEN REALISASI.ID_RAB != 0 THEN 
                                            REALISASI.VOLUME_RAB * REALISASI.HARGA_SATUAN_RAB
                                        ELSE 
                                            REALISASI.VOLUME_DPBM * REALISASI.HARGA_SATUAN_DPBM
                                    END)
                            END)
                        ) AS REALISASI
                    FROM stp_revisi_anggaran REVISI
                    LEFT JOIN stp_divisi b ON b.id = REVISI.DIVISI
                    LEFT JOIN stp_departemen c ON c.id = REVISI.DEPARTEMEN
                    LEFT JOIN (
                        SELECT * FROM stp_realisasi_anggaran
                        WHERE PERIODE = 2
                    ) REALISASI ON REALISASI.ID_ANGGARAN = REVISI.ID
                    LEFT JOIN (
                        SELECT ID_ANGGARAN,RAPAT_KE FROM stp_usulan_anggaran
                        WHERE AKTIF = 1 AND JENIS_RAPAT = 'REVISI-RKAP'
                    ) USULAN ON USULAN.ID_ANGGARAN = REVISI.ID
                    WHERE REVISI.ID = '$id_anggaran'
                    GROUP BY 
                        REVISI.KODE_ANGGARAN
                ) a
            ";
        }else{
            $isi = "
                SELECT
                    ID,
                    ID_ANGGARAN,
                    KODE_ANGGARAN,
                    KODE_PERKIRAAN,
                    URAIAN,
                    JUMLAH,
                    SATUAN,
                    RKAP,
                    TAHUN,
                    HARGA,
                    DEPARTEMEN,
                    DIVISI,
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
                    SETUJU,
                    STS_TAMBAHAN,
                    STS_REVISI,
                    RAPAT_KE,
                    REALISASI,
                    (CASE
                        WHEN (REALISASI > RKAP && REALISASI > 0) THEN 'merah'
                        WHEN (REALISASI < RKAP && REALISASI > 0) THEN 'kuning'
                        WHEN (STS_TAMBAHAN = 4) THEN 'orange'
                        WHEN (STS_TAMBAHAN = 3) THEN 'ungu'
                        WHEN (STS_TAMBAHAN = 1 && STS_REVISI = 6) THEN 'biru'
                        WHEN (STS_TAMBAHAN = 2 && STS_REVISI = 6) THEN 'biru'
                        ELSE 'putih'
                    END) AS WARNA
                FROM(
                   SELECT
                        DASAR.ID_ANGGARAN AS ID,
                        DASAR.ID_ANGGARAN,
                        DASAR.KODE_ANGGARAN,
                        DASAR.KODE_PERKIRAAN,
                        DASAR.URAIAN,
                        DASAR.JUMLAH AS JUMLAH,
                        DASAR.SATUAN,
                        (CASE
                            WHEN DASAR.JENIS_ANGGARAN = 'Barang' THEN
                                DASAR.TOTAL
                            ELSE
                                DASAR.TOTAL_PELAKSANAAN
                        END) AS RKAP,
                        DASAR.TAHUN,
                        DASAR.HARGA AS HARGA,
                        c.nama DEPARTEMEN,
                        b.nama DIVISI,
                        DASAR.JANUARI,
                        DASAR.FEBRUARI,
                        DASAR.MARET,
                        DASAR.APRIL,
                        DASAR.MEI,
                        DASAR.JUNI,
                        DASAR.JULI,
                        DASAR.AGUSTUS,
                        DASAR.SEPTEMBER,
                        DASAR.OKTOBER,
                        DASAR.NOVEMBER,
                        DASAR.DESEMBER,
                        DASAR.SETUJU,
                        DASAR.STS_TAMBAHAN,
                        DASAR.STS_REVISI,
                        USULAN.RAPAT_KE,
                        SUM(
                            (CASE
                                WHEN REALISASI.ID_SPK != 0 THEN 
                                    REALISASI.HARGA_SATUAN_SPK * REALISASI.VOLUME_SPK
                                ELSE 
                                    (CASE
                                        WHEN REALISASI.ID_RAB != 0 THEN 
                                            REALISASI.VOLUME_RAB * REALISASI.HARGA_SATUAN_RAB
                                        ELSE 
                                            REALISASI.VOLUME_DPBM * REALISASI.HARGA_SATUAN_DPBM
                                    END)
                            END)
                        ) AS REALISASI
                    FROM stp_anggaran_dasar DASAR
                    LEFT JOIN stp_divisi b ON b.id = DASAR.DIVISI
                    LEFT JOIN stp_departemen c ON c.id = DASAR.DEPARTEMEN
                    LEFT JOIN (
                        SELECT * FROM stp_realisasi_anggaran
                        WHERE PERIODE = 1
                    ) REALISASI ON REALISASI.ID_ANGGARAN = DASAR.ID_ANGGARAN
                    LEFT JOIN (
                        SELECT ID_ANGGARAN,RAPAT_KE FROM stp_usulan_anggaran
                        WHERE AKTIF = 1 AND JENIS_RAPAT = 'RKAP'
                    ) USULAN ON USULAN.ID_ANGGARAN = DASAR.ID_ANGGARAN
                    WHERE DASAR.ID_ANGGARAN = '$id_anggaran'
                    GROUP BY 
                        DASAR.KODE_ANGGARAN
                ) a
            ";
        }

        $sql = $isi;
        
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
        $harga_rkap,
        $volume_rkap,
        $total_rkap,
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
                '$harga_rkap',
                '$volume_rkap',
                '$total_rkap',
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

    function update_revisi_anggaran(
        $id_anggaran,
        $jenis_anggaran,
        $volume_rkap,
        $harga_rkap,
        $total_rkap,
        $januari,$februari,$maret,$april,$mei,$juni,$juli,$agustus,$september,$oktober,$november,$desember){

        $sql = "";
        if($jenis_anggaran == "Barang"){
            $sql = "
                UPDATE stp_revisi_anggaran SET
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
                WHERE ID = $id_anggaran
            ";
        }else{
            $sql = "
                UPDATE stp_revisi_anggaran SET
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
                WHERE ID = $id_anggaran
            ";
        }
        $this->db->query($sql);
    }

    function update_revisi_rkap(
        $id_anggaran,
        $harga_revisi,
        $jumlah_revisi,
        $total_revisi,
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
                HARGA_USULAN = '$harga_revisi',
                JUMLAH_USULAN = '$jumlah_revisi',
                TOTAL_USULAN = '$total_revisi',
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
                    WHERE USULAN.AKTIF = 1 AND USULAN.JENIS_RAPAT = 'REVISI-RKAP'
                    GROUP BY
                        USULAN.KODE_ANGGARAN
                ) a
            ) b
            GROUP BY b.NAMA_DEP
        ";
        $query = $this->db->query($sql);
        return $query->result();
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
            FROM stp_revisi_anggaran DASAR
            LEFT JOIN(
                SELECT * FROM stp_usulan_anggaran
                WHERE AKTIF = 1 AND JENIS_RAPAT = 'REVISI-RKAP'
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