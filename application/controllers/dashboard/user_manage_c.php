<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_manage_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_manage_m','model');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{

		$pegawai = $this->model->get_all_pegawai();
		$edit = '';
		$nama_pegawai_cari = '';
		$id_peg = '';
		$peg_edit = '';
		$msg = '';
		$err = 0;

		$sessi = $this->session->userdata('masuk_bos');
		$id_pegawai = $sessi['id'];
		$sql_peg = "SELECT * FROM stp_pegawai WHERE ID = '$id_pegawai'";
		$q_peg = $this->db->query($sql_peg)->row();
		$level = $q_peg->LEVEL;

		if($this->input->post('filter')){
			$edit = 1;

			$nama_pegawai_cari = $this->input->post('nama_pegawai_cari');
			$id_peg            = $this->input->post('id_peg');

			$peg_edit = $this->model->get_pegawai_by_id($id_peg);

		} else if($this->input->post('simpan')){

			$edit = 1;

			$id_peg2   = $this->input->post('id_peg2');
			$username  = $this->input->post('username');
			$pass1     = $this->input->post('pass1');
			$pass2 	   = $this->input->post('pass2');
			$sts 	   = $this->input->post('sts');
			$edit_pass = $this->input->post('edit_pass');
			$level_akun = $this->input->post('level_akun');

			$id_peg            = $id_peg2;
			$nama_pegawai_cari = $this->input->post('nama_pegawai');
			

			if($pass1 != $pass2){
				$err = 1;
			} else {
				$err = 0;
				$msg = 1;

				$this->model->update_user_login($id_peg, $username, $sts, $level_akun);

				$pass3 = md5(md5($pass2));
				if($edit_pass == 1){
					$this->model->update_user_password($id_peg, $pass3);
				}
			}

			$peg_edit = $this->model->get_pegawai_by_id($id_peg);

		}
		
		$data = array(
		  'page' => "dashboard/user_manage_v",
		  'induk_menu' => "user_manage",
		  'menu' => "login_user",
		  'title' => "LOGIN PENGGUNA",
		  'post_url' => "dashboard/user_manage_c",  
		  'pegawai' => $pegawai,
		  'edit' => $edit,
		  'nama_pegawai_cari' => $nama_pegawai_cari,
		  'id_peg' => $id_peg,
		  'peg_edit' => $peg_edit,
		  'msg' => $msg,
		  'err' => $err,
		  'level' => $level,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cek_username(){
		$username = $this->input->post('val');
		$cek = $this->model->cek_username($username);

		echo json_encode($cek);
	}

	function get_pegawai(){
		$keyword = $this->input->post('keyword');
		$where = "1 = 1";
		if($keyword != ""){
			$where = $where." AND (NIP LIKE '%$keyword%' OR NAMA LIKE '%$keyword%')";
		}
		$sql = "SELECT * FROM stp_pegawai WHERE $where ORDER BY ID LIMIT 10";
		$data = $this->db->query($sql)->result();
		echo json_encode($data);
	}

	function get_pegawai_by_id(){
		$id = $this->input->post('id');
		$sql = "SELECT * FROM stp_pegawai WHERE ID = $id";
		$data = $this->db->query($sql)->row();
		echo json_encode($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */