<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_pegawai_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('edit_pegawai_m','model');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
		$msg = "";
		$departemen_all = $this->model->get_all_departemen();
		$get_all_pegawai = $this->model->get_all_pegawai();
		$edit = '';
		$nama_pegawai_cari = '';
		$id_peg = '';
		$peg_edit = '';

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
			$id_peg2 = $this->input->post('id_peg2');

			$this->model->update_user($id_peg2, $nip, $nama_pegawai, $alamat, $kode_pos, $telpon, $tmp_lahir, $tgl_lahir, $jk, $agama, $jabatan, $departemen, $divisi);

			if($this->input->post('temp_image') == 1 ){

						$potret     = $this->model->get_pegawai_by_id($id_peg2)->FOTO;
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

						$this->model->edit_foto_user($id_peg2, str_replace(' ', '_', $value['name'][$s]) );
						}
			}

			$edit = 1;
			$peg_edit = $this->model->get_pegawai_by_id($id_peg2);
			$id_peg = $id_peg2;
			$nama_pegawai_cari = $peg_edit->NAMA;

		} else if($this->input->post('filter')){ 
			$edit = 1;

			$nama_pegawai_cari = $this->input->post('nama_pegawai_cari');
			$id_peg            = $this->input->post('id_peg');

			$peg_edit = $this->model->get_pegawai_by_id($id_peg);

		}

		$data = array(
		  'page' => "dashboard/edit_pegawai_v",
		  'induk_menu' => "pegawai",
		  'menu' => "edit_pegawai",
		  'title' => "EDIT PEGAWAI",
		  'post_url' => "dashboard/edit_pegawai_c",  
		  'msg'  => $msg,
		  'departemen' => $departemen_all,
		  'edit' => $edit,
		  'get_all_pegawai' => $get_all_pegawai,
		  'nama_pegawai_cari' => $nama_pegawai_cari,
		  'id_peg' => $id_peg,
		  'peg_edit' => $peg_edit,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */