<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_model_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}


	function get_user_detail($id_user){
        $sql = "
            SELECT a.*, b.NAMA AS DEPARTEMEN_USER, c.NAMA AS DIVISI_USER
            FROM stp_pegawai a
            LEFT JOIN stp_departemen b ON a.ID_DEPARTEMEN = b.ID 
            LEFT JOIN stp_divisi c ON a.ID_DIVISI = c.ID
            WHERE a.ID = $id_user
        ";
        return $this->db->query($sql)->row();
    }

    function get_bagian_all($key){
        $where = "1 = 1";
        if($key != ""){
            $where = $where." AND (KODE LIKE '%$key%' OR NAMA LIKE '%$key%')";
        }
        $sql = "SELECT * FROM stp_departemen WHERE $where ORDER BY ID DESC LIMIT 0,10";
        return $this->db->query($sql)->result();
    }

    function save_log($jenis, $kegiatan, $modul, $kegiatan2, $objek){
        $tgl = date('d-m-Y');
        $jam = date('H:i:s');
        $ip_addr = $_SERVER['REMOTE_ADDR'];

        $sess_user = $this->session->userdata('masuk_bos');
        $id_user = $sess_user['id'];

        $sql = "
            INSERT INTO stp_log_user 
            (ID_PEGAWAI, TANGGAL, JAM, JENIS, KEGIATAN, MODUL, OBJEK, IP_ADDR, KEGIATAN2)
            VALUES 
            ($id_user, '$tgl', '$jam', '$jenis', '$kegiatan', '$modul', '$objek', '$ip_addr', '$kegiatan2')
        ";

         $this->db->query($sql);
    }

    function get_log_user($id_user){
        $sql = "
            SELECT * FROM stp_log_user WHERE ID_PEGAWAI = $id_user
            ORDER BY ID DESC
        ";
        return $this->db->query($sql)->result();
    }

    function delete_last_login(){

        $sess_user = $this->session->userdata('masuk_bos');
        $id_user = $sess_user['id'];
        $sql = "
            DELETE FROM stp_last_login WHERE ID_PEGAWAI = $id_user
        ";

         $this->db->query($sql);
    }

    function save_last_login(){
        $tgl = date('d-m-Y');
        $jam = date('H:i:s');
        $ip_addr = $_SERVER['REMOTE_ADDR'];

        $sess_user = $this->session->userdata('masuk_bos');
        $id_user = $sess_user['id'];
        $browser_agent = $_SERVER['HTTP_USER_AGENT'];
        $pc_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);

        $sql = "
            INSERT INTO stp_last_login
            (ID_PEGAWAI, TANGGAL, JAM, IP_ADDR, PC_NAME, AGENT)
            VALUES 
            ($id_user, '$tgl', '$jam', '$ip_addr', '$pc_name', '$browser_agent')
        ";

         $this->db->query($sql);
    }

    function get_last_login_all($id_user){
        $sql = "
            SELECT * FROM stp_last_login WHERE ID_PEGAWAI = $id_user
        ";

        return $this->db->query($sql)->result();
    }

    function get_last_login($id_user){
        $sql = "
            SELECT * FROM stp_last_login WHERE ID_PEGAWAI = $id_user
        ";

        return $this->db->query($sql)->row();
    }

    function get_menu_lev1($id_user){
        $sql = "
            SELECT a.*, hak.ID_PEGAWAI AS STS FROM stp_menu_lev1 a
            LEFT JOIN stp_hak_akses hak ON a.ID = hak.ID_MENU2 AND hak.ID_PEGAWAI = $id_user
            ORDER BY a.URUT ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_menu_lev2($id_induk_menu, $id_user){
        $sql = "
            SELECT a.*, hak.ID_PEGAWAI AS STS FROM stp_menu_lev2 a
            LEFT JOIN stp_hak_akses hak ON a.ID = hak.ID_MENU1 AND hak.ID_PEGAWAI = $id_user
            WHERE a.ID_INDUK_MENU = $id_induk_menu
            ORDER BY a.URUT ASC
        ";

        return $this->db->query($sql)->result();
    }

    function cek_menu_akses($id_induk_menu, $id_user){

        $sql = "
            SELECT a.*, hak.ID_PEGAWAI AS STS FROM stp_menu_lev2 a
            JOIN stp_hak_akses hak ON a.ID = hak.ID_MENU1 AND hak.ID_PEGAWAI = $id_user
            WHERE a.ID_INDUK_MENU = $id_induk_menu
            ORDER BY a.URUT ASC
        ";

        return $this->db->query($sql)->result();

    }

    function get_menu_akses_peg1($id_user, $link){

        $sql = "
        SELECT b.* FROM stp_hak_akses a 
        JOIN stp_menu_lev1 b ON a.ID_MENU2 = b.ID AND a.ID_PEGAWAI = $id_user
        WHERE (b.LINK IS NOT NULL OR b.LINK != '') AND b.LINK = '$link'
        ";

        return $this->db->query($sql)->result();
    }

    function get_menu_akses_peg2($id_user, $link){
        
        $sql = "
        SELECT b.* FROM stp_hak_akses a 
        JOIN stp_menu_lev2 b ON a.ID_MENU1 = b.ID AND a.ID_PEGAWAI = $id_user
        WHERE (b.LINK IS NOT NULL OR b.LINK != '') AND b.LINK = '$link'
        ";

        return $this->db->query($sql)->result();
    }

    function get_ttd($ket){
        $sql = "
        SELECT b.* FROM stp_master_ttd a
        LEFT JOIN stp_master_ttd_detail b ON a.ID = b.ID_TTD
        WHERE a.KET = '$ket'
        ";

        return $this->db->query($sql)->result();
    }


}

?>