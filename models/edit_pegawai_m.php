<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_pegawai_m extends CI_Model
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

	function get_all_pegawai(){
		$sql = "
			SELECT ID, NIP, NAMA FROM stp_pegawai ORDER BY ID 
		";
		return $this->db->query($sql)->result();
	}

	function get_divisi_peg($id_dep){
		$sql = "
			SELECT * FROM stp_divisi 
			WHERE ID_DEPARTEMEN = $id_dep
			ORDER BY ID 
		";
		return $this->db->query($sql)->result();
	}

	function get_pegawai_by_id($id_peg){
		$sql = "
			SELECT * FROM stp_pegawai 
			WHERE ID = $id_peg
			ORDER BY ID 
		";
		return $this->db->query($sql)->row();
	}

	function update_user($id_peg2, $nip, $nama_pegawai, $alamat, $kode_pos, $telpon, $tmp_lahir, $tgl_lahir, $jk, $agama, $jabatan, $departemen, $divisi){
		$sql = "
			UPDATE stp_pegawai SET

			  NIP = '$nip',
			  NAMA = '$nama_pegawai',
			  ALAMAT = '$alamat',
			  KODE_POS = '$kode_pos',
			  NO_TELP = '$telpon',
			  KOTA_LAHIR = '$tmp_lahir',
			  TGL_LAHIR = '$tgl_lahir',
			  J_KEL = '$jk',
			  AGAMA = '$agama',
			  JABATAN = '$jabatan',
			  ID_DEPARTEMEN = $departemen,
			  ID_DIVISI = $divisi
			
			WHERE ID = $id_peg2
		";

		$this->db->query($sql);
	}

	function update_user_beranda($id_peg2, $nama_pegawai, $alamat, $kode_pos, $telpon, $tmp_lahir, $tgl_lahir, $jk, $agama){
		$sql = "
			UPDATE stp_pegawai SET

			  NAMA = '$nama_pegawai',
			  ALAMAT = '$alamat',
			  KODE_POS = '$kode_pos',
			  NO_TELP = '$telpon',
			  KOTA_LAHIR = '$tmp_lahir',
			  TGL_LAHIR = '$tgl_lahir',
			  J_KEL = '$jk',
			  AGAMA = '$agama'
			
			WHERE ID = $id_peg2
		";

		$this->db->query($sql);
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

	function edit_foto_user($id_peg, $foto){
		$sql = "
			UPDATE stp_pegawai SET FOTO = '$foto'
			WHERE ID = $id_peg
		";

		$this->db->query($sql);
	}

	function update_user_password($id_peg, $pass){
		$sql = "
			UPDATE stp_pegawai SET PASSWORD = '$pass'
			WHERE ID = $id_peg
		";
		$this->db->query($sql);
	}

}

?>