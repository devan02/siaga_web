<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_sumber_dana_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('master_sumber_dana_m','model');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
		$msg = "";
		$err = "";

		if($this->input->post('simpan')){
			
			$sumber = addslashes($this->input->post('sumber'));

			$cek = $this->model->cek_sumber_dana(trim($sumber));

			if(count($cek) > 0){
				$err = 1;
			} else {
				$msg = 1;
				$this->model->save_sumber_dana($sumber);
			}

			$this->master_model_m->save_log('Simpan', 'Melakukan simpan data pada menu', 'MASTER SUMBER DANA', 'dengan Nama Sumber Dana', $sumber);

		} else if($this->input->post('id_hapus')){

			$id_hapus = $this->input->post('id_hapus');
			//$nama_sub_bagian = $this->model->get_sub_bagian_by_id($id_hapus)->NAMA;
			$msg = 3;
			//$this->master_model_m->save_log('Hapus', 'Melakukan hapus data pada menu', 'MASTER SUB BAGIAN', 'dengan Nama Sub Bagian', $nama_sub_bagian);
			$this->model->hapus_sumber_dana($id_hapus);

		} else if($this->input->post('edit')){

			$id = $this->input->post('id_sumber_dana_ed');
			$nama = addslashes($this->input->post('sumber_dana_ed'));
			$msg = 1;

			$this->master_model_m->save_log('Ubah', 'Melakukan ubah data pada menu', 'MASTER SUMBER DANA', 'dengan Nama Sumber Dana', $nama);
			$this->model->edit_sumber_dana($id, $nama);

		}

		$data = array(
		  'page' => "dashboard/master_sumber_dana_v",
		  'induk_menu' => "setup_data",
		  'menu' => "master_dana",
		  'title' => "MASTER SUMBER DANA",
		  'post_url' => "dashboard/master_sumber_dana_c",  
		  'msg'  => $msg,
		  'err'  => $err,
		  'dt'   => $this->model->get_all_dana(),
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function cek_dana(){
		$sumber_dana = $this->input->post('sumber_dana');
		$hasil = 0;

		$cek = $this->model->cek_sumber_dana(trim($sumber_dana));
		if(count($cek) >= 1){
			$hasil = 1;
		} else {
			$hasil = 0;
		}

		echo json_encode($hasil);
	}

	function get_data_dana(){
		$id = $this->input->post('id');
		$data = $this->model->get_dana_by_id($id);

		echo json_encode($data);
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */