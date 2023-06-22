<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tambah_pegawai_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('tambah_pegawai_m','model');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
		$msg = "";
		$departemen = $this->model->get_all_departemen();

		if($this->input->post('simpan')){ 

			$msg = 1;

			$nip = $this->input->post('nip');
			$nama_pegawai = addslashes($this->input->post('nama_pegawai'));
			$alamat = addslashes($this->input->post('alamat'));
			$kode_pos = addslashes($this->input->post('kode_pos'));
			$telpon = addslashes($this->input->post('telpon'));
			$tmp_lahir = addslashes($this->input->post('tmp_lahir'));
			$tgl_lahir = $this->input->post('tgl_lahir');
			$jk = $this->input->post('jk');
			$agama = $this->input->post('agama');
			$jabatan = $this->input->post('jabatan');
			$departemen = $this->input->post('departemen');
			$divisi = $this->input->post('divisi');

			$this->master_model_m->save_log('Simpan', 'Melakukan penyimpanan data pada menu', 'TAMBAH PEGAWAI', 'dengan NIP', $nip);
			$this->model->simpan_user($nip, $nama_pegawai, $alamat, $kode_pos, $telpon, $tmp_lahir, $tgl_lahir, $jk, $agama, $jabatan, $departemen, $divisi);

			if($this->input->post('temp_image') == 1 ){

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

						$this->model->edit_foto_user($nip, str_replace(' ', '_', $value['name'][$s]) );
						}
			}

		}

		$data = array(
		  'page' => "dashboard/tambah_pegawai_v",
		  'induk_menu' => "pegawai",
		  'menu' => "tambah_pegawai",
		  'title' => "TAMBAH PEGAWAI",
		  'post_url' => "dashboard/tambah_pegawai_c",  
		  'msg'  => $msg,
		  'departemen' => $departemen,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */