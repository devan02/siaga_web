<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_sub_bagian_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
		$this->load->model('master_sub_bagian_m','model');
		$sess_user = $this->session->userdata('masuk_bos');
    	$id_user = $sess_user['id'];
	    if($id_user == "" || $id_user == null){
	        redirect('login');
	    }
	}

	function index()
	{
		$msg = "";

		if($this->input->post('simpan')){
			$msg = 1;

			$kode_sub_bagian = addslashes($this->input->post('kode_sub_bagian'));
			$nama_sub_bagian = addslashes($this->input->post('nama_sub_bagian'));
			$keterangan      = addslashes($this->input->post('keterangan'));
			$id_bagian       = $this->input->post('id_bagian');

			$this->master_model_m->save_log('Simpan', 'Melakukan penyimpanan data pada menu', 'MASTER SUB BAGIAN', 'dengan Nama Sub Bagian', $nama_sub_bagian);
			$this->model->simpan_sub_bagian($kode_sub_bagian, $nama_sub_bagian, $keterangan, $id_bagian);

		} else if($this->input->post('id_hapus')){

			$id_hapus = $this->input->post('id_hapus');
			$nama_sub_bagian = $this->model->get_sub_bagian_by_id($id_hapus)->NAMA;
			$msg = 3;
			$this->master_model_m->save_log('Hapus', 'Melakukan hapus data pada menu', 'MASTER SUB BAGIAN', 'dengan Nama Sub Bagian', $nama_sub_bagian);
			$this->model->hapus_sub_bagian($id_hapus);

		} else if($this->input->post('edit')){
			$id_edit = $this->input->post('id_sub_bagian_ed');
			$nama_sub = addslashes($this->input->post('nama_sub_bagian_ed'));			
			$keterangan = addslashes($this->input->post('keterangan_ed'));			
			$kode = addslashes($this->input->post('kode_sub_bagian_ed'));			
			$msg = 1;
			$this->master_model_m->save_log('Ubah', 'Melakukan ubah data pada menu', 'MASTER SUB BAGIAN', 'dengan Nama Sub Bagian', $nama_sub);

			$this->model->edit_bagian($id_edit, $kode, $nama_sub, $keterangan);			
		
		} else if($this->input->post('excel')){
			$this->print_excel();
		} else if($this->input->post('pdf')){
			$this->print_pdf();
		}

		$get_sub_bagian = $this->model->get_sub_bagian_all();
		$get_bagian     = $this->model->get_bagian_all();


		$data = array(
		  'page' => "dashboard/master_sub_bagian_v",
		  'induk_menu' => "setup_data",
		  'menu' => "master_sub_bagian",
		  'title' => "MASTER SUB BAGIAN",
		  'dt' => $get_sub_bagian,		
		  'get_bagian' => $get_bagian,		
		  'post_url' => "dashboard/master_sub_bagian_c",  
		  'msg'  => $msg,
		);
		$this->load->view('dashboard/beranda_v', $data);
	}

	function print_excel(){

		$get_sub_bagian = $this->model->get_sub_bagian_all();

		$data = array(
		  'dt' => $get_sub_bagian,		
		);
		$this->load->view('dashboard/excel/master_sub_bagian_xls', $data);
	}

	function print_pdf(){
		$get_sub_bagian = $this->model->get_sub_bagian_all();

		$data = array(
		  'dt' => $get_sub_bagian,		
		);
		$this->load->view('dashboard/pdf/master_sub_bagian_pdf', $data);
	}

	function cek_kode(){
		$kode_sub_bagian = $this->input->post('kode_sub_bagian');
		$hasil = 0;

		$cek = $this->model->cek_kode_subbagian($kode_sub_bagian);
		if(count($cek) > 0){
			$hasil = 1;
		} else {
			$hasil = 0;
		}

		echo json_encode($hasil);
	}

	function cek_kode_ed(){
		$kode_sub_bagian = $this->input->post('kode_sub_bagian');
		$hasil = 0;

		$cek = $this->model->cek_kode_subbagian($kode_sub_bagian);
		if(count($cek) >= 1){
			$hasil = 1;
		} else {
			$hasil = 0;
		}

		echo json_encode($hasil);
	}

	function get_data_sub_bagian(){
		$id = $this->input->post('id');
		$data = $this->model->get_sub_bagian_by_id($id);

		echo json_encode($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */