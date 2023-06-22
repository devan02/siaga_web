<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tambah_pegawai_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_all_departemen(){
		$sql = "
			SELECT * FROM stp_departemen ORDER BY ID 
		";
		return $this->db->query($sql)->result();
	}

	function simpan_user($nip, $nama_pegawai, $alamat, $kode_pos, $telpon, $tmp_lahir, $tgl_lahir, $jk, $agama, $jabatan, $departemen, $divisi){
		$sql = "
			INSERT INTO stp_pegawai 
			(
			  NIP,
			  NAMA,
			  ALAMAT,
			  KODE_POS,
			  NO_TELP,
			  KOTA_LAHIR,
			  TGL_LAHIR,
			  J_KEL,
			  AGAMA,
			  JABATAN,
			  ID_DEPARTEMEN,
			  ID_DIVISI,
			  STATUS
			)
			VALUES
			(
			  '$nip',
			  '$nama_pegawai',
			  '$alamat',
			  '$kode_pos',
			  '$telpon',
			  '$tmp_lahir',
			  '$tgl_lahir',
			  '$jk',
			  '$agama',
			  '$jabatan',
			  $departemen,
			  $divisi,
			  1
			)
		";

		$this->db->query($sql);
	}

	function edit_foto_user($nip, $foto){
		$sql = "
			UPDATE stp_pegawai SET FOTO = '$foto'
			WHERE NIP = '$nip'
		";

		$this->db->query($sql);
	}

}

?>