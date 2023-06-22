<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$data = array(
			'url'	=> base_url().'login/sign_in',
		);
		$this->load->view('login_v',$data);
	}

	function cek_uspa($tabel = '', $uspa = array()){
        $where = '';
        foreach($uspa as $key => $value){
            $where .= " AND $key = '$value' AND STATUS = 1";
        }
        $data = $this->db->query("SELECT u.* FROM $tabel u WHERE 1=1 $where");

        return $data;
    }

	function sign_in(){
		$user = $this->input->post('username');
		$pass = md5(md5($this->input->post('password')));
		$tabel = "stp_pegawai";
		$uspa = array(
			'USERNAME'	=> $user,
			'PASSWORD'	=> $pass
		);
		$cek_uspa = $this->cek_uspa($tabel,$uspa);
		$jumlah = $cek_uspa->num_rows();
		
		if($jumlah != 0){
			$data = $cek_uspa->row();
			$sess_array = array(
				'id'		=> $data->ID,
				'username'	=> $data->USERNAME,
				'nama'		=> $data->NAMA,
				'id_departemen'	=> $data->ID_DEPARTEMEN,
				'id_divisi'	=> $data->ID_DIVISI
			);
			$this->session->set_userdata('masuk_bos', $sess_array);
			$session_data = $this->session->userdata('masuk_bos');
			redirect('dashboard/beranda');
		}else{
			$this->session->set_flashdata('gagal','1');
			redirect('login');
		}
	}

	public function sign_out(){

		$sess_user = $this->session->userdata('masuk_bos');
	    $id_user = $sess_user['id'];

	    if($id_user != "" || $id_user != null){
	        $this->master_model_m->delete_last_login();
			$this->master_model_m->save_last_login();
	    }		

		$sess_array = $this->session->userdata('masuk_bos');
		$this->session->unset_userdata('masuk_bos');
		$this->session->sess_destroy();
		redirect(base_url());
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */