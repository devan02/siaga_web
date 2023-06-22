<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beranda extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('edit_pegawai_m','model2');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{

		$msg_beranda = 0;
		$tab = 0;
		$error_pass = 0;

		if($this->input->post('simpan')){ 

			$msg_beranda = 1;
			$tab = 2;			

			$nama_pegawai = $this->input->post('nama_pegawai');
			$alamat = $this->input->post('alamat');
			$kode_pos = $this->input->post('kode_pos');
			$telpon = $this->input->post('telpon');
			$tmp_lahir = $this->input->post('tmp_lahir');
			$tgl_lahir = $this->input->post('tgl_lahir');
			$jk = $this->input->post('jk');
			$agama = $this->input->post('agama');
			$id_peg2 = $this->input->post('id_peg2');

			$this->model2->update_user_beranda($id_peg2, $nama_pegawai, $alamat, $kode_pos, $telpon, $tmp_lahir, $tgl_lahir, $jk, $agama);

			if($this->input->post('temp_image') == 1 ){

				$potret     = $this->model2->get_pegawai_by_id($id_peg2)->FOTO;
				 if($potret != "" || $potret != null ){
					$path  = "./files/user/".$potret;
					unlink($path); 		
				}

				$name_array = array();
				$count = count($_FILES['userfile']['size']);

				foreach($_FILES as $key=>$value)
				for($s=0; $s<=$count-1; $s++) {
				$_FILES['userfile']['name']    	= str_replace(' ', '_', $value['name'][$s]) ;
				$_FILES['userfile']['type']    	= $value['type'][$s];
				$_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
				$_FILES['userfile']['error']    = $value['error'][$s];
				$_FILES['userfile']['size']    	= $value['size'][$s];  
				$config['upload_path'] = './files/user/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '200000';
				$config['max_width']  = '10000';
				$config['max_height']  = '10000';
				$this->load->library('upload', $config);
				$this->upload->do_upload();
				$data = $this->upload->data();
				$name_array[] = $data['file_name'];

				$this->model2->edit_foto_user($id_peg2, str_replace(' ', '_', $value['name'][$s]) );
				}
			}


		} else if($this->input->post('ganti_password')){ 

			$tab = 3;	

			$pass_tmp = $this->input->post('pass_tmp');
			$pass_lama = $this->input->post('pass_lama');
			$pass_baru1 = $this->input->post('pass_baru1');
			$pass_baru2 = $this->input->post('pass_baru2');
			$id_peg = $this->input->post('id_peg_pass');

			if($pass_tmp != md5(md5($pass_lama)) ) {
				$error_pass = 1;
			} else if($pass_baru1 != $pass_baru2){
				$error_pass = 2;
			} else {
				$msg_beranda = 1;
				$this->model2->update_user_password($id_peg, md5(md5($pass_baru2)));
			}

		}

		$sessi = $this->session->userdata('masuk_bos');
		if($sessi){
			$data = array(
			  'page' => "",
			  'induk_menu' => "",
			  'menu' => "",
			  'title' => "BERANDA SIAGA TIRTA PATRIOT KOTA BEKASI",
			  'post_url' => "dashboard/beranda",
			  'msg_beranda' => $msg_beranda,
			  'tab' => $tab,
			  'error_pass' => $error_pass,
			);
			$this->load->view('dashboard/beranda_v', $data);
		}else{
			redirect('login');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */